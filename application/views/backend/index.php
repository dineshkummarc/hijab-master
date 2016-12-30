<!DOCTYPE html>
<html lang="en">
	<head>        
		<!-- BASE URL -->
		<base href="<?php echo base_url(); ?>"></base>
		<!-- EOF BASE URL -->
		<!-- META SECTION -->
		<title><?php echo $app_title; ?> - <?php echo $function_name; ?></title>             
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="icon" href="assets/uploads/app_settings/<?php echo $app_favicon_logo; ?>" type="image/x-icon" />
		<!-- END META SECTION -->
		
		<!-- CSS INCLUDE -->        
		<link rel="stylesheet" type="text/css" id="theme" href="assets/backend_assets/css/theme-default.css"/>
		<link rel="stylesheet" type="text/css" id="theme" href="assets/backend_assets/css/px-admin.css"/>
		<!-- EOF CSS INCLUDE -->

		<!-- START PLUGINS -->
		<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap.min.js"></script> 
		<script type='text/javascript' src='assets/backend_assets/js/plugins/icheck/icheck.min.js'></script>
		<script type="text/javascript" src="assets/backend_assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="assets/backend_assets/js/plugins/jcrop/jquery.Jcrop.min.js"></script>      
		<!-- END PLUGINS -->                                  
	</head>
	<body>
		<?php
			if(is_file('assets/uploads/admin/'.$this->session_admin['admin_id'].'/'.$this->session_admin['photo']))
				$admin_photo = 'assets/uploads/admin/'.$this->session_admin['admin_id'].'/'.$this->session_admin['photo'];
			else
				$admin_photo = 'assets/backend_assets/img/admin.png';
		?>
		<!-- START PAGE CONTAINER -->
		<div class="page-container">
			
			<!-- START PAGE SIDEBAR -->
			<div class="page-sidebar">
				<!-- START X-NAVIGATION -->
				<ul class="x-navigation">
					<li class="xn-logo">
						<a href="" class="xn-logo-big" style="background:rgba(0, 0, 0, 0) url('assets/uploads/app_settings/<?php echo $app_mini_logo; ?>') no-repeat scroll center center / auto 100%;"></a>
						<a href="" class="xn-logo-mini" style="background:rgba(0, 0, 0, 0) url('assets/uploads/app_settings/<?php echo $app_single_logo; ?>') no-repeat scroll center center / auto 30px;"></a>
						<a href="#" class="x-navigation-control"></a>
					</li>
					<li class="xn-profile">
						<a href="#" class="profile-mini">
							<img src="<?php echo $admin_photo; ?>" alt="<?php echo $this->session_admin['realname']; ?>"/>
						</a>
						<div class="profile">
							<div class="profile-image">
								<img src="<?php echo $admin_photo; ?>" alt="<?php echo $this->session_admin['realname']; ?>"/>
							</div>
							<div class="profile-data">
								<div class="profile-data-name"><?php echo $this->session_admin['realname']; ?></div>
								<div class="profile-data-title"><?php echo $this->session_admin['name_usergroup']; ?></div>
							</div>
							<div class="profile-controls">
								<a href="admin_system/my_profile" class="profile-control-left"><span class="fa fa-info"></span></a>
							</div>
						</div>                                                                        
					</li>
					<li class="xn-title">Navigation</li>
					<?php foreach ($menu as $m) { ?>
					<li <?php if(count($m->submenu)){ ?>class="xn-openable<?php if($controller == $m->target){ ?> active<?php } ?>"<?php } else { ?>class="<?php if($controller == $m->target){ ?> active<?php } ?>"<?php } ?>>
						<a href="<?php echo $m->target; ?>">
							<span class="fa <?php echo $m->icon; ?>"></span> 
							<span class="xn-text"><?php echo $m->name; ?></span>
						</a>
						<?php if(count($m->submenu)){ ?>
							<ul>
								<?php foreach ($m->submenu as $sm) { ?>
								<li <?php if($function == $sm->target){ ?>class="active"<?php } ?>>
									<a href="<?php echo $m->target.'/'.$sm->target; ?>">
										<i class="fa <?php echo $sm->icon; ?>"></i> <?php echo $sm->name; ?>
									</a>
								</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</li>
					<?php } ?>                    
					
				</ul>
				<!-- END X-NAVIGATION -->
			</div>
			<!-- END PAGE SIDEBAR -->
			
			<!-- PAGE CONTENT -->
			<div class="page-content">
				
				<!-- START X-NAVIGATION VERTICAL -->
				<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
					<!-- TOGGLE NAVIGATION -->
					<li class="xn-icon-button">
						<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
					</li>
					<!-- END TOGGLE NAVIGATION -->
					<!-- SEARCH -->
					<!-- <li class="xn-search">
						<form role="form">
							<input type="text" name="search" placeholder="Search..."/>
						</form>
					</li> -->   
					<!-- END SEARCH -->
					<!-- SIGN OUT -->
					<li class="xn-icon-button pull-right">
						<a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
					</li>
					<!-- END SIGN OUT -->
					<!-- TASKS -->
					<!-- <li class="xn-icon-button pull-right">
						<a href="#"><span class="fa fa-tasks"></span></a>
						<div class="informer informer-warning">3</div>
						<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
								<div class="pull-right">
									<span class="label label-warning">3 active</span>
								</div>
							</div>
							<div class="panel-body list-group scroll" style="height: 200px;">                                
								<a class="list-group-item" href="#">
									<strong>Phasellus augue arcu, elementum</strong>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
									</div>
									<small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
								</a>
								<a class="list-group-item" href="#">
									<strong>Aenean ac cursus</strong>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
									</div>
									<small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
								</a>
								<a class="list-group-item" href="#">
									<strong>Lorem ipsum dolor</strong>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
									</div>
									<small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
								</a>
								<a class="list-group-item" href="#">
									<strong>Cras suscipit ac quam at tincidunt.</strong>
									<div class="progress progress-small">
										<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
									</div>
									<small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
								</a>                                
							</div>     
							<div class="panel-footer text-center">
								<a href="pages-tasks.html">Show all tasks</a>
							</div>                            
						</div>                        
					</li> -->
					<!-- END TASKS -->
				</ul>
				<!-- END X-NAVIGATION VERTICAL -->                     

				<?php echo $content; ?>                               
			</div>            
			<!-- END PAGE CONTENT -->
		</div>
		<!-- END PAGE CONTAINER -->

		<!-- MESSAGE BOX-->
		<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
			<div class="mb-container">
				<div class="mb-middle">
					<div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
					<div class="mb-content">
						<p>Are you sure you want to log out?</p>                    
						<p>Press No if you want to continue work. Press Yes to logout current user.</p>
					</div>
					<div class="mb-footer">
						<div class="pull-right">
							<a href="admin/do_logout" class="btn btn-success btn-lg">Yes</a>
							<button class="btn btn-default btn-lg mb-control-close">No</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MESSAGE BOX-->
		<!-- START PRELOADS -->
		<audio id="audio-alert" src="assets/backend_assets/audio/alert.mp3" preload="auto"></audio>
		<audio id="audio-fail" src="assets/backend_assets/audio/fail.mp3" preload="auto"></audio>
		<!-- END PRELOADS -->         
	</body>
</html>






