<?php
namespace Home\Controller;
use Think\Controller;
class LeftMenuController extends Controller {
    public function index(){
        $leftMenu = $this->getLeftMenu();
        $this->assign('leftMenu', $leftMenu);
        $this->display('LeftMenu:leftMenu');
    }

    protected function getLeftMenu() {
        $leftMenu = array();
        $User = D('User');
        $userType = $User->getType();
        if ($userType == 'admin') {
            $name = array("用户管理");
            $url = array("Admin/userManage.html");
        }
        else {
            $name = array("订单管理", "物品管理", "统计信息");
            $url = array("Order/index.html", "Item/index.html" , "Statistic/index.html");
        }
        for ($i = 0; $i < count($name); $i++){
            $row['name'] = $name[$i];
            $row['url'] = $url[$i];
            array_push($leftMenu, $row);
        }
        return $leftMenu;
    }

}
?>
