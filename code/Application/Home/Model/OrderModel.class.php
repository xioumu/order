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
        $orderInfo['change_remark'] = $this->getChangeRemark($orderInfo);
        return $orderInfo;
    }

    //生成修改备注
    public function getChangeRemark($orderInfo){
        if ($orderInfo['from_oid'] == NULL) return array();
        $remarkList = array();
        $condition['oid'] = $orderInfo['from_oid'];
        $oldOrderInfo = $this->where($condition)->find();
        $userInfo = M('User')->where("type='" . $orderInfo['type'] . "'" )->find();
        $remark['username'] = $userInfo['username'];
        $remark['content'] =  array();
        $orderInfoRemark = $this->getOrderInfoRemark($orderInfo, $oldOrderInfo);
        $ItemChangeRemark = $this->getItemRemark($orderInfo, $oldOrderInfo);
        $remark['content'] = array_merge($remark['content'], $ItemChangeRemark);
        $remark['content'] = array_merge($remark['content'], $orderInfoRemark);
        $remarkList = $this->getChangeRemark($oldOrderInfo);
        if (count($remark['content']) != 0) {
            array_push($remarkList, $remark);
        }
        return $remarkList;
    }

    //生成订单信息修改备注
    public function getOrderInfoRemark($order, $oldOrder) {
        $orderInfoRemarkList = array();
        $attributeList = array('name', 'buyer');
        $nameList = array('名称', '采购员');
        for ($i = 0; $i < count($attributeList); $i++){
            if ($order[$attributeList[$i]] != $oldOrder[$attributeList[$i]]) {
                $orderInfoRemark['type'] = 'order';
                $orderInfoRemark['item_name'] = '订单';
                $orderInfoRemark['attribute_name'] = $nameList[$i];
                $orderInfoRemark['old_val'] = $oldOrder[$attributeList[$i]];
                $orderInfoRemark['new_val'] = $order[$attributeList[$i]];
                array_push($orderInfoRemarkList, $orderInfoRemark);
            }
        }
        return $orderInfoRemarkList;
    }

    //生成订单物品修改备注
    public function getItemRemark($order, $oldOrder){
        $itemRemark = array();
        $OrderItem = D('OrderItem');
        $itemList = $OrderItem->getOrderItemListNameKey($order['oid']);
        $oldItemList = $OrderItem->getOrderItemListNameKey($oldOrder['oid']);
        $itemRemark = array_merge($itemRemark, $this->getItemRemarkAdd($itemList, $oldItemList, 'add'));
        $itemRemark = array_merge($itemRemark, $this->getItemRemarkAdd($oldItemList, $itemList, 'del'));  //获取删除的评论
        $itemRemark = array_merge($itemRemark, $this->getItemRemarkModify($itemList, $oldItemList));
        return $itemRemark;
    }

    //获取订单新增或删除物品的记录
    public function getItemRemarkAdd($itemList, $oldItemList, $typeName) {
        $itemRemark = array();
        foreach ($itemList as $item) {
           if (!array_key_exists($item['name'], $oldItemList)) {
               $remark['item_name'] = $item['name'];
               $remark['type'] = $typeName;
               array_push($itemRemark, $remark);
           }
        }
        return $itemRemark;
    }

    //获取物品修改的记录
    public function getItemRemarkModify($itemList, $oldItemList) {
        $itemRemark = array();
        $attributeList = array('scale', 'price', 'quantity', 'remark');
        $nameList = array('规格', '价格',  '数量', '备注');
        foreach ($itemList as $item) {
            if (array_key_exists($item['name'], $oldItemList)) {
                $oldItem = $oldItemList[$item['name']];
                for ($i = 0; $i < count($nameList); $i++) {
                    if ($item[$attributeList[$i]] != $oldItem[$attributeList[$i]]) {
                        $remark['type'] = 'modify';
                        $remark['item_name'] = $item['name'];
                        $remark['attribute_name'] = $nameList[$i];
                        $remark['old_val'] = $oldItem[$attributeList[$i]];
                        $remark['new_val'] = $item[$attributeList[$i]];
                        array_push($itemRemark, $remark);
                    }
                }
            }
        }
        return $itemRemark;
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
        $orderList = $this->where($condition)->order('creation_time desc')->select();
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
        $orderInfo['type'] = 'staff';
        $orderInfo['from_oid'] = NULL;
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
        if (!$accept)  {
            if ($type == 'checker')
                $nextType = 'checkerReject';
            elseif ($type == 'boss')
                $nextType = 'bossReject';
        }
        elseif ($type == 'staff') $nextType = 'checker';
        elseif ($type == 'checker') $nextType = 'boss';
        elseif ($type == 'boss')  $nextType = 'accept';
        return $nextType;
    }

    //获取订单名称
    public function getStatus($type) {
        if ($type == 'checkerReject') return "被审批者驳回";
        elseif ($type == 'bossReject') return "被老板驳回";
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

    //判断修复订单权限
    public function getOrderPermission($userInfo, $orderInfo){
        if ($userInfo['type'] == 'staff') {
            if ($userInfo['username'] != $orderInfo['creator'])
                return false;
        }
        return $userInfo['type'] == $orderInfo['type'];
    }

    public function delOrder($oid) {
        if ($oid == NULL) return true;
        $OrderItem = D('OrderItem');
        $condition['oid'] = $oid;
        $orderInfo = $this->where($condition)->find();
        //删除历史订单
        if (!$this->delOrder($orderInfo['from_oid']))
            return false;
        //删除订单物品
        if ($OrderItem->where($condition)->delete() === false) {
            return false;
        }
        //删除订单
        if (!$this->where($condition)->delete()) {
            return false;
        } else {
            return true;
        }
    }
}

?>
