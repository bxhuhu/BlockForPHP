<?php
namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{
    /**
     * @return userInfo
     */
    public function getUserInfo()
    {
        ///permission
        $userInfo = $this->select();
        $modelP = D('permission');

        for ($i = 0; $i < sizeof($userInfo); $i++) {
            $id = $userInfo[$i]['permission_id'];

            $permission = $modelP->where("id=" . $id)->find();

            $userInfo[$i]['permission'] = $permission['name'];
        }

        return $userInfo;
    }


    public function hello()
    {
        var_dump("hello ");
    }
}