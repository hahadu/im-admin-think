<?php


namespace Hahadu\ThinkAdmin\model;

use Hahadu\ThinkBaseModel\BaseModel;
use Hahadu\ThinkAdmin\model\SetUserLevel;

/*****
 * 分配用户等级
 * @package app\common\model
 */
class UserLevel extends BaseModel
{
    protected $defaultSoftDelete = NULL;
    protected $user_level_data;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->user_level_data = new SetUserLevel();
    }

    /*****
     * @param int $uid 用户id
     * @param int $level_id 用户等级id
     * @param bool $update true 修改 false 设置
     */
    public function set_level($uid,$level_id,$update=true){
        if($update){
            $user = ['uid'=>$uid];
            $level = ['lid'=>$level_id];

            $this->editData($user,$level);
        }else{
            $data=[
                'uid'=>$uid,
                'lid'=>$level_id,
            ];
            $this->addData($data);
        }
    }

    /*****
     * 获取用户等级
     * @param int $uid 用户id
     * @return mixed
     */
    public function get_level($uid){
        $lid = $this->get_lid($uid);
        return $this->user_level_data->where('id',$lid)->field('level,level_name')->find();
    }

    /******
     * 删除用户等级
     * @param $uid
     * @return bool
     */
    public function delete_level($uid)
    {
        $map = ['uid'=>$uid];
        return $this->where($map)->delete();
    }

    /*****
     * 获取用户等级ID
     * @param $uid
     * @return mixed
     */
    public function get_lid($uid){
        $user_level = $this->where('uid',$uid)->findOrEmpty();
        if($user_level->isEmpty()){
            $this->set_level($uid,1 ,false); //设置默认等级
            return $this->get_lid($uid);
        }
        $lid = $user_level->lid;
        if($uid === get_uid() && session('user.level_id')!=$lid){
            session('user.level_id',$lid);
        }
        return $lid;
    }

}