<?php if (!defined('THINK_PATH')) exit();?><div class="indexBackground">
    <div class="ch-container">
        <div class="row">

            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2 class="loginTitle">采购订单系统</h2>
                </div>
                <!--/span-->
            </div>
            <!--/row-->

            <div class="row" >
                <div class="well col-md-5 center login-box">
                    <?php if($info["errorPasswd"] == false): ?><div class="alert alert-info">
                            请输入用户名和密码
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            用户名或密码错误
                        </div><?php endif; ?>
                    <form class="form-horizontal" action="/order/code/index.php/Home/Index/login" method="post" >
                        <fieldset>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                <input type="text" name = "username" id = "username" class="form-control" placeholder="用户名">
                            </div>
                            <div class="clearfix"></div>
                            <br>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <input type="password" name = "passwd" id = "passwd" class="form-control" placeholder="密码">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend">
                                <label class="remember" for="remember"><input type="checkbox" id="remember">
                                    记住密码</label>
                            </div>
                            <div class="clearfix"></div>

                            <p class="center col-md-5">
                                <button type="submit" class="btn btn-primary" id = 'submit_login' onclick="mysubmit()">登陆</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
                <!--/span-->
            </div>
            <!--/row-->
        </div>
        <!--/fluid-row-->
    </div>
<!--/.fluid-container-->
</div>
<script>
    function mysubmit() {
        if ( $('#remember').prop('checked') == true) {
            localStorage.username = $("#username").val();
            localStorage.passwd = $("#passwd").val();
            localStorage.remember = true;
        }
        else {
            localStorage.username = ''
            localStorage.passwd = ''
            localStorage.remember = false;
       }
    }

    function initialize() {
        if(localStorage.username) {
            $("#username").val(localStorage.username);
            $("#passwd").val(localStorage.passwd);
            $('#remember').prop('checked', localStorage.remember)
        }
    }

    initialize();
</script>