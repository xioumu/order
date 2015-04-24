<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2> 物品管理</h2>

                <div class="operation">
                    <button class="btn btn-info btn-sm" href="#">
                        添加订单
                    </button>
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
                    <tr>
                        <td>主食</td>
                        <td>staff1</td>
                        <td>赵子龙</td>
                        <td>2015-04-16 23:06</td>
                        <td>981</td>
                        <td><span class="label label-warning">未提交</span></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="/order/code/index.php/Home/Order/orderInfo">详细信息</a>
                            <a class="btn btn-info btn-sm" href="#">复制订单</a>
                            <a class="btn btn-danger btn-sm" href="#">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td>肉类</td>
                        <td>staff1</td>
                        <td>赵子龙</td>
                        <td>2015-04-16 23:06</td>
                        <td>981</td>
                        <td><span class="label label-info">审批者审批中</span></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="#">详细信息</a>
                            <a class="btn btn-info btn-sm" href="#">复制订单</a>
                            <a class="btn btn-danger btn-sm disabled" href="#">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td>蔬菜</td>
                        <td>staff1</td>
                        <td>赵子龙</td>
                        <td>2015-04-16 23:06</td>
                        <td>981</td>
                        <td><span class="label label-info">老板审批中</span></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="#">详细信息</a>
                            <a class="btn btn-info btn-sm" href="#">复制订单</a>
                            <a class="btn btn-danger btn-sm disabled" href="#">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td>水果</td>
                        <td>staff2</td>
                        <td>关云长</td>
                        <td>2015-04-15 23:06</td>
                        <td>781</td>
                        <td><span class="label label-success">审批通过</span></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="#">详细信息</a>
                            <a class="btn btn-info btn-sm" href="#">复制订单</a>
                            <a class="btn btn-danger btn-sm" href="#">删除</a>
                        </td>
                    </tr>
                    <tr>
                        <td>水果</td>
                        <td>staff2</td>
                        <td>关云长</td>
                        <td>2015-04-15 23:06</td>
                        <td>781</td>
                        <td><span class="label label-danger">被驳回</span></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="#">详细信息</a>
                            <a class="btn btn-info btn-sm" href="#">复制订单</a>
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