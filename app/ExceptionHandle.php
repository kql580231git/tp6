<?php

namespace app;

use app\lib\exception\BaseException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\App;
use think\facade\Log;
use think\facade\Request;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制
        if ($e instanceof BaseException) {
            // 如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errCode = $e->errCode;
        } else {
            if (config('app.app_debug')) {
                return parent::render($request, $e);
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
    protected function recordErrorLog($e)
    {
        Log::init([
            'type'  => 'File',
            'path'  => App::getRuntimePath() . 'log/',
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}
