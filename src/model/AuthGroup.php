<?php
declare (strict_types = 1);

namespace Hahadu\ImAdminThink\model;
use Hahadu\ThinkBaseModel\BaseModel;
use Hahadu\ImAdminThink\model\AuthGroupAccess;
use think\model\concern\SoftDelete;

/****
 * Class AuthGroup
 * @package Hahadu\ImAdminThink\model
 */
class AuthGroup extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;

    /**
     * 传递主键id删除数据
     * @param  array   $map  主键id
     * @return boolean       操作是否成功
     */
    public function deleteData($map, $type = false)
    {
        $this::destroy($map,$type);
        $result = $this->delete();
        if($result){
            $group_map=array(
                'group_id'=>$map['id']
            );
            $auth_group_access = new AuthGroupAccess();
            // 删除关联表中的组数据
            $result=$auth_group_access::deleteData($group_map);
        }
        return $result;
    }
}
