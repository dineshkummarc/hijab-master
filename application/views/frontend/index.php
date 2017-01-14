<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
       	<title><?php echo $controller_name ?> - HijabDept</title>
        <base href="<?php echo base_url() ?>">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="assets/uploads/app_settings/<?php echo $app_favicon_logo; ?>">
        <!-- Place favicon.ico in the root directory -->


        <!-- all css here -->
        <!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/font-awesome.min.css">		
        <!-- animate.css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/animate.css">			
        <!--normalizecss -->
        <link rel="stylesheet" href="assets/frontend_assets/css/normalize.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/owl.carousel.css">
        <!-- owl.theme css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/owl.theme.css">
        <!-- owl.transitions css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/owl.transitions.css">
        <!-- jquery-ui.min.css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/jquery-ui.css">		
        <!-- main css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/main.css">		
        <link rel="stylesheet" href="assets/frontend_assets/css/meanmenu.min.css">		
        <!-- nivo-slider -->
        <link rel="stylesheet" href="assets/frontend_assets/css/default.css">			
        <link rel="stylesheet" href="assets/frontend_assets/css/nivo-slider.css">		
        <!-- style css -->
        <link rel="stylesheet" href="assets/frontend_assets/css/style.css">
        <link rel="stylesheet" href="assets/frontend_assets/css/responsive.css">
        <link rel="stylesheet" href="assets/frontend_assets/css/hijab.css">
        <!-- modernizr css -->
        <script src="assets/frontend_assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <header class="home-2">
            <!-- header-top-area start -->
            <div class="header-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="header-left">
                                <!--							<div class="header-language">-->
                                <!--								<h3>English</h3>-->
                                <!--								<ul>-->
                                <!--									<li><a href="#">English</a></li>-->
                                <!--									<li class="active" ><a href="#">French</a></li>-->
                                <!--									<li><a href="#">Jerman</a></li>-->
                                <!--									<li><a href="#">Italian</a></li>-->
                                <!--									<li><a href="#">Spanish</a></li>-->
                                <!--									<li><a href="#">Polish</a></li>-->
                                <!--									<li><a href="#">Russian</a></li>-->
                                <!--									<li><a href="#">American</a></li>-->
                                <!--									<li><a href="#">Aribian</a></li>-->
                                <!--								</ul>-->
                                <!--							</div>-->
                                <!--							<div class="header-doller hidden-xs">-->
                                <!--								<h4>$ USD</h4>-->
                                <!--								<ul>-->
                                <!--									<li><a href="#">€ EUR</a></li>	-->
                                <!--									<li class="active" ><a href="#">$ USD</a></li>			-->
                                <!--								</ul>-->
                                <!--							</div>-->
                                <div class="header-account hidden-xs">
                                    <h3>My Account</h3>
                                    <ul>
                                        <?php if ($this->session->userdata('member')['validated']) { ?>
                                            <ul>
                                                <li><a href="dashboard">Hello, <?php echo $this->session->userdata('member')['nama_depan']; ?></a></li>
                                                <li><a href="#" >Profile</a></li>
                                                <li><a href="#" >Order History</a></li>
                                                <li><a href="#" >Change Password</a></li>
                                                <li><a href="wishlist">My Wishlist</a></li>
                                                <li><a href="cart">My Cart</a></li>
                                                <li><a href="cart/checkout">Checkout</a></li>
                                                <li><a href="login/logout">Logout</a></li>
                                            </ul>
                                        <?php } else { ?>
                                            <!--							<li><a href="cart">My Cart</a></li>-->
                                            <!--									<li><a href="cart">Cart </a></li>-->
                                            <li><a href="login">Login</a></li>
                                        <?php } ?>

                                    </ul>							
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="header-last">
                                <!--							<div class="header-right hidden-xs">-->
                                <!--								<a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>-->
                                <!--								<span>0</span>-->
                                <!--							</div>-->
                                <div class="header-last">
<!--							<div class="header-right hidden-xs">-->
<!--								<a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>-->
<!--								<span>0</span>-->
<!--							</div>-->
							<div class="my-cart">

								<a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
								<span><?php echo $this->cart->total_items(); ?></span>
								<?php $get_cart = $this->cart->contents();
