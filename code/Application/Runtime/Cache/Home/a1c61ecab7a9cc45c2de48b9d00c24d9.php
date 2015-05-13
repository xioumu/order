<?php if (!defined('THINK_PATH')) exit();?><!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">
    <div class="navbar-inner">
        <a class="navbar-brand" href="#"> <span>采购订单系统</span></a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo ($navbar["username"]); ?></span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="/order/code/index.php/Home/User/changePasswd/<?php echo ($navbar["username"]); ?>">修改密码</a></li>
                <li class="divider"></li>
                <li><a href="/order/code/index.php/Home/User/logout">注销</a></li>
            </ul>
        </div>
        <!-- user dropdown ends -->

    </div>
</div>
<!-- topbar ends -->