<?php
declare (strict_types = 1);

namespace Hahadu\ImAdminThink\model;


/**
 * @mixin UserBaseModel
 */
class Users extends UserBaseModel
{
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