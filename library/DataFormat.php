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
     * @return array
     */
    public static function successFormat($data)
    {
        return array("code" => 0, "message" => "成功", "data" => $data);
    }

    /**失败数据的封装
     * @param $data
     * @return array
     */
    public static function failFormat($data)
    {
        return array("code" => 1, "message" => "失败", "data" => $data);
    }
}
