<?php
declare (strict_types = 1);

namespace Hahadu\ImAdminThink\model;
use Hahadu\ThinkBaseModel\BaseModel;
use think\model\concern\SoftDelete;

/**
 * @mixin \think\Model
 */
class Rule extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;

}
