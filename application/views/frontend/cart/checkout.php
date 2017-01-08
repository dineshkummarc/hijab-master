<?php echo $this->load->view('frontend/sidebar') ?>
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
					
					</div>
				</div>
				
				<div class="billing-details">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h3 class="h3-18">Billing Details</h3>
							<form action="cart/submit_order" method="post" class="biling-info">
								
								<div class="col-sm-6">
									<div class="input-box">
										<label>First Name <abbr class="required" title="required">*</abbr></label>
										<input readonly type="text" name="firstname" value="<?php echo $user->nama_depan?>"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Last Name <abbr class="required" title="required">*</abbr></label>
										<input readonly type="text" name="lastname" value="<?php echo $user->nama_belakang?>"/>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="input-box m-b-10">
										<label>Address <abbr class="required" title="required">*</abbr></label>
										<textarea readonly name="note" id="note" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."><?php echo $useraddress->address?></textarea>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Provice <abbr class="required" title="required">*</abbr></label>
										<select name="province">
											
											<option value="<?php echo $useraddress->province->id ?>"><?php echo $useraddress->province->name ?></option>
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
										<input  readonlytype="text" name="Postcode" placeholder="Postcode / Zip" value="<?php echo $useraddress->postal_code?>"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Email Address <abbr class="required" title="required">*</abbr></label>
										<input readonly type="email" name="Email" value="<?php echo $user->email?>" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Phone <abbr class="required" title="required">*</abbr></label>
										<input readonly type="text" name="Phone " placeholder="Phone" value="<?php echo $useraddress->phone?>"/>
									</div>
								</div>
								<div class="col-sm-12">
									
									<div class="input-box m-b-10">
										<label>Billing Address<abbr class="required" title="required">*</abbr></label>
										<textarea readonly name="billing-address" id="address" cols="5" rows="2" placeholder=""><?php  echo $useraddress->address ?></textarea>
									</div>

								</div>
						</div>

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
										<select required name="shipping_id" id="list_shipp" class="ship">
										<option value="">Choose Adress</option>
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
												<input readonly type="text" name="name_ship" id="name_ship"  value="" />
											</div>
										</div>
									
										<div class="col-sm-12">
											<div class="input-box mt-10">
											<label>Tempat Tujuan <abbr class="required" title="required">*</abbr></label>
												<input readonly type="text" name="tujuan_ship" id="tujuan_ship" placeholder="Apartment, suite, unit etc. (optional)" />
											</div>									
										</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Province <abbr class="required" title="required">*</abbr></label>
										<select name="province_ship" id="province_ship" class="province">
											
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
										<input  readonly type="text" name="postcode_ship" id="postcode_ship" placeholder="Postcode / Zip" value=""/>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box m-b-10">
									<label>Shipping Address</label>
										<textarea readonly name="address_ship" id="address_ship" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
										
										<tr class="">
											<th>Biaya Kirim</th>
											<td>
												<span class="price" id="cost_text">-</span>
											</td>
										</tr>
										<tr class="order-total">
											<th>Total</th>
											<td><strong><span class="t-price" id="tot_price_text"><?php echo indonesian_currency($this->cart->total()); ?></span></strong> </td>
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