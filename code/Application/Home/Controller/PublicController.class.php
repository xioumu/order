<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function jumpIndex($userType = ''){
        $username = session('username');
        if ($username == '') {
            $this->redirect('/Home');
        }
        if ($userType == '') {
            $User = D('User');
            $userType = $User->getType($username);
        }
        if ($userType == 'admin') {
            $this->redirect('/Home/Admin/userManage');
        }
        elseif ($userType == 'staff' or $userType == 'checker' or $userType == 'boss' or $userType == 'observer') {
            $this->redirect('/Home/Order/index');
        }
        else {
            //echo $userType;
            echo 'type error';
        }
    }
}
