<?php
namespace Home\Controller;
use Think\Controller;
class NavbarController extends Controller {
    public function index(){
        $this->display('Navbar:navbar');
    }
}
?>
