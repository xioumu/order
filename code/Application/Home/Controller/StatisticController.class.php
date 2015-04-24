<?php
namespace Home\Controller;
use Think\Controller;
class StatisticController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
        $this->breadcrumb = A('Breadcrumb');
    }
    public function index(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $this->breadcrumb->index();
        $this->display('Statistic:choiceDate');
        $this->display(T('Tail/tail'));
    }
    public function info(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $this->breadcrumb->index();
        $this->display('Statistic:info');
        $this->display(T('Tail/tail'));
    }
}
?>
