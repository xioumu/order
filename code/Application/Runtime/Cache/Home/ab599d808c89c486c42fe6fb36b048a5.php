<?php if (!defined('THINK_PATH')) exit();?><div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li><span><?php echo ($user["typeName"]); ?></span></li>
            <li><span>订单管理</span></li>
            <li><span>订单详情</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>订单信息</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" action="/order/code/index.php/Home/Order/modifyInfoEvent/<?php echo ($order["oid"]); ?>" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">名称</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name = "name" value="<?php echo ($order["name"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buyer" class="col-sm-2 control-label">采购员</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control disable" id="buyer" name="buyer" value="<?php echo ($order["buyer"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="creations" class="col-sm-2 control-label">创建者</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="creations" value="<?php echo ($order["creator"]); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="creationTime" class="col-sm-2 control-label">创建时间</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="creationTime" value="<?php echo ($order["creation_time"]); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="totalPrice" class="col-sm-2 control-label">总价</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="totalPrice" value="981" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark" class="col-sm-2 control-label">审批备注</label>

                            <div class="col-sm-10">
                                <div class=" well" id="remark">
                                    审批者：审批者<br>
                                    审批时间：2015-4-17 22:20<br>
                                    <blockquote>添加物品：香蕉<br>
                                        修改物品“苹果”数量：10 改为 20<br>
                                        修改物品“苹果”价格：1 改为 2<br>
                                    </blockquote>
                                    <hr>
                                    审批者：老板<br>
                                    审批时间：2015-4-18 22:20<br>
                                    <blockquote>添加物品：荔枝<br>
                                        修改物品“苹果”数量：20 改为 15<br>
                                        修改物品“苹果”价格：2 改为 4<br>
                                    </blockquote>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">保存</button>
                                <button class="btn btn-info">提交审批</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2> 物品详单</h2>

                    <div class="operation">
                        <a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/orderItemInfo/<?php echo ($order["oid"]); ?>/add">
                            添加物品
                        </a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable ">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>规格</th>
                            <th>单价</th>
                            <th>备注</th>
                            <th>购买数量</th>
                            <th>购买总价</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>香蕉</td>
                            <td>元/kg</td>
                            <td>8</td>
                            <td></td>
                            <td>10</td>
                            <td>80</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="#">修改</a>
                                <a class="btn btn-danger btn-sm" href="#">删除</a>
                            </td>
                        </tr>
                        <tr>
                            <td>苹果</td>
                            <td>元/kg</td>
                            <td>10</td>
                            <td></td>
                            <td>10</td>
                            <td>100</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/orderItemInfo">修改</a>
                                <a class="btn btn-danger btn-sm" href="#">删除</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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