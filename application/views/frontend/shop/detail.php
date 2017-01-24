<?php echo $this->load->view('frontend/sidebar') ?>
<div class="product-details-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5">
					<div class="single-pro-tab">
					  <!-- Tab panes -->
					  <div class="tab-content">
					  <?php $no=0; foreach ($detail->image as $key) {
					  	$no++;
						
						?>
						<div role="tabpanel" class="tab-pane <?php if($no==1){ echo"active"; } ?>" id="home<?php echo $no ?>">
							<img class="zoom_01" src="assets/uploads/product/<?php echo $detail->id ?>/<?php echo $key->photo ?>" data-zoom-image="assets/uploads/product/<?php echo $detail->id ?>/<?php echo $key->photo ?>" alt=""/></div>
						
						<?php } ?>
					  </div>
					 
					  <!-- Nav tabs -->
					  <ul class="pro-show-tab " role="tablist">
					  <?php $no=0; foreach ($detail->image as $key) {
								$no++;
								?>
						<li role="presentation" class="<?php if($no==1) echo"active"; ?>"><a href="#home<?php echo $no ?>" aria-controls="<?php echo $no ?>" role="tab" data-toggle="tab">
							<img src="assets/uploads/product/<?php echo $detail->id ?>/<?php echo $key->photo ?>" alt=""/></a>
						</li>
						<?php } ?>
					  </ul>
					</div>	
				</div>
				<div class=" col-lg-7 col-md-7 col-sm-7">
				<form id="form-product-detail" method="post" action="cart/add_to_cart" enctype="multipart/form-data">
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
						<p class="msg-status red"></p>
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
							<li class="active"><a href="#pro-des" data-toggle="tab">The same products</a></li>
							
<!--							<li><a href="#tag" data-toggle="tab">Tags</a></li>-->
<!--							<li><a href="#cus-tab" data-toggle="tab">Custom Tab</a></li>-->
						</ul>							
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active m-mb" id="pro-des">
								 <?php foreach ($product as $d_row) {
//                                                $id = $d_row->id;
//                                                $name = $d_row->name_product;
//                                                $price = $d_row->price;

                                                ?>
                                            <div class="col-lg-3 col-md-3 col-sm-4">
                                                <div class="single-product2">
                                                    <div class="product-pic">
                                                        <a href="shop/detail/<?php echo $d_row->id?>">
                                                            <img src="assets/uploads/product/<?php echo $d_row->id ?>/<?php echo $d_row->image?>" alt="" />
                                                            <img class="secondary-img" src="assets/uploads/product/<?php echo $d_row->id?>/<?php echo $d_row->image?>" alt="" />
                                                        </a>
                                                        <div class="pro-cart-bottom">
                                                            <a type="button" data-target-id="<?php echo $d_row->id ?>" data-toggle="modal" class="btn-quick-view"  data-target="#shopModal" title="Quick View" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                                            <!-- <a data-toggle="tooltip" title="Add to Compare" href="#"><i class="fa fa-exchange"></i></a> -->
                                                            <input type="hidden" value="<?php echo $this->session->userdata('id') ?>" name="session_id" id="session_id" />
                                                            <?php if($this->session->userdata('validated')) { ?>
                                                            <a data-toggle="tooltip" title="Add to Wishlist" href="wishlist/wishlist_add/<?php echo $this->session->userdata('id') ?>/<?php echo $d_row->id?>" class="whishlist-true"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                            <?php }else{ ?>
                                                            <a type="button"  data-toggle="modal" data-target="#myModal"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            
                                                            <!--class="whishlist-true"-->
                                                        </div>

                                                    </div>
                                                    <div class="product-details">
<!--                                                        --><?php
//                                                        echo form_open('shop/addToCart');
//                                                        echo form_hidden('id', $id);
//                                                        echo form_hidden('name', $name);
//                                                        echo form_hidden('price', $price);
//                                                        ?>
                                                        <h3><a href="shop/detail/<?php echo $d_row->id?>"><?php echo $d_row->name_product?></a></h3>
<!--                                                        --><?php
//                                                        $btn = array(
//                                                            'class' => 'fa fa-shopping-cart',
//                                                            'value' => 'add to cart',
//                                                            'name' => 'action'
//                                                        );
//
//                                                        // Submit Button.
//                                                        echo form_submit($btn);
//                                                        echo form_close();
//                                                        ?><!-- 
                                                        <a href="shop/addToCart/<?php echo $d_row->id ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> -->
                                                        <div class="price-star">
                                                            
                                                            <div class="price">
                                                            <?php if($d_row->discount>0){
                                                                ?>
                                                                <span class="discount-price"><?php echo $d_row->price?></span>
                                                                <span><?php echo $d_row->price_disc ?></span>
                                                                <?php }else{ ?>
                                                                <span><?php echo $d_row->price?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>                          
                                                </div>
                                            </div>


                                            <?php } ?>
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