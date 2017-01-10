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
						<form action="cart/updateAllCart" method="post">
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
										<?php if (!empty($cart)) { ?>
											<?php $no=0; foreach ($cart as $d_row) {
												$no++;
												if ($this->session->userdata('id') == $d_row['customer_id']) { ?>
											<td class="product-Item">
												<a href="#">
													<img src="assets/uploads/product/<?php echo $d_row['product_id'] ?>/<?php echo $d_row['pict']?>" alt="" title="<?php echo $d_row['name'] ?>" />
												</a>												
											</td>										
											<td class="product-name">
												<h3><a href="#"><?php echo $d_row['name']?> </a></h3>
												<div class="price-star">
													<div class="rating">
														<h4>Color <span><?php echo $d_row['n_color']; ?></span></h4>
													</div>
													<div class="rating">
														<h4>Size <span><?php echo $d_row['n_size']; ?></span></h4>
													</div>
												</div>											
											</td>
											<td class="product-price">
												<h4><?php echo indonesian_currency($d_row['price'])?></h4>							
											</td>
											<td class="product-quantity">
												<div class="quantity cart-plus-minus">
													<input class="text" type="text" name="qty[<?php echo $no ?>]" value="<?php echo $d_row['qty']?>">
												</div>												
											</td>
											<td class="product-subtotal">
												<h4><?php echo indonesian_currency($d_row['price'] * $d_row['qty'])?></h4>
												<div class="sub-icon">
													<a class="trash" href="shop/updateToCart/<?php echo $d_row['rowid'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</div>												
											</td>
										</tr>
										<?php }}}?>
									</tbody>
								</table>
							</div>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="shopping-link">
						<div class="continue-shp">
							<a href="shop">continue shopping</a>
						</div>
						<div class="action continue-shp update-cart">
						<button name="update" class="btn-update">UPDATE SHOPPING CART</button>
							

						</div>
						<div class="continue-shp clear-cart">
							<a href="cart/clearAllCart">clear shopping cart</a>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- cart-collaterals -->
	<div class="cart-collaterals">
		<div class="container">
			<div class="row">
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
				<div class="col-lg-5 col-md-5 col-sm-6 pull-right">
					<div class="shipping-tax grand-total">
						<div class="sub-price">
							<h5>Subtotal</h5>
							<h5 class="right"><?php echo indonesian_currency($this->cart->total()); ?></h5>
						</div>
						<div class="sub-price">
							<h4>Grand Total</h4>
							<h4 class="right"><?php echo indonesian_currency($this->cart->total()); ?></h4>
						</div>
						<div class="check-link">
							<a href="cart/checkout">proceed to checkout</a>
							<h4>Checkout with Multiple Addresses</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->