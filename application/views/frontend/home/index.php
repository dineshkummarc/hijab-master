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
      <div class="col-md-6 grid no-padding-left">
        <div class="grid-large" style="background: url('assets/frontend_assets/img/grid1.jpg') center center; background-size: cover">
          <div class="caption-right">
            <div class="caption-grid">top</div>
          </div>
        </div>
      </div>

      <div class="col-md-3 grid no-padding-right">
        <div class="grid-small" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
          <div class="caption-left">
            <div class="caption-grid">accessories</div>
          </div>
        </div>
      </div>

      <div class="col-md-3 grid no-padding-right">
        <div class="grid-small" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
          <div class="caption-left">
            <div class="caption-grid">hijab</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid no-padding-right">
        <div class="grid-small" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
          <div class="caption-right">
            <div class="caption-grid">look book</div>
          </div>
        </div>
      </div>

       <div class="col-md-6 grid no-padding-left">
        <div class="grid-large" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
        </div>
        <div class="caption-grid-bottom">
          <h4><b>The Ultimate Gift Guide</b></h4>
          <a href="#" class="link-shop">shop now</a>
        </div>
      </div>

       <div class="col-md-6 grid no-padding-right">
        <div class="grid-large" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
        </div>
        <div class="caption-grid-bottom">
          <h4><b>Lorem Ipsum Dolor Amet</b></h4>
          <a href="#" class="link-shop">shop now</a>
        </div>
      </div>

       <div class="col-md-6 grid no-padding-left">
        <div class="grid-large" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
        </div>
        <div class="caption-grid-bottom">
          <h4><b>The Ultimate Gift Guide</b></h4>
          <a href="#" class="link-shop">shop now</a>
        </div>
      </div>

       <div class="col-md-6 grid no-padding-right">
        <div class="grid-large" style="background: url('assets/frontend_assets/img/grid1.jpg') center; background-size: cover">
        </div>
        <div class="caption-grid-bottom">
          <h4><b>The Ultimate Gift Guide</b></h4>
          <a href="#" class="link-shop">shop now</a>
        </div>
      </div>
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
                            <li role="presentation" class="active"><a href="#<?php echo str_replace(" ","_",$key->name); ?>" aria-controls="<?php echo str_replace(" ","_",$key->name); ?>" role="tab" data-toggle="tab"><?php echo $key->name ?></a></li>
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
                                    <div class="product-carousel" id="featured-product">
                                    <?php foreach ($key->product as $prod) {
                                    ?>
                                        <div class="col-lg-12 col-xs-12 col-sm-12">
                                            <div class="single-product">
                                                <div class="product-pic">
                                                    <a href="#">
                                                        <img src="assets/uploads/product/<?php echo $prod->id ?>/<?php echo $key->image ?>" alt="" />
                                                    </a>
                                                    <div class="pro-cart-bottom">
                                                        <a data-toggle="tooltip" title="Quick View" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
<!--                                                        <!--                                                        <a data-toggle="tooltip" title="Add to Compare" href="#"><i class="fa fa-exchange"></i></a>-->
                                                        <a data-toggle="tooltip" title="Add to Wishlist" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                    <h3><a href="#"><?php echo $prod->name_product ?></a></h3>
                                                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                                    <div class="price-star">
                                                        <div class="rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
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