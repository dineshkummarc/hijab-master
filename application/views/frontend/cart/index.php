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
											<?php $no=0; foreach ($cart as $item) {
												$no++;
												$item_option = $this->cart->product_options($item['rowid']); ?>
											<td class="product-Item">
												<a href="#">
													<img src="assets/uploads/product/<?php echo $item_option['product_id'] ?>/<?php echo $item_option['pict'] ?>" alt="" title="<?php echo $item['name'] ?>" />
												</a>												
											</td>										
											<td class="product-name">
												<h3><a href="#"><?php echo $item['name']?> </a></h3>
												<div class="price-star">
													<div class="rating">
														<h4>Color <span><?php echo $item_option['n_color']; ?></span></h4>
													</div>
													<div class="rating">
														<h4>Size <span><?php echo $item_option['n_size']; ?></span></h4>
													</div>
												</div>											
											</td>
											<td class="product-price">
												<h4><?php echo indonesian_currency($item['price'])?></h4>							
											</td>
											<td class="product-quantity">
												<div class="quantity cart-plus-minus">
													<input class="text" type="text" name="qty[<?php echo $no ?>]" data-id="<?php echo $item['rowid'] ?>" value="<?php echo $item['qty']?>">
												</div>												
											</td>
											<td class="product-subtotal">
												<h4><span class="subtotal_<?php echo $item['rowid']?>"><?php echo indonesian_currency($item['price'] * $item['qty'])?></span></h4>
												<div class="sub-icon">
													<a class="trash" href="shop/updateToCart/<?php echo $item['rowid'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</div>												
											</td>
										</tr>
										<?php }}?>
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
						<div class="continue-shp clear-cart">
							<a href="cart/clear_all_cart">clear shopping cart</a>
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
					<div class="shipping-tax discount">
						<form action="cart/apply_voucher" id="form-voucher" method="post" enctype="multipart/form-data">
							<div class="content-title min">
								<h4>Discount Codes</h4>
							</div>
							<label>Enter your coupon code if you have one.</label>
							<div class="input-box">
								<input type="text" name="coupon" />								
							</div>
							<div class="msg-voucher red"></div>
							<div class="btn-link">
								<a class="btn-voucher">apply coupon</button>
							</div>
						</form>						
					</div>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-6 pull-right">
					<div class="shipping-tax">
						<div class="sub-price voucher-price hidden">
							<h4>Discount Voucher <span class="disc-percentage"></span></h4>
							<h4 class="right"><span class="disc-total"></span></h4>
						</div>
						<div class="sub-price">
							<h4>Grand Total</h4>
							<h4 class="right"><span class="grand-total"><?php echo indonesian_currency($this->cart->total()); ?></span></h4>
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