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
                $this->response(\DataFormat::successFormat($data), 'json');
            } else {
                $this->response(\DataFormat::failFormat("error"), 'json');
            }
        }
    }

}