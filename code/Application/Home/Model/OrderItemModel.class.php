<?php
namespace Home\Model;
use Think\Model;
class OrderItemModel extends Model {
    protected $_validate = array(
        array('name', 'require', '必须填写物品名', self::MUST_VALIDATE),
        array('price', 'require', '必须填写价格', self::MUST_VALIDATE),
        array('quantity', 'require', '必须填写采购数量', self::MUST_VALIDATE),
    );
    public function getNewInfo($oid) {
        $OrderItemInfo = I('post.');
        $OrderItemInfo['oid'] = $oid;
        unset($OrderItemInfo['ooid']);
        return $OrderItemInfo;
    }
}
