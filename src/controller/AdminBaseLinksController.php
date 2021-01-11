<?php


namespace Hahadu\ImAdminThink\controller;

use app\Request;
use Hahadu\ImAdminThink\model\Link;
use think\App;

/*****
 * Class  AdminBaseLinksController 友链管理模块
 * @package Hahadu\ImAdminThink\controller
 */
class AdminBaseLinksController extends AdminBaseController
{

    protected $links;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->links = new Link();
    }

    public function link_list(){
        return $this->links->getDataByState();
    }
    public function edit(Request $request){
        $data = $request->post();
        $map = ['lid'=>$data['lid']];
        $edit = $this->links->editData($map,$data);
        if($edit){
            return wrap_msg_array('1','编辑成功');
        }else{
            return wrap_msg_array('0','编辑失败');
        }
    }
    public function add(Request $request){
        $data = $request->post();
        $save = $this->links->addData($data);
        if($save){
            return wrap_msg_array('1','添加成功');
        }else{
            return wrap_msg_array('0','添加失败');
        }
    }

}