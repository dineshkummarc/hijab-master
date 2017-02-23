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
									<label>Availability:</label> <span id="availability"><?php echo $detail->stock; ?></span>
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
									<select id="select-color" name="color">
										<?php foreach ($detail->color->result() as $list_color) { ?>
										<option value="<?php echo $list_color->color_id?>"><?php echo $list_color->color->name?></option>
										<?php } ?>
									</select>							
								</div>
								<div class="input-box">
									<h4>Size <span>*</span></h4>
									<div class="input-box">
									
										<select id="select-size" name="size">
										<?php foreach ($detail->size->result() as $list_size) { ?>
											<option value="<?php echo $list_size->size_id;?>"><?php echo $list_size->size->name.' ('.$list_size->stock.' Left)'?></option>
										<?php } ?>
										</select>								
									</div>
									
								</div>				
						</div>

						<div class="actions">
							<div class="plus-minus">
								<div class="quantity detail-plus-minus">
									<input class="text" name="qty" type="text" value="<?php echo $detail->default_qty ?>"/>
								</div>							
							</div>	
							<button type="submit" class="btn btn-add-cart">Add To Cart</button>
							<ul class="add-to-link">
<!--								<li><a data-toggle="tooltip" title="Quick View" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
<!--								<li><a data-toggle="tooltip" title="Add to Compare" href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a></li>-->
								<li></a><?php echo $detail->wishlist_true ?></li>
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
                                                        <h3><a href="shop/detail/<?php echo $d_row->id?>"><?php echo $d_row->name_product?></a></h3>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<div id="wishlist-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p id="wishlist-msg"></p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->