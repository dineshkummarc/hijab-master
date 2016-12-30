<ul class="breadcrumb">
    <li><a href="admin">Home</a></li>                    
    <li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
    <li class="active"><?php echo $function_name; ?> Detail</li>
</ul>

<div class="page-title">                    
    <h2><?php echo $function_name; ?></h2>
</div>

<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Detail Produk</h3></br></br>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Produk</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->name_product ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kategori</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->category->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Size</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->stock->size->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Color</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->stock->color->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Stock</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->stock->stock ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Price</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->price ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Weight</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->weight ?> gram
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Barcode</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->barcode ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Description</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->description ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Input Produk</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->date_created ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Edit Product</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $product->date_modified ?>
                        </div>
                    </div></br>
                </div>
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
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>