<?php
namespace Admin\Controller;

use Think\Controller;


class TestController extends Controller
{
    /**
     * 对表联立查询
     */
    public function centerTableTest()
    {
        $order = D('order');
//        $cetenr = D('center');
//        $product = D('product');
        $data = $order->join('center on `order`.id=center.order_id')->join('product on center.product_id=product.id')->where('order_id=1')->select();

        var_dump($data);
    }


    /**
     * 测试重定向
     */
    public function redirectTest()
    {
        $this->redirect('redirectEnd', '页面跳转中');
//        $this->success('新增成功', 'redirectEnd');
    }

    /**
     * 重定向后面的界面
     */
    public function redirectEnd()
    {
        var_dump("hello");
    }
}