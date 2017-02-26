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
                    <h3 class="panel-title">Data</h3>
                    <!-- <a class="btn btn-success pull-right btn-add" href="<?php echo $controller.'/'.$function_form; ?>"><i class="fa fa-plus"></i> Add New</a>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>  -->                               
                </div>
                <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-primary">
                                        <form id="delete_messages" action="<?php echo $controller . '/delete_messages' ?>" method="POST"> 
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Inbox</h3>
                                                <div class="box-tools pull-right">
                                                </div><!-- /.box-tools -->
                                            </div><!-- /.box-header -->
                                            <div class="box-body no-padding">
                                                <div class="mailbox-controls">
                                                    <!-- Check all button -->
                                                    <button class="btn btn-default btn-sm checkbox-toggle" type="button" id="selectAll"><i class="fa fa-square-o"></i></button>
                                                    <div class="btn-group">
                                                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                                    </div><!-- /.btn-group -->
                                                    <div class="pull-right">
                                                        1-50/200
                                                        <div class="btn-group">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                        </div><!-- /.btn-group -->
                                                    </div><!-- /.pull-right -->
                                                </div>
                                                <?php
                                                if (isset($_GET['delete'])) {
                                                    if ($_GET['delete'] == 'error') {
                                                        ?>
                                                        <div class="alert alert-danger">Delete Failed</div>
                                                    <?php } elseif($_GET['delete'] == 'kosong'){ 
                                                        ?>
                                                        <div class="alert alert-danger">Harus pilih yang akan didelete</div>
                                                    <?php } else { ?>
                                                        <div class="alert alert-success">Delete Success</div>
                        <?php }
                    } ?>
                                                <div class="table-responsive mailbox-messages">
                                                    <table class="table table-hover table-striped">
                                                        <tbody>
                    <?php foreach ($guest_book as $data_row) { ?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="messages_id[]" value="<?php echo $data_row->id ?>"/></td>
                                                                    <td class="mailbox-name"><a href="<?php echo $controller . '/read_messages/' . $data_row->id ?>" class="<?php if ($data_row->read_flag == 0) echo 'text-red'; ?>"><?php echo $data_row->name ?></a></td>
                                                                    <td class="mailbox-subject"><a href="<?php echo $controller . '/read_messages/' . $data_row->id ?>" class="<?php if ($data_row->read_flag == 0) echo 'text-red'; ?>"><?php echo $data_row->subject ?> - <?php echo $data_row->message ?></a></td>
                                                                    <td class="mailbox-date"><?php echo $data_row->date_created ?></td>
                                                                </tr>
                    <?php } ?>
                                                        </tbody>
                                                    </table><!-- /.table -->
                                                </div><!-- /.mail-box-messages -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer no-padding">
                                                <div class="mailbox-controls">
                                                    <!-- Check all button -->
                                                    <button class="btn btn-default btn-sm checkbox-toggle" type="button" id="selectAll"><i class="fa fa-square-o"></i></button>              
                                                    <div class="btn-group">
                                                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                                    </div><!-- /.btn-group -->
                                                    <div class="pull-right">
                                                        1-50/200
                                                        <div class="btn-group">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                                        </div><!-- /.btn-group -->
                                                    </div><!-- /.pull-right -->
                                                </div>
                                            </div>
                                            <input type="hidden" name="redirect" value="messages_inbox" />
                                        </form>
                                    </div><!-- /. box -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

        </div>
    </div>                                
    
</div>
<!-- PAGE CONTENT WRAPPER -->

<!-- MESSAGE BOX -->
<div id="px-site-content-album-message-box" class="message-box message-box-warning animated fadeIn fade">
    <div class="mb-container">
        <div class="mb-middle">
            <form action="<?php echo $controller.'/'.$function_delete; ?>" method="post" id="px-site-content-album-message-form">
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
    <!-- END TEMPLATE -->  
    <!-- THIS PAGE JS SETTINGS -->
       <script src="assets/backend_assets/page/guest_book/messages.js" type="text/javascript"></script>
    <!-- EOF PAGE SETTINGS  -->
<!-- END SCRIPTS -->   