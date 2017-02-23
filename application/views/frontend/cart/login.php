	<div class="shopping-area p-t-70">
		<div class="container">
			<div class="row">
			<?php if($this->session->flashdata('msg_check')){ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 text-center">
				<h4><?php echo $this->session->flashdata('msg')?></h4>
			</div>
			<?php } ?>
				<div class="col-lg-12">
					<div class="page-title m-b-30">
						<h5>Login or Create an Account</h5>
					</div>					
				</div>
			</div>
		</div>
	</div>
	<!-- cart-collaterals -->
	<div class="cart-collaterals">
		<div class="container">
			<div class="row">
			
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="shipping-tax">
					
						<div class="content-title">
							<h4>Login Customers</h4>
						</div>

                        <div class="form-group text-center" >
                        <h4 class="login-msg" style="color:red"></h4>
                        </div>

						<form id="form-login" action="cart/do_login" method="post">
							<div class="shipping-form">						
								<div class="input-box m-b-20">
									<h4>Email Address <span>*</span></h4>
									<input type="text" name="email" id="email" placeholder="E-MAIL OR LOGIN"/>
								</div>					
								<div class="input-box m-b-20">
									<h4>Password <span>*</span></h4>
									<input type="password" name="password" id="password" placeholder="Password" />						
								</div>					
								<div class="input-box m-b-20 m-mb">
									<p class="red floatleft">* Required Fields</p>
									<p class="floatright inherit"><a class="inherit" href="#">Forgot Your Password?</a></p>
								</div>
							</div>
							<div class="btn-link">
								<button class="btnb-l">login</button>
							</div>
						</form>
						<div class="text-center">
						<h3>OR</h3>
						<a href="<?php echo $login_url ?>"><img src="assets/frontend_assets/img/login_fb.png" width="50%"></a>
						<a href="<?php echo $login_google ?>"><img src="assets/frontend_assets/img/login_g.png" width="50%"></a>
					</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="shipping-tax">
						<div class="content-title">
							<h4>New Customers</h4>
						</div>
						<?php if($this->session->flashdata('notif')){ ?>
                        <div class="form-group text-center" >
                        <h4 style="color:red"><?php echo $this->session->flashdata('notif') ?></h4>
                        </div>
                        <?php } ?>
						<form action="register/do_register" method="post" enctype="multipart/form-data">
							<div class="shipping-form">		
								<div class="input-box m-b-20">
									<h4>Nama Depan <span>*</span></h4>
									<input required type="text" value="<?php if($this->session->flashdata('notif')){ echo $this->session->flashdata('nama_depan');} ?>" name="nama_depan" id="px-customer-form-nama_depan" placeholder="Nama Depan"/>
								</div>
								<div class="input-box m-b-20">
									<h4>Nama Belakang <span>*</span></h4>
									<input required type="text" value="<?php if($this->session->flashdata('notif')){ echo $this->session->flashdata('nama_belakang');} ?>" name="nama_belakang" id="px-customer-form-nama_belakang" placeholder="Nama Belakang"/>
								</div>
								<div class="input-box m-b-20">
									<h4>Tanggal Lahir <span>*</span></h4>
									<input required type="date" value="<?php if($this->session->flashdata('notif')){ echo $this->session->flashdata('tgl_lahir');} ?>" name="tgl_lahir" id="px-customer-form-tgl_lahir" placeholder="tanggal_lahir" class="datepicker"/>
								</div>
								<div class="input-radio m-b-20">
									<h4>Jenis Kelamin <span>*</span></h4>
									<input required type="radio" <?php if($this->session->flashdata('notif') and $this->session->flashdata('jenis_kelamin')=='L'){ echo"checked";} ?>  name="jenis_kelamin" id="jenis_kelamin" value="L" /> Laki-Laki
									<input required type="radio" name="jenis_kelamin" <?php if($this->session->flashdata('notif') and $this->session->flashdata('jenis_kelamin')=='P' ){ echo"checked";} ?> id="jenis_kelamin" value="P" /> Perempuan
								</div>				
								<div class="input-box m-b-20">
									<h4>Email Address <span>*</span></h4>
									<input required type="email" value="<?php if($this->session->flashdata('notif')){ echo $this->session->flashdata('email');} ?>" name="email" id="px-customer-form-email" placeholder="E-Mail"/>
								</div>					
								<div class="input-box m-b-20">
									<h4>Password <span>*</span></h4>
									<input required type="password" name="password" id="px-customer-form-password" placeholder="Password" />		
								</div>
								<div class="input-box m-b-20">
									<h4>Konfirm Password <span>*</span></h4>
									<input required type="password" name="cpassword" id="px-customer-form-password" placeholder="Konfirm Password" />		
								</div>					
								<div class="input-box m-b-20 m-mb">
									<p class="red floatleft">* Required Fields</p>									
								</div>
							</div>
							<div class="btn-link">
								<button type="submit" name="submit" class="btnb-l">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>