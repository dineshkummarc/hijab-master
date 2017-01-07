<?php echo $this->load->view('frontend/sidebar') ?>
<div class="product-details-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5">
					<div class="single-pro-tab">
					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">
							<?php foreach ($detail->image as $key) {
								?>
								<img class="zoom_01" src="assets/uploads/product/<?php echo $key->product_id ?>/<?php echo $key->photo ?>" data-zoom-image="assets/uploads/product/<?php echo $key->product_id ?>/<?php echo $key->photo ?>" alt=""/></div>
						<?php	} ?>
							
						
					  </div>
					  <!-- Nav tabs -->
					  <ul class="pro-show-tab " role="tablist">
					  <?php foreach ($detail->image as $detail->image) {
								?>
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">
							<img src="assets/uploads/product/<?php echo $detail->image->product_id ?>/<?php echo $detail->image->photo ?>"  alt=""/></a>
						</li>
						<?php } ?>
					  </ul>
					</div>	
				</div>
				<div class=" col-lg-7 col-md-7 col-sm-7">
				<form method="post" action="shop/addToCart" enctype="multipart/form-data">
					<div class="product-details pro-right fashion">
						<h1><?php echo $detail->name_product?></h1>
						<div class="price-star">
							
							<label> Product code : <?php echo $detail->id?> </label>
							<input type="hidden" name="id_product" value="<?php echo $detail->id ?>">
							<div class="price fix">
								<div class="low-price special-price floatleft">
									<h4><span><?php echo $detail->price?></span></h4>
								</div>
								<div class="availability floatright">
									<label>Availability:</label> <span class="stock"><?php echo $detail->stock; ?></span>
								</div>
							</div>
						</div>
						<div class="desc-std p-details">
							<h5><strong>PRODUCT DESCRIPTION</strong></h5>
							<p><?php echo $detail->description?>. 
							
						</div>
						<div class="product-size">
										
								<div class="input-box">
									<h4>Color <span>*</span></h4>							
									<select name="color">
										<?php foreach ($detail->color as $list_color) { ?>
										<option value="<?php echo $list_color->color_id?>" selected><?php echo $list_color->color->name?></option>
										<?php } ?>
									</select>							
								</div>
								<div class="input-box">
									<h4>Size <span>*</span></h4>
									<div class="input-box">
									
										<select name="size">
										<?php foreach ($detail->size as $list_size) { ?>
											<option value="<?php echo $list_size->size_id;?>" selected><?php echo $list_size->size->name?></option>
										<?php } ?>
										</select>								
									</div>
									
								</div>				
						</div>

						<div class="actions">
							<div class="plus-minus">
								<div class="quantity cart-plus-minus">
									<input class="text" name="qty" type="text" value="1"/>
								</div>							
							</div>	
							<button type="submit" class="btn">Add To Cart</button>
							<ul class="add-to-link">
<!--								<li><a data-toggle="tooltip" title="Quick View" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
<!--								<li><a data-toggle="tooltip" title="Add to Compare" href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a></li>-->
								<li><a data-toggle="tooltip" title="Add to Wishlist" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="porduct-decs-tab p-t-70">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="pro-tab-all">
						<ul class="pro-desc-tab-menu">
							<li class="active"><a href="#pro-des" data-toggle="tab">Product Description</a></li>
							<li><a href="#addreviews" data-toggle="tab">Size Chart</a></li>
<!--							<li><a href="#tag" data-toggle="tab">Tags</a></li>-->
<!--							<li><a href="#cus-tab" data-toggle="tab">Custom Tab</a></li>-->
						</ul>							
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active m-mb" id="pro-des">
								<p><?php echo $detail->description?>. </p>
							</div>
							<div role="tabpanel" class="tab-pane" id="addreviews">
								<div class="add-review">
									<h2>Size Chart</h2>
									<form action="#">
