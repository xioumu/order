<?php if (!defined('THINK_PATH')) exit();?><div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li><span><?php echo ($user["typeName"]); ?></span></li>
            <li><span>订单管理</span></li>
            <li><span>订单信息</span></li>
            <li><span><?php echo ($breadcrumb["now"]); ?></span></li>
        </ul>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><?php echo ($breadcrumb["now"]); ?></h2>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" method="post"
                          action="/order/code/index.php/Home/Order/orderItemInfoEvent/<?php echo ($order["oid"]); ?>/<?php echo ($orderItem["oiid"]); ?>">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">名称</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control disabled" id="name" name="name"
                                       value="<?php echo ($orderItem["name"]); ?>">
                            </div>
                            <div class="col-sm-4">
                                <a class="btn btn-info" onclick="fillItemInfo()">从物品库中填充信息</a>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="scale" class="col-sm-2 control-label">规格</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="scale" name="scale"
                                       value="<?php echo ($orderItem["scale"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">价格</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price"
                                       value="<?php echo ($orderItem["price"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label">购买数量</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="quantity" name="quantity"
                                       value="<?php echo ($orderItem["quantity"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark" class="col-sm-2 control-label">备注</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="remark" name="remark"
                                       value="<?php echo ($orderItem["remark"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="saveItem" class="col-sm-3 control-label">添加至物品列表</label>

                            <div class="col-sm-9 checkbox">
                                <input type="checkbox" name="saveItem" id="saveItem" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
</div>
<!--/fluid-row-->

</div><!--/.fluid-container-->
<script>
    function fillItemInfo() {
        var name = $('#name').val();
        $.post("/order/code/index.php/Home/Order/fillOrderItemInfo", {
                    name: name
                },
                function (data, status) {
                    if (status == 'success') {
                        if (data != null) {
                            $('#name').val(data.name);
                            $('#price').val(data.price);
                            $('#scale').val(data.scale);
                            $('#remark').val(data.remark);
                            $('body').noty({"text": "获取信息成功", "layout": "topLeft", "type": "success"});
                        }
                        else {
                            $('body').noty({"text": '物品库中不存在"' + name + '"', "layout": "topLeft", "type": "error"});
                        }
                    }
                    else {
                        $('body').noty({"text": "错误1", "layout": "topLeft", "type": "error"});
                    }
                }
        )
    }
</script>