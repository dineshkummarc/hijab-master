	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="grid-full">
						<ul>
							<li>
								<a href="#">Home</a>
								<span> / </span>
							</li>
							<li>My Account</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- faq-area -->
	<div class="faq-area my-account">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="faq-title">
						<h4><?php echo $function_name;?></h4>
					</div>
					
					<?php
						$this->load->view('frontend/dashboard/side-menu'); 
					?>
					<div class="col-lg-6 col-xs-6 col-sm-6">
						  <div class="panel-body">
						  <h3>Ganti Password bila Anda perlu</h3>
							<form action="#" class="biling-info">
								<div class="col-sm-12">
									<div class="input-box">
										<label>Old Password<span>*</span></label>
										<input type="password" name="oldpassword" value="<?php echo $user->password?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>New Password<span>*</span></label>
										<input type="text" name="password" value="" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Konfirm Password<span>*</span></label>
										<input type="text" name="cpassword" value="" />
									</div>
								</div>								
								<div class="col-sm-12">
									<div class="input-box mt-10">
										<button class="btnb-l">Save</button>
									</div>
								</div>
							</form>
						  </div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>