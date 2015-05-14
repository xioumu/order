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

    //检测权限
    public function checkUserOrTypeLicence($nameList, $typeList) {
        $User = D('User');
        $username = session('username');
        $userType = $User->getType();
        $nameAccept = false;
        $typeAccept = false;
        if (in_array($username, $nameList))
            $nameAccept = true;
        if (in_array($userType, $typeList))
            $typeAccept = true;
        $res = ($nameAccept || $typeAccept);
        if (!$res)
            $this->error('权限错误', U('/Home/Index/index'));
        else
            return true;
    }
}
