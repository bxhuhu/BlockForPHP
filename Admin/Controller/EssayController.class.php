<?php
namespace Admin\Controller;

use Think\Controller;

class EssayController extends Controller
{
    public function essay_list()
    {
        $this->assign("userList", D('user')->getUserInfo());
        $this->display();
    }

    public function essay_new()
    {
        $this->display();
    }

    public function essay_profile()
    {
        $this->display();
    }

}