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
 *  | Date: 2020/10/6 上午12:40
 *  +----------------------------------------------------------------------
 *  | Description:   ImAdminThink 权限->用户组管理
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\controller;

use Hahadu\ImAdminThink\model\AuthGroup;
use Hahadu\ImAdminThink\model\AuthGroupAccess;
use Hahadu\ImAdminThink\model\AuthRule;
use think\App;
use think\facade\Db;
use think\facade\Request;

class AdminBaseRuleGroupController extends AdminBaseController
{
    protected $auth_rule;
    protected $auth_group;
    protected $auth_group_access;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->auth_rule = new AuthRule();
        $this->auth_group = new AuthGroup();
        $this->auth_group_access = new AuthGroupAccess();
        // $this->Users = new Users();
    }
    /**
     * 分配权限
     */
    public function rule_group(){
            // $data = Request::post();
            $map=array(
                'id'=>Request::post('id'),
            );
            $data['rules']=implode(',', Request::post('rule_ids'));
            $result=$this->auth_group->editData($map,$data);
            return $result;
    }

    /****
     * 获取权限信息
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function rule_group_view($id){
        $group_data=$this->auth_group::where(array('id'=>$id))->find();
        $group_data['rules']=explode(',', $group_data['rules']);
        // 获取规则数据
        $rule_data=$this->auth_rule->getTreeData('level','id','title');
        $result=array(
            'group_data'=>$group_data,
            'rule_data'=>$rule_data
        );
        return $result;
    }

    /****
     * 查找用户
     * @param \think\Request $request
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function base_check_user(\think\Request $request){
        $username = $request->param('username');
        $group_id = $request->param('group_id');
        $group_name=Db::name('Auth_group')->getFieldById($group_id,'title');
        $uids=$this->auth_group_access->getUidsByGroupId($group_id);
        // 判断用户名是否为空
        if(empty($username)){
            $user_data=[];
        }else{
            $user_data=Db::name('Users')->where(array('username'=>$username))->select();
        }
        $result=array(
            'group_name'=>$group_name,
            'uids'=>$uids,
            'user_data'=>$user_data,
        );
        return $result;
    }

    /****
     * 添加用户到管理组
     * @param \think\Request $request
     * @return int
     */
    public function add_user_from_group(\think\Request $request){
        $data = $request->param();
        $map=array(
            'uid'=>$data['uid'],
            'group_id'=>$data['group_id']
        );
        $count=$this->auth_group_access->where($map)->count();
        $result = ($count==0)? $this->auth_group_access->addData($data):420301;
        return $result;
    }

    /****
     * 用户从管理组移除
     * @param \think\Request $request
     * @return bool|int
     */
    public function delete_user_from_group(\think\Request $request){
        $result=$this->auth_group_access->deleteData($request->param(),true);
        return $result;
    }




}