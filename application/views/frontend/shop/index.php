<?php $this->load->view('frontend/sidebar') ?>
    <div class="fashion-area">
        <div class="container">
            <div class="row">
            <?php $this->load->view('frontend/shop/sidebar') ?>
                <div class="col-lg-9 col-md-9 col-sm-12" id="row_product">
                    <div class="fashion-tab-area">
                        <div class="page-title">
                            <h4>Fashion</h4>
                        </div>
                        <div class="toolbar-category">
                            <div class="topbar-category">
                                
                                <div class="sort-by hidden-xs">
                                    <label>Sort by</label>
                                    <select id="sort-by">
                                        <!-- <option value="#" selected>Position</option> -->
                                        <option value="">-</option>
                                        <option value="name_product">Name</option>
                                        <option value="price">Price</option>
                                    </select>
                                    <span><a href="#" title="Set Descending Direction"><i class="fa fa-long-arrow-down"></i></a></span>
                                </div>                                                                                              
                                <div class="show hidden-xs">
                                    <label>Show</label>
                                    <select id="show-per-page">
                                        <option value="9" selected>9</option>
                                        <option value="12">12</option>
                                        <option value="15">15</option>
                                    </select>
                                </div>
                                <div class="pager-item-right">
                                    <div class="item-right">
                                        <?php echo $links ?>
                                    </div>
                                    <p class="amount item-right  hidden-xs">Items <?php echo $start_items ?> to <?php echo $to_items ?> of <?php echo $total_items ?> total</p>
                                </div>
                            </div>
                            </div>
                            <div class="tab-content no-margin">
                                <!-- gried-view -->
                                <div class="brand-header"></div>
                                <div role="tabpanel" class="tab-pane active" id="gried_view">

                                    <div class="fashion-grid-view">

                                        <div class="row" id="">
                                            <?php foreach ($product->result() as $d_row) { ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
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


                    <div class="topbar-category">
                        <div class="sort-by  hidden-xs">
                            <label>Sort by</label>
                            <select id="sort-by-bot">
                                <option value="">-</option>
                                <option value="name_product">Name</option>
                                <option value="price">Price</option>
                            </select>
                            <span><a href="#" title="Set Descending Direction"><i class="fa fa-long-arrow-down"></i></a></span>
                        </div>                                                                                              
                        <div class="show hidden-xs">
                            <label>Show</label>
                            <select id="show-per-page-bot">
                                <option value="9" selected>9</option>
                                <option value="12">12</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="pager-item-right">
                            <div class="item-right">
                                <?php echo $links ?>
                            </div>
                            <p class="amount item-right  hidden-xs">Items <?php echo $start_items ?> to <?php echo $to_items ?> of <?php echo $total_items ?> total</p>
                        </div>
                    </div>                         
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>                              
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<div id="shopModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
     
        <div class="modal-content" id="shop-detail">

                <a  type="button" class="btn btn-default"  href="login" >Login / Register</a>
            </div>
        </div>
                </div>
            </div>

    </div>
