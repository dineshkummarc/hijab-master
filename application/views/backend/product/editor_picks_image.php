<div class="modal fade" id="pixel-modal-warehouse-productimage" tabindex="-1" role="dialog" aria-labelledby="pixel-modal-warehouse-productimage-label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="pixel-modal-warehouse-productimage-label"><?php echo $function_name; ?> of <?php echo $name; ?></h4>
			</div>
			<form id="pixel-warehouse-productimage-form" class="form-horizontal" action="<?php echo $controller.'/editor_picks_image_add'; ?>" method="POST">
			<input type="hidden" name="id" id="warehouse-productimage-id">
			<input type="hidden" name="editor_picksimage-id" id="warehouse-productimage-product-id" value="<?php echo $id; ?>">
			<div class="modal-body">
				<div class="alert alert-danger hidden"></div>
				<div class="alert alert-warning hidden"></div>
				<div class="alert alert-success hidden"></div>
				<!-- <div class="form-group">
					<label class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3" for="warehouse-productimage-caption">Caption</label>
					<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
						<input class="form-control" type="text" name="editor_picksimage-caption" id="warehouse-productimage-caption">
					</div>
				</div> -->
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3" for="warehouse-productimage-image">Image</label>
					<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
						<label class="btn btn-primary" id="warehouse-productimage-upload-button" for="file-upload-file">Upload</label>
						<input type="hidden" name="x" id="x">
						<input type="hidden" name="y" id="y">
						<input type="hidden" name="w" id="w">
						<input type="hidden" name="h" id="h">
						<input type="hidden" name="origwidth" id="origwidth">
						<input type="hidden" name="origheight" id="origheight">
						<input type="hidden" name="fakewidth" id="fakewidth">
						<input type="hidden" name="fakeheight" id="fakeheight">
						<input type="hidden" name="image" id="image">
						<input type="hidden" name="old_image" id="old-image">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="progress" id="warehouse-productimage-progress">
							<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
								<span class="sr-only">0% Complete (success)</span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 warehouse-productimage-preview">
						<div class="image-original-preview">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="image-productimage-crop-preview">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-add" id="pixel-warehouse-productimage-add-button">Save</button>
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="admin">Home</a></li>                    
		<li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
		<li><a href="<?php echo $controller.'/'.$function; ?>"><?php echo $function_name; ?></a></li>
		<li class="active"><?php echo $function_name; ?> Form</li>
	</ul>
	<!-- END BREADCRUMB -->

	<!-- PAGE TITLE -->
	<div class="page-title">                    
		<h2><?php echo $function_name; ?></h2>
	</div>
	<!-- END PAGE TITLE -->              

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<?php if(isset($_GET['delete'])){
					if($_GET['delete'] == 'error'){
				?>
				<div class="alert alert-danger">Delete Failed</div>
				<?php }else{ ?>
				<div class="alert alert-success">Delete Success</div>
				<?php }} ?>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php echo $function_name ?> of <?php echo $name; ?></h3>
						
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="row">
					<?php if ($image) { ?>
					<div class="col-md-3">
						<!-- Primary tile -->
						<div class="box box-solid bg-light-blue">
							<div class="box-body text-center product-image-thumbnail">
								<div class="btn-group btn-group-xs">
									<button class="btn btn-primary btn-edit" data-target-edit="<?php echo $controller.'/'.$function_edit; ?>" data-target-get-data="<?php echo $controller.'/'.$function_get; ?>" data-target-id="<?php echo $id; ?>"><i class="fa fa-edit"></i></button>
									<!-- <a href="<?php echo $controller.'/'.$function_delete.'/'.$id; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a> -->
								</div>
								
								
								<?php if($image!=''){ ?>
								<img src="assets/uploads/editor_picks/<?php echo $id.'/'.$image; ?>">
								<?php }else{echo"<div style='height:100px;'>no image</div>";} ?>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->
					<?php }else{?>
						<button class="btn btn-success btn-pop" data-target-add="<?php echo $controller.'/'.$function_add; ?>" data-toggle="modal" data-target="#pixel-modal-warehouse-productimage"><i class="fa fa-plus"></i> Add New</button>
					 <?php } ?>
					</div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div>
<form id="file-upload" action="upload/image" method="POST" enctype="multipart/form-data" class="hidden">
	<input type="hidden" name="old" id="old-foto">
	<input type="file" name="image" id="file-upload-file">
</form>
<!-- START SCRIPTS -->               
<!-- THIS PAGE PLUGINS -->
<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js"></script>              
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-file-input.js"></script>  
<script type="text/javascript" src="assets/backend_assets/js/plugins/summernote/summernote.js"></script>    
<!-- Bootstrap Validator -->
<script src="assets/backend_assets/js/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/fileupload/fileupload.min.js"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
<!-- END TEMPLATE -->  
<!-- THIS PAGE JS SETTINGS -->

<script type="text/javascript" src="assets/backend_assets/page/product/editor_picks_image.js"></script>
<!--  -->
<!-- END SCRIPTS -->   
