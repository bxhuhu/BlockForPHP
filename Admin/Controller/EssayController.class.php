<?php
namespace Admin\Controller;

use Think\Controller;


class EssayController extends Controller
{
    public function essay_list()
    {
        $this->assign("essayList", D('essay')->getEssayList());
        $this->display();
    }

    public function essay_new()
    {
        if (IS_POST) {
            $file = new FileController();
            $path = $file->upFile();
            if ($path == "error") {
                $this->error("上传图片出错");
            } else {
                $user = D('user')->where("user_name='Cree'")->find();
                $model = D('essay');
                $model->title = I('title');
                $model->content = I('content');
                $model->date = date("Y-m-d h:m:s");
                $model->classify_id = I('leixing');
                $model->user_id = $user['id'];
                $model->user_permission_id = $user['permission_id'];
                $model->user_name = $user['user_name'];
                $model->img = $path;
                $model->add();
                $this->success('上传成功！');
            }
            exit;
        }

        $classify = D('classify')->select();
        $this->assign("classify", $classify);
        $this->display();
    }

    public function essay_profile()
    {
        $model = D('essay');
        $sqlStr = "id=" . I('id');
        $data = $model->where($sqlStr)->find();
        $this->assign("data", $data['content']);
        $this->display();
    }

}