<?php
/**
 *  +----------------------------------------------------------------------
 *  | Created by  hahadu (a low phper and coolephp)
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2020. [hahadu] All rights reserved.
 *  +----------------------------------------------------------------------
 *  | SiteUrl: https://github.com/hahadu
 *  +----------------------------------------------------------------------
 *  | Author: hahadu <582167246@qq.com>
 *  +----------------------------------------------------------------------
 *  | Date: 2020/9/19 下午10:02
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\model;
use Hahadu\ThinkBaseModel\BaseModel;
use think\model\concern\SoftDelete;

class UserBaseModel extends BaseModel{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;
    protected $autoWriteTimestamp = true;
    protected $updateTime = 'last_login_time';
    protected $createTime = 'register_time';

    /****
     * 获取注册用户列表
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_user_list(){
        return $this->field('id,username,avatar,email,phone,status,register_time,last_login_ip,last_login_time')->order('id','desc')->select();
    }

}