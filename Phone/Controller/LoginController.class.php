<?php
namespace Phone\Controller;

use Think\Controller\RestController;

require_once './library/DataFormat.php';

class LoginController extends RestController
{

    public function login()
    {
        if (IS_POST) {
            $username = I('username');
            $password = I('password');
            $model = D("admin/user");
            $data = $model->where("user_name='" . $username . "'and password='" . $password . "'")->select();
            if (sizeof($data) > 0) {
                $this->response(\DataFormat::successFormat(null, $data), 'json');
            } else {
                $this->response(\DataFormat::failFormat(), 'json');
            }
        }
    }

    public function register()
    {
        if (IS_POST) {
            $name = I('name');
            $password = I('password');

            $this->response(\DataFormat::successFormat("添加用户成功:" . $name));
            exit;


            $username = I('username');
            $model = D('admin/user');
            $perModel = D('admin/permission');
            $data = $model->where("user_name='" . $username . "'")->select();
            if (sizeof($data) > 0) {
                $this->response(\DataFormat::failFormat("用户名已存在"), 'json');
            } else {

                $file = new FileController();
                $path = $file->upFile();
                if ($path == "error") {
                    $this->error("上传图片出错");
                } else {
                    $data = $perModel->where("name='" . "成员" . "'")->find();
                    //----------------以下是添加数据----------------
                    $model->user_name = I('username');
                    $model->password = I('password');
                    $model->permission_id = $data['id'];
                    $model->email = I['email'];
                    $model->head_img = $path;
                    $model->create_date = date("Y-m-d h:m:s");
                    $model->add();
                    $this->response(\DataFormat::successFormat("添加用户成功"));
                }
            }

        }
    }

}