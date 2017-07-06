<?php
namespace Phone\Controller;

use Admin\Controller\FileController;
use Think\Controller\RestController;

require_once './library/DataFormat.php';

class VideoController extends RestController
{

    public function videoList()
    {
        if (IS_POST) {
            $model = D("admin/video");
            $data = $model->findAllList();
            $this->response(\DataFormat::successFormat(null, $data), 'json');
        }
    }

}