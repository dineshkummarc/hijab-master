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
				<div class="col-sm-12 ">
					<div class="faq-title">
						<h4><?php echo $function_name;?></h4>
					</div>
					<?php if($count_bil==0){ ?>
						<p class="my-title text-center">Please upload your photos to complete the registration</p>
						<div class="col-lg-12 col-xs-12 col-sm-12 text-center">
						<?php }else{ ?>
					
					<?php
						$this->load->view('frontend/dashboard/side-menu'); 
					?>
					<div class="col-lg-6 col-xs-6 col-sm-6">
					<?php } ?>
						  <div class="panel-body">
						  <h3>Your Photos</h3>
						  <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-center" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
							<form action="dashboard/submit_photo" class="biling-info" method="post" enctype="multipart/form-data">
								<div class="col-sm-4 center">
									<div class="input-box">
										<input required type="file" style="height: 50px" name="photo" value="" />
									</div>
								</div>								
								<div class="col-sm-12">
									<div class="input-box mt-10">
										<button type="submit" class="btnb-l">Next Step</button>
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