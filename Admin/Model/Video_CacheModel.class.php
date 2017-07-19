<?php
namespace Admin\Model;

use Think\Model;

class Video_CacheModel extends Model
{
    public function findAllList()
    {
        return $this->select();
    }
}