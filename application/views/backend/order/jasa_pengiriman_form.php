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
                </div>
                <form class="form-horizontal" action="<?php if ($data) echo $controller . '/' . $function_edit; else echo $controller . '/' . $function_add; ?>" method="POST" id="px-jasa_pengiriman-form">
                    <input type="hidden" name="id" id="px-jasa_pengiriman-form-id" value="<?php if ($data) echo $data->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-jasa_pengiriman-form-title">Nama Jasa Pengiriman</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="name" id="px-jasa_pengiriman-form-title" value="<?php if ($data) echo $data->name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Foto Jasa Pengiriman</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="hidden" name="old_photo" value="<?php if ($data) echo $data->photo; ?>">
                                <input type="hidden" name="photo">                                                                                                                                       
                                <label for="file-upload-file" class="btn btn-primary btn-upload" data-target="photo" id="px-jasa_pengiriman-fileupload-photo-upload-button">Browse</label>
                            </div>
                            <?php
                            if ($data) {
                                if (is_file('assets/uploads/order/' . $data->id . '/' . $data->photo)) {
                                    $photo = ' ';
                                    $photo_file = 'assets/uploads/order/' . $data->id . '/' . $data->photo;
                                } else {
                                    $photo = 'hidden';
                                    $photo_file = ' ';
                                }
                            } else {
                                $photo = 'hidden';
                                $photo_file = ' ';
                            }
                            ?>
                            <div class="col-md-9 col-xs-12 col-md-offset-2 no-padding <?php echo $photo ?>" id="preview-photo">
                                <div class="image-original-preview" id="image-original-previews">
                                    <img src="<?php echo $photo_file ?>" alt="photo" id="original-image"/>                                                                                                           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">          
                        <!-- <button class="btn btn-info btn-preview" type="button">Preview</button>                       -->
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
<script type="text/javascript" src="assets/backend_assets/page/order/jasa_pengiriman_form.js"></script>
<!--  -->
<!-- END SCRIPTS -->   