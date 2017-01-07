<?php echo $this->load->view('frontend/sidebar') ?>
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
					
					</div>
				</div>
				
				<div class="billing-details">
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-7">
							<h3 class="h3-18">Billing Details</h3>
							<form action="shop/process_checkout" method="post" class="biling-info">
								
								<div class="col-sm-6">
									<div class="input-box">
										<label>First Name <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="firstname" value="<?php echo $user->nama_depan?>"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Last Name <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="lastname" value="<?php echo $user->nama_belakang?>"/>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="input-box m-b-10">
										<label>Address <abbr class="required" title="required">*</abbr></label>
										<textarea name="note" id="note" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."><?php echo $useraddress->address?></textarea>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Provice <abbr class="required" title="required">*</abbr></label>
										<select name="province">
											<option value="">choose province</option>
											<?php foreach ($province_list as $key) { ?>
											<option <?php if($useraddress->province->id==$key->id) echo"selected"; ?> value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>City <abbr class="required" title="required">*</abbr></label>
										<select name="city">
											<option value="<?php echo $useraddress->city->id ?>"><?php echo $useraddress->city->name ?></option>
											
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Region <abbr class="required" title="required">*</abbr></label>
										<select name="region">
											<option value="<?php echo $useraddress->region->id ?>"><?php echo $useraddress->region->name?></option>
											
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Postcode / Zip <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Postcode" placeholder="Postcode / Zip" value="<?php echo $useraddress->postal_code?>"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Email Address <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Email" value="<?php echo $user->email?>" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Phone <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Phone " placeholder="Phone" value="<?php echo $useraddress->phone?>"/>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box m-b-10">
									<tr class="shipping">
										<label>Shipping Address Title</label>
										<select name="shipping_id" class="ship">
											<?php foreach ($usershipping as $d_row) { ?>
											<option value="<?php echo $d_row->id?>"><?php echo $d_row->title?></option>
											<?php } ?>
										</select>
									</tr>
										</div>
									<div class="input-box m-b-10">
										<label>Shipping Address<abbr class="required" title="required">*</abbr></label>
										<textarea name="shippingAdress" id="address" cols="5" rows="2" placeholder=""></textarea>
									</div>

								</div>
								<div class="col-sm-12">
									<div class="account-box-hide">
										<p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
										<div class="input-box">
											<label>Account password <abbr class="required" title="required">*</abbr></label>
											<input type="password" name="Account" placeholder="password" />
										</div>
									</div>
								</div>
								<div class="shiping-address">
									<div class="col-sm-12">
									<h3 class="h3-18">Ship to a different address? <input type="checkbox" name="input_different" value ="1" class="showship"/></h3>
									</div>
									<div class="ship-box-hide">
										
										<div class="col-sm-6">
											<div class="input-box">
												<label>First Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="firstname"  value="" />
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-box">
												<label>Last Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="lastname" value=""/>
											</div>
										</div>
									
										<div class="col-sm-12">
											<div class="input-box">
												<label>Address <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="address" placeholder="Street address" />
											</div>
											<div class="input-box mt-10">
											<label>Tempat Tujuan <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="address" placeholder="Apartment, suite, unit etc. (optional)" />
											</div>									
										</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Province <abbr class="required" title="required">*</abbr></label>
										<select name="province" class="province">
											<option value="">Pilih Provinsi</option>
											<?php foreach ($province_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>City <abbr class="required" title="required">*</abbr></label>
										<select name="city" class="city" id="city">
											<option value="">Pilih Kota</option>
											<?php foreach ($city_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Region <abbr class="required" title="required">*</abbr></label>
										<select name="region" id="region">
											<option value="">Pilih Kecamatan</option>
											<?php foreach ($region_list as $d_row) { ?>
                                    		<option value="<?php echo $d_row->id; ?>"><?php echo $d_row->name;?></option>
                                    		<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Postcode / Zip <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Postcode" placeholder="Postcode / Zip" value=""/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Email Address <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Email" value="" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Phone <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Phone " placeholder="Phone" value=""/>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box m-b-10">
									<tr class="shipping">
										<label>Alamat Pengiriman</label>
<!--										<td>-->
											<select name="jasa_pengiriman_id">
												<?php foreach ($kurir as $data) { ?>
													<option value="<?php echo $data->id?>"><?php echo $data->name?></option>
												<?php } ?>
											</select>
<!--										</td>-->
									</tr>
										</div>
									<div class="input-box m-b-10">
<!--										<label>Alamat Pengiriman<abbr class="required" title="required">*</abbr></label>-->
										<textarea name="note" id="note" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."><?php echo $useraddress->address?></textarea>
									</div>

								</div>
									</div>
									
								</div>

						
						</div>
						<!-- billing content end -->
						<!-- order view start-->
						<div class="col-lg-5 col-md-5 col-sm-5">
							<div class="payment-box">
								<h3 class="h3-18">Your Order</h3>
								<table class="shop_table checkbox-tbl">
									<thead>
										<tr>
											<th class="product-name">Product</th>
											<th class="product-total">Total</th>
										</tr>
									</thead>
									<tbody>
									<?php $get_checkout = $this->cart->contents();?>
										<?php if (!empty($get_checkout)) { ?>
											<?php foreach ($get_checkout as $checkout) { 
												if ($this->session->userdata('id') == $checkout['customer_id']) { ?>
										<tr class="cart_item">										
											<td class="product-name">
												<?php echo $checkout['name']?> <strong class="product-quantity">× <?php echo $checkout['qty']?></strong>
											</td>
											<td class="product-total"><span class="p-price"><?php echo indonesian_currency($checkout['price'])?></span></td>										
										</tr>
									<?php }}}?>
									</tbody>
									<tfoot>
										<tr class="cart-subtotal">
											<th>Subtotal</th>
											<td><span class="t-price"><?php echo indonesian_currency($this->cart->total()); ?></span></td>
										</tr>
										<tr class="shipping">
											<th>Shipping</th>
											<td>
												<select name="jasa_pengiriman_id">
													<?php foreach ($kurir as $data) { ?>
													<option value="<?php echo $data->id?>"><?php echo $data->name?></option>
													<?php } ?>
												</select>
											</td>
										</tr>
										<tr class="">
											<th>Tipe Pengiriman</th>
											<td>
												<span>*</span>
											</td>
										</tr>
										<tr class="">
											<th>Biaya Kirim</th>
											<td>
												<span class="price" id="price"></span>
											</td>
										</tr>
										<tr class="order-total">
											<th>Total</th>
											<td><strong><span class="t-price"><?php echo indonesian_currency($this->cart->total()); ?></span></strong> </td>
										</tr>
									</tfoot>
								</table>
								<div class="payment-method">

									<button class="btnb floatright" type="submit">Proceed</button>
								</div>
							</div>
						</div>
						<!-- order view end-->
					</div>
				</div>
				</form>
				<!-- billing details end -->
			</div>
		</div>