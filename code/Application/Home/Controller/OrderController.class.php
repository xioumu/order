<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
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
        $this->display('Order:orderList');
        $this->display(T('Tail/tail'));
    }
    public function orderInfo() {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $this->breadcrumb->index();
        $this->display('Order:orderInfo');
        $this->display(T('Tail/tail'));
    }
    public function orderItemInfo() {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $this->breadcrumb->index();
        $this->display('Order:orderItemInfo');
        $this->display(T('Tail/tail'));
    }
}
?>
