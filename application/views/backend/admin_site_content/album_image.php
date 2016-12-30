<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="admin">Home</a></li>                    
	<li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
	<li><a href="<?php echo $controller.'/'.$function; ?>">Admin Album</a></li>
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
					<button class="btn btn-success pull-right btn-add" data-target-form="<?php echo $controller.'/album_image_add'; ?>"><i class="fa fa-plus"></i> Add New</button>                             
				</div>
				<div class="panel-body">
					<table class="table datatable table-bordered">
						<thead>
							<tr>
								<th width="6%" class="text-center">No</th>
								<th class="text-center">Caption</th>
								<th width="15%" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($data as $d_row) {
							?>
							<tr>
								<td class="text-center"><?php echo $no; ?></td>
								<td class="text-center"><?php echo $d_row->caption; ?></td>
								<td class="text-center">
									<button class="btn btn-info btn-xs btn-edit" type="button" data-original-title="Ubah" data-placement="top" data-toggle="tooltip" data-target-form="<?php echo $controller.'/album_image_edit'; ?>" data-target-id="<?php echo $d_row->id; ?>" data-target-get="<?php echo $controller.'/album_image_get'; ?>"><i class="fa fa-edit"></i></button>
									<button class="btn btn-danger btn-xs btn-delete" type="button" data-original-title="Hapus" data-placement="top" data-toggle="tooltip" data-target-id="<?php echo $d_row->id; ?>"><i class="fa fa-trash-o"></i></button>
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
<div class="modal fade animated" id="px-sitecontent-albumimage-modal" tabindex="-1" role="dialog" aria-labelledby="px-sitecontent-albumimage-modal-label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="px-sitecontent-albumimage-modal-label"><?php echo $function_name; ?></h4>
			</div>
			<form class="form-horizontal" id="px-sitecontent-albumimage-form" action="<?php echo $controller.'/album_image_add'; ?>" method="post">
			<input type="hidden" name="id" id="px-sitecontent-albumimage-form-id">
			<input type="hidden" name="id_album" id="px-sitecontent-albumimage-form-id-parent" value="<?php echo $id_album; ?>">
			<div class="modal-body">
				<div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
				<div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
				<div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label" for="#px-sitecontent-albumimage-form-caption">Caption</label>
					<div class="col-md-6 col-xs-12">
						<input type="text" class="form-control" name="caption" id="px-sitecontent-albumimage-form-caption">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label" for="#px-site-content-peoplegroup-form-orientation">Orientation</label>
					<div class="col-md-6 col-xs-12">
						<div class="radio">
							<label><input type="radio" name="orientation" value="landscape" checked>Landscape</label>
							<div class="divider"></div>
							<label><input type="radio" name="orientation" value="potrait">Potrait</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-xs-12 control-label">Image</label>
					<div class="col-md-6 col-xs-12">
						<input type="hidden" name="old_photo" value="">
						<input type="hidden" name="photo">   
						<input type="hidden" name="x" id="x">
						<input type="hidden" name="y" id="y">
						<input type="hidden" name="w" id="w">
						<input type="hidden" name="h" id="h">
						<input type="hidden" name="origwidth" id="origwidth">
						<input type="hidden" name="origheight" id="origheight">
						<input type="hidden" name="fakewidth" id="fakewidth">
						<input type="hidden" name="fakeheight" id="fakeheight">                                                                                                                                       
						<label for="file-upload-file" class="btn btn-primary btn-upload" data-target="photo" id="px-sitecontent-albumimage-fileupload-photo-upload-button">Browse</label>
					</div>
					<div class="col-md-9 col-xs-12 col-md-offset-2 no-padding hidden" id="preview-photo">
						<div class="image-original-preview" id="image-original-previews">
							<img src="#" alt="photo" id="original-image"/>                                                                                                           
						</div>
						<div class="image-crop-previews" id="image-crop-previews">
							<img src="#" alt="photo" id="crop-image"/>  
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
<div id="px-sitecontent-albumimage-message-box" class="message-box message-box-warning animated fadeIn fade">
	<div class="mb-container">
		<div class="mb-middle">
			<form action="<?php echo $controller.'/album_image_delete'; ?>" method="post" id="px-sitecontent-albumimage-message-form">
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
<!-- FORM UPLOAD -->
<form id="file-upload" action="upload/image" method="POST" enctype="multipart/form-data" class="hidden">
	<input type="hidden" name="target" id="target-file">
	<input type="hidden" name="old" id="old-file">
	<input type="file" name="image" id="file-upload-file">
</form>
<!-- EOF FORM UPLOAD -->

<!-- START SCRIPTS -->               
	<!-- THIS PAGE PLUGINS -->
	<script type="text/javascript" src="assets/backend_assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js"></script>              
	<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-file-input.js"></script>    
	<script type="text/javascript" src="assets/backend_assets/js/plugins/fileupload/fileupload.min.js"></script>
	<!-- END PAGE PLUGINS -->
	<!-- START TEMPLATE -->
	<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>
	
	<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
	<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
	<!-- END TEMPLATE -->  
	<!-- THIS PAGE JS SETTINGS -->
	<script type="text/javascript" src="assets/backend_assets/page/site_content/album_image.js"></script>
	<!--  -->
<!-- END SCRIPTS -->   