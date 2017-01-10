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
					<div class="col-lg-6 col-xs-12 col-sm-12">
					<div class="row">
						<?php $no=1; foreach ($order as $d_row) { ?>
						<div class="box orderlist">
						<div class="col-md-1 text-center box2">
							<?php echo $no?>
						</div>
							<div class="col-md-11">
							<h4><?php echo $d_row->invoice_number?></h4>
							<SPAN><?php echo $d_row->date_created?></SPAN> | <span>Jam : 02:09</span>
								<div style="" class="square-order">
									<div class="row">
										<div class="col-md-8">
									Total Pesan Barang : <?php echo $d_row->total_order?><br>
									Total Kirim Barang : <?php echo $d_row->total_ship_price?><br>
									Total Pembayaran : <?php echo $d_row->total_payment?>
										</div>

										<div class="col-md-4">
										<div class="text-center status-order">
										<h3 style=""><?php if($d_row->status==0){echo"Unconfirm";}elseif ($d_row->status==1){echo"Confirm";}elseif ($d_row->status==2){echo"Packing";}elseif ($d_row->status==3){echo"Shipped";}elseif ($d_row->status==-99){echo"Canceled/Rejected";}elseif ($d_row->status==-98){echo"Out of Stock";}else{ echo"Tidak ada Status"; }?></h3>
										</div>
											
										</div>
										<div class="clearfix"></div>
									</div>
									
								</div>
								<br>
								<a href="cart/thankyou/<?php echo $d_row->invoice_number?>" class="link-shop">DETAIL</a>

							</div>
							<div class="clearfix"></div>
						</div>
						<?php } ?>
					</div>
						
					</div>	

				</div>
			</div>
		</div>
	</div>