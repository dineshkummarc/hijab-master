<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="admin">Home</a></li>                    
    <li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
    <li class="active"><?php echo $function_name; ?> Form</li>
</ul>
<!-- END BREADCRUMB -->
<link rel="stylesheet" href="assets/backend_assets/css/tinymce/content.min.css">
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
                <form class="form-horizontal" action="<?php if ($data) echo $controller . '/' . $function_edit; else echo $controller . '/' . $function_add; ?>" method="POST" id="px-product-form">
                    <input type="hidden" name="id" id="px-product-form-id" value="<?php if ($data) echo $data->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-name_product">Nama Produk</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="name_product" id="px-product-form-name_product" value="<?php if ($data) echo $data->name_product; ?>" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-category_id">Category</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="category_id" id="px-product-form-category_id" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($category_list as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($data) if($data->category_id == $d_row->id) echo 'selected' ?>><?php echo $d_row->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-barnd_id">Brand</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="brand_id" id="px-product-form-brand_id" class="form-control">
                                    <option value="">Pilih Brand</option>
                                    <?php foreach ($brand_list as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($data) if($data->brand_id == $d_row->id) echo 'selected' ?>><?php echo $d_row->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-editor_picks_id">Group</label>
                            <div class="col-md-9 col-xs-12">
                                <?php foreach ($group_list as $d_row) { ?>
                                    <input type="checkbox" name="group[]" value="<?php echo $d_row->id?>" 
                                    <?php if($data) 
                                    foreach($data->group as $group) 
                                        if($group->group_id == $d_row->id) 
                                            echo 'checked' ?>> <?php echo $d_row->name ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-editor_picks_id">Editor Picks</label>
                            <div class="col-md-9 col-xs-12">
                                <?php foreach ($editor_picks_list as $d_row) { ?>
                                    <input type="checkbox" name="editor[]" value="<?php echo $d_row->id?>" 
                                    <?php if($data) 
                                    foreach($data->editor as $event) 
                                        if($event->editor_picks_id == $d_row->id) 
                                            echo 'checked' ?>> <?php echo $d_row->name ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-color_id">Color</label>
                            <div class="col-md-9 col-xs-12">
                                <?php foreach ($color_list as $d_row) { ?>
                                    <input type="checkbox" name="color[]" value="<?php echo $d_row->id?>" 
                                    <?php if($data) 
                                    foreach($data->color as $color_p) 
                                        if($color_p->color_id == $d_row->id) 
                                            echo 'checked' ?>> <?php echo $d_row->name ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-stock_id">Size</label>
                            <div class="col-md-9 col-xs-12">
                                <?php foreach ($size_list as $d_row) { ?>
                                    <input type="checkbox" name="size[]" value="<?php echo $d_row->id?>" 
                                    <?php if($data) 
                                    foreach($data->size as $size_p) 
                                        if($size_p->size_id == $d_row->id) 
                                            echo 'checked' ?>> <?php echo $d_row->name ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-price">Price</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="price" id="px-product-form-price" value="<?php if ($data) echo $data->price; ?>" placeholder="Harga Barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-weight">Weight</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="weight" id="px-product-form-weight" value="<?php if ($data) echo $data->weight; ?>" placeholder="Berat Barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-barcode">Barcode</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="barcode" id="px-product-form-barcode" value="<?php if ($data) echo $data->barcode; ?>" placeholder="Barcode Barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-product-form-description">Description</label>
                            <div class="col-md-9 col-xs-12">
                                <textarea class="form-control ignore px-summernote" name="description" id="px-site-content-static-content-form-static-content-content"><?php if($data!=null) echo $data->description; ?></textarea>
<!--                                <textarea  name="description" id="px-product-form-description" value="--><?php //if ($data) echo $data->description; ?><!--">--><?php //if ($data) echo $data->description; ?><!--</textarea>-->
<!--                                <input type="text" class="form-control" name="description" id="px-product-form-description" value="--><?php //if ($data) echo $data->description; ?><!--" placeholder="Deskripsi Barang">-->
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
<!-- START SCRIPTS -->               
<!-- THIS PAGE PLUGINS -->
<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js"></script>              
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-file-input.js"></script>  
<script type="text/javascript" src="assets/backend_assets/js/plugins/summernote/summernote.js"></script>    
<script type="text/javascript" src="assets/backend_assets/js/plugins/fileupload/fileupload.min.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/tinymce/tinymce.min.js"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
<!-- END TEMPLATE -->  
<!-- THIS PAGE JS SETTINGS -->
<script type="text/javascript" src="assets/backend_assets/page/product/product_form.js"></script>

<!--  -->
<!-- END SCRIPTS -->   