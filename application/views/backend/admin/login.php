<!DOCTYPE html>
<html lang="en" class="body-full-height">
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
		<!-- EOF CSS INCLUDE -->                                    
	</head>
	<body>
		
		<div class="login-container">
		
			<div class="login-box animated fadeInDown">
				<div class="login-logo" style="height:100px;background:rgba(0, 0, 0, 0) url('assets/uploads/app_settings/<?php echo $app_login_logo; ?>') no-repeat scroll center center / auto 100%;"></div>
				<div class="login-body">
					<div class="login-title"><strong>Welcome</strong>, Please login</div>
					<form action="admin/do_login" class="form-horizontal" method="post" id="login-form">
						<div role="alert" class="alert alert-success hidden">
							<strong>Success!</strong> <span>Login success, You'll be redirected.</span>
						</div>
						<div role="alert" class="alert alert-warning hidden">
							<strong>Processing!</strong> <span>Please wait ...</span>
						</div>
						<div role="alert" class="alert alert-danger hidden">
							<strong>Failed!</strong> <span>Login failed.</span>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="Username" name="username" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="password" class="form-control" placeholder="Password" name="password" />
							</div>
						</div>
						<div class="form-group">
							<!-- <div class="col-md-6">
								<a href="#" class="btn btn-link btn-block">Forgot your password?</a>
							</div> -->
							<div class="col-md-6 pull-right">
								<button class="btn btn-info btn-block">Log In</button>
							</div>
						</div>
					</form>
				</div>
				<div class="login-footer">
					<div class="pull-left">
						&copy; 2015 <?php echo $app_title; ?>
					</div>
					<!-- <div class="pull-right">
						<a href="#">About</a> |
						<a href="#">Privacy</a> |
						<a href="#">Contact Us</a>
					</div> -->
				</div>
			</div>
			
		</div>
	<!-- START SCRIPTS -->
		<!-- START PLUGINS -->
		<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap.min.js"></script>
		<!-- END PLUGINS -->
		
		<!-- THIS PAGE PLUGINS -->
		<script type='text/javascript' src='assets/backend_assets/js/plugins/jquery-validation/jquery.validate.js'></script>
		<!-- END THIS PAGE PLUGINS -->               
		
		<script type="text/javascript">
			var jvalidate = $("#login-form").validate({
				ignore: [],
				rules: {                                            
					username: {
						required: true
					},
					password: {
						required: true
					}
				},
				submitHandler: function(form) {
					var target = $(form).attr('action');
					$('#login-form .alert-warning').removeClass('hidden');
					$('#login-form .alert-success').addClass('hidden');
					$('#login-form .alert-danger').addClass('hidden');
					$.ajax({
						url : target,
						type : 'POST',
						dataType : 'json',
						data : $(form).serialize(),
						success : function(response){
							$('#login-form .alert-warning').addClass('hidden');
							if(response.status == 'ok'){
								$('#login-form .alert-success').removeClass('hidden').children('span').text(response.msg);
								window.location.href = response.redirect;
							}
							else
								$('#login-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
						},
						error : function(jqXHR, textStatus, errorThrown) {
							alert(textStatus, errorThrown);
						}
					});
				}
			});                                    
		</script>
		
	<!-- END SCRIPTS --> 
		
	</body>
</html>






