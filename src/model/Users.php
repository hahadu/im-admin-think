<?php
declare (strict_types = 1);

namespace Hahadu\ImAdminThink\model;


/**
 * @mixin UserBaseModel
 */
class Users extends UserBaseModel
{
    protected $updateTime = 'last_login_time';
    protected $createTime = 'register_time';
    protected $autoWriteTimestamp = true;

    /****
     * @param array $data
     * @return int
     * 添加用户
     */
    public function addData($data)
    {
        return parent::addData($data);
    }


    public function deleteData($map, $type = false)
    {
        return parent::deleteData($map, $type);
    }

}