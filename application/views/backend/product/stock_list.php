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
                    <h3 class="panel-title">Data Stok Barang</h3>                            
                </div>
                <form action="<?php echo $controller . '/stockeditnumber'; ?>" method="post">
                    <div class="panel-body">
                        <?php if(isset($_GET['edit'])) { if($_GET['edit'] == 'success') { ?>
                        <div class="alert alert-success"><strong>Update Stock Success</strong><span></span></div>
                        <?php } else { ?>
                        <div class="alert alert-danger"><strong>Update Stock Failed</strong><span></span></div>
                        <?php }} ?>
                        <table class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th width="6%" class="text-center">No</th>
                                    <th class="text-center">Produk</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">SKU Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($stock_list as $d_row) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no; ?></td>
                                        <td class="text-center"><?php echo $d_row->product->name_product; ?></td>
                                        <td class="text-center"><?php echo $d_row->color->name; ?></td>
                                        <td class="text-center"><?php echo $d_row->size->name; ?></td>
                                        <td class="text-center"><input type="number" value="<?php echo $d_row->stock; ?>" name="stock[]" id="stock-<?php echo $d_row->id ?>"><br><input type="hidden" value="<?php echo $d_row->id; ?>" name="id[]" id="id-<?php echo $d_row->id ?>"></td>
                                        <td class="text-center"><input type="text" class="form-control" name="sku_code[]" value="<?php echo $d_row->sku_code; ?>"></td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
                        <button class="btn btn-success" type="submit">Save Stock</button>
                    </div>
                </form>
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
<div id="px-stock-message-box" class="message-box message-box-warning animated fadeIn fade">
    <div class="mb-container">
        <div class="mb-middle">
            <form action="<?php echo $controller . '/' . $function_delete; ?>" method="post" id="px-stock-message-form">
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
<script type="text/javascript" src="assets/backend_assets/page/product/stock_list.js"></script>