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

	                        <div class="form-group text-center" >
	                        <h4 class="update-pass-msg" style="color:red"></h4>
	                        </div>


							<form action="dashboard/update_pass" method="post" id="form-update-pass">
								<div class="col-sm-12">
									<div class="input-box">
										<label>Old Password<span>*</span></label>
										<input type="password" name="oldpassword"/>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>New Password<span>*</span></label>
										<input type="password" name="password" value="" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Konfirm Password<span>*</span></label>
										<input type="password" name="cpassword" value="" />
									</div>
								</div>								
								<div class="col-sm-12">
									<div class="input-box mt-10">
										<button type="submit" class="btnb-l">Save</button>
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