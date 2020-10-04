<?php
declare (strict_types = 1);

namespace Hahadu\CooleAdmin\model;
use Hahadu\ThinkBaseModel\BaseModel;


/**
 * @mixin \think\Model
 */
class AuthRule extends BaseModel
{
    /**
     * 删除数据
     * @param   array   $map    where语句数组形式
     * @param   bool   $type     删除模式 true为真实删除 false为软删除
     * @return  boolean         操作是否成功
     */
    public function deleteData($map, $type = true)
    {
        $count = $this
            ->where(array('pid' => $map['id']))
            ->count();
        if ($count != 0) {
            $result = 400002;
        }else{
            $result = parent::deleteData($map, $type);
        }
        return $result;
    }
}
