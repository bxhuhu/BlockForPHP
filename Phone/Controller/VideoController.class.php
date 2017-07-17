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

    public function video_new()
    {
        if (IS_POST) {
            $file = new FileController();
            $path = $file->saveBigFile();
            if (sizeof($path) > 0) {
                $model = D('video');
                $model->url = $path['videoPath'];
                $model->title = I('title');
                $model->create_data = date("Y-m-d h:m:s");
                $model->img = $path['imgPath'];

                if (I('title') == null || $path['imgPath'] == null || $path['videoPath'] == null) {
                    $this->response(\DataFormat::failFormat("视频和标题以及图片不能为空"), 'json');
                }
                $model->add();
                $this->response(\DataFormat::successFormat("视频上传成功", $model), 'json');
            } else {
                $this->response(\DataFormat::failFormat("添加视频失败"), 'json');
            }
            exit;
        }
        $this->display();
    }

}