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
        $this->display();
    }


}