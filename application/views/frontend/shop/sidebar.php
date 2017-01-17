                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="panel">
                                <div id="headingNine" role="tab" class="panel-heading">
                                  <h4 class="panel-title">
                                    <a aria-controls="collapseNine" aria-expanded="true" href="#collapseNine" data-parent="#accordion" data-toggle="collapse" role="button" class="border">
                                        Search Items                                          
                                        <span class="counter"><i class="fa fa-list-ol"></i></span>                      
                                        <span class="opener"></span>                                        
                                    </a>
                                  </h4>
                                </div>
                                <div aria-labelledby="headingNine" role="tabpanel" class="panel-collapse collapse in" id="collapseNine" aria-expanded="true">
                                  <div class="panel-body">
                                  <div class="sidebar-widget">
                        <h4 class="side-title">Categories</h4>  
                        <div class="category-menu-area info-widget">
                            <div class="category-menu" id="cate-toggle">
                                <ul>
                                <?php foreach ($category as $key) {
                                ?>
                                    <li>
                                        <input value="<?php echo $key->id ?>" name="category[]" id="category<?php echo $key->id ?>" class="box" type="checkbox" />
                                        <label for="category<?php echo $key->id ?>"><?php echo $key->name  ?></label>
                                    </li>  
                                    <?php  }?>    
                                </ul>
                            </div>
                        </div>                      
                    </div>
                    <div class="sidebar-widget">
                        <h4 class="side-title">Brand</h4>  
                        <div class="category-menu-area info-widget">
                            <div class="category-menu" id="cate-toggle">
                                <ul>
                                <?php foreach ($brand as $key) {
                                ?>
                                    <li>
                                        <input value="<?php echo $key->id ?>"  name="brand[]" id="brand<?php echo $key->id ?>" class="box" type="checkbox" />
                                        <label for="brand<?php echo $key->id ?>"><?php echo $key->name  ?></label>
                                    </li>  
                                    <?php  }?>    
                                </ul>
                            </div>
                        </div>                      
                    </div>
                    <div class="sidebar-widget shop-filter">
                            <h4 class="side-title">Shop By</h4>
                        <div class="info-widget">
                            <h4>Price</h4>
                            <div class="info_widget">
                                <div class="price_filter">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                    <div class="col-md-12 no-padding">
                                    <input  name="price" type="text" id="amount" placeholder="" />
                                    </div>
                                            <button class="btnb-l box">apply</button>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="content-box">
                            <div class="info-widget">
                                <h4>Color</h4>
                            </div>
                            <div class="view">
                                <ul>
                                    <?php foreach ($color as $key) {
                                ?>
                                    <li>
                                        <input value="<?php echo $key->id ?>" name="color[]" id="color<?php echo $key->id ?>" class="box" type="checkbox" />
                                        <label for="color<?php echo $key->id ?>"><?php echo $key->name  ?></label>
                                        <div style="background: <?php echo $key->kode ?>;" class="color-box"></div>
                                    </li>  
                                    <?php  }?>
                                </ul>
                            </div>
                        </div>
                        <div class="content-box">
                            <div class="info-widget">
                                <h4>Size</h4>
                            </div>
                            <div class="view even">
                                <ul>
                                    <?php foreach ($size as $key) {
                                ?>
                                    <li>
                                        <input  value="<?php echo $key->id ?>" name="size[]" id="size<?php echo $key->id ?>" class="box" type="checkbox" />
                                        <label for="size<?php echo $key->id ?>"><?php echo $key->name  ?></label>
                                    </li>  
                                    <?php  }?>
                                </ul>
                            </div>
                        </div>
                       
                                      
                    </div>
                                  </div>
                                </div>                              
                            </div>
                </div>