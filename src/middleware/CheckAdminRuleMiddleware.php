<?php
namespace Hahadu\ThinkAdmin\middleware;
use Hahadu\ThinkAuth\Auth;
use Hahadu\ThinkJumpPage\JumpPage;
use Hahadu\ThinkUserLogin\Builder\JWTBuilder;
use think\facade\Config;
use think\facade\Request;
use think\facade\Session;

/****
 * Class CheckAdminRuleMiddleware
 * 管理员权限验证
 * @package Hahadu\ImAdminThink\middleware
 */
class CheckAdminRuleMiddleware
{
    /****
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next){
        $auth = new Auth();
        $root_name = parse_name(Request::rootUrl()); //应用名
        $controller_name = parse_name(Request::controller()); //控制名
        $action_name = parse_name(Request::action());   //操作名
        $rule_url = $root_name .'/'. $controller_name .'/'. $action_name;
        if(Config::get('login.JWT_login')==true) {
            $token = $request->param(Config::get('login.token_name'));
            $parser = JWTBuilder::parser($token);
            if (is_int($parser)) {
                JumpPage::jumpPage($parser)->send();
            }
            $uid = $parser->getClaim('uid');
        }else{
            $uid =Session::get('user.id');
        }
        $check_result = $auth->check($rule_url,$uid);
        if(!$check_result){

            JumpPage::jumpPage(300001,'/index')->send();
        }
        return $next($request);

    }
}