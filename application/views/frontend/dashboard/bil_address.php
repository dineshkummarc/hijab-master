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
					<?php if($count_bil==0){ ?>
						<p class="my-title text-center">Please fill in your address to complete the register</p>
						<div class="col-lg-6 col-xs-6 col-sm-6 center text-center">
						<?php }else{ ?>
					<p class="my-title">Welcome to your account. Here you can manage all of your personal information and orders.</p>
					<?php
						$this->load->view('frontend/dashboard/side-menu'); 
					?>
					<div class="col-lg-6 col-xs-6 col-sm-6">
					<?php } ?>
						  <div class="panel-body text-center">
						  <h3>Your Address</h3>
						  <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-left" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
							<form action="dashboard/register_biladdress" class="biling-info text-left" method="post">
								<div class="col-sm-12">
									<div class="input-box">
										<label>Tempat Tujuan<span>*</span></label>
										<select required name="title">
											<option value="">Pilih Kantor/Rumah</option>
											<option value="Kantor">Kantor</option>
											<option value="Rumah">Rumah</option>
										</select>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="input-box">
										<label>Provinsi<span>*</span></label>
										<select id="province" required name="province" class="province">
											<option value="">Pilih Provinsi</option>
											<?php foreach ($province_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kota/Kabupaten<span>*</span></label>
										<select id="kabupaten" required name="city"  class="city">
											<option value="">Pilih Kota</option>
											
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kecamatan<span>*</span></label>
										<select  required name="region" id="region">
											<option value="">Pilih Kecamatan</option>
											
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Alamat<span>*</span></label>
										<textarea required name="address"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kode Pos<span>*</span></label>
										<input required type="text" name="postal_code" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Phone<span>*</span></label>
										<input required type="text" name="phone"/>
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