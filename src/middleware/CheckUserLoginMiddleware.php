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
 *  | Date: 2020/9/29 下午12:25
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin 检测用户是否登录
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\middleware;
use think\facade\Session;
use Hahadu\ThinkJumpPage\JumpPage;

class CheckUserLoginMiddleware{
    public function handle($request, \Closure $next){
        //验证是否登录
        if (Session::get('user.id')==null){
            if(config('jumpPage.ajax')){
                return JumpPage::jumpPage(420102);
            }else{
                JumpPage::jumpPage(420102,'/admin/login')->send();
            }
        }
        return $next($request);
    }
}