<?php


namespace app\lib\validate;


use app\lib\exception\ParamterException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{


    /**
     * @return bool
     * User: kql
     * Date: 2021/7/16 15:50
     */
    public function goCheck()
    {
        // 获取所有参数
        $request = Request::instance();
        $param = $request->param();
        $res = $this->batch()->check($param);

        if (!$res) {
            throw new ParamterException([
                'msg'  => $this->error,
                'code' => 422,
            ]);
        } else {
            return true;
        }

    }


    /**
     * Method:必须是正整数
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool
     * User: kql
     * Date: 2021/7/16 15:53
     */
    protected function isPostiveInterger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Method: 必须是选择 1 或 -1
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool
     * User: kql
     * Date: 2021/7/16 15:55
     */
    protected function isChecked($value, $rule = '', $data = '', $field = '')
    {
        return in_array($$value, [-1, 1]) ? true : false;
    }


    /**
     * Method: 不能为空
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool
     * User: kql
     * Date: 2021/7/16 15:56
     */
    protected function isNotEmpty($value, $rule = '', $data = '', $field = '')
    {
        if (empty(trim($value))) {
            return false;
        } else {
            return true;
        }
    }


}