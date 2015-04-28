<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    protected $_validate = array(
        array('username','require','必须填写账号'),
        array('passwd','require','必须填写密码'),
        array('repasswd','require','必须填写确认密码'),
        array('repasswd','passwd','确认密码不一致',self::EXISTS_VALIDATE,'confirm'),
        //array('username','','帐号已经存在',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        array('type',array('boss','staff','checker','observer'),'账号类型错误',1,'in',self::MODEL_INSERT),
    );

    public function getType($username = '') {
        if ($username == '') {
            $username = session('username');
        }
        $condition['username'] = $username;
        $type = $this->where($condition)->getField('type');
        return $type;
    }

    public function getAllUser() {
        $userList = $this->select();
        for ($i = 0; $i < count($userList); $i++) {
            $userList[$i]['typeName'] = $this->getUserTypeName($userList[$i]['type']);
        }
        return $userList;
    }

    public function getUserTypeName($type) {
        if ($type == 'admin')  return '系统管理员';
        elseif ($type == 'staff') return '员工';
        elseif ($type == 'checker') return '审批者';
        elseif ($type == 'boss') return "老板";
        elseif ($type == 'observer') return "观察者";
    }

    public function getInfo($username = '') {
        if ($username == '') {
            $username = session('username');
        }
        $user = array();
        $user['username'] = $username;
        $user['type'] = $this->getType($username);
        $user['typeName'] = $this->getUserTypeName($user['type']);
        return $user;
    }

}

?>
