<?php if (!defined('THINK_PATH')) exit();?><div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li><span><?php echo ($user["typeName"]); ?></span></li>
            <li><span>订单管理</span></li>
            <li><span>添加订单</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>添加订单</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" method="post" action="/order/code/index.php/Home/Order/addOrderEvent">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">订单名称</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="水果">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buyer" class="col-sm-2 control-label">采购员</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="buyer" name="buyer" value="关云长">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">下一步</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    <!-- content ends -->
</div>
<!--/fluid-row-->

</div><!--/.fluid-container-->