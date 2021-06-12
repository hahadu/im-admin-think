<?php
/**
 *  +----------------------------------------------------------------------
 *  | Created by  hahadu (a low phper and coolephp)
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2020. [hahadu] All rights reserved.
 *  +----------------------------------------------------------------------
 *  | SiteUrl: https://github.com/hahadu
 *  +----------------------------------------------------------------------
 *  | Author: hahadu <582167246@qq.com>
 *  +----------------------------------------------------------------------
 *  | Date: 2020/10/7 下午4:15
 *  +----------------------------------------------------------------------
 *  | Description:   ImAdminThink
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\controller;

use Hahadu\Helper\StringHelper;
use Hahadu\ImAdminThink\model\AuthGroup;
use Hahadu\ImAdminThink\model\AuthGroupAccess;
use Hahadu\ImAdminThink\model\AuthRule;
use Hahadu\ImAdminThink\model\Users;
use think\App;
use think\facade\Db;
use think\facade\Request;

class AdminBaseRuleUserController extends AdminBaseController
{
    protected $auth_rule;
    protected $auth_group;
    protected $auth_group_access;
    public function __construct(App $app)
    {
        $this->auth_rule = new AuthRule();
        $this->auth_group = new AuthGroup();
        $this->auth_group_access = new AuthGroupAccess();
        parent::__construct($app);
    }
    /****
     * 管理员列表
     * @return \think\response\View
     */
    public function admin_list(){
        $data= $this->auth_group_access->getAllData();
        $result=array(
            'data'=>$data,

        );
        return $result;
    }

    /**
     * 修改管理员
     */
    public function edit_admin($id){
        if(request()->isPost()){
            $data =request()->post();
            // 组合where数组条件
            $map=array(
                'id'=>$data['id']
            );
            // 修改权限
            if($this->auth_group_access->where(array('uid'=>$data['id']))->find()){
                $this->auth_group_access->deleteData(array('uid'=>$data['id']),true);
            }
            foreach ($data['group_ids'] as $k => $v) {
                $group=array(
                    'uid'=>$data['id'],
                    'group_id'=>$v
                );
                $this->auth_group_access->addData($group);
            }
            // 如果修改密码则md5
            if (!empty($data['password'])) {
                $data['password']=StringHelper::password($data['password']);
            }

            $result=$this->Users->editData($map,array_filter(array_filter($data),function($k){
                return $k !== 'group_ids';
            }, 2));
            return $result;
        }else{
            // 获取用户数据
            $user_data=Db::name('users')->find($id);
            // 获取已加入用户组
            $group_data=Db::name('auth_group_access')
                ->where(array('uid'=>$id))
                ->column('group_id');
            // 全部用户组
            $data=$this->auth_group->select();
            $assign=array(
                'data'=>$data,
                'user_data'=>$user_data,
                'group_data'=>$group_data
            );
            return $assign;
        }
    }
    /****
     * 添加管理员
     * @return \think\response\View
     */
    public function add_admin(){
        if(Request::isPost()){
            $data = request()->post();
            $result = $this->Users->addData(array_filter($data,function($k){
                return $k !== 'group_ids';
            }, 2));
            if($result){
                if (!empty($data['group_ids'])) {
                    foreach ($data['group_ids'] as $k => $v) {
                        $group=array(
                            'uid'=>$result,
                            'group_id'=>$v
                        );
                        $this->auth_group_access->addData($group);
                    }
                }
                // 操作成功
                return 1;
            }else{
                return 0;
            }

        }else{
            $group_data=$this->auth_group->select();
            $result=array(
                'data'=>$group_data,
            );

            return $result;
        }
    }


}