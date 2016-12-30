<?php echo $this->load->view('frontend/sidebar') ?>
<div class="faq-area my-account">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="faq-title">
						<h4>Procced to Checkout</h4>
					</div>
					<p class="my-title">Welcome to your account. Here you can manage all of your personal information and orders.</p>				
				</div>
				<div class="col-lg-6 col-xs-12 col-sm-6">
					<div class="faq-accordion account-top">
						<div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
							<div class="panel">
								<div id="headingOne" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a aria-controls="collapseOne" aria-expanded="false" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
									   Add my first address 									
										<span class="counter"><i class="fa fa-building"></i></span>	
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>
								<div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="collapseOne" aria-expanded="false">
								  <div class="panel-body">
								  <h3>Your Address</h3>
								  <p>To add a new address, please fill out the form below.</p>
									<form action="#" class="biling-info">
										<div class="col-sm-12">
											<div class="input-box">
												<label>Your Full Name<span>*</span></label>
												<input type="text" name="name" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>Address<span>*</span></label>
												<input type="text" name="address" />
											</div>
										</div>	
										<div class="col-sm-12">
											<div class="input-box">
												<label>City<span>*</span></label>
												<input type="text" name="city" />
											</div>
										</div>									
										<div class="col-sm-12">
											<div class="input-box">
												<label>Country  <span>*</span></label>
												<select name="country" id="country">
													<option value="Bangladesh">Select Country...</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Afghanistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>Phone <abbr class="required" title="required">*</abbr></label>
												<input type="text" name="Phone " placeholder="Phone" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box m-mb mt-10">
												<p class="red">** You must register at least one phone number.</p>
												<label>Additional information <abbr class="required" title="required">*</abbr></label>
												<textarea name="note"  cols="5" rows="2"></textarea>
												<p class="mt-10">Please assign an address title for future reference. <span>*</span></p>
												<input class="mt-10" type="text" name="Phone " placeholder="Phone" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box mt-10">
												<button class="btnb-l">Save</button>
											</div>
										</div>
									</form>																  
								  
								  </div>
								</div>								
							</div>
							<div class="panel">
								<div id="headingNine" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a aria-controls="collapseNine" aria-expanded="false" href="#collapseNine" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
									    My credit slips         									
										<span class="counter"><i class="fa fa-list-ol"></i></span>						
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>
								<div aria-labelledby="headingNine" role="tabpanel" class="panel-collapse collapse" id="collapseNine" aria-expanded="false">
								  <div class="panel-body">
								  <h3>Order history</h3>
								  <p>Here are the orders you've placed since your account was created.</p>
								  <p class="alert order-alert">You have not placed any orders.</p>
								  </div>
								</div>								
							</div>
							<div class="panel">
								<div id="headingThree" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a aria-controls="collapseThree" aria-expanded="false" href="#collapseThree" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
									   My addresses                									
										<span class="counter"><i class="fa fa-file-o"></i></span>						
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>
								<div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;">
								  <div class="panel-body">
								  <h3>Your Address</h3>
								  <p>Here are the Address you've placed since your account was started.</p>
								  <p class="alert order-alert">You have not placed any Any Address.</p>
								  </div>
								</div>								
							</div>
							<div class="panel">
								<div id="headingFour" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a aria-controls="collapseFour" aria-expanded="false" href="#collapseFour" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
									  My personal information                          									
										<span class="counter"><i class="fa fa-building"></i></span>
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>
								<div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse" id="collapseFour" aria-expanded="false" style="height: 0px;">
								  <div class="panel-body">
								  <h3>Your personal information</h3>
								  <p>Please be sure to update your personal information if it has changed.</p>
									<form action="#" class="biling-info">
										<div class="col-sm-12">
											<div class="input-box">
												<label>Your Full Name<span>*</span></label>
												<input type="text" name="name" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>E-mail address<span>*</span></label>
												<input type="text" name="emailp" />
											</div>
										</div>	
										<div class="col-sm-12">
											<div class="input-box bithtday">
												<label>Date of Birth</label>
												<input type="text" name="address" />
											</div>
										</div>	
										<div class="col-sm-12">
											<div class="input-box">
												<label>Current Password<span>*</span></label>
												<input type="text" name="cpassword"/>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box">
												<label>New Password</label>
												<input type="text" name="cpassword"/>
											</div>
										</div>	
										<div class="col-sm-12">
											<div class="input-box">
												<label>Confirmation</label>
												<input type="text" name="cpassword"/>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-box mt-10">										
												<input type="checkbox"/>
												 <label class="inline">&nbsp;  Sign up for our newsletter! </label>
											</div>
											<div class="input-box">										
												<input type="checkbox"/>
												 <label class="inline">&nbsp; Receive special offers from our partners!</label>
											</div>
										</div>								
										<div class="col-sm-12">
											<div class="input-box mt-10">
												<button class="btnb-l">Save</button>
											</div>
										</div>
									</form>
								  </div>
								</div>								
							</div>
						</div>						
					</div>
				</div>
				<div class="col-lg-6 col-xs-12 col-sm-6">
					<div class="faq-accordion withlink">
						<div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
							<div class="panel">
								<div id="headingThree" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a  href="wishlist.html" class="collapsed">
									   My wishlists                									
										<span class="counter"><i class="fa fa-heart"></i></span>						
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>							
							</div>
							<div class="panel">
								<div id="headingThree" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a  href="cart.html" class="collapsed">
									   Order history and details                									
										<span class="counter"><i class="fa fa-list-ol"></i></span>						
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>							
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>