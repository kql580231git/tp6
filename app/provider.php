<?php

use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
    'helper'                 => think\helper::class,
//    'userModel'              => \app\admin\model\User::class,
];
