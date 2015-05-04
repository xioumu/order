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
        $userInfo = $User->getInfo();

        $statistic = $this->dealDatePostInfo();
        $statisticItemList = $Order->getStatisticItemList($statistic['beginDate'], $statistic['endDate'], $statistic['creator']);
        $statistic['sumPrice'] = $this->getSumPrice($statisticItemList);
        $this->assign('user', $userInfo);
        $this->assign('statisticItemList', $statisticItemList);
        $this->assign('statistic', $statistic);
        $this->display('Statistic:info');
        $this->display(T('Tail/tail'));
    }

    //处理获取时间的post
    private function dealDatePostInfo() {
        $res = array();
        $res['beginDate'] = I('post.begin_date');
        $res['endDate'] = I('post.end_date');
        $res['creator'] = I('post.creator');
        if ($res['beginDate'] == '' || $res['endDate'] == '') {
            $res['beginDate'] = $res['endDate'] = 'all';
            $res['dateName'] = '全部';
        }
        else
            $res['dateName'] = $res['beginDate'] . ' 至 ' . $res['endDate'];
        if ($res['creator'] == '')
            $res['creator'] = 'all';
        if ($res['creator'] == 'all')
            $res['creatorName'] = '全部';
        else
            $res['creatorName'] = $res['creator'];
        return $res;
    }
    private function getSumPrice($statisticItemList) {
        $sumPrice = 0;
        foreach ($statisticItemList as $item) {
            $sumPrice += $item['sumPrice'];
        }
        return number_format($sumPrice, 2);
    }
}
?>
