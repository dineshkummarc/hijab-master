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
					<a class="btn btn-success pull-right btn-add" href="<?php echo $controller.'/'.$function_form; ?>"><i class="fa fa-plus"></i> Add New</a>
					<!-- <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
						<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
						<li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
					</ul>  -->                               
				</div>
				<div class="panel-body">
					<div class="gallery" id="links">
             			<?php foreach ($data as $data_row) { ?>
			            <a class="gallery-item" title="<?php echo $data_row->title; ?>" data-gallery>
			                <div class="image">                              
			                    <img src="assets/uploads/banner/<?php echo $data_row->id.'/'.$data_row->banner; ?>" alt="<?php echo $data_row->title; ?>"/>                                        
			                    <form action="<?php echo $controller.'/'.$function_form; ?>" method="POST">
				                    <input type="hidden" value="<?php echo $data_row->id; ?>" name="id">
				                    <ul class="gallery-item-controls">
				                        <li><button class="btn-info btn-xs btn-edit" type="submit"><i class="fa fa-edit"></i></button></li>
				                        <li><button class="btn-danger btn-xs btn-delete" type="button" data-target-id="<?php echo $data_row->id; ?>"><i class="fa fa-times"></i></button></li>
				                    </ul>
			                    </form>            
			                </div>
			                <div class="meta">
			                    <strong><?php echo $data_row->title; ?></strong>
			                    <span><?php echo $data_row->content; ?></span>
			                </div>                                
			            </a>
			            <?php } ?>                         
			             
			        </div>
			             
			        <!-- <ul class="pagination pagination-sm pull-right push-down-20 push-up-20">
			            <li class="disabled"><a href="#">«</a></li>
			            <li class="active"><a href="#">1</a></li>
			            <li><a href="#">2</a></li>
			            <li><a href="#">3</a></li>
			            <li><a href="#">4</a></li>                                    
			            <li><a href="#">»</a></li>
			        </ul> -->
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
<div id="px-site-content-banner-message-box" class="message-box message-box-warning animated fadeIn fade">
	<div class="mb-container">
		<div class="mb-middle">
			<form action="<?php echo $controller.'/'.$function_delete; ?>" method="post" id="px-site-content-banner-message-form">
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
	<!-- END TEMPLATE -->  
	<!-- THIS PAGE JS SETTINGS -->
	<script type="text/javascript" src="assets/backend_assets/page/site_content/banner.js"></script>
	<!-- EOF PAGE SETTINGS  -->
<!-- END SCRIPTS -->   