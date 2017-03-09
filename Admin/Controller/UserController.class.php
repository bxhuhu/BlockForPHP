<?php
namespace Admin\Controller;

use Think\Controller;

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
            var_dump($_POST);
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
                $model->add();
            } else {
                echo '添加数据失败,密码不一致';
            }
        }
        $list = D('permission')->getList();
        $this->assign("perList", $list);
        $this->display();
    }


    //----------------响应的请求----------------

    //----------------ajax----------------
    public function isNameExistes()
    {
        if (IS_POST) {

        }
        $data = false;
        $this->ajaxReturn($data);
    }


}