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
											  <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-center" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>

	                        <h3>OVERVIEW</h3>
	                        <div class="col-md-12">
	                        <div class="row">
	                       <div class="widget-dash">
	                       	<div class="col-md-12">
	                       		<div class="row">
	                       			<div class="col-md-4 text-center col-left">
	                       				<i class="fa fa-credit-card-alt"></i>
	                       			</div>
	                       			<div class="col-md-8 con-dash">
	                       				<h3>Total Order</h3>
	                       				<h5 style=""> <?php echo $order_count ?> Order</h5>
	                       			</div>
	                       		</div>
	                       	</div>
	                       	<div class="clearfix"></div>
	                       </div>
	                        </div>
	                        </div>
	                        </div>
					</div>	
				</div>
			</div>
		</div>
	</div>