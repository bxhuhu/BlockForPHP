<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class VideoController extends Controller
{
    public function video_list()
    {
        $this->assign("userList", D('user')->getUserInfo());
        $this->display();
    }

    public function video_new()
    {
        if (IS_POST) {
            $file = new FileController();
            $path = $file->upFileAndVideo();
            if ($path == "error") {
                $this->error("上传视频出错");
            } else {
               $this->success("上传视频成功");
            }
            exit;
        }
        $list = D('permission')->getList();
        $this->assign("perList", $list);
        $this->display();
    }


    public function video_profile()
    {

        $model = D("user");
        $id = I("id");
        if ($id == null) {
            $this->assign("data", null);
        } else {
            $data = $model->where("id=" . $id)->find();
            $this->assign("data", $data);
        }
        $this->display();
    }


    public function test_page()
    {
        $this->display();
    }

    //----------------响应的请求----------------


    public function delete()
    {
        $id = I('id');
        $model = D('user');
        $result = $model->where('id=' . $id)->delete();
        if ($result) {
            redirect(U('user/user_list'), 1, '删除成功,页面跳转中...');
        } else {
            $this->error('数据删除失败');
        }

    }

    //----------------ajax----------------
    public function isNameExistes()
    {
        if (IS_POST) {
            $name = I("name");
            $user = D('user')->where("user_name = '" . $name . "'")->select();
            $size = sizeof($user);
            if ($size > 0) {
                $this->ajaxReturn(false);
            } else {
                $this->ajaxReturn(true);
            }
        }
    }

    public function up_head_img()
    {
        $this->display();
    }


}