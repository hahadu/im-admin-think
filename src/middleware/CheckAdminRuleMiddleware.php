<?php
namespace Hahadu\ImAdminThink\middleware;
use Hahadu\ThinkAuth\Auth;
use think\facade\Request;

/****
 * Class CheckAdminRuleMiddleware
 * 管理员权限验证
 * @package Hahadu\ImAdminThink\middleware
 */
class CheckAdminRuleMiddleware
{
    /****
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next){
        $auth = new Auth();
        $root_name = parse_name(Request::rootUrl()); //应用名
        $controller_name = parse_name(Request::controller()); //控制名
        $action_name = parse_name(Request::action());   //操作名
        $rule_url = $root_name .'/'. $controller_name .'/'. $action_name;
        $check_result = $auth->check($rule_url,get_uid());
        if(!$check_result){
            jumpPag(300001,'/index')->send();
        }
        return $next($request);

    }
}