<?php echo $this->load->view('frontend/sidebar') ?>
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<!-- returning customer start-->
						<!-- <div class="form-box">
							<div class="form-title">
								<img src="assets/frontend_assets/img/icone/chekout-list.png" alt="" />
								Returning customer? <div class="showlogin">Click here to login</div>
							</div>
							<form action="#" class="login">
								<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="input-box">
										<label>Username or email <span class="start-red">*</span></label>
										<input type="text" name="username" />
									</div>
								</div>
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="input-box">
										<label>Password <span class="start-red">*</span></label>
										<input type="password" name="username" />
									</div>
								</div>								
								<div class="col-sm-12">
									<div class="input-box-button mt-10">
										<button class="btnb-l">Login</button>&nbsp;
										<label>
										<input name="rememberme" id="rememberme" value="forever" type="checkbox"> Remember me</label>
										<a href="#">Lost your password?</a>
									</div>								
								</div>								
							</form>
						</div> -->
						<!-- returning customer end-->
						<!-- coupon start-->
						<!-- <div class="form-box">
							<div class="form-title">
								<img src="assets/frontend_assets/img/icone/chekout-list.png" alt="" />
								Have a coupon?  <div class="show-coupon">Click here to enter your code</div>
							</div>
							<form action="#" class="checkout_coupon">
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="input-box">
										<input type="text" name="coupon" placeholder="Coupon code" />
									</div>
								</div>
								<div class="col-md-6 col-md-6 col-xs-12">
									<div class="input-box">
										<button class="btnb-l">Apply Coupon</button>
									</div>
								</div>							
							</form>
						</div> -->						
						<!-- coupon end-->
					</div>
				</div>
				<!-- billing details start -->
				<div class="billing-details">
					<div class="row">
						<!-- billing content start -->
						<div class="col-lg-7 col-md-7 col-sm-7">
							<h3 class="h3-18">Billing Details</h3>
							<form action="shop/process_checkout" method="post" class="biling-info">
								<!-- <div class="col-sm-12">
									<div class="input-box">
										<label>Country  <abbr class="required" title="required">*</abbr></label>
										<select name="country" id="country">
											<option value="Bangladesh">Select Country...</option>
											<option value="Bangladesh">Bangladesh</option>
											<option value="Afghanistan">Afghanistan</option>
											<option value="Albania">Albania</option>
											<option value="Algeria">Algeria</option>
										</select>
									</div>
								</div> -->
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
								<!-- <div class="col-sm-12">
									<div class="input-box">
										<label>Company Name <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="companyname" />
									</div>
								</div> -->
<!--								<div class="col-sm-12">-->
<!--									<div class="input-box">-->
<!--										<label>Company Name <abbr class="required" title="required">*</abbr></label>-->
<!--										<input type="text" name="companyname" />-->
<!--									</div>-->
<!--								</div>-->
								<div class="col-sm-12">
									<div class="input-box m-b-10">
										<label>Address <abbr class="required" title="required">*</abbr></label>
										<textarea name="note" id="note" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."><?php echo $useraddress->address?></textarea>
									</div>
<!--									<div class="input-box">-->
<!--										<label>Tempat Tujuan <abbr class="required" title="required">*</abbr></label>-->
<!--										<input type="text" name="title" value="--><?php //echo $useraddress->title?><!--" />-->
<!--									</div>-->
<!--									<div class="input-box">-->
<!--										<label>Tempat Tujuan <abbr class="required" title="required">*</abbr></label>-->
<!--										<input type="text" name="title" placeholder="Apartment, suite, unit etc. (optional)" value="--><?php //echo $useraddress->title?><!--" />-->
<!--									</div>									-->
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Provice <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="province" value="<?php echo $useraddress->province->name?>" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>City <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="city" value="<?php echo $useraddress->city->name?>" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Region <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="region" value="<?php echo $useraddress->region->name?>" />
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
<!--										<td>-->
										<select name="shipping_id" class="ship">
											<option>-- choose one --</option>
											<?php foreach ($usershipping as $d_row) { ?>
											<option value="<?php echo $d_row->id?>"><?php echo $d_row->title?></option>
											<?php } ?>
										</select>
<!--										</td>-->
									</tr>
										</div>
									<div class="input-box m-b-10">
										<label>Shipping Address<abbr class="required" title="required">*</abbr></label>
										<textarea name="shippingAdress" id="address" cols="5" rows="2" placeholder=""></textarea>
									</div>

								</div>
								<div class="col-sm-12">

<!--									<div class="input-box">										-->
<!--										<input type="checkbox" class="showaccount"/>-->
<!--										 <label class="inline">&nbsp;  Create an account?</label>-->
<!--									</div>-->
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
										<!-- <div class="col-sm-12">
											<div class="input-box">
												<label>Country  <abbr class="required" title="required">*</abbr></label>
												<select name="country3" id="country3">
													<option value="Bangladesh">Select Country...</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Afghanistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
												</select>
											</div>
										</div> -->
<!--										<div class="col-sm-12">-->
<!--											<div class="input-box">-->
<!--												<label>Country  <abbr class="required" title="required">*</abbr></label>-->
<!--												<select name="country3" id="country3">-->
<!--													<option value="Bangladesh">Select Country...</option>-->
<!--													<option value="Bangladesh">Bangladesh</option>-->
<!--													<option value="Afghanistan">Afghanistan</option>-->
<!--													<option value="Albania">Albania</option>-->
<!--													<option value="Algeria">Algeria</option>-->
<!--												</select>-->
<!--											</div>-->
<!--										</div>-->
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
										<!-- <div class="col-sm-12">
											<div class="input-box">
												<label>Company Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="companyname" />
											</div>
										</div> -->
<!--										<div class="col-sm-12">-->
<!--											<div class="input-box">-->
<!--												<label>Company Name <abbr class="required" title="required">*</abbr></label>-->
<!--												<input type="text" name="companyname" />-->
<!--											</div>-->
<!--										</div>-->
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
									<!-- <div class="col-sm-12">
										<div class="input-box">
											<label>Order Notes</label>
											<textarea name="note" id="note" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
										</div>
									</div> -->
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
<!--									<ul>-->
<!--										<li class="payment_method-li">-->
<!--											<input id="payment_method_bacs" class="input-radio" name="payment_method" value="bacs" type="radio">-->
<!--											<label for="payment_method_bacs">Direct Bank Transfer</label>-->
<!--											<div class="pay-box payment_method_bacs">-->
<!--												<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>-->
<!--											</div>-->
<!--										</li>-->
<!--										<li class="payment_method_cheque-li">-->
<!--											<input id="payment_method_cheque" class="input-radio" name="payment_method" value="cheque"  type="radio" checked="checked">-->
<!--											<label for="payment_method_cheque">	Cheque Payment 	</label>-->
<!--											<div class="pay-box payment_method_cheque">-->
<!--												<p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>-->
<!--											</div>-->
<!--										</li>-->
<!--										<li class="payment_method_paypal-li">-->
<!--											<input id="payment_method_paypal" class="input-rado" name="payment_method" value="paypal"  type="radio">-->
<!--											<label for="payment_method_paypal">	PayPal <a href=""><img src="assets/frontend_assets/img/paypal.png" alt=""/>What is PayPal?</a></label>-->
<!--											<div class="pay-box payment_method_paypal">-->
<!--												<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>-->
<!--											</div>-->
<!--										</li>-->
<!--									</ul>-->
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