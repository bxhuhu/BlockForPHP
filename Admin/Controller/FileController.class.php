<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class FileController extends Controller
{
    public function upFile()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './uploads'; // 设置附件上传根目录
        $upload->savePath = '/img'; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            return "error";
        } else {// 上传成功
            foreach ($info as $file) {
                return $file['savepath'] . $file['savename'];
            }
        }
    }


    public function saveBigFile()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 1024 * 1024 * 50;// 设置附件上传大小
        $upload->exts = array('jpg', 'jpeg', 'png', 'mp4', 'avi');// 设置附件上传类型
        $upload->rootPath = './uploads'; // 设置附件上传根目录
        $upload->savePath = '/video'; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            return "error";
        } else {// 上传成功
            $arrays = array();
            foreach ($info as $file) {
                $fileName = $file['savepath'] . $file['savename'];
                $endStr = strrchr($fileName, '.');
                if ($endStr == '.jpg' || $endStr == '.jpeg' || $endStr == '.png') {
                    $arrays['imgPath'] = $fileName;
                } else {
                    $arrays['videoPath'] = $fileName;
                }
            }
            return $arrays;
        }
    }

    public function upVideoFile()
    {
        $uploaddir = './video/';
        foreach ($_FILES as $upfile) {
            $uploadfile = $uploaddir . $upfile['name'];
            if (move_uploaded_file($upfile['tmp_name'], $uploadfile))
                echo "true";
            else {
                echo $_FILES['userfile']['error']; //具体见下面的注释
                echo "<br/>false";
            }
        }
    }
}