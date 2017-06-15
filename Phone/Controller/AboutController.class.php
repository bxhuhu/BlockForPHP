<?php
namespace Phone\Controller;
require_once './library/DataFormat.php';
use Think\Controller\RestController;

class AboutController extends RestController
{

    public function checkVersion()
    {
        if (IS_POST) {
            $getVersoin = I('versionCode');
            $configVersion = C('versionCode');
            $configVersionName = C('versionName');
            $updateLog = C('updateLog');
            $md5 = md5_file('uploads/file/creeblog.apk');
            $isUpdate = false;
            if ($getVersoin < $configVersion)
                $isUpdate = true;
            $data = array('isUpdate' => $isUpdate, 'versionCode' => $configVersion, 'versionName' => $configVersionName, 'url' => 'http://192.168.99.180/myblogs/uploads/file/creeblog.apk', 'md5' => $md5);
            $this->response(\DataFormat::successFormat($updateLog, $data), 'json');
        }
    }

}