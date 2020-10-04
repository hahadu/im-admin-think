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

namespace Hahadu\ImAdminThink\model;

use Hahadu\ThinkBaseModel\BaseModel;
use Hahadu\DataHandle\Data;
use Hahadu\ThinkAuth\Auth;
use think\facade\Session;
use think\model\concern\SoftDelete;


/**
 * 菜单操作model
 */
class AdminNav extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = NULL;
    public function addData($data)
    {
        return parent::addData($data); // TODO: Change the autogenerated stub
    }
    public function editData($map, $data)
    {
        return parent::editData($map, $data); // TODO: Change the autogenerated stub
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

    /**
     * 获取全部菜单
     * @param string $type tree获取树形结构 level获取层级结构
     * @return array        结构数据
     */
    /*
    public function getTreeData($type = 'tree', $order = '', $name = 'name', $child = 'id', $parent = 'pid')
    {
        // 判断是否需要排序
        if (empty($order)) {
            $data = $this->select();
        } else {
            $data = $this->order('order_by is null,' . $order)->select();
        }

    }
    /**

        public function getTreeData($type = 'tree', $order = '', $name = 'name', $child = 'id', $parent = 'pid')
        {

                // 判断是否需要排序
                if (empty($order)) {
                    $data = $this->select();
                } else {
                    $data = $this->order('order_by is null,' . $order)->select();
                }
                // 获取树形或者结构数据
                if ($type == 'tree') {
                    $data = Data::tree($data, 'name', 'id', 'pid');
                } elseif ($type = "level") {
                    $data = Data::channelLevel($data, 0, '&nbsp;', 'id');
                    // 显示有权限的菜单
                    $auth = new Auth();
                    foreach ($data as $k => $v) {
                        if ($auth->check($v['mca'], Session::get('user.id'))) {
                            foreach ($v['_data'] as $m => $n) {
                                if (!$auth->check($n['mca'], Session::get('user.id'))) {
                                    unset($data[$k]['_child'][$m]);
                                }
                            }
                        } else {
                            // 删除无权限的菜单
                            unset($data[$k]);
                        }
                    }
                }
                // p($data);die;
                return $data;
            }
*/

}
