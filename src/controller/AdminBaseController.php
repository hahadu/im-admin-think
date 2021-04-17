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
use Hahadu\ImAdminThink\model\Users;

class AdminBaseController extends BaseController
{
    /****
     * @var int 用户ID
     */
    protected $uid;

    /*****
     * @var Users
     */
    protected $Users;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->uid = get_uid();
        $this->Users = new Users();

        View::assign($this->get_home_info());
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
    //获取页面常用信息
    public function get_home_info(){
        return [
            'adminNav'=>$this->adminNavLevel(),
            'index' => $this->getCurrent(),
            'user' => get_user(),
        ];
    }

}