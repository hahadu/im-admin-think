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
 *  | Date: 2020/10/3 上午1:16
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\controller;


use Hahadu\ImAdminThink\model\AuthGroup;
use Hahadu\ImAdminThink\model\AuthGroupAccess;
use Hahadu\ImAdminThink\model\AuthRule;
use Hahadu\ImAdminThink\model\Users;
use think\App;

class AdminBaseRuleController extends AdminBaseController
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

    /****
     * 显示菜单列表
     * @return Array
     */
    public function get_tree_nav()
    {
        $data=$this->auth_rule->getTreeData('tree','id','title');
        $assign=array(
            'data'=>$data,
            'page_title' => '权限列表',
        );
        return  $assign;
    }
    /**
     * 添加权限
     */
    public function add(){
        if(request()->isPost()){
            $data=request()->post();
            $result=$this->auth_rule->addData($data);
            return $result;
        }
    }
    /**
     * 修改权限
     */
    public function edit(){
        if(request()->isPost()){
            $data=request()->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=$this->auth_rule->editData($map,$data);
            return $result;
        }
    }
    /**
     * 删除权限
     */
    public function delete($id){
        $map=array(
            'id'=>$id
        );
        $result=$this->auth_rule->deleteData($map,false); //软删除
        return $result;
    }
    /****
     * 列出已删除的权限
     */
    public function on_delete_rule(){

        $data = $this->auth_rule->selectDelData();
        $result = [
            'group' =>$data,
        ];
        return $result;
    }
    /****
     * 恢复已删除的权限
     * @param $id
     * @return string
     */
    public function rec_delete_rule($id){
        $map = ['id'=>$id];
        return $this->auth_rule->recDelete($map);
    }



}