<?php echo $this->load->view('frontend/sidebar') ?>
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
					
					</div>
				</div>
				<form id="form-checkout" method="post" action="cart/submit_order" enctype="multipart/form-data">
				<div class="billing-details">
					<div class="row">
						<div class="col-md-6">
							<div class="shiping-address">
									<div class="col-sm-12">
									<h3 class="h3-18">Choose shipping address</h3>
									</div>
									<div>
									<div class="col-md-6">
									<div class="input-box m-b-12">
									<div class="">
										<label>Shipping Address Title</label>
										<select name="shipping_id" id="list_shipp" class="ship">
											<option value="0">Pilih Alamat</option>
											<?php foreach ($usershipping as $d_row) { ?>
											<option value="<?php echo $d_row->id?>"><?php echo $d_row->title?></option>
											<?php } ?>
										</select>
									</div>
										</div>
								</div>
								<div class="col-md-6">
									<div class="input-box m-b-6">

										<div class="product-details">
										<button class="" type="button" id="newshipping">Add new Shipping address</button>
										</div>
									</div></div>
									<div class="clearfix"></div>
									</div>

									<div class="hide" id="form-shiiping">
										<div class="col-sm-12">
											<div class="input-box">
												<label>Reciever Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="name_ship" id="name_ship"  value="" />
											</div>
										</div>
									
										<div class="col-sm-12">
											<div class="input-box mt-10">
											<label>Tempat Tujuan <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="tujuan_ship" id="tujuan_ship" placeholder="Apartment, suite, unit etc. (optional)" />
											</div>									
										</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Province <abbr class="required" title="required">*</abbr></label>
										<select name="province_ship" id="province_ship" class="province">
											<option value="0">Pilih Provinsi</option>
											<?php if ($province_list) {
												foreach ($province_list as $data) { ?>
													<option value="<?php echo $data->id_province ?>"><?php echo $data->name ?></option>
												<?php }
											} ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>City <abbr class="required" title="required">*</abbr></label>
										<select name="city_ship" id="city_ship" >
											
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Region <abbr class="required" title="required">*</abbr></label>
										<select name="region_ship" id="region_ship">
											
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Postcode / Zip <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="postcode_ship" id="postcode_ship" placeholder="Postcode / Zip" value=""/>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box m-b-10">
									<label>Shipping Address</label>
										<textarea  name="address_ship" id="address_ship" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
									</div>

								</div>
								<input type="hidden" name="cost" value="" id="cost"/>
								<input type="hidden" value="" name="tot_price" id="tot_price"/>
									</div>
									<div class="clearfix"></div>
								</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 pull-right">
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
											<?php foreach ($get_checkout as $checkout) {  ?>
										<tr class="cart_item">										
											<td class="product-name">
												<?php echo $checkout['name']?> <strong class="product-quantity">× <?php echo $checkout['qty']?></strong>
											</td>
											<td class="product-total"><span class="p-price"><?php echo indonesian_currency($checkout['price'] * $checkout['qty'])?></span></td>										
										</tr>
									<?php }}?>
									</tbody>
									<tfoot>
										<tr class="cart-subtotal">
											<th>Subtotal</th>
											<td><span class="t-price"><?php echo indonesian_currency($this->cart->total()); ?></span></td>
										</tr>
										<tr>
											<th>Discount</th>
											<td>
												<span class="price" id="discount-text">
												<?php if ($this->session->userdata('voucher')) {
													$discount = $this->cart->total() * ($this->session->userdata('voucher')['discount'] / 100);
													echo indonesian_currency($discount);
												}else{
													$discount = 0;
													echo "-";
													} ?>
												</span>
											</td>
										</tr>
										<tr class="">
											<th>Biaya Kirim</th>
											<td>
												<span class="price" id="cost_text">-</span>
											</td>
										</tr>

										<tr class="order-total">
											<th>Total</th>
											<td><strong><span class="t-price" id="tot_price_text"><?php echo indonesian_currency($this->cart->total() - $discount); ?></span></strong> </td>
										</tr>
									</tfoot>
								</table>
								<div class="payment-method">
									<button id="btn-proceed" class="btnb floatright" type="submit" disabled="disabled">Proceed</button>
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