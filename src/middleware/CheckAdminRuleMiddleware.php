<?php
namespace Hahadu\CooleAdmin\middleware;
use Hahadu\ThinkAuth\Auth;
use think\facade\Request;

/**
* Class CheckAdminAuth
* @package app\admin\middleware
* 检测 是否登录
*/
class CheckAdminRuleMiddleware
{
    public function handle($request, \Closure $next){
        //验证是否登录
        $auth = new Auth();
        $root_name = parse_name(Request::rootUrl()); //应用名
        $controller_name = parse_name(Request::controller()); //控制名
        $action_name = parse_name(Request::action());   //操作名
        $rule_url = $root_name .'/'. $controller_name .'/'. $action_name;
        $check_result = $auth->check($rule_url,get_uid());
      //  dump($check_result);
        if(!$check_result){
            //jumpPag(300001,'/index')->send();
        }

        return $next($request);

    }
}