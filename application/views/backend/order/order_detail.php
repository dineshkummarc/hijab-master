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

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Data Customer</h3></br></br>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Customer</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->name_customer->nama_depan ?> <?php echo $order_detail->name_customer->nama_belakang ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">E-Mail</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->name_customer->email ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Username</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->name_customer->username ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Lahir</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->name_customer->tgl_lahir ?>
                        </div>
                    </div></br>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Alamat Pembayaran</h3></br></br>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Alamat</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->billing->address ?>
                        </div>
                    </div></br>                    
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kecamatan</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->billing->region->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kota</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->billing->city->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Provinsi</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->billing->province->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kode Pos</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->billing->postal_code ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Phone</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->billing->phone ?>
                        </div>
                    </div></br>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

            <?php $no=1; foreach ($order_detail->shipping as $d_row) {?>
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Data Alamat Pengiriman/Pembayaran</h3></br></br>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Dikirim ke</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->title ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Alamat</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->address ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kecamatan</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->region->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kota/Kabupaten</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->city->type ?> <?php echo $d_row->city->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Provinsi</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->province->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kode Pos</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->postal_code ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Phone</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $d_row->phone ?>
                        </div>
                    </div></br>
                </div>
            </div>
            <?php $no++; } ?>
            <!-- END DEFAULT DATATABLE -->

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Data Pengiriman</h3></br></br>
                </div>
                <div class="panel-body">
                <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Invoice</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->invoice_number ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Status Pembelian</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->status ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Dikirim Ke</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->title ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Alamat Pengiriman</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->address ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kecamatan</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->region->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kota</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->city->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Provinsi</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->province->name ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kode Pos</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->postal_code ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Phone</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->ship->phone ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Total Order</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->total_order ?> Barang
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Total Pengiriman</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->total_ship_price ?>
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Total Pembayaran</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->total_payment ?>
                            (Sudah Termasuk Total Pengiriman)
                        </div>
                    </div></br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Pemesanan Barang</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->date_created ?>
                        </div>
                    </div></br><br>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Status Pemesanan Barang</label>
                        <div class="col-md-9 col-xs-12">
                            <?php echo $order_detail->date_modified ?>
                        </div>
                    </div></br>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Data Pembelian Barang <?php echo $order_detail->name_customer->nama_depan?> <?php echo $order_detail->name_customer->nama_belakang?></h3></br></br>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="6%" class="text-center">No</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Ukuran</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach ($order as $d_row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td class="text-center"><?php echo $d_row->product->name_product; ?></td>
                                <td class="text-center"><?php echo $d_row->product_stock->size->name; ?></td>
                                <td class="text-center"><?php echo $d_row->product_stock->color->name; ?></td>
                                <td class="text-center"><?php echo $d_row->harga; ?></td>
                                <td class="text-center"><?php echo $d_row->quantity; ?></td>
                                <td class="text-center"><?php echo $d_row->totalprice?></td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                    <?php if ($order_detail->status == 0) { ?>
                    <a class="btn btn-success" href="<?php echo $controller ?>/order_status/<?php echo $order_detail->id ?>/<?php echo $order_detail->customer_id ?>/1">Accepted</a> <a class="btn btn-danger pull-right" href="<?php echo $controller ?>/order_status/<?php echo $order_detail->id ?>/<?php echo $order_detail->customer_id ?>/-99">Canceled/Rejected</a>
                    <?php } ?>
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