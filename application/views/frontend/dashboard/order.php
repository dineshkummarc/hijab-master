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
						<table border="2px">
							<tr>
								<th>No</th>
								<th>Tanggal Pesan</th>
								<th>Status Order</th>
								<th>Kode Pesan</th>
								<th>Total Pesan Barang</th>
								<th>Total Kirim Barang</th>
								<th>Total Pembayaran</th>
								<th></th>
							</tr>
							<tr>
								<?php $no=1; foreach ($order as $d_row) { ?>
								<td><?php echo $no?></td>
								<td><?php echo $d_row->date_created?></td>
								<td><?php if($d_row->status==0){echo"Unconfirm";}elseif ($d_row->status==1){echo"Confirm";}elseif ($d_row->status==2){echo"Packing";}elseif ($d_row->status==3){echo"Shipped";}elseif ($d_row->status==-99){echo"Canceled/Rejected";}elseif ($d_row->status==-98){echo"Out of Stock";}else{ echo"Tidak ada Status"; }?></td>
								<td><?php echo $d_row->invoice_number?></td>
								<td><?php echo $d_row->total_order?></td>
								<td><?php echo $d_row->total_ship_price?></td>
								<td><?php echo $d_row->total_payment?></td>
								<td><a href="#">Detail</a></td>
								<?php } $no++ ?>
							</tr>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>