<?php
namespace Home\Model;
use Think\Model;
class ItemModel extends Model{
    protected $_validate = array(
        array('name','require','必须填写名称'),
        array('scale','require','必须填写规格'),
        array('price','require','必须填写价格'),
    );

    public function checkAddInfo($itemInfo){
        $condition['name'] = $itemInfo['name'];
        if($this->where($condition)->find() == NULL)
            return array(true);
        else
            return array(false, '已存在相同名称物品');
    }

    public function checkModifyInfo($itemInfo){
        $condition['name'] = $itemInfo['name'];
        $resInfo = $this->where($condition)->find();
        if ($resInfo == NULL || $resInfo['iid'] == $itemInfo['iid'])
            return array(true);
        else
            return array(false, '已存在相同名称物品');
    }

    //获取物品列表
    public function getItemList(){
        $itemList = $this->select();
        return $itemList;
    }

    //获取物品信息
    public function getInfo($iid){
        $condition['iid'] = $iid;
        return $this->where($condition)->find();
    }

    //用名称获取信息
    public function getInfoByName($name) {
        $condition['name'] = $name;
        return $this->where($condition)->find();
    }
}

?>
