<?php
namespace Admin\Model;

use Think\Model;

class EssayModel extends Model
{
    //文章标题,文章ID,文章图片,创建时间,文章类型,留言数
    public function getEssayList()
    {
        $essayList = $this->select();
        $classify = D('classify');
        $message_message = D('essay_message');
        for ($i = 0; $i < sizeof($essayList); $i++) {
            $messageType = $classify->where("id=" . $essayList[$i]['classify_id'])->find();

            $messageCount = $message_message->where("essay_id=" . $essayList[$i]['id'])->select();
            $essayList[$i]['messageCount'] = sizeof($messageCount);
            $essayList[$i]['classify'] = $messageType['name'];
        }
        return $essayList;
    }

}