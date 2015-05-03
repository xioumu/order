<?php
namespace Home\Controller;
use Think\Controller;
class StatisticController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
    }
    public function index(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D('User');
        $Order = D('Order');
        $userInfo = $User->getInfo();
        $creatorList = $Order->getCreatorList();
        $this->assign('user', $userInfo);
        $this->assign('creatorList', $creatorList);
        $this->display('Statistic:choiceDate');
        $this->display(T('Tail/tail'));
    }
    public function info(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D('User');
        $Order = D('Order');
        $OrderItem = D('OrderItem');
        $userInfo = $User->getInfo();
        $statisticItemList = $Order->getStatisticItemList(I('post.begin_date'), I('post.end_date'), I('post.creator'));
        $sumPrice = $this->getSumPrice($statisticItemList);
        $this->assign('user', $userInfo);
        $this->assign('statisticItemList', $statisticItemList);
        $this->assign('sumPrice', $sumPrice);
        $this->display('Statistic:info');
        $this->display(T('Tail/tail'));
    }
    private function getSumPrice($statisticItemList) {
        $sumPrice = 0;
        foreach ($statisticItemList as $item) {
            $sumPrice += $item['sumPrice'];
        }
        return $sumPrice;
    }
}
?>
