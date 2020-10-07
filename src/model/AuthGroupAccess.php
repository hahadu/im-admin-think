<?php
declare (strict_types = 1);

namespace Hahadu\ImAdminThink\model;
use Hahadu\ThinkBaseModel\BaseModel;
use think\model\concern\SoftDelete;
/**
 * @mixin BaseModel;
 */
class AuthGroupAccess extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    /**
     * 根据group_id获取全部用户id
     * @param  int $group_id 用户组id
     * @return array         用户数组
     */
    public function getUidsByGroupId($group_id){
        $user_ids=$this
            ->where(array('group_id'=>$group_id))
            ->getField('uid',true);
        return $user_ids;
    }
    /**
     * 获取管理员权限列表
     */
    public function getAllData(){
        $data=$this->alias('aga')
            ->field('u.id,u.username,u.email,aga.group_id,ag.title')
            ->join('users u ',' aga.uid=u.id','RIGHT')
            ->join('auth_group ag ',' aga.group_id=ag.id','LEFT')
            ->select()
            ->toArray();

        // 获取第一条数据
        if(!isset($data[0])) return false;
        $first=$data[0];
        $first['title']=array();
        $user_data[$first['id']]=$first;
        // 组合数组
        foreach ($data as $k => $v) {
            foreach ($user_data as $m => $n) {
                $uids=array_map(function($a){return $a['id'];}, $user_data);
                if (!in_array($v['id'], $uids)) {
                    $v['title']=array();
                    $user_data[$v['id']]=$v;
                }
            }
        }
        // 组合管理员title数组
        foreach ($user_data as $k => $v) {
            foreach ($data as $m => $n) {
                if ($n['id']==$k) {
                    $user_data[$k]['title'][]=$n['title'];
                }
            }
            $user_data[$k]['title']=implode('、', $user_data[$k]['title']); // 管理组title数组用顿号连接
        }

        return $user_data;
    }
}
