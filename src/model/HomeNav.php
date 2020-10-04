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
 *  | Date: 2020/9/29 下午3:08
 *  +----------------------------------------------------------------------
 *  | Description:   cooleAdmin
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\CooleAdmin\model;

use Hahadu\ThinkBaseModel\BaseModel;
use Hahadu\DataHandle\Data;
use Hahadu\ThinkAuth\Auth;
use think\facade\Session;
use think\model\concern\SoftDelete;


/**
 * 菜单操作model
 */
class HomeNav extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;
    public function addData($data)
    {
        return parent::addData($data);
    }
    public function editData($map, $data)
    {
        return parent::editData($map, $data);
    }

    /**
     * 删除数据
     * @param array $map where语句数组形式
     * @param  type boole true真删除 false为软删除
     * @return    boolean            操作是否成功
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