<!--										<h3>You're reviewing: <span>Simple Product With Tier Price</span></h3>	-->
<!--										<h4>How do you rate this product? <em class="required">*</em></h4>-->
										<div class="table-responsive">
											<table class="data-table">
												<colgroup><col>
												<col>
												<col>
												<col>
												<col>
												<col>
												</colgroup>
												<thead>
												<tr class="first last">
													<th>&nbsp;</th>
													<?php foreach ($detail->size as $list_size) { ?>
													<th><span class="nobr"></span><?php echo $list_size->size_id?></th>
													<?php } ?>
												</tr>
												</thead>
												<tbody>
													<tr class="first odd">
														<th>Price</th>
														<td class="value"><input name="ratings[3]" id="Price_1" value="11" class="radio" type="radio"></td>
														<td class="value"><input name="ratings[3]" id="Price_2" value="12" class="radio" type="radio"></td>
														<td class="value"><input name="ratings[3]" id="Price_3" value="13" class="radio" type="radio"></td>
														<td class="value"><input name="ratings[3]" id="Price_4" value="14" class="radio" type="radio"></td>
														<td class="value last"><input name="ratings[3]" id="Price_5" value="15" class="radio" type="radio"></td>
													</tr>
													<tr class="even">
														<th>Value</th>
														<td class="value"><input name="ratings[2]" id="Value_1" value="6" class="radio" type="radio"></td>
														<td class="value"><input name="ratings[2]" id="Value_2" value="7" class="radio" type="radio"></td>
														<td class="value"><input name="ratings[2]" id="Value_3" value="8" class="radio" type="radio"></td>
														<td class="value"><input name="ratings[2]" id="Value_4" value="9" class="radio" type="radio"></td>
														<td class="value last"><input name="ratings[2]" id="Value_5" value="10" class="radio" type="radio"></td>
													</tr>
													<tr class="last odd">
														<th>Quality</th>
															<td class="value"><input name="ratings[1]" id="Quality_1" value="1" class="radio" type="radio"></td>
															<td class="value"><input name="ratings[1]" id="Quality_2" value="2" class="radio" type="radio"></td>
															<td class="value"><input name="ratings[1]" id="Quality_3" value="3" class="radio" type="radio"></td>
															<td class="value"><input name="ratings[1]" id="Quality_4" value="4" class="radio" type="radio"></td>
															<td class="value last"><input name="ratings[1]" id="Quality_5" value="5" class="radio" type="radio"></td>
														</tr>
												</tbody>
											</table>
										</div>
<!--										<div class="sub-form m-t-30">-->
<!--											<div class="input-box">-->
<!--												<h4>Nickname <span>*</span></h4>-->
<!--												<input type="text" name="nickname" id="nickname" />-->
<!--											</div>-->
<!--											<div class="input-box">-->
<!--												<h4>Summary of Your Review <span>*</span></h4>-->
<!--												<input type="text" name="summary" id="summary" />-->
<!--											</div>-->
<!--											<div class="input-box">-->
<!--												<h4>Review <span>*</span></h4>-->
<!--												<textarea name="review" id="review" cols="30" rows="10"></textarea>-->
<!--											</div>-->
<!--											<div class="input-box">-->
<!--												<button class="btnb-l">Submit Review</button>-->
<!--											</div>											-->
<!--										</div>-->
									</form>
								</div>
							</div>
<!--							<div role="tabpanel" class="tab-pane" id="tag">-->
<!--								<div class="add-review sub-form m-mb">-->
<!--									<h2>Product Tags</h2>-->
<!--									<form action="#">-->
<!--										<div class="input-box">-->
<!--											<h4>Add Your Tags: </h4>-->
<!--											<input type="text" name="tag" id="tag2" />-->
<!--											<button class="btnb-l ml-10">Add Tag</button>-->
<!--										</div>-->
<!--										<p>Use spaces to separate tags. Use single quotes (') for phrases</p>-->
<!--									</form>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div role="tabpanel" class="tab-pane" id="cus-tab">-->
<!--								<div class="add-review">-->
<!--									<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>-->
<!--									<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>-->
<!--									<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>-->
<!--								</div>-->
<!--							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>