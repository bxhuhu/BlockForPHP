<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class UserController extends Controller
{
    public function user_list()
    {


        $this->assign("userList", D('user')->getUserInfo());
        $this->display();
    }

    public function new_user()
    {
        if (IS_POST) {
            $path = $this->upFile();
            if ($path == "error") {
                $this->error("上传图片出错");
            } else {
                $name = I('nicheng');
                $mima = I('mima');
                $qrmima = I('qrmima');
                $youxiang = I('youxiang');
                $leixing = I('leixing');
                $dateTime = date("Y-m-d h:m:s");
                if ($mima == $qrmima) {
                    $model = D('user');
                    $model->user_name = $name;
                    $model->password = $mima;
                    $model->email = $youxiang;
                    $model->create_date = $dateTime;
                    $model->permission_id = $leixing;
                    $model->head_img = $path;
                    $model->add();
                    $this->success('上传成功！');
                } else {
                    $this->error("添加数据失败,密码不一致");
                }
            }
            exit;
        }
        $list = D('permission')->getList();
        $this->assign("perList", $list);
        $this->display();
    }


    public function user_profile()
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