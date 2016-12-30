<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="admin">Home</a></li>                    
    <li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
    <li><a href="<?php echo $function_name; ?>"><?php echo $function_name; ?></a></li>
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
                <form class="form-horizontal" action="<?php if ($customer) echo $controller . '/shipping_address_list_edit'; else echo $controller . '/shipping_address_list_add'; ?>" method="POST" id="px-customer-address-form">
                    <input type="hidden" name="id" id="px-customer-address-form-id" value="<?php if ($customer) echo $customer->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group" hidden>
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Customer_id</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="customer_id" id="px-customer-address-form-address" value="<?php echo $data->id; ?>" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Tujuan</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="title" id="px-customer-address-form-title" value="<?php if ($customer) echo $customer->title; ?>" placeholder="Home atau Office">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Alamat Anda</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="address" id="px-customer-address-form-address" value="<?php if ($customer) echo $customer->address; ?>" placeholder="Alamat Anda">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-province">Provinsi</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="province" id="px-customer-address-form-province" class="form-control province">
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($province_list as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($customer) if($customer->province == $d_row->id) echo 'selected' ?>><?php echo $d_row->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-city">Kota</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="city" id="px-customer-address-form-city" class="form-control city">
                                    <option value="">Pilih Kota</option>
                                    <?php foreach ($city_list as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($customer) if($customer->city == $d_row->id) echo 'selected' ?>><?php echo $d_row->type;?> <?php echo $d_row->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-region">Kecamatan</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="region" id="px-customer-address-form-region" class="form-control region">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($region_list as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($customer) if($customer->region == $d_row->id) echo 'selected' ?>><?php echo $d_row->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-postal_code">Kode Pos</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="number" class="form-control" name="postal_code" id="px-customer-address-form-postal_code" value="<?php if ($customer) echo $customer->postal_code; ?>" placeholder="Kode Pos Anda">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-phone">Phone</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="number" class="form-control" name="phone" id="px-customer-address-form-phone" value="<?php if ($customer) echo $customer->phone; ?>" placeholder="No Handphone">
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
<script type="text/javascript" src="assets/backend_assets/page/customer/customer_billing_address_form.js"></script>
<!--  -->
<!-- END SCRIPTS -->   