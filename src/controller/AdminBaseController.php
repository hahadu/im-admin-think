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
 *  | Date: 2020/9/29 下午3:03
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\controller;
use Hahadu\ImAdminThink\model\AdminNav;
use think\App;
use think\facade\View;


class AdminBaseController extends BaseController
{

    public function __construct(App $app)
    {
        parent::__construct($app);

        $adminNav=[
            'adminNav'=>$this->adminNavLevel(),
            'index' => $this->getCurrent(),
            'user' => get_user(),
        ];
        View::assign($adminNav);
    }
    protected function adminNavLevel(){
        $adminNav = new AdminNav;
        $data = $adminNav->getTreeData('level','order_by,id');
        return $data;
    }
    protected function getCurrent(){
        $adminNav = new AdminNav;
        return $adminNav->getCurrentInfo();
    }

    public function __call($method, $args){
        return jump_page(404,'/admin');
    }

}