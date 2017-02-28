<?php
namespace Home\Controller;

use Think\Controller;

class AjaxTestController extends Controller
{
    public function test()
    {
        $this->display();
    }

    public function resultData()
    {
//        $data['status']  = 1;
//        $data['content'] = 'content';
        $arr=array("a"=>1,"b"=>2);
        $data = json_encode($arr);
        $this->ajaxReturn($data);
    }
}