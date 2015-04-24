<?php if (!defined('THINK_PATH')) exit();?><div class="row">
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
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" value="苹果">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="creations" class="col-sm-2 control-label">规格</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="creations" value="元/kg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buyer" class="col-sm-2 control-label">单价</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="buyer" value="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="creationTime" class="col-sm-2 control-label">备注</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="creationTime" value="我是备注">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="totalCount" class="col-sm-2 control-label">购买数量</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="totalCount" value="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="totalPrice" class="col-sm-2 control-label">购买总价</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control disabled" id="totalPrice" value="100" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="saveItem" class="col-sm-3 control-label">保存至物品列表</label>

                        <div class="col-sm-9 checkbox">
                            <input type="checkbox"  id="saveItem" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">提交修改</button>
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