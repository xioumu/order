<?php if (!defined('THINK_PATH')) exit();?><div class="ch-container">
    <div class="row">
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">
                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">菜单</li>
                        <?php if(is_array($leftMenu)): $i = 0; $__LIST__ = $leftMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li><a class="ajax-link" href="/order/code/index.php/Home/<?php echo ($row["url"]); ?>"><span><?php echo ($row["name"]); ?></span></a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->