	<div class="shopping-area label-down">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="content-box-heading">
						<h5>Wishlist</h5>
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-content">
						<form action="#">
							<div class="table-content table-responsive">
								<table class="wishlist">
									<thead>
										<tr>
											<th class="product-Item">ITEM</th>
											<th class="product-name">PRODUCT NAME</th>
											<th class="product-price">UNIT PRICE</th>
											<th class="product-quantity">STOCK STATUS</th>
											<th class="product-subtotal"></th>
										</tr>										
									</thead>
									<tbody>
										<?php foreach ($wishlist as $data_wish) { ?>
										<tr>
											<td class="product-Item">
												<a href="#">
													<img src="assets/uploads/product/<?php echo $data_wish->image->product_id ?>/<?php echo $data_wish->image->photo ?>" alt="" title="Simple Product With Their Price" />
												</a>												
											</td>										
											<td class="product-name">
												<h3><a href="#"><?php echo $data_wish->product->name_product?> </a></h3>
												<div class="price-star">
													<div class="rating">
														<h4>Color <span>Green</span></h4>
													</div>
													<div class="rating">
														<h4>Size <span>Medium</span></h4>
													</div>
												</div>											
											</td>
											<td class="product-price">
												<h4 class="mbt-30"><?php echo $data_wish->product->price;?></h4>							
											</td>
											<td class="product-quantity">
												<div class="quantity mbt-30">
													In Stock
												</div>												
											</td>
											<td class="product-subtotal">
												<a class="btnb mbt-30" href="shop/addToCart/<?php echo $data_wish->product_id ?>">Add to cart</a>
												<div class="sub-icon">
													<a class="trash" href="wishlist/wishlist_delete/<?php echo $data_wish->id?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</div>												
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="shopping-link">
						<div class="continue-shp">
							<a href="#">continue shopping</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart-collaterals -->
	<div class="devider mt-70">
		<hr />
	</div>	