//								var_dump($get_cart);
								?>
								<a class="cart" href="#">My Cart <span><?php echo indonesian_currency($this->cart->total()); ?></span></a>
								<ul>
									<?php if(!empty($get_cart)){

										?>
									<li>
										<h3><?php echo $this->cart->total_items(); ?> items in the shopping bag.</h3>
									</li>
										<?php foreach ($get_cart as $d_row){
												if($this->session->userdata('member')['id'] == $d_row['customer_id']){
												?>
									<li>
										<div class="cart-img">
											<a href="#"><img src="assets/uploads/product/<?php echo $d_row['product_id'] ?>/<?php echo $d_row['pict'] ?>" alt="" /></a>
										</div>
										<div class="cart-info">
											<h5><a href="#"><?php echo $d_row['name'] ?></a></h5>
											<span><strong><?php echo $d_row['qty'] ?></strong> x <?php echo indonesian_currency( $d_row['price']) ?></span>
										</div>
										<div class="del-icon">
											<a class="fa fa-trash-o" aria-hidden="true" href="shop/updateToCart/<?php echo $d_row['rowid'] ?>"></a>
										
										</div>
									</li>
									<?php }}} ?>
									<li>
										<div class="cart-total">
											<h4>Cart Subtotal: <span><?php echo indonesian_currency($this->cart->total()); ?></span></h4>
										</div>
										<div class="checkout">
											<a class="" style="width: 100%" href="cart">view cart</a>
										</div>
									</li>
								</ul>
							</div>
						</div>				
                            <div class="header-search hidden-xs hidden-sm">
                                <form action="#">
                                    <input type="text" placeholder="" value="Search entire store here" 
                                           onblur="if (this.value == '') {
                                                       this.value = 'Search entire store here';
                                                   }" 
                                           onfocus="if (this.value == 'Search entire store here') {
                                                       this.value = '';
                                                   }"/>
                                    <button type="submit"><i class="fa fa-search"></i></button>							
                                </form>
                            </div>					
                        </div>
                    </div>
                </div>
            </div>
            <!-- 	header-top-area end -->
            <!-- header-bottom-area start -->
            <div class="header-bottom-area hidden-xs hidden-sm" id="sticker">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-2">
                            <div class="logo">
                                <a href="#"><img src="assets/frontend_assets/img/logo.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-10">
                            <div class="menu-list">
                                <nav>
                                    <ul>
                                        <li><a href="<?php echo base_url() ?>">home</a>

                                        </li>
                                        <li><a href="about"> about us</a>
                                        </li>
                                        <li><a href="shop">shop</a></li>	
                                        <li><a href="contact">Contact</a></li>									
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile-menu-area start-->
        <div class="mobile-menu-area visible-xs visible-sm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul>
                                    <li><a href="<?php echo base_url() ?>">home</a>

                                    </li>
                                    <li><a href="about"> about us</a>
                                    </li>
                                    <li><a href="shop">shop</a></li>	
                                    <li><a href="contact">Contact</a></li>								
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please Register/Login to continue</h4>
                    </div>
                    <!--					<div class="modal-body">-->
                    <!--						<p>Some text in the modal.</p>-->
                    <!--					</div>-->
                    <div class="modal-footer">
                        <a  type="button" class="btn btn-default"  href="login" >Login / Register</a>
                    </div>
                </div>

            </div>
        </div>
        <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
