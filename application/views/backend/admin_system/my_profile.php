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
					<!-- <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
						<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
						<li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
					</ul>  -->                               
				</div>
				<form class="form-horizontal" action="<?php echo $controller.'/'.$function_edit; ?>" method="POST" id="px-system-my-profile-form">
				<input type="hidden" name="id" id="px-system-my-profile-form-id" value="<?php echo $data['admin_id']; ?>">
				<div class="panel-body">
					<div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
					<div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
					<div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-my-profile-form-realname">Realname</label>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="realname" id="px-system-my-profile-form-realname" value="<?php echo $data['realname']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-my-profile-form-username">Username</label>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="username" id="px-system-my-profile-form-username" value="<?php echo $data['username']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-my-profile-form-password">Password</label>
						<div class="col-md-6 col-xs-12">
							<div class="input-group">
								<input type="password" class="form-control" name="password" id="px-system-my-profile-form-password" value="<?php echo $data['password']; ?>">
								<span class="input-group-addon"><i class="btn-show-pass fa fa-eye-slash" data-status="hidden"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-my-profile-form-c-password">Confirm Password</label>
						<div class="col-md-6 col-xs-12">
							<input type="password" class="form-control" name="c-password" id="px-system-my-profile-form-c-password" value="<?php echo $data['password']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label" for="#px-system-my-profile-form-email">Email</label>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="email" id="px-system-my-profile-form-email" value="<?php echo $data['email']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-12 control-label">Profile Pic</label>
						<div class="col-md-6 col-xs-12">  
							<input type="hidden" name="old_photo" value="<?php echo $data['photo']; ?>">
							<input type="hidden" name="photo">                                                                                                                                                                         
							<label for="file-upload-file" class="btn btn-primary btn-upload" data-target="photo">Browse</label>
						</div>
						<div class="gallery col-md-6 col-xs-12 col-md-offset-4 no-padding" id="preview_photo">
							<a class="gallery-item" href="assets/uploads/admin/<?php echo $data['admin_id'].'/'.$data['photo']; ?>" title="Gambar Profil" data-gallery>
								<div class="image">
									<img src="assets/uploads/admin/<?php echo $data['admin_id'].'/'.$data['photo']; ?>" alt="Gambar Profil"/>                                                                                                           
								</div>                               
							</a>
						</div>
					</div>
				</div>
				<div class="panel-footer">                                 
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
	<script type="text/javascript" src="assets/backend_assets/page/system/my_profile.js"></script>
	<!--  -->
<!-- END SCRIPTS -->   