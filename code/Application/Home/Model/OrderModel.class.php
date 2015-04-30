<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model{
    protected $_validate = array(
        array('name','require','必须填写订单名', self::MUST_VALIDATE),
        array('buyer','require','必须填写采购者', self::MUST_VALIDATE),
    );

    //填充新建的订单信息
    public function getNewOrderInfo($userInfo){
        $orderInfo = I('post.');
        $orderInfo['creator'] = $userInfo['username'];
        $orderInfo['type'] = $userInfo['type'];
        $orderInfo['form_oid'] = NULL;
        $orderInfo['creation_time'] = date('Y-m-d H:i:s',time());
        $orderInfo['status'] = '未提交';
        $orderInfo['show'] = 1;
        return $orderInfo;
    }
    //获取订单信息
    public function getOrderInfo($oid){
        $condition['oid'] = $oid;
        $orderInfo = $this->where($condition)->find();
        $orderInfo['total_price'] = $this->getOrderTotalPrice($oid);
        return $orderInfo;
    }

    //获取订单总价
    public function getOrderTotalPrice($oid) {
        $fieldList['price * quantity'] = 'total_price';
        $condition['oid'] = $oid;
        $itemTotalPrice = M('OrderItem')->field($fieldList)->where($condition)->select();
        $totalPrice = 0;
        foreach ($itemTotalPrice as $item)
            $totalPrice += $item['total_price'];
        return $totalPrice;
    }
    //获取修改订单信息
    public function getModifyInfo($oid) {
        $orderInfo['name'] = I('post.name');
        $orderInfo['buyer'] = I('post.buyer');
        $orderInfo['oid'] = $oid;
        return $orderInfo;
    }
    //获取所有订单的信息
    public function getOrderList($userInfo){
        $condition = array();
        $condition['show'] = 1;
        if ($userInfo['type'] == 'staff') {
            $condition['creator'] = $userInfo['username'];
        }
        $orderList = $this->where($condition)->select();
        for ($i = 0; $i < count($orderList); $i++){
            $orderList[$i]['total_price'] = $this->getOrderTotalPrice($orderList[$i]['oid']);
        }
        return $orderList;
    }

    //复制订单
    public function copyOrder($oid){
        $orderInfo = $this->getOrderInfo($oid);
        $orderInfo['creation_time'] = date('Y-m-d H:i:s',time());
        $orderInfo['status'] = '未提交';
        $orderInfo['show'] = 1;
        unset($orderInfo['oid']);
        if (!$this->create($orderInfo)) {
            dump('复制订单信息出错');
            return false;
        }
        else {
            $newOid = $this->add();
        }

        if (!$this->copyOrderItem($oid, $newOid)) {
            dump('复制订单物品出错');
            return false;
        }
        return true;
    }

    //获取订单下一个类别
    public function getNextType($type, $accept) {
        $nextType = $type;
        if (!$accept)  $nextType = 'reject';
        elseif ($type == 'staff') $nextType = 'checker';
        elseif ($type == 'checker') $nextType = 'boss';
        elseif ($type == 'boss')  $nextType = 'accept';
        return $nextType;
    }

    //获取订单名称
    public function getStatus($type) {
        if ($type == 'reject') return "被驳回";
        elseif ($type == 'staff') return "未提交";
        elseif ($type == 'checker') return "审批者审批中";
        elseif ($type == 'boss') return "老板审批中";
        elseif ($type == 'accept') return "审批通过";
        else return "错误";
    }

    //处理提交老的订单数据
    public function dealOldOrder($oid) {
        $data['show'] = 0;
        $condition['oid'] = $oid;
        if ($this->where($condition)->save($data) === false)
            return false;
        else
            return true;
    }

    //处理审批订单的数据变化
    public function submitOrder($oid, $accept = true){
        $orderInfo = $this->getOrderInfo($oid);
        $orderInfo['type'] = $this->getNextType($orderInfo['type'], $accept);
        $orderInfo['status'] = $this->getStatus($orderInfo['type']);
        $orderInfo['from_oid'] = $oid;
        $orderInfo['show'] = 1;
        unset($orderInfo['oid']);
        if (!$this->create($orderInfo)) {
            dump('新增订单信息出错');
            return false;
        }
        else {
            $newOid = $this->add();
        }
        if (!$this->copyOrderItem($oid, $newOid)) {
            dump('新增订单物品出错');
            return false;
        }
        if (!$this->dealOldOrder($oid)) {
            dump('更新旧数据出错');
            return false;
        }
        return true;
    }

    //复制订单中的物品
    public function copyOrderItem($oid, $newOid) {
        $OrderItem = D('OrderItem');
        $orderItemList = $OrderItem->getOrderItemList($oid);
        foreach ($orderItemList as $itemInfo){
            unset($itemInfo['oiid']);
            $itemInfo['oid'] = $newOid;
            if (!$OrderItem->create($itemInfo)){
                dump('复制物品出错');
                return false;
            }
            else {
                $OrderItem->add();
            }
        }
        return true;
    }
}

?>
