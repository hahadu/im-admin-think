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
 *  | Date: 2020/10/3 上午12:30
 *  +----------------------------------------------------------------------
 *  | Description:   前台菜单管理基础控制器
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ImAdminThink\controller;

use Hahadu\ImAdminThink\model\HomeNav;
use think\App;

class AdminBaseHomeNavController extends AdminBaseController
{
    protected $HomeNav ;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->HomeNav = new HomeNav;

    }
    public function adminNavTree(){
        $data = $this->HomeNav->getTreeData('tree','order_by,id');
        return $data;
    }


    /****
     * 菜单排序
     * @return string
     */
    public function order_by(){
        if(request()->isPost()){
            $data=$this->request->post();
            $order_status=$this->HomeNav->orderData($data);
            if($order_status){
                $result= 100011;
            }else{
                $result= 400001;
            }
        }else{
            $result = 0;
        }
        return $result;
    }

    /****
     * 添加菜单
     * @return string
     */
    public function add(){
        if(request()->isPost()){
            $data=$this->request->post();
            $add_data=$this->HomeNav->addData($data);
            if($add_data>0){
                $result= 100012;
            }else{
                $result = 200001;
            }
            return $result;
        }
        return 0;
    }

    /****
     * 编辑
     * @return bool|int
     */
    public function edit(){
        if(request()->isPost()){
            $data=$this->request->post();
            $id =[ 'id'=>$data['id']];
            return $this->HomeNav->editData($id,$data);
        }
        return 0;
    }

    /****
     * 删除
     * @return bool|int
     */
    public function delete(){
        if(request()->isGet()){
            $data['id'] = request()->param('id');
            return $this->HomeNav->deleteData($data,true);
        }
        return 0;
    }

}