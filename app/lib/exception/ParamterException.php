<?php
/**
 * ParamterException.php
 * User: kql
 * Created on 2021/7/16 16:15
 */

namespace app\lib\exception;


class ParamterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errCode = 10000;
}