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
                    <h3 class="panel-title">Data Shipping Cost</h3>
                    <!-- <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>  -->                               
                </div>
                <div class="panel-body">
                    <table class="table table-bordered" id="table-datatable">
                        <thead>
                            <tr>
                                <th class="text-center" width="2%">No</th>
                                <th class="text-center">Province</th>
                                <th class="text-center">City</th>
                                <th class="text-center">Region</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Service</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
<div id="px-shipping_cost-shipping_cost_list-message-box" class="message-box message-box-warning animated fadeIn fade">
    <div class="mb-container">
        <div class="mb-middle">
            <form action="<?php echo $controller . '/' . $function_delete; ?>" method="post" id="px-shipping_cost-shipping_cost_list-message-form">
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
<script type="text/javascript" src="assets/backend_assets/page/shipping_cost/shipping_cost_list.js"></script>