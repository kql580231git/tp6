<?php
/**
 * BaseException.php
 * User: kql
 * Created on 2021/7/16 15:58
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    // http 状态码 404，200
    public $code = 200;
    // 具体信息
    public $msg = '参数错误';
    // 自定义错误码
    public $errCode = 10000;

    public function __construct($params = [])
    {
        parent::__construct();
        if (!is_array($params)) {
            return false;
        }

        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('errcode', $params)) {
            $this->errCode = $params['errCode'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
    }
}