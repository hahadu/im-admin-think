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
 *  | Date: 2020/9/19 下午10:02
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

// 这是系统自动生成的公共文件
/****
 * 判断是否为POST提交
 */
if(!function_exists('is_post')){
    function is_post(){
        return \think\facade\Request::isPost();
    }
}
if(!function_exists('status_code')){
    function status_code($code){
        $result = \Hahadu\ThinkJumpPage\JumpPage::status_code($code);
        return $result;
    }
}

/****
 * @param $code
 * @param string|null $jumpUrl
 * @param int|null $waitSecond
 */
if(!function_exists('jumpPag')){
    function jumpPag($code,$jumpUrl = null,$waitSecond = null){
        return \Hahadu\ThinkJumpPage\JumpPage::jumpPage($code,$jumpUrl,$waitSecond);
    }
}
/**
 * 返回用户id
 * @return integer 用户id
 */
if(!function_exists('get_uid')){
    function get_uid(){
        return \think\facade\Session::get('user.id');
    }
}
/**
 * 检测是否登录
 * @return boolean 是否登录
 */
if(!function_exists('check_login')){
    function check_login(){
        if (!empty(get_uid())){
            return true;
        }else{
            return false;
        }
    }
}

