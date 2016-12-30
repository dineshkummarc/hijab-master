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
					<h3 class="panel-title">Data Alamat <?php echo $customer->nama_depan?> <?php echo $customer->nama_belakang?></h3>
					
					<div class="btn-group pull-right responsive-width" role="group">
						<a class="btn btn-default btn-responsive" ><i class="fa fa-download">  Export</i></a>
						<a class="btn btn-default btn-responsive" href="<?php echo $controller ?>/customer_address/<?php echo $customer->id?>" data-original-title="Data Alamat Pengiriman Barang"><i class="fa fa-file-excel-o"></i></a>
						<a class="btn btn-default btn-responsive" href="<?php echo $controller. '/customer_excel/'?>" ><i class="fa fa-file-pdf-o"></i></a>
						<a class="btn btn-success pull-right btn-add" href="<?php echo $controller; ?>/shipping_address_list_form/<?php echo $customer->id?>"><i class="fa fa-plus"></i> Add New</a>
					</div>
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
								<th class="text-center">Home/Office</th>
								<th class="text-center">Provinsi</th>
								<!-- <th class="text-center">Status Customer</th> -->
								<th width="15%" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($address_list as $d_row) { ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?php echo $d_row->title?></td>
								<td class="text-center"><?php echo $d_row->province->name?></td>
								<td class="text-center">
									<form action="<?php echo $controller; ?>/shipping_address_list_form/<?php echo $customer->id?>" method="post">
										<input type="hidden" name="id" value="<?php echo $d_row->id; ?>">
										<button class="btn btn-info btn-xs btn-edit" type="submit" data-original-title="Ubah" data-placement="top" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
								 		<button class="btn btn-danger btn-xs btn-delete" type="button" data-original-title="Hapus" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>"><i class="fa fa-trash-o"></i></button>
								 	</form>
								 </td>
							</tr>
							<?php $no++; } ?>
						</tbody>
					</table>
					<!--<a href="<?php echo $controller ?>/customer_address/<?php echo $customer->id?>" class="btn btn-default btn-xs" data-original-title="Data Alamat Pengiriman Barang" data-placement="top" data-toggle="tooltip"><i class="fa fa-file-excel-o"></i> Download Data Pengiriman Alamat</a>-->
				</div>
			</div>
			<!-- END DEFAULT DATATABLE -->

		</div>
	</div>                                
	
</div>
<!-- PAGE CONTENT WRAPPER -->

<!-- BLUEIMP GALLERY -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>      
<!-- END BLUEIMP GALLERY -->

<!-- MESSAGE BOX -->
<div id="px-customer-message-box" class="message-box message-box-warning animated fadeIn fade">
	<div class="mb-container">
		<div class="mb-middle">
			<form action="<?php echo $controller.'/'.$function_delete; ?>" method="post" id="px-customer-message-form">
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
	<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js"></script>
	<script type="text/javascript" src="assets/backend_assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/backend_assets/js/plugins/summernote/summernote.js"></script>   
    <script type="text/javascript" src="assets/backend_assets/js/plugins/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="assets/backend_assets/js/plugins/icheck/icheck.min.js"></script> 
	<!-- END PAGE PLUGINS -->
	<!-- START TEMPLATE -->
	<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>
	
	<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
	<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>
	<script type="text/javascript" src="assets/backend_assets/page/customer/customer_list.js"></script>