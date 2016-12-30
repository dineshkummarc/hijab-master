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
					<a class="btn <?php if($underconstruct_status == 0) echo 'btn-success'; else echo 'btn-danger'; ?> pull-right btn-add" id="underconstruct_button" data-value="<?php echo $underconstruct_status ?>">
						<?php if($underconstruct_status == 0) echo 'Website Online'; else echo 'Website Underconstruction'; ?>
					</a>
					<!-- <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
						<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
						<li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
					</ul>  -->                               
				</div>
				<form class="form-horizontal" action="<?php echo $controller.'/'.$function_edit; ?>" method="POST" id="px-system-settings-form">
				<input type="hidden" name="id" id="px-system-settings-form-id" value="<?php echo $app_id; ?>">
				<div class="panel-body">
					<div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
					<div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
					<div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-settings-form-title">App Name</label>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="title" id="px-system-settings-form-title" value="<?php echo $app_title; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-settings-form-desc">App Desc</label>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="desc" id="px-system-settings-form-desc" value="<?php echo $app_desc; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label">Login Logo</label>
						<div class="col-md-6 col-xs-12">
							<input type="hidden" name="old_login_logo" value="<?php echo $app_login_logo; ?>">
							<input type="hidden" name="login_logo">                                                                                                                                        
							<label for="file-upload-file" class="btn btn-primary btn-upload" data-target="login_logo">Browse</label>
						</div>
						<div class="gallery col-md-6 col-xs-12 col-md-offset-4 no-padding" id="preview_login_logo">
							<a class="gallery-item" href="assets/uploads/app_settings/<?php echo $app_login_logo; ?>" title="Login Logo" data-gallery>
								<div class="image">
									<img src="assets/uploads/app_settings/<?php echo $app_login_logo; ?>" alt="Login Logo"/>                                                                                                           
								</div>                               
							</a>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label">Mini Logo</label>
						<div class="col-md-6 col-xs-12">  
							<input type="hidden" name="old_mini_logo" value="<?php echo $app_mini_logo; ?>">
							<input type="hidden" name="mini_logo">                                                                                                                                                                         
							<label for="file-upload-file" class="btn btn-primary btn-upload" data-target="mini_logo">Browse</label>
						</div>
						<div class="gallery col-md-6 col-xs-12 col-md-offset-4 no-padding" id="preview_mini_logo">
							<a class="gallery-item" href="assets/uploads/app_settings/<?php echo $app_mini_logo; ?>" title="Login Logo" data-gallery>
								<div class="image">
									<img src="assets/uploads/app_settings/<?php echo $app_mini_logo; ?>" alt="Login Logo"/>                                                                                                           
								</div>                               
							</a>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label">Single Logo</label>
						<div class="col-md-6 col-xs-12"> 
							<input type="hidden" name="old_single_logo" value="<?php echo $app_single_logo; ?>">
							<input type="hidden" name="single_logo">                                                                                                                                                                       
							<label for="file-upload-file" class="btn btn-primary btn-upload" data-target="single_logo">Browse</label>
						</div>
						<div class="gallery col-md-6 col-xs-12 col-md-offset-4 no-padding" id="preview_single_logo">
							<a class="gallery-item" href="assets/uploads/app_settings/<?php echo $app_single_logo; ?>" title="Login Logo" data-gallery>
								<div class="image">
									<img src="assets/uploads/app_settings/<?php echo $app_single_logo; ?>" alt="Login Logo"/>                                                                                                           
								</div>                               
							</a>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label">Favicon Logo</label>
						<div class="col-md-6 col-xs-12">
							<input type="hidden" name="old_favicon_logo" value="<?php echo $app_favicon_logo; ?>">
							<input type="hidden" name="favicon_logo">                                                                                                                                                                      
							<label for="file-upload-file" class="btn btn-primary btn-upload" data-target="favicon_logo">Browse</label>
						</div>
						<div class="gallery col-md-6 col-xs-12 col-md-offset-4 no-padding" id="preview_favicon_logo">
							<a class="gallery-item" href="assets/uploads/app_settings/<?php echo $app_favicon_logo; ?>" title="Login Logo" data-gallery>
								<div class="image">
									<img src="assets/uploads/app_settings/<?php echo $app_favicon_logo; ?>" alt="Login Logo"/>                                                                                                           
								</div>                               
							</a>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-default" type="reset">Clear Form</button>                                    
					<button class="btn btn-primary pull-right">Save</button>
				</div>
				</form>
			</div>
			<!-- END DEFAULT DATATABLE -->

		</div>
	</div>                                
	
</div>
<!-- PAGE CONTENT WRAPPER -->

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
	<script type="text/javascript" src="assets/backend_assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>    
	<script type="text/javascript" src="assets/backend_assets/js/plugins/fileupload/fileupload.min.js"></script>
	<!-- END PAGE PLUGINS -->
	<!-- START TEMPLATE -->
	<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>
	
	<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
	<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
	<!-- END TEMPLATE -->  
	<!-- THIS PAGE JS SETTINGS -->
	<script type="text/javascript" src="assets/backend_assets/page/system/settings.js"></script>
	<!--  -->
<!-- END SCRIPTS -->   