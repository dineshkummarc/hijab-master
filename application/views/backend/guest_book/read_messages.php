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
                          <div class="box-header with-border">
                            <h3 class="box-title">Read Messages</h3>
                          </div><!-- /.box-header -->
                          <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                              <h3><?php echo $messages->subject ?></h3>
                              <h5>From: <?php echo $messages->name; ?></h5>
                              <!-- <h5><?php echo $messages->company; ?></h5> -->
                              <h5>Email: <?php echo $messages->email; ?></h5>
                              <h5>Phone: <?php echo $messages->phone; ?><span class="mailbox-read-time pull-right"><?php echo $messages->date_created ?></span></h5>
                            </div><!-- /.mailbox-read-info -->
                            <div class="mailbox-read-message">
                              <?php echo $messages->content ?>
                            </div><!-- /.mailbox-read-message -->
                          </div><!-- /.box-body -->
                          <div class="box-footer">
                            <form id="form1" action="<?php echo $controller.'/delete_messages' ?>" method="POST" />
                            <input type="hidden" name="messages_id[]" value="<?php echo $messages->id ?>" />
                            <button class="btn btn-default" type="submit"><i class="fa fa-trash-o"></i> Delete</button>
                            </form>
                          </div><!-- /.box-footer -->
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