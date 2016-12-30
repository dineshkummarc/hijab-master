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

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

	<div class="row">
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">                                
					<h3 class="panel-title">Form</h3>                              
				</div>
				<form class="form-horizontal" id="px-site-content-static-content-form" method="POST" action="<?php if($data) echo $controller.'/'.$function_edit; else echo $controller.'/'.$function_add; ?>">
				<input type="hidden" value="<?php if($data!=null) echo $data->id; ?>" name="id">
				<div class="panel-body">
					<div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
					<div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
					<div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
					<div class="form-group">
						<label class="col-md-2 col-xs-12 control-label" for="#px-site-content-static-content-form-static-content-title">Title</label>
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="title" id="px-site-content-static-content-form-static-content-title" value="<?php if($data!=null) echo $data->title; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-xs-12 control-label" for="#px-site-content-static-content-form-static-content-content">Content</label>
						<div class="col-md-10 col-xs-12">
							<textarea class="form-control ignore px-summernote" name="content" id="px-site-content-static-content-form-static-content-content"><?php if($data!=null) echo $data->content; ?></textarea>
						</div>
					</div>
				</div>
				<?php if(isset($data->image)){
					foreach ($data->image as $images) {
				?>
				<input type="hidden" name="images[]" value="<?php echo $images; ?>">
				<?php
					}
				} ?>
				<div class="panel-footer">
					<button class="btn btn-primary pull-right" type="submit">Save</button>
				</div>
				</form>
			</div>
			<!-- END DEFAULT DATATABLE -->

		</div>
	</div>                                
	
</div>
<!-- PAGE CONTENT WRAPPER -->

<!-- START SCRIPTS -->               
	<!-- THIS PAGE PLUGINS -->
	<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js"></script>  
	<script type="text/javascript" src="assets/backend_assets/js/plugins/summernote/summernote.js"></script>    
	<!-- END PAGE PLUGINS -->
	<!-- START TEMPLATE -->
	<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>
	
	<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
	<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
	<!-- END TEMPLATE -->  
	<!-- THIS PAGE JS SETTINGS -->
	<script type="text/javascript" src="assets/backend_assets/page/site_content/static_content_form.js"></script>
	<!--  -->
<!-- END SCRIPTS -->   