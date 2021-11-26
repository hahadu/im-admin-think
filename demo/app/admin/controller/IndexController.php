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
 *  | Date: 2020/9/19 下午10:00
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

declare (strict_types = 1);

namespace app\admin\controller;
use app\admin\extend\AdminPageStyle;
use Hahadu\Helper\StringHelper;
use Hahadu\ThinkAdmin\controller\AdminBaseController;
use Hahadu\ThinkAdmin\Layout\Content;
use Hahadu\ThinkAdmin\model\AdminNav;
use Hahadu\ThinkAdmin\Support\ErrorCode;
use think\facade\View;
use Hahadu\ThinkAdmin\Facades\Admin;
use think\facade\Request;

class IndexController extends AdminBaseController
{
    public function initialize(){
        parent::initialize();
    }
    public function _index(Content $content)
    {
        View::assign('title','后台首页');
        //    dump(Admin::user()->toArray());
        return view('index/index_adminLte');
    }
    public function index(Content $content){

        return $content->title('后台首页')
            ->view('sss')
            ->render();

    }
    public function jwt(){
        return new Builder();
    }


}
