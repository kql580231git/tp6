<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\BaseController;
use think\facade\App;

class Index extends BaseController
{
    public function index()
    {
        $app = App::getAppPath();
//        halt($app);
        return view();
    }
}
