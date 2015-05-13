<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
        $this->breadcrumb = A('Breadcrumb');
        $this->public = A('Public');
    }
    //修改密码页面
    public function changePasswd($username){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $this->breadcrumb->index();
        $userInfo = D('User')->getInfo();
        $info['username'] = $username;
        $this->assign('info', $info);
        $this->assign('user', $userInfo);
        $this->display('User:changePasswd');
        $this->display(T('Tail/tail'));
    }
    //修改密码事件
    public function changePasswdEvent() {
        $User = D('User');
        $data['username'] = I('post.username');
        $data['passwd'] = I('post.passwd');
        $data['repasswd'] = I('post.repasswd');
        if (!$User->checkPasswdComplex($data['passwd'])) {
           $this->error("密码必须大于6位且同时包含数字与字母");
        }
        if ($data['passwd'] != $data['repasswd']) {
            $this->error('密码与重复密码不一致');
        }
        $res = $User->data($data)->save();
        //只用$res == false的话，数据不变会出错
        if ($res === false) {
            //echo $res;
            $this->error('修改密码失败');
        }
        else{
            $this->success('密码修改成功', U('Public/jumpIndex'));
        }
    }

    public function logout() {
        session('username', null);
        $this->public->jumpIndex();
    }


}

