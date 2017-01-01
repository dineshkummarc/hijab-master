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
                <form class="form-horizontal" action="<?php if ($data) echo $controller . '/' . $function_edit; else echo $controller . '/' . $function_add; ?>" method="POST" id="px-customer-form">
                    <div class="panel-heading">                                
                        <h3 class="panel-title">Data Customer</h3>                              
                    </div>
                    <input type="hidden" name="id" id="px-customer-form-id" value="<?php if ($data) echo $data->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-name">Nama Depan</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="nama_depan" id="px-customer-form-nama_depan" value="<?php if ($data) echo $data->nama_depan; ?>" placeholder="Nama Depan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-name">Nama Belakang</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="nama_belakang" id="px-customer-form-nama_belakang" value="<?php if ($data) echo $data->nama_belakang; ?>" placeholder="Nama Belakang" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-email">Email</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="email" class="form-control" name="email" id="px-customer-form-email" value="<?php if ($data) echo $data->email; ?>" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-password">Password</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="password" class="form-control" name="password" id="px-customer-form-password" value="<?php if ($data) echo $data->password; ?>" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-conf-password">Password Confirm</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="password" class="form-control" name="password_confirm" id="px-customer-form-password_confirm" value="<?php if ($data) echo $data->password; ?>" placeholder="Ulangi Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-tgl_lahir">Tanggal Lahir</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control datepicker" name="tgl_lahir" id="px-customer-form-tgl_lahir" value="<?php if ($data) echo $data->tgl_lahir; ?>" placeholder="Tanggal Lahir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-form-jenis_kelamin">Jenis Kelamin</label>
                            <div class="col-md-9 col-xs-12">
                                <select class="form-control" name="jenis_kelamin" id="px-customer-form-jenis_kelamin" required>
                                    <option value="L" <?php if($data) if($data->jenis_kelamin == 'L') echo 'selected' ?>>Pria</option>
                                    <option value="P" <?php if($data) if($data->jenis_kelamin == 'P') echo 'selected' ?>>Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Foto</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="hidden" name="old_photo" value="<?php if ($data) echo $data->photo; ?>">
                                <input type="hidden" name="photo">                                                                                                                                       
                                <label for="file-upload-file" class="btn btn-primary btn-upload" data-target="photo" id="px-customer-fileupload-photo-upload-button">Browse</label>
                            </div>
                            <?php
                            if ($data) {
                                if (is_file('assets/uploads/customer/' . $data->id . '/' . $data->photo)) {
                                    $photo = ' ';
                                    $photo_file = 'assets/uploads/customer/' . $data->id . '/' . $data->photo;
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
                    <div class="panel-heading">                                
                        <h3 class="panel-title">Customer Billing Address</h3>                              
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-title">Judul Alamat</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="title" id="px-customer-address-form-title" value="<?php if($data) if ($data->billing) echo $data->billing->title; ?>" placeholder="Home atau Office" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-address">Alamat Anda</label>
                            <div class="col-md-9 col-xs-12">
                                <textarea class="form-control" name="address" id="px-customer-address-form-address" placeholder="Alamat Anda" required><?php if($data) if ($data->billing) echo $data->billing->address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-province">Provinsi</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="province" id="px-customer-address-form-province" class="form-control" required>
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($province_list as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($data) if($data->billing) if($data->billing->province == $d_row->id) echo 'selected' ?>><?php echo $d_row->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-city">Kota</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="city" id="px-customer-address-form-city" class="form-control" required>
                                    <option value="">Pilih Kota</option>
                                    <?php if($data) if($data->billing) { foreach ($city as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($data) if($data->billing) if($data->billing->city == $d_row->id) echo 'selected' ?>><?php echo $d_row->type.' '.$d_row->name;?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-region">Kecamatan</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="region" id="px-customer-address-form-region" class="form-control" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php if($data) if($data->billing) { foreach ($region as $d_row) { ?>
                                    <option value="<?php echo $d_row->id; ?>"<?php if($data) if($data->billing) if($data->billing->region == $d_row->id) echo 'selected' ?>><?php echo $d_row->name;?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-postal_code">Kode Pos</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="postal_code" id="px-customer-address-form-postal_code" value="<?php if($data) if ($data->billing) echo $data->billing->postal_code; ?>" placeholder="Kode Pos Anda" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label" for="#px-customer-address-form-phone">Phone</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="phone" id="px-customer-address-form-phone" value="<?php if($data) if ($data->billing) echo $data->billing->phone; ?>" placeholder="No Handphone" required>
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
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>               
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/fileupload/fileupload.min.js"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>        
<!-- END TEMPLATE -->  
<!-- THIS PAGE JS SETTINGS -->
<script type="text/javascript" src="assets/backend_assets/page/customer/customer_form.js"></script>
<!--  -->
<!-- END SCRIPTS -->   