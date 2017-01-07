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
                    <h3 class="panel-title">Data Pemesanan Barang Customer</h3>

<!--						<span class="input-group-addon" id="basic-addon1">@</span>-->
                    <div class="btn-group pull-right responsive-width" role="group">
                        <a class="btn btn-default btn-responsive" ><i class="fa fa-download">  Export</i></a>
                        <a class="btn btn-default btn-responsive" href="<?php echo $controller . '/penjualan_order_excel/' ?>" ><i class="fa fa-file-excel-o"></i></a>
                        <a class="btn btn-default btn-responsive" href="<?php echo $controller . '/customer_excel/' ?>" ><i class="fa fa-file-pdf-o"></i></a>
                        <a class="btn btn-success pull-right btn-add" href="<?php echo $controller . '/order_barang_form'; ?>"><i class="fa fa-plus"></i> Add New</a>
                    </div>

                    <!-- <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>  -->                               
                </div>
                <div class="panel-body">
                    <?php if (isset($_GET['update'])) {
                        if ($_GET['update'] == 'true') { ?>
                            <div class="alert alert-success"><strong>Order Status Update Success</strong><span></span></div>
                        <?php } else { ?>
                            <div class="alert alert-danger"><strong>Order Status Update Failed</strong><span></span></div>
                    <?php } } ?>
                    <table class="table datatable table-bordered">
                        <thead>
                            <tr>
                                <th width="6%" class="text-center">No</th>
                                <th class="text-center">Invoice</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Total Payment</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Status</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; foreach ($order_list as $d_row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <td class="text-center"><?php echo $d_row->invoice_number ?></td>
                                <td class="text-center"><?php echo $d_row->customer ?></td>
                                <td class="text-center"><?php echo $d_row->total_payment ?></td>
                                <td class="text-center"><?php echo $d_row->date_created ?></td>
                                <td class="text-center"><span class="btn <?php echo $d_row->status->class_text ?>"><?php echo $d_row->status->title ?></span></td>
                                <td class="text-center">
                                    <a class="btn btn-default btn-xs" href="<?php echo $controller.'/order_detail/'.$d_row->id ?>" data-original-title="Detail Order" data-placement="top" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

        </div>
    </div>                                

</div>
<!-- PAGE CONTENT WRAPPER -->

<!-- MESSAGE BOX -->
<div id="px-order-message-box" class="message-box message-box-warning animated fadeIn fade">
    <div class="mb-container">
        <div class="mb-middle">
            <form action="<?php echo $controller . '/' . $function_delete; ?>" method="post" id="px-order-message-form">
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

