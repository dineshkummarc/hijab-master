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
                    <h3 class="panel-title">Form</h3>                              
                </div>
                <form class="form-horizontal" id="px-site-content-news-form" method="POST" action="<?php echo $controller . '/photo_landscape_edit'; ?>">
                    <input type="hidden" value="<?php if ($data != null) echo $data->id; ?>" name="id">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Photo</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="hidden" name="old_photo_landscape" value="<?php if ($data) echo $data->photo_landscape; ?>">
                                <input type="hidden" name="photo_landscape">     
                                <input type="hidden" name="x" id="x">
                                <input type="hidden" name="y" id="y">
                                <input type="hidden" name="w" id="w">
                                <input type="hidden" name="h" id="h">
                                <input type="hidden" name="origwidth" id="origwidth">
                                <input type="hidden" name="origheight" id="origheight">
                                <input type="hidden" name="fakewidth" id="fakewidth">
                                <input type="hidden" name="fakeheight" id="fakeheight">                                                                                                                                      
                                <label for="file-upload-file" class="btn btn-primary btn-upload" data-target="photo_landscape">Browse</label>
                            </div>
                            <?php
                            if ($data) {
                                if (is_file('assets/uploads/news/' . $data->id . '/' . $data->photo_landscape)) {
                                    $photo_landscape = ' ';
                                    $photo_landscape_file = 'assets/uploads/news/' . $data->id . '/' . $data->photo_landscape;
                                } else {
                                    $photo_landscape = 'hidden';
                                    $photo_landscape_file = ' ';
                                }
                            } else {
                                $photo_landscape = 'hidden';
                                $photo_landscape_file = ' ';
                            }
                            ?>
                            <div class="col-md-9 col-xs-12 col-md-offset-2 no-padding <?php echo $photo_landscape; ?>" id="preview-photo_landscape">
                                <div class="image-original-preview" id="image-original-previews">
                                    <img src="<?php echo $photo_landscape_file; ?>" alt="photo" id="original-image"/>                                                                                                           
                                </div>
                                <div class="image-crop-previews-news" id="image-crop-previews">
                                    <img src="<?php echo $photo_landscape_file; ?>" alt="photo" id="crop-image"/>  
                                </div>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript" src="assets/backend_assets/js/plugins/summernote/summernote.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/fileupload/fileupload.min.js"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
<!-- END TEMPLATE -->  
<!-- THIS PAGE JS SETTINGS -->
<script type="text/javascript" src="assets/backend_assets/page/site_content/news_photo_landscape_form.js"></script>
<!--  -->
<!-- END SCRIPTS -->   