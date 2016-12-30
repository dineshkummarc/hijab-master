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
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">                                
					<h3 class="panel-title">Data</h3>
					<button class="btn btn-success pull-right btn-add" data-target-form="<?php echo $controller.'/'.$function_add; ?>"><i class="fa fa-plus"></i> Add New</button>
					<!-- <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
						<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
						<li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
					</ul>  -->                               
				</div>
				<div class="panel-body">
					<table class="table datatable table-bordered">
						<thead>
							<tr>
								<th width="6%" class="text-center">No</th>
								<th class="text-center">Menu</th>
								<th class="text-center">Target</th>
								<th class="text-center">Parent</th>
								<th width="15%" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($data as $d_row) { ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?php echo $d_row->name; ?></td>
								<td class="text-center"><?php echo $d_row->target; ?></td>
								<td class="text-center"><?php if($d_row->id_parent == 0) echo 'Main Menu'; else echo $d_row->parent; ?></td>
								<td class="text-center">
									<button class="btn btn-info btn-xs btn-edit" type="button" data-original-title="Update" data-placement="top" data-toggle="tooltip" data-target-form="<?php echo $controller.'/'.$function_edit; ?>" data-target-id="<?php echo $d_row->id; ?>" data-target-get="<?php echo $controller.'/'.$function_get; ?>"><i class="fa fa-edit"></i></button>
									<button class="btn btn-danger btn-xs btn-delete" type="button" data-original-title="Delete" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>"><i class="fa fa-trash-o"></i></button>
								 </td>
							</tr>
							<?php $no++; } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END DEFAULT DATATABLE -->

		</div>
	</div>                                
	
</div>
<!-- PAGE CONTENT WRAPPER -->

<!-- MODAL -->
<div class="modal fade animated" id="px-system-menu-modal" tabindex="-1" role="dialog" aria-labelledby="px-system-menu-modal-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="px-system-menu-modal-label"><?php echo $function_name; ?></h4>
			</div>
			<form class="form-horizontal" id="px-system-menu-form" action="<?php echo $controller.'/'.$function_add; ?>" method="post">
			<input type="hidden" name="id" id="px-system-menu-form-id">
			<input type="hidden" name="orders" id="px-system-menu-form-orders" value="0">
			<div class="modal-body">
				<div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
				<div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
				<div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label" for="#px-system-menu-form-name">Name</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" class="form-control" name="name" id="px-system-menu-form-name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label" for="#px-system-menu-form-target">Target</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" class="form-control" name="target" id="px-system-menu-form-target">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label" for="#px-system-menu-form-id-parent">Parent</label>
					<div class="col-md-6 col-xs-12">
						<select class="form-control" name="id_parent" id="px-system-menu-form-id-parent">
							<option value="0">Main Menu</option>
							<?php foreach ($data_parent as $data_row) { ?>
							<option value="<?php echo $data_row->id; ?>"><?php echo $data_row->name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label" for="#px-system-menu-form-icon">Icon</label>
					<div class="col-md-6 col-xs-12">
						<div class="input-group">
							<span class="input-group-addon" id="px-system-menu-form-icon-preview"><span class="fa fa-adjust"></span></span>
							<select class="form-control" name="icon" id="px-system-menu-form-icon">
								<?php foreach ($data_icon as $data_row) { ?>
								<option value="<?php echo $data_row->content; ?>"><?php echo $data_row->content; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-info">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- EOF MODAL -->
<!-- MESSAGE BOX -->
<div id="px-system-menu-message-box" class="message-box message-box-warning animated fadeIn fade">
	<div class="mb-container">
		<div class="mb-middle">
			<form action="<?php echo $controller.'/'.$function_delete; ?>" method="post" id="px-system-menu-message-form">
			<input type="hidden" name="id">
			<div class="mb-title"><span class="fa fa-warning"></span> Warning</div>
			<div class="mb-content">
				<p>Are you sure you want to delete this data?</p>
				<p class="msg-status"></p>                  
			</div>
			<div class="mb-footer">
				<button class="btn btn-danger btn-lg pull-right" type="submit">Delete</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close" type="button">Cancel</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- EOF MESSAGE BOX -->

<!-- START SCRIPTS -->               
	<!-- THIS PAGE PLUGINS -->
	<script type="text/javascript" src="assets/backend_assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js"></script>    
	<!-- END PAGE PLUGINS -->
	<!-- START TEMPLATE -->
	<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>
	
	<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
	<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
	<!-- END TEMPLATE -->  
	<!-- THIS PAGE JS SETTINGS -->
	<script type="text/javascript" src="assets/backend_assets/page/system/menu.js"></script>
	<!--  -->
<!-- END SCRIPTS -->   