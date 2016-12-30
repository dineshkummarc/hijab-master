<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="admin">Home</a></li>                    
    <li><a href="<?php echo $controller; ?>"><?php echo $controller_name; ?></a></li>
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
                <form class="form-horizontal" action="<?php if ($customer) echo $controller . '/customer_billing_address_edit'; else echo $controller . '/customer_billing_address_add'; ?>" method="POST" id="px-customer-address-form">
                    <input type="hidden" name="id" id="px-customer-address-form-id" value="<?php if ($customer) echo $customer->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
<!--                            <label class="col-md-2 col-xs-12 control-label">Foto Customer</label>-->
                            <div class="col-md-9 col-xs-12">
                                <input type="hidden" name="old_photo" value="<?php if ($customer) echo $customer->photo; ?>">
                                <input type="hidden" name="photo">
                            </div>
                            <?php
                            if ($customer) {
                                if (is_file('assets/uploads/customer/' . $customer->id . '/' . $customer->photo)) {
                                    $photo = ' ';
                                    $photo_file = 'assets/uploads/customer/' . $customer->id . '/' . $customer->photo;
                                } else {
                                    $photo = '';
                                    $photo_file = 'assets/uploads/customer/noimagefound.jpg';
                                }
                            } else {
                                $photo = 'hidden';
                                $photo_file = ' ';
                            }
                            ?>
                            <div class="col-md-9 col-xs-12 col-md-offset-5 no-padding <?php echo $photo ?>" id="preview-photo">
<!--                                <label class="col-md-2 col-xs-12 control-label">Foto Customer</label>-->
                                <div class="img-thumbnail profile-pict" id="image-original-previews">
                                    <img src="<?php echo $photo_file ?>" alt="photo" id="original-image"/>                                                                                                           
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-title">Nama Lengkap</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="customer_id" id="px-customer-address-form-customer_id" value="<?php if ($customer) echo $customer->nama_depan. ' '. $customer->nama_belakang; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-title">ID</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="hidden" class="form-control" name="customer_id" id="px-customer-address-form-customer_id" value="<?php if ($customer) echo $customer->id; ?>" placeholder="Nama Belakang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Alamat</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="address" id="px-customer-address-form-address" value="<?php if ($customer) echo $customer->address; ?>" placeholder="Alamat Anda" disabled>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-province">Provinsi</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="province" id="px-customer-address-form-province" class="form-control province" disabled>
                                    <option value="">Pilih Provinsi</option>
                                    <?php /*foreach ($province_list as $d_row) { */?>
                                    <option value="<?php /*echo $d_row->id; */?>"<?php /*if($customer) if($customer->province == $d_row->id) echo 'selected' */?>><?php /*echo $d_row->name;*/?></option>
                                    <?php /*} */?>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Provinsi</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="province" id="px-customer-address-form-province" value="<?php if ($customer) echo $customer->province; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Kota</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="city" id="px-customer-address-form-city" value="<?php if ($customer) echo $customer->city; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Kecamatan</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="region" id="px-customer-address-form-region" value="<?php if ($customer) echo $customer->region; ?>" disabled>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-city">Kota</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="city" id="px-customer-address-form-city" class="form-control city" disabled>
                                    <option value="">Pilih Kota</option>
                                    <?php /*foreach ($city_list as $d_row) { */?>
                                    <option value="<?php /*echo $d_row->id; */?>"<?php /*if($customer) if($customer->city == $d_row->id) echo 'selected' */?>><?php//*/ echo $d_row->type;*/?> <?php /*echo $d_row->name;*/?></option>
                                    <?php /*} */?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-region">Kecamatan</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="region" id="px-customer-address-form-region" class="form-control region" disabled>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php /*foreach ($region_list as $d_row) { */?>
                                    <option value="<?php /*echo $d_row->id; */?>"<?php /*if($customer) if($customer->region == $d_row->id) echo 'selected' */?>><?php /*echo $d_row->name;*/?></option>
                                    <?php /*} */?>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-postal_code">Kode Post</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="postal_code" id="px-customer-address-form-postal_code" value="<?php if ($customer) echo $customer->postal_code; ?>" placeholder="Kode Pos Anda" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-phone">Phone</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control customer" name="phone" id="px-customer-address-form-phone" value="<?php if ($customer) echo $customer->phone; ?>" placeholder="No Handphone" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">          
                        <!-- <button class="btn btn-info btn-preview" type="button">Preview</button>                       -->
                        <button class="btn btn-primary pull-right" disabled>Save</button>
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