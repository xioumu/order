<?php
namespace Home\Model;
use Think\Model;
class OrderItemModel extends Model {
    protected $_validate = array(
        array('name', 'require', '必须填写物品名', self::MUST_VALIDATE),
        array('price', 'require', '必须填写价格', self::MUST_VALIDATE),
        array('quantity', 'require', '必须填写采购数量', self::MUST_VALIDATE),
    );
    //填充新增订单物品信息
    public function getNewInfo($oid) {
        $OrderItemInfo = I('post.');
        $OrderItemInfo['oid'] = $oid;
        unset($OrderItemInfo['ooid']);
        return $OrderItemInfo;
    }

    //获取修改订单物品的信息
    public function getModifyInfo($oid, $oiid) {
        $OrderItemInfo = I('post.');
        $OrderItemInfo['oiid'] = $oiid;
        return $OrderItemInfo;
    }

    //获取订单中所有物品信息
    public function getOrderItemList($oid) {
        $condition['oid'] = $oid;
        $fieldList = array('oiid', 'oid', 'name', 'scale', 'price', 'remark', 'quantity');
        $fieldList['price * quantity'] = 'total_price';
        $orderItemList = $this->field($fieldList)->where($condition)->select();
        return $orderItemList;
    }

    public function getOrderItemListNameKey($oid){
        $res = array();
        $itemList = $this->getOrderItemList($oid);
        foreach ($itemList as $item) {
            $res[$item['name']] = $item;
        }
        return $res;
    }

    //获取订单中物品的信息
    public function getOrderItemInfo($oiid) {
        $condition['oiid'] = $oiid;
        $orderItemInfo = $this->where($condition)->find();
        $orderItemInfo['totalPrice'] = $orderItemInfo['count'] * $orderItemInfo['price'];
        return $orderItemInfo;
    }


}
