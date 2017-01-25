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
					
						  <div class="panel-body text-center">
						  <h3>Your Address</h3>
						  <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-left" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
							<form action="dashboard/update_ship" class="biling-info text-left" method="post">
							<div class="col-sm-12">
							<input type="hidden" name="id" value="<?php if($shipping!=''){ echo $shipping->id; }?>">
									<div class="input-box">
										<label>Receiver Name<span>*</span></label>
										<input type="text" required name="receiver_name" value="<?php if($shipping!=''){ echo $shipping->receiver_name; } ?>">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Tempat Tujuan<span>*</span></label>
										<input type="text" required name="title" placeholder="ex. Home, Hotel" value="<?php if($shipping!=''){ echo $shipping->title; } ?>">
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="input-box">
										<label>Provinsi<span>*</span></label>
										<select id="province" required name="province" class="province">
											<option value="">Pilih Provinsi</option>
											<?php foreach ($province_list as $d_row) { ?>
                                    		<option <?php if($shipping and $shipping->province==$d_row->id){ echo"selected"; } ?> value="<?php echo $d_row->id; ?>"><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kota/Kabupaten<span>*</span></label>
										<select id="kabupaten" required name="city"  class="city">
											<?php if($shipping!=''){ ?>
											<option value="<?php echo $city->id ?>"><?php echo $city->name ?></option>
											<?php }else{ ?>
											<option value="">Pilih Kota</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kecamatan<span>*</span></label>
										<select  required name="region" id="region">
										<?php if($shipping!=''){ ?>
											<option value="<?php echo $region->id ?>"><?php echo $region->name ?></option>
											<?php }else{ ?>
											<option value="">Pilih Kecamatan</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Alamat<span>*</span></label>
										<textarea required name="address"><?php if($shipping!=''){ echo $shipping->address; } ?></textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Kode Pos<span>*</span></label>
										<input required type="text" value="<?php if($shipping!=''){ echo $shipping->postal_code; } ?>" name="postal_code" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Phone<span>*</span></label>
										<input required type="text" value="<?php if($shipping!=''){ echo $shipping->phone; } ?>" name="phone"/>
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