<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function user_list()
    {

        $model = D('User');
        $data = $model->select();
        $this->assign("userList", $data);
        $this->display();
    }

    public function new_user()
    {
        $this->display();
    }
}