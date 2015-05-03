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
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo ($order["name"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buyer" class="col-sm-2 control-label">采购员</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control disable" id="buyer" name="buyer"
                                       value="<?php echo ($order["buyer"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="creations" class="col-sm-2 control-label">创建者</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="creations" value="<?php echo ($order["creator"]); ?>"
                                       disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="creationTime" class="col-sm-2 control-label">创建时间</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="creationTime" value="<?php echo ($order["creation_time"]); ?>"
                                       disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="totalPrice" class="col-sm-2 control-label">总价(元)</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="totalPrice" value="<?php echo (round($order["total_price"],2)); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">状态</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="status" value="<?php echo ($order["status"]); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark" class="col-sm-2 control-label">审批备注</label>

                            <div class="col-sm-10">
                                <div class=" well" id="remark">
                                    <?php if(is_array($order["change_remark"])): $i = 0; $__LIST__ = $order["change_remark"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$remark): $mod = ($i % 2 );++$i;?>审批者：<?php echo ($remark["username"]); ?><br>
                                        <blockquote><?php if(is_array($remark["content"])): $i = 0; $__LIST__ = $remark["content"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$content): $mod = ($i % 2 );++$i; if($content["type"] == order): ?>修改订单<?php echo ($content["attribute_name"]); ?>："<?php echo ($content["old_val"]); ?>" 改为 "<?php echo ($content["new_val"]); ?>"<br>
                                                    <?php elseif($content["type"] == del): ?>删除物品"<?php echo ($content["item_name"]); ?>"<?php echo ($content["attribute_name"]); ?><br>
                                                    <?php elseif($content["type"] == add): ?>添加物品"<?php echo ($content["item_name"]); ?>"<?php echo ($content["attribute_name"]); ?><br>
                                                    <?php elseif($content["type"] == modify): ?>修改物品"<?php echo ($content["item_name"]); ?>"<?php echo ($content["attribute_name"]); ?>："<?php echo ($content["old_val"]); ?>" 改为 "<?php echo ($content["new_val"]); ?>"<br><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                        </blockquote>
                                        <hr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?php if($permission["order"] == true): ?><button type="submit" class="btn btn-info">保存</button>
                                    <a class="btn btn-info" href="/order/code/index.php/Home/Order/submitEvent/<?php echo ($order["oid"]); ?>">提交审批</a>
                                    <?php if(($order["type"] == checker) OR ($order["type"] == boss)): ?><a class="btn btn-danger" href="/order/code/index.php/Home/Order/submitEvent/<?php echo ($order["oid"]); ?>/false">驳回审批</a><?php endif; endif; ?>
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
                        <?php if($permission["order"] == true): ?><a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/orderItemInfo/<?php echo ($order["oid"]); ?>/add">
                                添加物品
                            </a><?php endif; ?>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable ">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>规格</th>
                            <th>单价</th>
                            <th>购买数量</th>
                            <th>购买总价(元)</th>
                            <th>备注</th>
                            <?php if($permission["order"] == true): ?><th>操作</th><?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($orderItemList)): $i = 0; $__LIST__ = $orderItemList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orderItem): $mod = ($i % 2 );++$i;?><tr id="tr_<?php echo ($orderItem["oiid"]); ?>">
                                <td><?php echo ($orderItem["name"]); ?></td>
                                <td><?php echo ($orderItem["scale"]); ?></td>
                                <td><?php echo ($orderItem["price"]); ?></td>
                                <td><?php echo ($orderItem["quantity"]); ?></td>
                                <td><?php echo (round($orderItem["total_price"],2)); ?></td>
                                <td><?php echo ($orderItem["remark"]); ?></td>
                                <?php if($permission["order"] == true): ?><td>
                                        <a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/orderItemInfo/<?php echo ($orderItem["oid"]); ?>/<?php echo ($orderItem["oiid"]); ?>">修改</a>
                                        <button class="btn btn-danger btn-sm" onclick="delOrderItem(<?php echo ($orderItem["oiid"]); ?>)">删除</button>
                                    </td><?php endif; ?>
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
    function delOrderItem($oiid) {
        var r = confirm('确认删除这个物品?');
        if (r == true) {
            $.post("/order/code/index.php/Home/Order/delOrderItemEvent", {
                        oiid: $oiid
                    },
                    function (data, status) {
                        if (status == 'success') {
                            if (data == 'ok') {
                                $('body').noty({"text": "删除成功", "layout": "topLeft", "type": "success"});
                                $('#tr_' + $oiid).remove();
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