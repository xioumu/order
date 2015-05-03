<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
    }

    //初始页面，展示所有订单
    public function index(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();

        $User = D('User');
        $Order = D('Order');
        $userInfo = $User->getInfo();
        $orderList = $Order->getOrderList($userInfo);
        $this->assign('user', $userInfo);
        $this->assign('orderList', $orderList);
        $this->display('Order:orderList');
        $this->display(T('Tail/tail'));
    }

    //添加订单页面
    public function addOrder() {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();

        $User = D('User');
        $userInfo = $User->getInfo();
        $this->assign('user', $userInfo);
        $this->display('Order:addOrder');
        $this->display(T('Tail/tail'));
    }

    //订单中物品的信息
    public function orderItemInfo($oid, $oiid) {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();

        $OrderItem = D('OrderItem');
        $User = D('User');
        $userInfo = $User->getInfo();
        $orderInfo['oid'] = $oid;
        if ($oiid == 'add') {
            $orderItemInfo['oiid'] = 'add';
            $breadcrumb['now'] = '添加订单物品';
            $this->assign('breadcrumb', $breadcrumb);
        }
        else {
            $orderItemInfo = $OrderItem->getOrderItemInfo($oiid);
        }
        $this->assign('orderItem', $orderItemInfo);
        $this->assign('user', $userInfo);
        $this->assign('order', $orderInfo);
        $this->display('Order:orderItemInfo');
        $this->display(T('Tail/tail'));
    }

    //添加订单事件
    public function addOrderEvent() {
        $User = D('User');
        $Order = D('Order');
        $userInfo = $User->getInfo();
        $orderInfo = $Order->getNewOrderInfo($userInfo);
        if (!$Order->create($orderInfo)) {
            $this->error($Order->getError());
        }
        else {
            $oid = $Order->add();
            $this->redirect('Home/Order/modifyInfo/' . $oid);
        }
    }

    //展现、修改订单
    public function modifyInfo($oid) {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();

        $Order = D('Order');
        $User = D('User');
        $OrderItem = D('OrderItem');
        $userInfo = $User->getInfo();
        $orderInfo = $Order->getOrderInfo($oid);
        $orderItemList = $OrderItem->getOrderItemList($oid);
        $permission['order'] = $Order->getOrderPermission($userInfo, $orderInfo);
        $this->assign('user', $userInfo);
        $this->assign('order', $orderInfo);
        $this->assign('permission', $permission);
        $this->assign('orderItemList', $orderItemList);
        $this->display('Order:modifyInfo');
        $this->display(T('Tail/tail'));
    }

    //修改订单事件
    public function modifyInfoEvent($oid) {
        $Order = D('Order');
        $orderInfo = $Order->getModifyInfo($oid);
        if (!$Order->create($orderInfo)) {
            $this->error($Order->getError());
        }
        else {
            $Order->save();
            $this->success('订单信息保存成功', U('Home/Order/modifyInfo/' . $oid));
        }
    }

    //添加、修改订单中物品事件
    public function orderItemInfoEvent($oid, $oiid) {
        $OrderItem = D('OrderItem');
        if ($oiid == 'add') {
            $OrderItemInfo = $OrderItem->getNewInfo($oid);
        }
        else {
            $OrderItemInfo = $OrderItem->getModifyInfo($oid, $oiid);
        }
        if (!$OrderItem->create($OrderItemInfo)) {
            $this->error($OrderItem->getError());
        }
        else {
            if ($oiid == 'add')
                $oiid = $OrderItem->add();
            else
                $OrderItem->save();
            $this->success('物品信息提交成', U('Home/Order/modifyInfo/' . $oid));
        }
    }

    //删除订单物品
    public function delOrderItemEvent() {
        $OrderItem = D('OrderItem');
        $condition['oiid'] = I('post.oiid');
        if (!$OrderItem->where($condition)->delete()) {
            $this->ajaxReturn('sql error');
        }
        else {
            $this->ajaxReturn('ok');
        }
    }

    //删除订单
    public function delOrderEvent() {
        $Order = D('Order');
        if (!$Order->delOrder(I('post.oid'))) {
            $this->ajaxReturn('delete error');
        }
        else {
            $this->ajaxReturn('ok');
        }
    }

    //复制订单事件
    public function copyOrderEvent($oid){
        $Order = D('Order');
        if ($Order->copyOrder($oid)) {
            $this->success('复制订单成功', U('Home/Order/index'));
        }
        else {
            $this->error('复制订单失败');
        }
    }

    //提交订单、提交审批
    public function submitEvent($oid, $accept = true) {
        $Order = D('Order');
        if ($accept === 'false')
            $accept = false;
        if ($Order->submitOrder($oid, $accept)) {
            $this->success('提交成功', U('Home/Order/index'));
        }
        else {
            $this->error('提交失败');
        }
    }
}
?>
