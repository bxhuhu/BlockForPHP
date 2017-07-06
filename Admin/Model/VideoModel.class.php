<?php
namespace Admin\Model;

use Think\Model;

class VideoModel extends Model
{
    public function findAllList()
    {
        return $this->select();
    }
}