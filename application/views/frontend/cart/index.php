<?php echo $this->load->view('frontend/sidebar.php') ?>

	<div class="shopping-area label-down">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="content-box-heading">
						<h5>Shopping Cart</h5>
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-content">
						<form action="#">
							<div class="table-content table-responsive">
								<table>
									<thead>
										<tr>
											<th class="product-Item">ITEM</th>
											<th class="product-name">PRODUCT NAME</th>
											<th class="product-price">UNIT PRICE</th>
											<th class="product-quantity">QUANTITY</th>
											<th class="product-subtotal">SUB TOTAL</th>
										</tr>										
									</thead>
									<tbody>
										<tr>
										<?php $get_cart = $this->cart->contents(); ?>
										<?php if (!empty($get_cart)) { ?>
											<?php foreach ($get_cart as $d_row) {
												if ($this->session->userdata('id') == $d_row['customer_id']) { ?>
											<td class="product-Item">
												<a href="#">
													<img src="assets/frontend_assets/img/topsell/2.jpg" alt="" title="Simple Product With Their Price" />
												</a>												
											</td>										
											<td class="product-name">
												<h3><a href="#"><?php echo $d_row['name']?> </a></h3>
												<div class="price-star">
													<div class="rating">
														<h4>Color <span>Red</span></h4>
													</div>
													<div class="rating">
														<h4>Size <span>Medium</span></h4>
													</div>
												</div>											
											</td>
											<td class="product-price">
												<h4><?php echo indonesian_currency($d_row['price'])?></h4>							
											</td>
											<td class="product-quantity">
												<div class="quantity cart-plus-minus">
													<input class="text" type="text" name="qty[]" value="<?php echo $d_row['qty']?>">
												</div>												
											</td>
											<td class="product-subtotal">
												<h4><?php echo indonesian_currency($d_row['price'] * $d_row['qty'])?></h4>
												<div class="sub-icon">
													<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<a class="trash" href="shop/updateToCart/<?php echo $d_row['rowid'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</div>												
											</td>
										</tr>
										<?php }}}?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="shopping-link">
						<div class="continue-shp">
							<a href="#">continue shopping</a>
						</div>
						<div class="continue-shp update-cart">

							<a href="cart/updateAllCart">update shopping cart</a>

						</div>
						<div class="continue-shp clear-cart">
							<a href="cart/clearAllCart">clear shopping cart</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-collaterals -->
	<div class="cart-collaterals">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="shipping-tax">
						<div class="content-title min">
							<h4>Estimate Shipping and Tax</h4>
						</div>
						<label>Enter your destination to get a shipping estimate.</label>
						<form action="#">
							<div class="shipping-form">						
								<div class="input-box">
									<h4>country <span>*</span></h4>							
									<select>
										<option value="#" selected>United States</option>
										<option value="#">Afghanistan</option>
										<option value="#">Aland Islands</option>
										<option value="#">Albania</option>
										<option value="#">Algeria</option>
										<option value="#">American Samoa</option>
										<option value="#">Andorra</option>
										<option value="#">Angola</option>
										<option value="#">Anguilla</option>
										<option value="#">Antarctica</option>
										<option value="#">Antigua and Barbuda</option>
										<option value="#">Argentina</option>
										<option value="#">Armenia</option>
										<option value="#">Aruba</option>
										<option value="#">Australia</option>
										<option value="#">Austria</option>
										<option value="#">Azerbaijan</option>
										<option value="#">Bahamas</option>
										<option value="#">Bahrain</option>
										<option value="#">Bangladesh</option>
										<option value="#">Barbados</option>
										<option value="#">Belarus</option>
										<option value="#">Belgium</option>
										<option value="#">Belize</option>
										<option value="#">Benin</option>
										<option value="#">Bermuda</option>
										<option value="#">Bhutan</option>
										<option value="#">Bolivia</option>
										<option value="#">Bosnia and Herzegovina</option>
										<option value="#">Botswana</option>
										<option value="#">Bouvet Island</option>
										<option value="#">British Indian Ocean Territory</option>
										<option value="#">British Virgin Islands</option>
										<option value="#">Brunei</option>
										<option value="#">Bulgaria</option>
										<option value="#">Burkina Faso</option>
										<option value="#">Burundi</option>
										<option value="#">Cambodia</option>
										<option value="#">Canada</option>
										<option value="#">Cape Verde</option>
										<option value="#">Canada</option>
										<option value="#">Cape Verde</option>
										<option value="#">Cameroon</option>
										<option value="#">Cayman Islands</option>
										<option value="#">Central African Republic</option>
										<option value="#">Chad</option>
										<option value="#">China</option>
										<option value="#">Christmas Island</option>
										<option value="#">Cocos (Keeling) Islands</option>
										<option value="#">Colombia</option>
									</select>								
								</div>
								<div class="input-box">
									<h4>State/Province</h4>
									<div class="input-box">
										<select>
											<option value="#" selected>Please select region, state or province</option>
											<option value="#">California</option>
											<option value="#">Colorado</option>
											<option value="#">Connecticut</option>
											<option value="#">Delaware</option>
											<option value="#">District of Columbia</option>
											<option value="#">Federated States Of Micronesia</option>
											<option value="#">Georgia</option>
											<option value="#">Dhaka</option>
										</select>								
									</div>
								</div>
								<div class="input-box">
									<h4>Zip/Postal Code</h4>
										<input type="text" name="code"/>						
								</div>
							</div>
							<div class="btn-link">
								<a href="#">get a quote</a>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="shipping-tax discount">
						<div class="content-title min">
							<h4>Discount Codes</h4>
						</div>
						<label>Enter your coupon code if you have one.</label>
						<div class="input-box">
							<form action="#">
								<input type="text" name="cupon" />
							</form>							
						</div>
						<div class="btn-link">
							<a href="#">apply coupon</a>
						</div>						
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="shipping-tax grand-total">
						<div class="sub-price">
							<h5>Subtotal</h5>
							<h5 class="right">$720.00</h5>
						</div>
						<div class="sub-price">
							<h4>Grand Total</h4>
							<h4 class="right">$1,536.00</h4>
						</div>
						<div class="check-link">
							<a href="#">proceed to checkout</a>
							<h4>Checkout with Multiple Addresses</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->