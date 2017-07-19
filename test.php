<?php
/**
 * Created by PhpStorm.
 * User: luyongjiang
 * Date: 2017/7/18
 * Time: 17:38
 */


$str1 = 'uploads/video2017-07-18/596dcedccd098.mp4';
$str2 = 'uploads/video2017-07-18/596dcee933725.mp4';
//$data = shell_exec('/bin/ls uploads/video2017-07-18/596dcedccd098.mp4');
$shellStr = 'cat ' . $str1 . ' ' . $str2 . '>>uploads/test.mp4';
var_dump($shellStr);
$data = shell_exec($shellStr);
echo '<pre>';
print_r($data);
echo '</pre>';

