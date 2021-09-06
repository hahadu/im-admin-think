<?php


namespace Hahadu\ThinkAdmin\controller;

use app\Request;
use Hahadu\ThinkAdmin\model\Link;
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

    /*****
     * 列表
     * @return \think\Collection
     */
    public function link_list(){
        return $this->links->getDataByState();
    }

    /*****
     * 编辑
     * @param Request $request
     * @return array
     */
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

    /****
     * 添加
     * @param Request $request
     * @return array
     */
    public function add(Request $request){
        $data = $request->post();
        $save = $this->links->addData($data);
        if($save){
            return wrap_msg_array('1','添加成功');
        }else{
            return wrap_msg_array('0','添加失败');
        }
    }

    /*****
     * 删除友链
     * @param Request $request
     * @return array
     */
    public function delete(Request $request){
        $data = $request->get();
        $delete = $this->links->deleteData($data);
        if($delete){
            return wrap_msg_array('1','删除成功');
        }else{
            return wrap_msg_array('0','删除失败');
        }
    }

    public function on_delete(){
        $links = $this->links->selectDelData();

        return compact('links');

    }

    /*****
     * 恢复被删除的数据
     * @param Request $request
     */
    public function rec_delete(Request $request){
        $data = $request->get();
        $data = $this->links->recDelete($data);
        if($data==100021){
            return wrap_msg_array($data,'恢复成功');
        }else{
            return wrap_msg_array($data,'恢复失败');
        }
    }


}