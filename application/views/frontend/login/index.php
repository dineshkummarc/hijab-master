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
						<?php if($this->session->flashdata('msg')){ ?>
                        <div class="form-group text-center" >
                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
                        </div>
                        <?php } ?>
						<form action="login/do_login" method="post">
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
						<form action="register/do_register" method="post">
							<div class="shipping-form">		
								<div class="input-box m-b-20">
									<h4>Nama Depan <span>*</span></h4>
									<input type="text" name="nama_depan" id="px-customer-form-nama_depan" placeholder="Nama Depan"/>
								</div>
								<div class="input-box m-b-20">
									<h4>Nama Belakang <span>*</span></h4>
									<input type="text" name="nama_belakang" id="px-customer-form-nama_belakang" placeholder="Nama Belakang"/>
								</div>
								<div class="input-box m-b-20">
									<h4>Tanggal Lahir <span>*</span></h4>
									<input type="date" name="tgl_lahir" id="px-customer-form-tgl_lahir" placeholder="tanggal_lahir" class="datepicker"/>
								</div>
								<div class="input-radio m-b-20">
									<h4>Jenis Kelamin <span>*</span></h4>
									<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki" /> Laki-Laki
									<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan" /> Perempuan
								</div>				
								<div class="input-box m-b-20">
									<h4>Email Address <span>*</span></h4>
									<input type="text" name="email" id="px-customer-form-email" placeholder="E-Mail"/>
								</div>					
								<div class="input-box m-b-20">
									<h4>Password <span>*</span></h4>
									<input type="password" name="password" id="px-customer-form-password" placeholder="Password" />		
								</div>
								<div class="input-box m-b-20">
									<h4>Konfirm Password <span>*</span></h4>
									<input type="password" name="cpassword" id="px-customer-form-password" placeholder="Konfirm Password" />		
								</div>					
								<div class="input-box m-b-20 m-mb">
									<p class="red floatleft">* Required Fields</p>									
								</div>
							</div>
							<div class="btn-link">
								<button class="btnb-l">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>