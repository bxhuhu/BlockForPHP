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


    public function voidFp()
    {
        if (IS_POST) {
            $file = new FileController();
            $path = $file->upFile();
            if (sizeof($path) > 0) {
                $videoModel = D('video');
                $videoModel->img = $path;
                $videoModel->url = $path['videoPath'];
                $videoModel->title = I('title');
                $videoModel->create_data = date("Y-m-d h:m:s");
                $id = $videoModel->add();
                $data = $videoModel->where('id=' . $id)->find();
                $this->response(\DataFormat::successFormat("数据添加成功,可以开始体添加视频了", $data), 'json');
            }
        }
    }

    public function voidCache()
    {
        if (IS_POST) {
            $cacheModel = D('VideoCache');
            $videoId = I('videoId');
            $cacheIndex = I('cacheIndex');
            $file = new FileController();
            $path = $file->saveBigFile();
            if (sizeof($path) > 0) {
                $cachePath = $path['videoPath'];
                $cacheModel->index = $cacheIndex;
                $cacheModel->video_id = $videoId;
                $cacheModel->cache_path = $cachePath;
                $id = $cacheModel->add();
                $date = $cacheModel->where('id=' . $id)->select();
                $this->response(\DataFormat::successFormat('合成视频ID为' . $videoId . '的第' . $cacheIndex . '段视频添加成功', $date), 'json');
            }
        }
    }


    public function mergeFile()
    {
        if (IS_POST) {
            $cacheModel = D('admin/VideoCache');
            $video_id = I('video_id');
            $data = $cacheModel->where('video_id=' . $video_id)->select();
            $size = sizeof($data);
            if ($size < 1) {
                $this->response(\DataFormat::failFormat("没有缓存文件"), json);
                exit;
            }
            $shellStr = 'cat';
            $savePath = '';
            $splitStr = '';
            $video_id = '';
            for ($i = 0; $i < $size; $i++) {
                $cacheData = $data[$i];
                $id = $cacheData['id'];
                $index = $cacheData['index'];
                $video_id = $cacheData['video_id'];
                $cache_path = 'uploads' . $cacheData['cache_path'];
                $shellStr = $shellStr . " " . $cache_path;
                $saveName = $video_id;
                $splitStr = $cacheData['cache_path'];
            }
            $splitStr = '/' . explode('/', $splitStr)['1'] . '/' . $video_id . 'video.mp4';
            $savePath = 'uploads' . $splitStr;
            $shellStr = $shellStr . ">>" . $savePath;
            $videoModel = D('video');
            $videoModel->url = $splitStr;
            $videoModel->where('id=' . $video_id)->save();
            $data = $videoModel->where('id=' . $video_id)->select();
            shell_exec($shellStr);
            $cacheModel->where('video_id=' . $video_id)->delete();
            $this->response(\DataFormat::successFormat('合成视频id为<' . $video_id . '>操作完成', null), 'json');
        }
    }


}