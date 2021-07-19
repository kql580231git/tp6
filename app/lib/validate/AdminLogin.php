<?php
/**
 * AdminLogin.php
 * User: kql
 * Created on 2021/7/16 16:17
 */

namespace app\lib\validate;


class AdminLogin extends BaseValidate
{
    protected $rule = [
        'name'    => 'require|alphaDash|min:5',
        'pwd'     => 'require|alphaDash|min:6',
        'captcha' => 'require|captcha',
    ];

    protected $message = [
        'name'    => '账号长度最小5位，且只能是数字字母_-',
        'pwd'     => '密码长度最小5位，且只能是数字字母_-',
        'captcha' => '验证码错误'
    ];
}