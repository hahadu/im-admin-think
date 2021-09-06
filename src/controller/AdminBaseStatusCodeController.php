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
 *  | Date: 2020/10/7 下午9:20
 *  +----------------------------------------------------------------------
 *  | Description:   ImAdminThink
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ThinkAdmin\controller;

use Hahadu\ThinkAdmin\model\StatusCode;
use think\App;

class AdminBaseStatusCodeController extends AdminBaseController
{
    protected $status_code_data;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->status_code_data = new StatusCode();
    }
    public function base_status_code_list(){
        $status_code = $this->status_code_data::order('code','DES')->paginate(15);
        $page = $status_code->render();
        $result = [
            'StatusCode'=>$status_code,
            'page' => $page,
        ];
        return $result;
    }

    /****
     * 添加状态码
     * @return int
     */
    public function add_status_code()
    {
        $data=$this->request->post();
        $add_data=$this->status_code_data->addData($data);
        if($add_data){
            $result = 100012;
        }else{
            $result = 420001;
        }
        return $result;
    }

    /****
     * 修改状态码
     * @return string
     */
    public function edit_status_code()
    {
        if(request()->isPost()){
            $data= $this->request->post();
            $id =[ 'id'=>$data['id']];
            $edit_status=$this->status_code_data->editData($id,$data);
            switch ($edit_status){
                case 1:
                    $result = 100011;
                    break;
                default :
                    $result = $edit_status;
                    break;
            }
            return $result;
        }
    }

    /****
     * 删除状态码 *默认为软删除
     * @param $id
     * @return bool|int
     */
    public function delete_status_code($id)
    {
        if(request()->isGet()){
            $data['id'] = $id;
            $delete_status = $this->status_code_data->deleteData($data,false);
            return $delete_status;
        }
    }
    /****
     * 显示已删除的数据
     * @return array
     */
    public function on_delete(){
        $data = $this->status_code_data->selectDelData();
        $result = [
            'StatusCode' =>$data,
        ];
        return $result;
    }

    /****
     * 恢复已删除的数据
     * @param $id
     * @return string
     */
    public function rec_delete($id){
        $map = ['id'=>$id];
        $result = $this->status_code_data->recDelete($map);
        return $result;
    }


}