
<section>
        <!-- slider-area start -->
        <div id="slider" class=" m-t-70">
            <div class="container">
                <div class="row no-hover">
                    <div class="col-sm-12">
                        <div class="slider-carousel green home-2">
                        <?php foreach ($banner as $data) { ?>
                            <div class="slider">
                                <a href="<?php echo $data->link ?>"><img src="assets/uploads/banner/<?php echo $data->id ?>/<?php echo $data->banner ?>" alt="" /></a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>  
                </div>
            </div>  
        </div>

        <section>
  <div class="container">
    <div class="grid-custom">
      <?php $no=1; foreach($category as $data_row) {
        if($no == 1) { ?>
      <div class="col-md-6 grid no-padding-left">
        <div class="grid-large" style="background: url('<?php echo "assets/uploads/category/".$data_row->id."/".$data_row->potrait_image ?>') center center; background-size: cover">
          <div class="caption-right">
            <a href="shop?category=<?php echo $data_row->id ?>"><div class="caption-grid"><?php echo $data_row->name ?></div></a>
          </div>
        </div>
      </div>
      <?php } else if($no == 2) { ?>

      <div class="col-md-3 grid no-padding-right2">
        <div class="grid-small" style="background: url('<?php echo "assets/uploads/category/".$data_row->id."/".$data_row->potrait_image ?>') center; background-size: cover">
          <div class="caption-left">
            <a href="shop?category=<?php echo $data_row->id ?>"><div class="caption-grid"><?php echo $data_row->name ?></div></a>
          </div>
        </div>
      </div>
        <?php } else if($no == 3) { ?>

      <div class="col-md-3 grid no-padding-right3">
        <div class="grid-small" style="background: url('<?php echo "assets/uploads/category/".$data_row->id."/".$data_row->potrait_image ?>') center; background-size: cover">
          <div class="caption-left">
            <a href="shop?category=<?php echo $data_row->id ?>"><div class="caption-grid"><?php echo $data_row->name ?></div></a>
          </div>
        </div>
      </div>
        <?php } else { ?>

      <div class="col-md-6 grid no-padding-right">
        <div class="grid-small" style="background: url('<?php echo "assets/uploads/category/".$data_row->id."/".$data_row->landscape_image ?>') center; background-size: cover">
          <div class="caption-right">
            <a href="shop?category=<?php echo $data_row->id ?>"><div class="caption-grid"><?php echo $data_row->name ?></div></a>
          </div>
        </div>
      </div>
        <?php }$no++;} ?>
       <?php
        $no=0; foreach($editor_pick as $data_row) { 
        $no++; 
        ?>
       <div class="col-md-6 grid <?php if(($no % 2)==0){ echo"no-padding-right"; }else{ echo"no-padding-left";} ?>">
        <div class="grid-large" style="background: url('<?php echo "assets/uploads/editor_picks/".$data_row->id."/".$data_row->image ?>') center; background-size: cover">
        </div>
        <div class="caption-grid-bottom">
          <h4><b><?php echo $data_row->name ?></b></h4>
          <a href="shop?editorspicks=<?php echo $data_row->id ?>" class="link-shop">shop now</a>
        </div>
      </div>
       <?php } ?>
    </div>
  </div>
</section>
        <div class="tab-area home-2 p-t-70">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="feature-tab-area">
                        <!-- Nav tabs -->
                        <ul class="features-nav" role="tablist">
                           <?php foreach ($r_product as $key) {
                           ?>
                            <li role="presentation"><a href="shop?group=<?php echo $key->id ?>"><?php echo $key->name ?></a></li>
                            <?php } ?>
                        
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                        <?php
                        $no=0;
                        foreach ($f_product as $key) {
                        $no++;
                        ?>
                            <div role="tabpanel" class="tab-pane <?php  if($no==1) echo"active";?> " id="<?php echo str_replace(" ","_",$key->name); ?>">
                                <div class="row">
                                    <div class="product-carousel featured-product" >
                                    <?php foreach ($key->product as $prod) {
                                    ?>
                                        <div class="col-lg-12 col-xs-12 col-sm-12">
                                            <div class="single-product">
                                                <div class="product-pic">
                                                    <a href="shop/detail/<?php echo $prod->id ?>">
                                                        <img src="assets/uploads/product/<?php echo $prod->id ?>/<?php echo $prod->image ?>" alt="" />
                                                    </a>
                                                    <div class="pro-cart-bottom">
<!--                                                        <a data-toggle="tooltip" title="Quick View" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>-->
<!--                                                        <!--                                                        <a data-toggle="tooltip" title="Add to Compare" href="#"><i class="fa fa-exchange"></i></a>-->
                                                        <a type="button" data-target-user="<?php echo $this->session->userdata('id') ?>" data-target-id="<?php echo $prod->id ?>" data-toggle="modal" class="btn-quick-view"  data-target="#shopModal" title="Quick View" ><i class="fa fa-search" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" title="Add to Wishlist" data-id="<?php echo $prod->id ?>" data-user="<?php  echo $this->session->userdata('id') ?>" class="btn-add-wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                       
<!--                                                        <a data-toggle="tooltip" title="Add to Wishlist" href="shop/addToWishList(--><?php //$prod->id ?><!--)"><i class="fa fa-heart" aria-hidden="true"></i></a>-->
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                    <h3><a href="shop/detail/<?php echo $prod->id ?>"><?php echo $prod->name_product ?></a></h3>
<!--                                                    <a href="shop/detail/--><?php //echo $prod->id ?><!--"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>-->
                                                    <div class="price-star">
<!--                                                        <div class="rating">-->
<!--                                                            <i class="fa fa-star"></i>-->
<!--                                                            <i class="fa fa-star"></i>-->
<!--                                                            <i class="fa fa-star"></i>-->
<!--                                                            <i class="fa fa-star"></i>-->
<!--                                                            <i class="fa fa-star"></i>-->
<!--                                                        </div>-->
                                                        <div class="price">
                                                            <span><?php echo  idr($prod->price) ?></span>                                                            
                                                        </div>
                                                    </div>
                                                </div>                          
                                            </div>
                                        </div> 
                                        <?php } ?>
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
    
    </section>

<div id="shopModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">

                <div class="modal-content" id="shop-detail">

                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal-wish fade" id="modal" role="dialog">
    <div class="modal-dialog-wish">
        <div class="modal-content-wish">
            <div class="modal-header-wish">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal add</h4>
            </div>
        </div>
    </div>
</div>


