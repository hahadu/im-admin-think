<?php


namespace Hahadu\ImAdminThink\model;


use Hahadu\ThinkBaseModel\BaseModel;
use think\model\concern\SoftDelete;

/****
 * 用户等级
 * @package app\common\model
 */
class SetUserLevel extends BaseModel
{
    use SoftDelete;

    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;
    protected $autoWriteTimestamp = true;

    public function level_list(){
        return $this->field('id,level,level_name')->select();
    }


}