<?php


namespace Hahadu\ImAdminThink\model;


use Hahadu\ThinkBaseModel\BaseModel;
use think\model\concern\SoftDelete;

/*****
 * 友情链接
 * Class Link
 * @package Hahadu\ImAdminThink\model
 */
class Link extends BaseModel
{
    use SoftDelete;
    protected $pk = 'lid';
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;

    // 传递is_delete和is_show获取对应数据
    public function getDataByState($delete_time=null,$is_show=1){
        $where=array(
            //      'delete_time'=>$delete_time,
            'is_show'=>$is_show,
        );
        // 如果是获取全部链接；则删除is_show限制
        if ($is_show==='all') {
            unset($where['is_show']);
        }
        return $this->selectData($where,$delete_time)->order('sort');
    }


}