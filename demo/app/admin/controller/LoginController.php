<?php
declare (strict_types = 1);

namespace app\admin\controller;
use Hahadu\ThinkUserLogin\controller\BaseLoginController;
use think\facade\View;
use think\Request;

class LoginController extends BaseLoginController
{
    public function __construct()
    {
        parent::__construct();
        View::assign('title','管理员登录面板');
    }
    public function index()
    {

        return view();
    }
    public function login()
    {
        $result = parent::login();
        if($result['code'] == 100003){
            $jumpUrl = session('?login.redirect') ? session('login.redirect') : '/admin/index/index';
            session('login',null);
        }else{
            $jumpUrl = '/admin/login/index';
        }

        return jump_page($result['code'],$jumpUrl);
    }
    public function logout()
    {
        $result = parent::logout();
        $jumpUrl = ($result['code'] == 100004)?'/admin/login/index':'/admin/index/index';
        return jump_page($result['code'],$jumpUrl);
    }

    public function re_password(Request $request)
    {
        if(is_post()){
            $result =  parent::re_password($request);
            dump($result);
          //  return $result;
        }else{
            return view();

        }
    }

}
