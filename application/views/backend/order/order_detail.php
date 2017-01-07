<ul class="breadcrumb">
    <li><a href="admin">Home</a></li>                    
    <li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
    <li class="active"><?php echo $function_name; ?> Detail</li>
</ul>

<div class="page-title">                    
    <h2><?php echo $function_name; ?> Detail</h2>
</div>

<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Order : <?php echo $order->invoice_number ?></h3>
                    <button class="btn btn-danger pull-right">Reject This Order</button>
                    <button class="btn btn-success pull-right">Approve Order Payment</button>
                </div>
                <ul class="nav nav-tabs faq-cat-tabs">
                    <li class="active"><a href="#tab-1" data-toggle="tab">Order Summary</a></li>
                    <li><a href="#tab-2" data-toggle="tab">Order Detail</a></li>
                    <li><a href="#tab-3" data-toggle="tab">Data Customer</a></li>
                    <li><a href="#tab-4" data-toggle="tab">Shipping Address</a></li>
                    <li><a href="#tab-5" data-toggle="tab">Order Payment Confirmation</a></li>
                </ul>
                <div class="tab-content faq-cat-content">
                    <!-- TAB KONTRAK -->
                    <div class="tab-pane active in fade" id="tab-1">
                        <form class="form-horizontal">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Invoice Number</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->invoice_number ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Customer</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->nama_depan.' '.$customer->nama_belakang ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Customer Email</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->email ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Total Payment</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->total_payment ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Status</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->nama_depan.' '.$customer->nama_belakang ?></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>                                

</div>
<!-- PAGE CONTENT WRAPPER -->

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