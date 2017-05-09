<?php
namespace Phone\Controller;

use Think\Controller\RestController;

require_once './library/DataFormat.php';

class ArticleController extends RestController
{

    public function articleList()
    {
        if (IS_POST) {
            $model = D('admin/essay');
            $list = $model->getEssayListAlertContent();
//        var_dump($list);
            $this->response(\DataFormat::successFormat('获取数据成功', $list), 'json');
        }

    }

}