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
							<form action="shop/process_checkout" class="biling-info">
								<div class="col-sm-12">
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
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>First Name <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="firstname" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Last Name <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="lastname" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Company Name <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="companyname" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box m-b-10">
										<label>Address <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="address" placeholder="Street address" />
									</div>
									<div class="input-box">
										<input type="text" name="address" placeholder="Apartment, suite, unit etc. (optional)" />
									</div>									
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Town / City <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Town" placeholder="Town / City" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>District <abbr class="required" title="required">*</abbr></label>
										<select name="country2" id="country2">
											<option value="">Select an option...</option>
											<option value="Bagerhat">Bagerhat</option>
											<option value="Bandarban">Bandarban</option>
											<option value="Barguna">Barguna</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Postcode / Zip <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Postcode" placeholder="Postcode / Zip" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Email Address <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Email" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-box">
										<label>Phone <abbr class="required" title="required">*</abbr></label>
										<input type="text" name="Phone " placeholder="Phone" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">										
										<input type="checkbox" class="showaccount"/>
										 <label class="inline">&nbsp;  Create an account?</label>
									</div>
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
									<h3 class="h3-18">Ship to a different address? <input type="checkbox" value ="" class="showship"/></h3>
									</div>
									<div class="ship-box-hide">
										<div class="col-sm-12">
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
										</div>
										<div class="col-sm-6">
											<div class="input-box">
												<label>First Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="firstname" />
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-box">
												<label>Last Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="lastname" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>Company Name <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="companyname" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>Address <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="address" placeholder="Street address" />
											</div>
											<div class="input-box mt-10">
												<input type="text" name="address" placeholder="Apartment, suite, unit etc. (optional)" />
											</div>									
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>Town / City <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="Town" placeholder="Town / City" />
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-box">
												<label>District <abbr class="required" title="required">*</abbr></label>
												<select name="country1" id="country1">
													<option value="">Select an option...</option>
													<option value="Bagerhat">Bagerhat</option>
													<option value="Bandarban">Bandarban</option>
													<option value="Barguna">Barguna</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-box">
												<label>Postcode / Zip <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="Postcode" placeholder="Postcode / Zip" />
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="input-box">
											<label>Order Notes</label>
											<textarea name="note" id="note" cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
										<tr class="cart_item">
											<td class="product-name">
												Long Dress To Evening&nbsp; <strong class="product-quantity">× 1</strong>
											</td>
											<td class="product-total"><span class="p-price">£85.00</span></td>
										</tr>
									</tbody>
									<tfoot>
										<tr class="cart-subtotal">
											<th>Subtotal</th>
											<td><span class="t-price">£85.00</span></td>
										</tr>
										<tr class="shipping">
											<th>Shipping</th>
											<td>Free Shipping<input name="shipping_method[0]" data-index="0" id="shipping_method_0" value="free_shipping" class="shipping_method" type="hidden">
											</td>
										</tr>
										<tr class="order-total">
											<th>Total</th>
											<td><strong><span class="t-price">£85.00</span></strong> </td>
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
									<button class="btnb floatright" type="submit">Process Payment </button>
								</div>
							</div>
						</div>
						</form>
						<!-- order view end-->
					</div>
				</div>
				<!-- billing details end -->
			</div>
		</div>