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
        return $orderInfo;
    }
    //获取订单信息
    public function getOrderInfo($oid, $creator){
        $condition['oid'] = $oid;
        $condition['creator'] = $creator;
        $orderInfo = $this->where($condition)->find();
        return $orderInfo;
    }
    //获取修改订单信息
    public function getModifyInfo($oid) {
        $orderInfo['name'] = I('post.name');
        $orderInfo['buyer'] = I('post.buyer');
        $orderInfo['oid'] = $oid;
        return $orderInfo;
    }
}

?>
