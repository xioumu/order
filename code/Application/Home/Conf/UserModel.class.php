<?php
namespace Home\Model;
use Think\Model;
 class UserModel extends Model{
     protected $_validate = array(
         array('username','require','必须有账号'),
         array('password','require','必须有密码'),
         array('repassword','require','必须有确认密码'),
         array('repassword','password','确认密码不一致',self::EXISTS_VALIDATE,'confirm'),
         array('username','','帐号已经存在',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
     );

 }

?>
