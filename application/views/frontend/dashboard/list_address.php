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
					<div class="col-lg-8 col-xs-12 col-sm-12">
					
						  <div class="panel-body text-center">
						  <h3>Your Address</h3>
						  </div>

						     <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-center" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
						
					<div class="table-content">
						
							<div class="table-content table-responsive">
								<table class="wishlist">
									<thead>
										<tr>
											<th class="product-name" style="max-width: 500px;">ADDRESS</th>
											<th class="product-subtotal text-right"><a class="pull-right"  href="dashboard/detail_address/"><button class="btnb">Add New</button></a></th>
										</tr>										
									</thead>
									<tbody>
									<?php foreach ($shipping_address as $key) {
									?>
										<tr>									
											<td class="product-name" style="max-width: 500px;">
												<h3><a href="dashboard/detail_address/<?php echo $key->id ?>"><?php echo $key->receiver_name ?></a></h3>
												<div class="price-star">
													<div class="rating">
														<h4>Title : <span><?php echo $key->title ?></span></h4>
													</div>
													<div class="rating">
														<h4>Adress : <span><?php echo $key->address ?></span></h4>
													</div>
												</div>											
											</td>
											<td class="product-subtotal">
												<a href="dashboard/detail_address/<?php echo $key->id ?>"><button class="btnb mbt-30">Detail</button></a>

												<div class="sub-icon">
													<a class="trash" href="#" data-href="dashboard/del_address/<?php echo $key->id ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</div>												
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
					</div>
				
					</div>	
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog-confirm">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body-confirm">
                Are you sure you want to remove this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>