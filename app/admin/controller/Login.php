<?php


namespace app\admin\controller;


use app\lib\validate\AdminLogin;
use think\facade\Request;

class Login
{
    public function index()
    {

        return view();
    }


    public function doLogIn()
    {
        $request = Request::instance();
        (new AdminLogin())->goCheck();
        echo '我过来了';
    }

}