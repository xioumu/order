<?php
namespace Home\Controller;
use Think\Controller;
class ItemController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
    }

    //展现物品列表页面
    public function index(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D('User');
        $Item = D('Item');
        $userInfo = $User->getInfo();
        $itemList = $Item->getItemList();
        $this->assign('user', $userInfo);
        $this->assign('itemList', $itemList);
        $this->display('Item:itemList');
        $this->display(T('Tail/tail'));
    }

    //物品详情页面
    public function itemInfo($iid) {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D('User');
        $Item = D('Item');
        $userInfo = $User->getInfo();
        if ($iid == 'add') {
            $breadcrumb['now'] = '添加物品';
            $itemInfo['iid'] = $iid;
        }
        else {
            $breadcrumb['now'] = '修改物品信息';
            $itemInfo = $Item->getInfo($iid);
        }
        $this->assign('breadcrumb', $breadcrumb);
        $this->assign('user', $userInfo);
        $this->assign('item', $itemInfo);
        $this->display('Item:itemInfo');
        $this->display(T('Tail/tail'));
    }

    //修改物品页面
    public function modifyInfoEvent($iid) {
        $Item = D('Item');
        $itemInfo = I('post.');
        if ($iid == 'add') {
            unset($itemInfo['iid']);
            $checkData = $Item->checkAddInfo($itemInfo);
            if (!$checkData[0]) {
                $this->error("添加失败: " . $checkData[1]);
            }
        }
        else{
            $itemInfo['iid'] = $iid;
            $checkData = $Item->checkModifyInfo($itemInfo);
            if (!$checkData[0]) {
                $this->error("添加失败: " . $checkData[1]);
            }
        }
        if (!$Item->create($itemInfo)) {
            $this->error("添加失败: ". $Item->getError());
        }
        else {
            if ($iid == 'add')
                $Item->add();
            else
                $Item->save();
            $this->success("提交成功", U('Home/Item/index'));
        }
    }

    //删除物品事件
    public function delItemEvent(){
        $iid = I('post.iid');
        $condition['iid'] = $iid;
        $Item = D('Item');
        if (!$Item->where($condition)->delete()) {
            $this->ajaxReturn('sql error');
        }
        else {
            $this->ajaxReturn('ok');
        }
    }

    //批量删除物品事件
    public function delMultipleItemEvent(){
        $Item = D('Item');
        $deleteIid = I('post.deleteCheckbox');
        $condition['iid'] = array('in', $deleteIid);
        $res = $Item->where($condition)->delete();
        if ($res == count($deleteIid)) {
            $this->success('删除成功', U('Home/Item/index'));
        }
        else {
            $this->success('删除失败', U('Home/Item/index'));
        }
    }
}
?>
