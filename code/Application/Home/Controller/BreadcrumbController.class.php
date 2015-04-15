<?php
namespace Home\Controller;
use Think\Controller;
class BreadcrumbController extends Controller {
    public function index(){
        $this->display('Breadcrumb:breadcrumb');
    }
}
?>
