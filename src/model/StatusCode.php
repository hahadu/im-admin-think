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
 *  | Date: 2020/9/20 上午12:10
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin 状态码数据模型
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ThinkAdmin\model;
use Hahadu\ThinkBaseModel\BaseModel;
use think\model\concern\SoftDelete;

/******
 * 状态码
 * @package Hahadu\ImAdminThink\model
 */
class StatusCode extends BaseModel{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;

    function selectData($map=NULL, $type = 0)
    {
        return parent::selectData($map, $type);
    }

}
