<?php
namespace Home\Controller;
use Think\Controller;
class LeftMenuController extends Controller {
    public function index(){
        $this->display('LeftMenu:leftMenu');
    }
}
?>
