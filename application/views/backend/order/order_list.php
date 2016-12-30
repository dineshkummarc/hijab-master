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
					<h3 class="panel-title">Data Pemesanan Barang Customer</h3>

<!--						<span class="input-group-addon" id="basic-addon1">@</span>-->
					<div class="btn-group pull-right responsive-width" role="group">
						<a class="btn btn-default btn-responsive" ><i class="fa fa-download">  Export</i></a>
						<a class="btn btn-default btn-responsive" href="<?php echo $controller. '/penjualan_order_excel/'?>" ><i class="fa fa-file-excel-o"></i></a>
						<a class="btn btn-default btn-responsive" href="<?php echo $controller. '/customer_excel/'?>" ><i class="fa fa-file-pdf-o"></i></a>
						<a class="btn btn-success pull-right btn-add" href="<?php echo $controller.'/order_barang_form'; ?>"><i class="fa fa-plus"></i> Add New</a>
					</div>

					<!-- <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
						<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
						<li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
					</ul>  -->                               
				</div>
				<div class="panel-body">
				<?php if(isset($_GET['update'])) { if($_GET['update'] == 'true') { ?>
				<div class="alert alert-success"><strong>Order Status Update Success</strong><span></span></div>
				<?php } else { ?>
				<div class="alert alert-danger"><strong>Order Status Update Failed</strong><span></span></div>
				<?php }} ?>
					<table class="table datatable table-bordered">
						<thead>
							<tr>
								<th width="6%" class="text-center">No</th>
								<th class="text-center">Nama Customer</th>
								<th class="text-center">Status Order</th>
								<th class="text-center">Flag</th>
								<th class="text-center">Tanggal Pesan Barang</th>
								<th class="text-center">Tanggal Ubah Status Pesan</th>
								<th width="15%" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($order_list as $d_row) { ?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?php echo $d_row->customer->nama_depan; ?> <?php echo $d_row->customer->nama_belakang; ?></td>
								<td class="text-center"><?php 
								/*if($d_row->status==0){echo"Unconfirm";}elseif ($d_row->status==1){echo"Confirm";}elseif ($d_row->status==2){echo"Packing";}elseif ($d_row->status==3){echo"Shipped";}elseif ($d_row->status==-99){echo"Canceled/Rejected";}elseif ($d_row->status==-98){echo"Out of Stock";}else{ echo"Tidak ada Status"; } */
									echo $d_row->title;
								?></td>
								<td class="text-center"><?php 
								echo $d_row->flag;
								?></td>
								<td class="text-center"><?php echo $d_row->date_created; ?></td>
								<td class="text-center"><?php echo $d_row->date_modified; ?></td>
								<td class="text-center">
									<form action="" method="post">
										<input type="hidden" name="id" value="<?php echo $d_row->id; ?>">
										<?php if ($d_row->status == 0) {?>
											<a href="<?php echo $controller ?>/order_detail/<?php echo $d_row->id; ?>" class="btn btn-default btn-xs" data-original-title="Detail Order" data-placement="top" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
										<?php } ?>
										
										<?php if ($d_row->ship == 1) {?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled><i class="fa fa-money"></i> <?php echo $d_row->title; ?></button>
										<?php } elseif ($d_row->ship == 2) {?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled><i class="fa fa-money"></i> <?php echo $d_row->title; ?></button>
										<?php } elseif ($d_row->ship == 3) {?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled><i class="fa fa-dropbox"></i> <?php echo $d_row->title; ?></button>
										<?php } elseif ($d_row->ship == 4) {?>
											<button class="btn btn-info btn-xs btn-edit" type="button" data-original-title="Ubah" data-placement="top" data-toggle="tooltip" data-target-form="<?php echo $controller.'/tracking_system_edit'; ?>" data-target-id="<?php echo $d_row->id; ?>" data-target-get="<?php echo $controller.'/order_get'; ?>"><i class="fa fa-truck"></i> Send to Shipping</button>
										<?php } elseif ($d_row->ship == 5) {?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled><i class="fa fa-truck"></i> <?php echo $d_row->title; ?></button>
										<?php } elseif ($d_row->ship == 6) {?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled><i class="fa fa-user"></i> <?php echo $d_row->title; ?></button>
										<?php } elseif ($d_row->ship == 0) {?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled><?php echo $d_row->title; ?></button>
										<?php } else{ ?>
											<button class="btn btn-default btn-xs btn-edit" type="button" data-original-title="" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>" disabled>Tidak ada Transaksi</button>
										<?php } ?>

										<!-- <button class="btn btn-info btn-xs btn-edit" type="button" data-original-title="Ubah" data-placement="top" data-toggle="tooltip" data-target-form="<?php echo $controller.'/tracking_system_edit'; ?>" data-target-id="<?php echo $d_row->id; ?>" data-target-get="<?php echo $controller.'/order_get'; ?>"><i class="fa fa-truck"></i> Add to Shipping</button> -->
								 		<!-- <button class="btn btn-danger btn-xs btn-delete" type="button" data-original-title="Hapus" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>"><i class="fa fa-trash-o"></i></button> -->
								 	</form>
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
<div id="px-order-message-box" class="message-box message-box-warning animated fadeIn fade">
	<div class="mb-container">
		<div class="mb-middle">
			<form action="<?php echo $controller.'/'.$function_delete; ?>" method="post" id="px-order-message-form">
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
	
