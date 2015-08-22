<?php
namespace Home\Controller;
use Think\Controller;
class StatisticController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
        $this->public = A('public');
    }

    // 统计信息选择页面
    public function index(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D('User');
        $Order = D('Order');
        $userInfo = $User->getInfo();
        $creatorList = $Order->getCreatorList();
        if ($userInfo['type'] == 'staff') {
            $creatorList = array(array('creator' => $userInfo['username']));
        }
        $this->assign('user', $userInfo);
        $this->assign('creatorList', $creatorList);
        $this->display('Statistic:choiceDate');
        $this->display(T('Tail/tail'));
    }

    // 统计信息页面
    public function info(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D('User');
        $Order = D('Order');
        $userInfo = $User->getInfo();
        $statistic = $this->dealDatePostInfo();
        $statisticItemList = $Order->getStatisticItemList($statistic['beginDate'], $statistic['endDate'], $statistic['creator']);
        if ($userInfo['type'] == 'staff')
            $this->public->checkUserOrTypeLicence(array($statistic['creator']), array());
        $statistic['sumPrice'] = $this->getSumPrice($statisticItemList);
        $this->assign('user', $userInfo);
        $this->assign('statisticItemList', $statisticItemList);
        $this->assign('statistic', $statistic);
        $this->display('Statistic:info');
        $this->display(T('Tail/tail'));
    }

    //打印统计信息页面
    public function printInfo($beginDate, $endDate, $creator) {
        $Order = D('Order');
        $statistic['beginDate'] = $beginDate;
        $statistic['endDate'] = $endDate;
        $statistic['creator'] = $creator;
        $statistic = $this->dealDatePostInfo("data", $statistic);
        $statisticItemList = $Order->getStatisticItemList($statistic['beginDate'], $statistic['endDate'], $statistic['creator']);
        $statistic['sumPrice'] = $this->getSumPrice($statisticItemList);
        $this->assign('statisticItemList', $statisticItemList);
        $this->assign('statistic', $statistic);
        $this->display('Statistic:printInfo');
    }

    //处理获取时间的post
    private function dealDatePostInfo($type = 'post', $data = '') {
        $res = array();
        if ($type == 'post') {
            //数据从post来
            $res['beginDate'] = I('post.begin_date');
            $res['endDate'] = I('post.end_date');
            $res['creator'] = I('post.creator');
        }
        else if ($type == 'data') {
            //数据从data来
            $res['beginDate'] = $data['beginDate'];
            $res['endDate'] = $data['endDate'];
            $res['creator'] = $data['creator'];
        }

        if ($res['beginDate'] == '' || $res['endDate'] == '' || $res['beginDate'] == 'all') {
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
