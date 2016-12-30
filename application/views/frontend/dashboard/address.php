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
						  <h3>Isi Alamat Anda</h3>
						  <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-center" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
							<form action="dashboard/editaddress" class="biling-info" method="post">
								<div class="col-sm-12">
									<div class="input-box">
										<label>Tempat Tujuan<span>*</span></label>
										<select name="title">
											<option>Pilih Kantor/Rumah</option>
											<option value="Kantor"<?php if($useraddress->title == 'Kantor') echo 'selected';?>>Kantor</option>
											<option value="Rumah"<?php if($useraddress->title == 'Rumah') echo 'selected';?>>Rumah</option>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Alamat<span>*</span></label>
										<input type="text" name="address" value="<?php echo $useraddress->address ?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Provinsi<span>*</span></label>
										<select name="province" class="province">
											<option value="">Pilih Provinsi</option>
											<?php foreach ($province_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"<?php if($useraddress->province == $d_row->id) echo 'selected';?>><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kota/Kabupaten<span>*</span></label>
										<select name="city" id="city" class="city">
											<option value="">Pilih Kota</option>
											<?php foreach ($city_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"<?php if($useraddress->city == $d_row->id) echo 'selected';?>><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kecamatan<span>*</span></label>
										<select name="region" id="region">
											<option value="">Pilih Kecamatan</option>
											<?php foreach ($region_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"<?php if($useraddress->region == $d_row->id) echo 'selected';?>><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kode Pos<span>*</span></label>
										<input type="text" name="postal_code" value="<?php echo $useraddress->postal_code?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Phone<span>*</span></label>
										<input type="text" name="phone" value="<?php echo $useraddress->phone?>" />
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