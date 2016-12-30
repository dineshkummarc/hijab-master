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
					<p class="my-title">Welcome to your account. Here you can manage all of your personal information and orders.</p>
					<?php
						$this->load->view('frontend/dashboard/side-menu'); 
					?>
					<div class="col-lg-6 col-xs-6 col-sm-6">
						  <div class="panel-body">
						  <h3>Your personal information</h3>
						  <p>Please be sure to update your personal information if it has changed.</p>
						  <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-center" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
							<form action="dashboard/editprofile" class="biling-info" method="post">
								<div class="col-sm-12">
									<div class="input-box">
										<label>Nama Depan<span>*</span></label>
										<input type="text" name="nama_depan" value="<?php echo $user->nama_depan ?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Nama Belakang<span>*</span></label>
										<input type="text" name="nama_belakang" value="<?php echo $user->nama_belakang ?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>E-mail address<span>*</span></label>
										<input type="text" name="email" value="<?php echo $user->email?>" />
									</div>
								</div>	
								<div class="col-sm-12">
									<div class="input-box bithtday">
										<label>Date of Birth</label>
										<input type="text" name="tgl_lahir" value="<?php echo $user->tgl_lahir?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-radio">
										<label>Jenis Kelamin</label> : <span><?php echo $user->jenis_kelamin?></span>
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