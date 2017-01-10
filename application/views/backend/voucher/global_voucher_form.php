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
                <form class="form-horizontal" action="<?php if ($data) echo $controller . '/' . $function_edit; else echo $controller . '/' . $function_add; ?>" method="POST" id="px-voucher-form">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Voucer</h3>
                    </div>
                    <input type="hidden" name="id" id="px-voucher-form-id" value="<?php if($data) echo $data->id; ?>">
                    <div class="panel-body">
                        <div class="alert alert-success hidden"><strong>Success! </strong><span></span></div>
                        <div class="alert alert-warning hidden"><strong>Processing! </strong><span>Please wait...</span></div>
                        <div class="alert alert-danger hidden"><strong>Failed! </strong><span></span></div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Kode Voucher</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control" name="voucher" id="px-voucher-form-kode" value="<?php if($data) echo $data->voucher;?>" placeholder="Kode Voucher" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Tanggal Mulai</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control datepicker" name="date_start" id="px-voucher-form-date_start" value="<?php if($data) echo $data->date_start; ?>"  placeholder="Tanggal Mulai" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Tanggal Selesai</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" class="form-control datepicker" name="date_end" id="px-voucher-form-date_start" value="<?php if($data) echo $data->date_end ?>"  placeholder="Tanggal Selesai" required>
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
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>
<!-- END TEMPLATE -->
<!-- THIS PAGE JS SETTINGS -->
<script type="text/javascript" src="assets/backend_assets/page/voucher/voucher_form.js"></script>
<!--  -->
<!-- END SCRIPTS -->