<?php echo $content ?>

        <!--footer-->
        <footer>	
            <div class="footer-top-area home-2">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="top-border">
                                <div class="shipping-icon">
                                    <span><i class="fa fa-venus-double" aria-hidden="true"></i></span>
                                </div>
                                <div class="free-shipping">
                                    <div class="shipping">
                                        <h4>Free Shipping Worldwide</h4>
                                    </div>
                                </div>								
                            </div>
                            <div class="top-border">
                                <div class="shipping-icon">
                                    <span><i class="fa fa-support" aria-hidden="true"></i></span>
                                </div>
                                <div class="free-shipping">
                                    <div class="shipping">
                                        <h4>24/7 Customer Support</h4>
                                    </div>
                                </div>								
                            </div>
                            <div class="top-border">
                                <div class="shipping-icon">
                                    <span><i class="fa fa-dollar" aria-hidden="true"></i></span>
                                </div>
                                <div class="free-shipping">
                                    <div class="shipping">
                                        <h4>Resturns And Exchanges</h4>
                                    </div>
                                </div>								
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-4">
                            <div class="info">
                                <h4>Contact-Info</h4>
                            </div>
                            <div class="contact-info">
                                <div class="info-first">
                                    <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                </div>
                                <div class="info-d">
                                    <h5><?php echo $address->content ?> </h5>
                                    <h5></h5>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="info-first">
                                    <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                                </div>
                                <div class="info-d">
                                    <h5>Phone: <?php echo $phone->content ?></h5>
                                    <h5>Fax: <?php echo $fax->content ?></h5>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="info-first">
                                    <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                                <div class="info-d">
                                    <h5>Email: <a href="#">bootexperts@gmail.com</a> </h5>
                                    <h5>Website: <a href="#">www.bootexperts.com</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-3">
                            <div class="info">
                                <h4>Information</h4>
                            </div>
                            <div class="information">
                                <ul>
                                    <li><a href="about">About us</a></li>
                                    <li><a href="customer_service">Customer Service</a></li>
                                    <li><a href="privacy">Privacy Policy</a></li>
                                    <li><a href="terms">Terms & Conditions</a></li>
                                    <li><a href="contact">Contact us</a></li>
                                </ul>
                            </div>	
                        </div>
                        <div class="col-lg-2 col-xs-12 col-sm-12 col-md-2">
                            <div class="info">
                                <h4>Help</h4>
                            </div>
                            <div class="information">
                                <ul>
                                    <li><a href="order_returns">Orders & Returns</a></li>
                                    <li><a href="faq">Faq</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-3">
                            <div class="info">
                                <h4>Social Media</h4>
                            </div>	
                            <div class="card">
                                <ul>
                                    <li><a href="#"><img src="assets/frontend_assets/img/card/facebook.png" alt="Facebook" /></a></li>
                                    <li><a href="#"><img src="assets/frontend_assets/img/card/instagram.png" alt="Instagram" /></a></li>
                                    <li><a href="#"><img src="assets/frontend_assets/img/card/twitter.png" alt="Twitter" /></a></li>
                                </ul>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-last home-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="copyright">
                                &copy; 2017 HIJAB DEPT. All Right Reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>	



        <!-- vendor jquery-1.12.4.min.js -->
        <script src="assets/frontend_assets/js/vendor/jquery-1.12.4.min.js"></script>
        <!-- bootstrap.min.js -->
        <script src="assets/frontend_assets/js/bootstrap.min.js"></script>
        <!-- wow.min.js -->
        <script src="assets/frontend_assets/js/wow.min.js"></script>
        <!-- owl.carousel.min.js -->
        <script src="assets/frontend_assets/js/owl.carousel.min.js"></script>
        <!-- jquery.nivo.slider.pack.js -->
        <script src="assets/frontend_assets/js/jquery.nivo.slider.pack.js"></script>
        <!-- jquery-ui.min.js -->
        <script src="assets/frontend_assets/js/jquery-ui.min.js"></script>	
        <!-- jquery-meanmenujs -->
        <script src="assets/frontend_assets/js/jquery.meanmenu.js"></script>		
        <!-- elevatezoom js -->		
        <script src="assets/frontend_assets/js/jquery.elevateZoom-3.0.8.min.js"></script>
        <!-- waypoints js -->
        <script src="assets/frontend_assets/js/jquery.waypoints.min.js"></script>		
        <!-- jquery.scrollUp.js -->
        <script src="assets/frontend_assets/js/jquery.scrollUp.js"></script>
        <!-- plugins.js -->
        <script src="assets/frontend_assets/js/plugins.js"></script>
        <!-- main.js -->
        <script src="assets/frontend_assets/js/main.js"></script>
        <script src="assets/frontend_assets/page/dashboard/address.js"></script>
        <script src="assets/frontend_assets/page/shop/shop.js"></script>
    </body>
</html>	 