<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function _initialize() {
        $this->navbar = A('Navbar');
        $this->leftMenu = A('LeftMenu');
    }
    //用户管理页面，也是默认页面
    public function userManage(){
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $User = D("User");
        $userList = $User->getAllUser();
        $this->assign('userList', $userList);
        $this->display('Admin:userManage');
        $this->display(T('Tail/tail'));
    }
    //添加用户页面
    public function addUser() {
        $this->display(T('Head/head'));
        $this->navbar->index();
        $this->leftMenu->index();
        $this->display('Admin:addUser');
        $this->display(T('Tail/tail'));
    }
    //添加用户事件
    public function addUserEvent() {
        $User = D('User');
        $info = I('post.');
        $info['typeName'] = $User->getUserTypeName($info['type']);
        $infoCheck = $this->checkAddUserInfo($info);
        if ($infoCheck[0] == false) {
            $this->error('添加失败: ' . $infoCheck[1]);
        }
        if (!$User->create($info, 1)) {
            print_r($info);
            $this->error('添加失败: ' . $User->getError());
        }
        else {
            $User->add();
            $this->success('添加成功', U('Admin/userManage'));
        }
    }
    //删除用户事件
    public function delUserEvent() {
        $User = M('User');
        $info = I('post.');
        $infoCheck = $this->checkDelUserInfo($info);
        if ($infoCheck[0] == false) {
            $this->ajaxReturn($infoCheck[1]);
        }
        $condition['username'] = $info['username'];
        if (!$User->where($condition)->delete()) {
            $this->ajaxReturn('sql error');
        }
        else {
            $this->ajaxReturn('ok');
        }
    }
    //检测添加用户的信息
    private function checkAddUserInfo($info) {
        $User = M('User');
        if ($info['type'] == 'boss' or $info['type'] == 'checker') {
            $condition['type'] = $info['type'];
            $haveType = $User->where($condition)->find();
            if ($haveType != NULL) {
                return array(false, $info['typeName'] . "只能存在一个");
            }
        }
        $condition['username'] = $info['username'];
        $haveUser = $User->where($condition)->find();
        if ($haveUser != NULL)
            return array(false, '已存在用户名' . $info['username']);
        return array(true, "");
    }
    //检测删除用户的信息
    private function checkDelUserInfo($info) {
        if ($info['type'] == 'admin')
            return array(false, '不能删除系统管理员');
        else
            return array(true, '');
    }
}
?>
