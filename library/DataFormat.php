<?php

/**
 * Created by PhpStorm.
 * User: luyongjiang
 * Date: 2017/3/16
 * Time: 21:39
 */
class DataFormat
{
    /**数据调用成功的封装
     * @param $data
     * @param null $message
     * @return array
     */
    public static function successFormat($message = null, $data = null)
    {
        if ($message == null)
            $message = '成功';
        if ($data == null)
            $data = array();
        return array("code" => 0, "message" => $message, "data" => $data);
    }

    /**失败数据的封装
     * @param null $message
     * @return array
     */
    public static function failFormat($message = null)
    {
        if ($message == null)
            $message = '失败';
        return array("code" => 1, "message" => $message);
    }
}
