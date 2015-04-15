<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _before_index(){
        $this->display(T('Head/head'));
    }
    public function index(){
        $this->display('Index:index');
    }
    public function _after_index() {
        $this->display(T('Tail/tail'));
    }
}
?>
