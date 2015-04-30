<?php if (!defined('THINK_PATH')) exit();?><div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li><span><?php echo ($user["typeName"]); ?></span></li>
            <li><span>订单管理</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>订单管理</h2>

                    <div class="operation">
                        <a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/addOrder">
                            添加订单
                        </a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable ">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>创建者</th>
                            <th>采购员</th>
                            <th>创建时间</th>
                            <th>总价</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr id="tr_<?php echo ($order["oid"]); ?>">
                                <td><?php echo ($order["name"]); ?></td>
                                <td><?php echo ($order["creator"]); ?></td>
                                <td><?php echo ($order["buyer"]); ?></td>
                                <td><?php echo ($order["creation_time"]); ?></td>
                                <td><?php echo (round($order["total_price"],2)); ?></td>
                                <td><?php echo ($order["status"]); ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm"
                                       href="/order/code/index.php/Home/Order/modifyInfo/<?php echo ($order["oid"]); ?>">详细信息</a>
                                    <?php if($user["type"] == staff): ?><a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/copyOrderEvent/<?php echo ($order["oid"]); ?>">复制订单</a>
                                        <button class="btn btn-danger btn-sm" onclick="delOrder(<?php echo ($order["oid"]); ?>)">删除
                                        </button><?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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

<script>
    function delOrder($oid) {
        var r = confirm('确认删除这个订单?');
        if (r == true) {
            $.post("/order/code/index.php/Home/Order/delOrderEvent", {
                        oid: $oid
                    },
                    function (data, status) {
                        if (status == 'success') {
                            if (data == 'ok') {
                                $('body').noty({"text": "删除成功", "layout": "topLeft", "type": "success"});
                                $('#tr_' + $oid).remove();
                            }
                            else {
                                $('body').noty({"text": "error:" + data, "layout": "topLeft", "type": "error"});
                            }
                        }
                        else {
                            $('body').noty({"text": "js post error0!'", "layout": "topLeft", "type": "error"});
                        }
                    }
            )
        }
    }
</script>