<?php
/**
 * Created by PhpStorm.
 * User: luyongjiang
 * Date: 2017/3/7
 * Time: 10:54
 */
$link=mysqli_connect("127.0.0.1","root","root","blogs","3306");
$sql = "select * from user";
$result = mysqli_query($link,$sql); // 执行查询语句
while ($bookInfo = mysqli_fetch_array($result)){ //返回查询结果到数组
    $name = $bookInfo["user_name"]; //将数据从数组取出
    echo "<li>《".$name."》</li>";  //输出数据
}
exit;