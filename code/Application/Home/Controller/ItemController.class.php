<?php
namespace Home\Controller;
use Think\Controller;
class ItemController extends Controller {
    public function _before_index(){
        $this->display(T('Head/head'));
    }
    public function index(){
        $navbar = A('Navbar');
        $navbar->index();
        $leftMenu = A('LeftMenu');
        $leftMenu->index();
        $breadcrumb = A('Breadcrumb');
        $breadcrumb->index();
        $this->display('Item:itemList');
    }
    public function _after_index() {
        $this->display(T('Tail/tail'));
    }
}
?>
