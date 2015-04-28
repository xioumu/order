<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize() {
        $this->public = A('Public');
    }
    public function index($error_passwd = false){
        $this->display(T('Head/head'));
        $info['errorPasswd'] = $error_passwd;
        $this->assign('info', $info);
        $this->display('Index:index');
        $this->display(T('Tail/tail'));
    }
    public function login(){
        $username = I('post.username');
        $passwd = I('post.passwd');
        if ($this->checkLogin($username, $passwd)) {
            session('username', $username);
        }
        else {
            $this->index(true);
        }
        $this->public->jumpIndex();
    }

    //验证登陆
    protected function checkLogin($username, $passed) {
        $User = M('User');
        $condition['username'] = $username;
        $condition['passwd'] = $passed;
        $res = $User->where($condition)->select();
        if ($res != NULL)
            return true;
        else return false;
    }
}
?>
