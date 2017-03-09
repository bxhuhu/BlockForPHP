<?php
namespace Admin\Model;

use Think\Model;

class PermissionModel extends Model
{

    public function getList()
    {
        return $this->select();
    }

}