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
use think\facade\Request;

class AdminBaseRuleGroupController extends AdminBaseController
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
}