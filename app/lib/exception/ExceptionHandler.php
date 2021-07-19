<?php
/**
 * ExceptionHandler.php
 * User: kql
 * Created on 2021/7/16 16:02
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\facade\App;
use think\facade\Log;
use think\facade\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errCode;

    /**
     * Method: 异常报错
     * @param Throwable $e
     * @return \think\Response|\think\response\Json
     * User: kql
     * Date: 2021/7/16 16:12
     */
    public function render(Throwable $e)
    {
        // 覆盖父类的方法  修改配置中的'exception_handle'       => 'app\lib\exception\ExceptionHandler',路径
        if ($e instanceof BaseException) {
            // 如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errCode = $e->errCode;
        } else {
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = '服务器内部错误，请查看相关文档';
                $this->errCode = 999;
                $this->recordErrorLog($e);
            }
        }

        $request = Request::instance();
        $result = [
            'msg'         => $this->msg,
            'code'        => $this->errCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    /**
     * Method: 写入异常处理日志
     * @param Throwable $e
     * User: kql
     * Date: 2021/7/16 16:14
     */
    protected function recordErrorLog(Throwable $e)
    {
        Log::init([
            'type'  => 'File',
            'path'  => App::getRuntimePath() . 'log/',
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}