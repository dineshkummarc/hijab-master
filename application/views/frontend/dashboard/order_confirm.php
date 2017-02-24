	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="grid-full">
						<ul>
							<li>
								<a href="#">Home</a>
								<span> / </span>
							</li>
							<li>My Account</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- faq-area -->
	<div class="faq-area my-account">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="faq-title">
						<h4><?php echo $function_name;?></h4>
					</div>
					
					<?php
						$this->load->view('frontend/dashboard/side-menu'); 
					?>
					<div class="col-lg-6 col-xs-6 col-sm-6">
						  <div class="panel-body">
						  <h3>Form Confirmation</h3>
	                        <div class="form-group text-center" >
	                        <h4 class="order-confirm-msg" style="color:red"></h4>
	                        </div>
							<form id="form-order-confirmation" action="dashboard/submit_confirm" method="post" class="biling-info">
								<div class="col-sm-12">
									<div class="input-box">
										<label>Invoice Number<span>*</span></label>
										<input required type="text" name="code" value="<?php echo $invoice ?>" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Account Name<span>*</span></label>
										<input required type="text" name="acc_name" value="" />
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-box">
										<label>Account Bank<span>*</span></label>
										<input required type="text" name="acc_bank" value="" />
									</div>
								</div>	
								<div class="col-sm-12">
									<div class="input-box">
										<label>Transfer to Bank<span>*</span></label>
										<select required name="bank_target">
											<option value="MANDIRI">MANDIRI</option>
											<option value="BCA">BCA</option>
										</select>
									</div>
								</div>	
								<div class="col-sm-12">
									<div class="input-box">
										<label>Total Payment<span>*</span></label>
										<input type="text" required name="tot_payment" value="" />
									</div>
								</div>		
								<div class="col-sm-12">
									<div class="input-box">
										<label>Date Transfer<span>*</span></label>
										<input type="date" required name="date_tf" value="" />
									</div>
								</div>						
								<div class="col-sm-12">
									<div class="input-box mt-10">
										<button type="submit" class="btnb-l">Submit</button>
									</div>
								</div>
							</form>
						  </div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>