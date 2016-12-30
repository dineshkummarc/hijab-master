<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="admin">Home</a></li>                    
	<li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
	<li class="active"><?php echo $function_name; ?></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><?php echo $function_name; ?></h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

	<div class="row">
		<div class="col-md-6 panel-dragable" id="px-system-menu-orders-dragable">
			<!-- START DEFAULT DATATABLE -->
			<?php $x=1; foreach ($data as $md) { ?>
			<div class="panel panel-primary panel-toggled" id="item-<?php echo $md->id; ?>" data-menu-parent="<?php echo $md->id_parent; ?>">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title"><?php echo $md->name; ?></h3>
                    <ul class="panel-controls">
                        <li><a class="panel-collapse" href="#"><span class="fa fa-angle-up"></span></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                	<?php 
					if($md->submenu) {
					?>
	                <ul class="list-group border-bottom">
	                <?php 
						foreach ($md->submenu as $mdc) {
	                ?>
	                    <li class="list-group-item"id="item-<?php echo $mdc->id; ?>" data-menu-parent="<?php echo $mdc->id_parent; ?>"><?php echo $mdc->name; ?></li>
	                <?php } ?>
	                </ul>
	                <?php } ?>
                </div>                          
            </div>
            <?php $x++; } ?>
			<!-- END DEFAULT DATATABLE -->

		</div>
	</div>                                
	
</div>
<!-- PAGE CONTENT WRAPPER -->

<!-- START SCRIPTS -->
	<!-- START TEMPLATE -->
	<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>
	
	<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
	<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
	<!-- END TEMPLATE -->  
	<!-- THIS PAGE JS SETTINGS -->
	<script type="text/javascript" src="assets/backend_assets/page/system/menu_orders.js"></script>
	<!--  -->
<!-- END SCRIPTS -->   