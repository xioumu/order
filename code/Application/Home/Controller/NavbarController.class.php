<?php
namespace Home\Controller;
use Think\Controller;
class NavbarController extends Controller {
    public function index(){
        $navbar['username'] = session('username');
        $this->assign('navbar', $navbar);
        $this->display('Navbar:navbar');
    }
}
?>
