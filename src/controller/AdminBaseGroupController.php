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
 *  | Date: 2020/10/5 下午3:24
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ThinkAdmin\controller;

use Hahadu\ThinkAdmin\model\AuthGroup;
use Hahadu\ThinkAdmin\model\AuthGroupAccess;
use Hahadu\ThinkAdmin\model\AuthRule;
use think\App;

class AdminBaseGroupController extends AdminBaseController
{
    private $auth_rule;
    private $auth_group;
    private $auth_group_access;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->auth_rule = new AuthRule();
        $this->auth_group = new AuthGroup();
        $this->auth_group_access = new AuthGroupAccess();
    }
    /**
     * 用户组列表
     */
    public function base_group_list(){
        $data=$this->auth_group->select();
        $result =array(
            'data'=>$data,
        );
        return $result;
    }

    /**
     * 添加用户组
     */
    public function base_add_group(){
        if(request()->isPost()){
            $data = request()->post();
            unset($data['id']);
            $result=$this->auth_group->addData($data);
            return $result;
        }

    }

    /**
     * 修改用户组
     */
    public function base_edit_group(){
        if(request()->isPost()){
            $data = request()->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=$this->auth_group->editData($map,$data);
            return $result;
        }
    }

    /**
     * 删除用户组
     */
    public function base_delete_group($id){
        $result=$this->auth_group->deleteData($id);
        if ($result) {
            return 100013;
        }else{
            return 400011;
        }
    }

    /****
     * 列出已停用的组
     */
    public function on_delete_group(){
        $data = $this->auth_group->selectDelData();
        $result = [
            'group' =>$data,
        ];
        return $result;

    }

    /****
     * 恢复已删除的管理组
     * @param $id
     * @return string
     */
    public function rec_delete_group($id){
        $map = ['id'=>$id];
        $result = $this->auth_group->recDelete($map);
        return $result;
    }




}