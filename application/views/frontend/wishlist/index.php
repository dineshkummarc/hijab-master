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
				     <?php if($this->session->flashdata('msg')){ ?>
	                        <div class="form-group text-center" >
	                        <h4 style="color:red"><?php echo $this->session->flashdata('msg') ?></h4>
	                        </div>
	                        <?php } ?>
					<?php
						$this->load->view('frontend/dashboard/side-menu'); 
					?>
					<div class="col-lg-8 col-xs-12 col-sm-12">
					<div class="row">
					<div class="table-content">
						<form action="#">
							<div class="table-content table-responsive">
								<table class="wishlist">
									<thead>
										<tr>
											<th class="product-Item">ITEM</th>
											<th class="	" style="width: 200px">PRODUCT NAME</th>
											<th class="product-price">UNIT PRICE</th>
											<th class="product-subtotal"></th>
										</tr>										
									</thead>
									<tbody>
										<?php foreach ($wishlist as $data_wish) { ?>
										<tr>
											<td class="product-Item">
												<a href="#">
													<img src="assets/uploads/product/<?php echo $data_wish->image->product_id ?>/<?php echo $data_wish->image->photo ?>" alt="" title="Simple Product With Their Price" />
												</a>												
											</td>										
											<td class="product-name" style="width: 200px">
												<h3 style="padding-top: 25px;"><a href="#"><?php echo $data_wish->product->name_product?> </a></h3>
																					
											</td>
											<td class="product-price">
												<h4 class=""><?php echo $data_wish->product->price;?></h4>							
											</td>
											<td class="product-subtotal">
												<div class="sub-icon">
													<a class="trash" href="#" data-href="wishlist/wishlist_delete/<?php echo $data_wish->id ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</div>												
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</form>
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
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>