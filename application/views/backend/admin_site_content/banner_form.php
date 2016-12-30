<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="admin">Home</a></li>                    
    <li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
    <li><a href="<?php echo $controller . '/' . $function; ?>"><?php echo $function_name; ?></a></li>
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
                    <h3 class="panel-title">Data</h3>
                    <!-- <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>  -->                               
                </div>
                <form class="form-horizontal" action="<?php if ($data) echo $controller . '/' . $function_edit; else echo $controller . '/' . $function_add; ?>" method="POST" id="px-site-content-banner-form">
                    <input type="hidden" name="id" id="px-site-content-banner-form-id" value="<?php if ($data) echo $data->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please Wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-site-content-banner-form-title">Short Text</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="title" id="px-site-content-banner-form-title" value="<?php if ($data) echo $data->title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-site-content-banner-form-content">Long Text</label>
                            <div class="col-md-9 col-xs-12">
                                <textarea class="form-control" name="content" id="px-site-content-banner-form-content"><?php if ($data) echo $data->content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-site-content-banner-form-link">Link</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="link" id="px-site-content-banner-form-link" value="<?php if ($data) echo $data->link; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-site-content-banner-form-status">Visibility</label>
                            <div class="col-md-9 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" name="status" class="px-site-content-banner-form-status" <?php if ($data) {
    if ($data->status == 1) echo 'checked';
} else echo 'checked'; ?>>
                                        Visible
                                    </label>
                                    <label>
                                        <input type="radio" value="0" name="status" class="px-site-content-banner-form-status" <?php if ($data) {
    if ($data->status == 0) echo 'checked';
} ?>>
                                        Hidden
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Banner</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="hidden" name="old_banner" value="<?php if ($data) echo $data->banner; ?>">
                                <input type="hidden" name="banner">     
                                <input type="hidden" name="x" id="x">
                                <input type="hidden" name="y" id="y">
                                <input type="hidden" name="w" id="w">
                                <input type="hidden" name="h" id="h">
                                <input type="hidden" name="origwidth" id="origwidth">
                                <input type="hidden" name="origheight" id="origheight">
                                <input type="hidden" name="fakewidth" id="fakewidth">
                                <input type="hidden" name="fakeheight" id="fakeheight">                                                                                                                                      
                                <label for="file-upload-file" class="btn btn-primary btn-upload" data-target="banner">Browse</label>
                            </div>
                            <?php
                            if ($data) {
                                if (is_file('assets/uploads/banner/' . $data->id . '/' . $data->banner)) {
                                    $banner = ' ';
                                    $banner_file = 'assets/uploads/banner/' . $data->id . '/' . $data->banner;
                                } else {
                                    $banner = 'hidden';
                                    $banner_file = ' ';
                                }
                            } else {
                                $banner = 'hidden';
                                $banner_file = ' ';
                            }
                            ?>
                            <div class="col-md-9 col-xs-12 col-md-offset-2 no-padding <?php echo $banner; ?>" id="preview-banner">
                                <div class="image-original-preview" id="image-original-previews">
                                    <img src="<?php echo $banner_file; ?>" alt="photo" id="original-image"/>                                                                                                           
                                </div>
                                <div class="image-crop-previews-ban" id="image-crop-previews">
                                    <img src="<?php echo $banner_file; ?>" alt="photo" id="crop-image"/>  
                                </div>
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
<script type="text/javascript" src="assets/backend_assets/page/site_content/banner_form.js"></script>
<!--  -->
<!-- END SCRIPTS -->   