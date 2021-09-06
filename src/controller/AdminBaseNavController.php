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
 *  | Description:   后台菜单管理基础控制器
 *  +----------------------------------------------------------------------
 **/

namespace Hahadu\ThinkAdmin\controller;

use Hahadu\ThinkAdmin\model\AdminNav;
use think\App;

class AdminBaseNavController extends AdminBaseController
{
    protected $adminNav ;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->adminNav = new AdminNav;

    }
    public function adminNavTree(){
        $data = $this->adminNav->getTreeData('tree','order_by,id');
        return $data;
    }

    /****
     * 后台菜单导航栏的json数据
     * layer使用
     * @return \think\response\Json
     */
    public function admin_nav_menu_json(){
        $nav_menu = $this->adminNavLevel();
        $nav_menu_row = [];
        foreach ($nav_menu as $key=>$value){
            $data['title'] = $value['name'];
            $data['href'] = $value['url'];
            $data['icon'] = $value['icon'];
            $data["target"] = '_self';
            if(!empty($value['_child'])){
                $data['child'] =[];
                foreach($value['_child'] as $k =>$v)
                    array_push($data['child'],[
                        'title'=>$v['name'],
                        'href'=>$v['url'],
                        'icon'=>$v['icon'],
                        'target' =>'_self',
                    ]);
            }
            array_push($nav_menu_row,$data);
        }

        $assign = [
            'homeInfo'=>[
                'title'=>'首页',
                'href'=>url('/admin/index/welcome')->build()
            ],
            'logoInfo'=>[
                "title"=>"haha",
                "image"=> "/static/images/logo.png",
                "href"=> ""
            ],
            'menuInfo' =>[[
                "title"=> "主菜单",
                "icon"=>"fa fa-address-book",
                "href"=>"",
                "target"=> "_self",
                "child"=> $nav_menu_row
            ]
            ]
        ];
        return json($assign);
    }

    /****
     * 菜单排序
     * @return string
     */
    public function order_by(){
        if(request()->isPost()){
            $data=$this->request->post();
            $order_status=$this->adminNav->orderData($data);
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
            $add_data=$this->adminNav->addData($data);
            if($add_data>0){
                $result = 100012;
            }else{
                $result = 420001;
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
            return $this->adminNav->editData($id,$data);
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
            return $this->adminNav->deleteData($data,true);
        }
        return 0;
    }

}