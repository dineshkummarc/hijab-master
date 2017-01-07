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
                </div>
                <ul class="nav nav-tabs faq-cat-tabs">
                    <li class="active"><a href="#tab-1" data-toggle="tab">Order Summary</a></li>
                    <li><a href="#tab-2" data-toggle="tab">Data Customer</a></li>
                    <li><a href="#tab-3" data-toggle="tab">Shipping Address</a></li>
                    <li><a href="#tab-4" data-toggle="tab">Order Payment Confirmation</a></li>
                    <li><a href="#tab-5" data-toggle="tab">Tracking System</a></li>
                </ul>
                <div class="tab-content faq-cat-content">
                    <!-- TAB ORDER SUMMARY -->
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
                                    <label class="col-md-2 col-xs-12 control-label">Total Order</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->total_order ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Shipping Cost</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->total_ship_price ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Random Code</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->random_code ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Total Payment</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->total_payment ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Date Created</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->date_created ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Status</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $order->status_order->title ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h3>Order Detail</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-center">Size</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Price</th>
                                        </tr>
                                    <thead>
                                    <tbody>
                                        <?php $no=1; foreach($order->product_order as $data_row) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no; ?></td>
                                            <td class="text-center"><?php echo $data_row->data_product->name_product; ?></td>
                                            <td class="text-center"><?php echo $data_row->size; ?></td>
                                            <td class="text-center"><?php echo $data_row->color; ?></td>
                                            <td class="text-center"><?php echo $data_row->quantity; ?></td>
                                            <td class="text-right"><?php echo $data_row->price; ?></td>
                                        </tr>
                                        <?php $no++;} ?>
                                        <tr>
                                            <td colspan="5" class="text-right">Subtotal</td>
                                            <td class="text-right"><?php echo $order->total_order ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">Shipping Cost</td>
                                            <td class="text-right"><?php echo $order->total_ship_price ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">Random Code</td>
                                            <td class="text-right"><?php echo $order->random_code ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right"><strong>TOTAL</strong></td>
                                            <td class="text-right"><?php echo $order->total_payment ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <?php if(($order->status != -99) && ($order->status < 3)) { ?>
                        <div class="panel-heading">
                            <h3>Process Order</h3>
                        </div>
                        <div class="panel-body">
                            <?php if($order->status < 2) { ?>
                            <div class="col-md-6 col-xs-6 text-center">
                                <button class="btn btn-info btn-order-process" data-id="<?php echo $order->id ?>" data-status="2">PAID ORDER</button>
                            </div>
                            <?php } ?>
                            <?php if($order->status == 2) { ?>
                            <label class="col-md-1 col-xs-12">Nomor Resi</label>
                            <div class="col-md-8 col-xs-12">
                                <input type="text" class="form-control" id="nomor_resi" />
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <button class="btn btn-success btn-order-process" data-id="<?php echo $order->id ?>" data-status="3">SHIPPED ORDER</button>
                            </div>
                            <?php } ?>
                            <?php if($order->status < 2) { ?>
                            <div class="col-md-6 col-xs-6 text-center">
                                <button class="btn btn-danger btn-order-process" data-id="<?php echo $order->id ?>" data-status="-99">REJECT ORDER</button>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- TAB ORDER DETAIL -->
                    <div class="tab-pane fade" id="tab-2">
                        <form class="form-horizontal">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Nama</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->nama_depan.' '.$customer->nama_belakang ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Jenis Kelamin</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->jenis_kelamin ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Email</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->email ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Tgl Lahir</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->tgl_lahir ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h3>Billing Address</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Telp</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->billing_address->phone ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Provinsi</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->billing_address->province ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Kota</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->billing_address->city ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Kecamatan</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->billing_address->region ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Alamat Lengkap</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control" style="height:100%"><?php echo $customer->billing_address->address ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Postal Code</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $customer->billing_address->postal_code ?></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- TAB SHIPPING ADDRESS -->
                    <div class="tab-pane fade" id="tab-3">
                        <form class="form-horizontal">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Judul</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->title ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Nama Penerima</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->receiver_name ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Telp</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->phone ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Provinsi</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->province ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Kota</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->city ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Kecamatan</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->region ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Alamat Lengkap</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control" style="height:100%"><?php echo $shipping_address->address ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Postal Code</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $shipping_address->postal_code ?></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- TAB ORDER CONFIRMATION -->
                    <div class="tab-pane fade" id="tab-4">
                        <form class="form-horizontal">
                            <?php if($order_confirmation->num_rows() == 0) { ?>
                            <div class="panel-heading">
                                <h3>Tidak ada Data untuk Order ini</h3>
                            </div>
                            <?php } else { foreach($order_confirmation->result() as $data_confirm) { ?>
                            <div class="panel-heading">
                                <h3>Order Confirmation <?php echo $data_confirm->date_created ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Transfer ke Rekening</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $data_confirm->bank_target ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Nama Akun Bank Customer</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $data_confirm->account_name ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Nama Bank Customer</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $data_confirm->account_bank ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Tanggal Transfer</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $data_confirm->date_transfer ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Total Transfer</label>
                                    <div class="col-md-9 col-xs-12">
                                        <span class="form-control"><?php echo $data_confirm->total_payment ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                        </form>
                    </div>
                    <!-- TAB ORDER SUMMARY -->
                    <div class="tab-pane fade" id="tab-5">
                        <form class="form-horizontal">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Content</th>
                                            <th class="text-center">Date Created</th>
                                        </tr>
                                    <thead>
                                    <tbody>
                                        <?php $no=1; foreach($tracking_system as $data_row) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no; ?></td>
                                            <td class="text-center"><button class="btn <?php echo $data_row->status->class_text; ?>"><?php echo $data_row->status->title; ?></button></td>
                                            <td class="text-center"><?php echo $data_row->title; ?></td>
                                            <td class="text-center"><?php echo $data_row->content; ?></td>
                                            <td class="text-center"><?php echo $data_row->date_created; ?></td>
                                        </tr>
                                        <?php $no++;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>                                

</div>
<!-- PAGE CONTENT WRAPPER -->
<!-- MESSAGE BOX -->

<div id="px-order-message-box" class="message-box message-box-warning animated fadeIn fade">
    <div class="mb-container">
        <div class="mb-middle">
            <form id="px-order-message-form">
                <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                <div class="mb-title"><span class="fa fa-warning" id="popup-title"></span></div>
                <div class="mb-content">
                    <p id="msg-show"></p>
                    <p class="msg-status"></p>                  
                </div>
                <div class="mb-footer">
                    <button class="btn btn-danger btn-lg pull-right" id="process_id" type="button">YES</button>
                    <button class="btn btn-default btn-lg pull-right mb-control-close" type="button">NO</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EOF MESSAGE BOX -->

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
<script type="text/javascript" src="assets/backend_assets/page/order/order_detail.js"></script>