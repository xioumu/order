<?php if (!defined('THINK_PATH')) exit();?>            <div class="row">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                            <h2> 物品管理</h2>

                            <div class="operation">
                                <button class="btn btn-info btn-sm" href="#">
                                    添加物品
                                </button>
                                <button class="btn btn-danger btn-sm" href="#">
                                    删除选中物品
                                </button>
                            </div>
                        </div>
                        <div class="box-content">
                            <table class="table table-striped table-bordered bootstrap-datatable datatable ">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>名称</th>
                                    <th>规格</th>
                                    <th>单价</th>
                                    <th>备注</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>香蕉</td>
                                    <td >元/kg</td>
                                    <td >8</td>
                                    <td ></td>
                                    <td >
                                        <a class="btn btn-info btn-sm" href="#">修改</a>
                                        <a class="btn btn-danger btn-sm" href="#">删除</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>苹果</td>
                                    <td >元/kg</td>
                                    <td >10</td>
                                    <td ></td>
                                    <td >
                                        <a class="btn btn-info btn-sm" href="#">修改</a>
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