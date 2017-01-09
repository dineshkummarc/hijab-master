<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->                       

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <!-- START WIDGETS -->                    
    <div class="row">
        <div class="col-md-3">

            <!-- START WIDGET SLIDER -->
            <div class="widget widget-default widget-carousel">
                <div class="owl-carousel" id="owl-example">
                    <div>                                    
                        <div class="widget-title">Total Order</div>
                        <div class="widget-int">3,548</div>
                    </div>
                    <div>                                    
                        <div class="widget-title">Total Member</div>
                        <div class="widget-int">1,695</div>
                    </div>
                    <div>                                    
                        <div class="widget-title">Product Sold</div>
                        <div class="widget-int">1,977</div>
                    </div>
                </div>                            
            </div>
        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href = 'pages-messages.html';">
                <div class="widget-item-left">
                    <span class="fa fa-shopping-cart"></span>
                </div>                             
                <div class="widget-data">
                    <div class="widget-int num-count">48</div>
                    <div class="widget-title">Unprocessed Order</div>
                    <div class="widget-subtitle">In your Order List</div>
                </div>
            </div>                            
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET REGISTRED -->
            <div class="widget widget-default widget-item-icon" onclick="location.href = 'pages-address-book.html';">
                <div class="widget-item-left">
                    <span class="fa fa-dollar"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count">375</div>
                    <div class="widget-title">Order Success</div>
                    <div class="widget-subtitle">In your Order List</div>
                </div>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            
            </div>                            
            <!-- END WIDGET REGISTRED -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET CLOCK -->
            <div class="widget widget-danger widget-padding-sm">
                <div class="widget-big-int plugin-clock">00:00</div>                            
                <div class="widget-subtitle plugin-date">Loading...</div>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            
                <div class="widget-buttons widget-c3">
                    Hallo <?php echo $this->session_admin['realname']; ?>
                    <div class="col hidden">
                        <a href="#"><span class="fa fa-clock-o"></span></a>
                    </div>
                    <div class="col hidden">
                        <a href="#"><span class="fa fa-bell"></span></a>
                    </div>
                    <div class="col hidden">
                        <a href="#"><span class="fa fa-calendar"></span></a>
                    </div>
                </div>                            
            </div>                        
            <!-- END WIDGET CLOCK -->

        </div>
    </div>
    <!-- END WIDGETS -->                    

    <div class="row">
        <div class="col-md-12">

            <!-- START PROJECTS BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Total Order</h3>
                        <span>by City</span>
                    </div>
                </div>
                <div class="panel-body panel-body-table">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="20%">City</th>
                                    <th width="20%">Number</th>
                                    <th width="60%">Result</th>
                                </tr>
                            </thead>
                            <tbody>                                               
                                <tr>
                                    <td><strong>Jakarta</strong></td>
                                    <td>1234 Orders</td>
                                    <td>
                                        <div class="progress progress-small progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jakarta</strong></td>
                                    <td>1234 Orders</td>
                                    <td>
                                        <div class="progress progress-small progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jakarta</strong></td>
                                    <td>1234 Orders</td>
                                    <td>
                                        <div class="progress progress-small progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jakarta</strong></td>
                                    <td>1234 Orders</td>
                                    <td>
                                        <div class="progress progress-small progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jakarta</strong></td>
                                    <td>1234 Orders</td>
                                    <td>
                                        <div class="progress progress-small progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- END PROJECTS BLOCK -->

        </div>
    </div>

    <div class="row">
        <div class="col-md-4">

            <!-- START SALES & EVENTS BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Total Income</h3>
                        <span>Monthly</span>
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>                                        
                        </li>                                        
                    </ul>
                </div>
                <div class="panel-body padding-0">
                    <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
                </div>
            </div>
            <!-- END SALES & EVENTS BLOCK -->

        </div>
        <div class="col-md-4">

            <!-- START USERS ACTIVITY BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>New Customer Activity</h3>
                        <span>New Customer vs New Customer Order</span>
                    </div>                                    
                </div>                                
                <div class="panel-body padding-0">
                    <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
                </div>                                    
            </div>
            <!-- END USERS ACTIVITY BLOCK -->

        </div>
        <div class="col-md-4">

            <!-- START VISITORS BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Orders</h3>
                        <span>Orders (All Time)</span>
                    </div>
                </div>
                <div class="panel-body padding-0">
                    <div class="chart-holder" id="dashboard-donut-1" style="height: 200px;"></div>
                </div>
            </div>
            <!-- END VISITORS BLOCK -->

        </div>
    </div>

    <!-- START DASHBOARD CHART -->
    <div class="block-full-width hidden">
        <div id="dashboard-chart" style="height: 250px; width: 100%; float: left;"></div>
        <div class="chart-legend">
            <div id="dashboard-legend"></div>
        </div>                                                
    </div>                    
    <!-- END DASHBOARD CHART -->

</div>
<!-- END PAGE CONTENT WRAPPER -->                 

<!-- START SCRIPTS -->
<!-- START THIS PAGE PLUGINS--> 
<script type="text/javascript" src="assets/backend_assets/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/morris/morris.min.js"></script>       
<script type="text/javascript" src="assets/backend_assets/js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='assets/backend_assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='assets/backend_assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
<script type='text/javascript' src='assets/backend_assets/js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
<script type="text/javascript" src="assets/backend_assets/js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- END THIS PAGE PLUGINS-->        

<!-- START TEMPLATE -->
<script type="text/javascript" src="assets/backend_assets/js/settings.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/plugins.js"></script>        
<script type="text/javascript" src="assets/backend_assets/js/actions.js"></script>

<script type="text/javascript" src="assets/backend_assets/js/demo_dashboard.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->  