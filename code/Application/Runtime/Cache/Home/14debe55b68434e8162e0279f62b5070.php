<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>选择日期</h2>

            </div>
            <div class="box-content">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="submit" class="btn btn-info">一天内</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">三天内</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">一周内</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="submit" class="btn btn-info">一月内</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">半年内</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">一年内</button>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-6  control-label">自定义查询（选择查询时间段）</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">开始日期</label>

                        <div class="col-sm-2">
                            <input type="text" class="form-date form-control" value="">
                        </div>
                        <label class="col-sm-2 control-label">终止日期</label>

                        <div class="col-sm-2">
                            <input type="text" class="form-date form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-offset-1 col-sm-1 ">创建者</label>
                        <div class="col-sm-1">
                            <select class="">
                                <option value="volvo">全部</option>
                                <option value="volvo">staff1</option>
                                <option value="volvo">staff2</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="col-sm-offset-4">
                            <a type="submit" class="btn btn-info" href="/order/code/index.php/Home/Statistic/info">确定</a>
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