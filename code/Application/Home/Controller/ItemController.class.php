<?php
namespace Home\Controller;
use Think\Controller;
class ItemController extends Controller {
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
        $this->display('Item:itemList');
        $this->display(T('Tail/tail'));
    }
}
?>
