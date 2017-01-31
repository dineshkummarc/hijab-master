<?php echo $this->load->view('frontend/sidebar') ?>
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
					
					</div>
				</div>
				
				<div class="billing-details">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h3 class="h3-18">Thank You.....</h3>
							<h5 class="h3-18">Your order has been succed</h5>
							
				<!-- billing details end -->
			</div>
			<div class="col-md-12">
			<div style="border:4px solid #e3e3e3; width:100%; padding: 10px;">
				<div class="text-center col-md-2" style="border-bottom:2px solid #eeeeee; position: relative; float: none; margin:0 auto; margin-bottom: 10px;"><h3 class="h3-18">INVOICE</h3></div>
				<div><h4 class="h3-18">Invoice Number : <?php echo $invoice->invoice_number ?></h4></div>
				<div><h4 class="h3-18">Detail Address</h4></div>
				<div>

				<div class="col-md-12 address box">
					<div><h5 class="h3-18">Shipping Address</h5></div>
					<table>
						<tr>
							<td>Reciever Name</td>
							<td> : </td>
							<td><?php echo $ship_address->receiver_name ?></td>
						</tr>
						<tr>
							<td>Destination</td>
							<td> : </td>
							<td><?php echo $ship_address->title ?></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td> : </td>
							<td><?php echo $ship_address->phone ?></td>
						</tr>
						
						<tr>
							<td>Province</td>
							<td> : </td>
							<td><?php echo $prov_ship->name ?></td>
						</tr>
						<tr>
							<td>City</td>
							<td> : </td>
							<td><?php echo $city_ship->name ?></td>
						</tr>
						<tr>
							<td>Region</td>
							<td> : </td>
							<td><?php echo $region_ship->name ?></td>
						</tr>
						<tr>
							<td>Postal Code</td>
							<td> : </td>
							<td><?php echo $ship_address->postal_code ?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td> : </td>
							<td><?php echo $ship_address->address ?></td>
						</tr>
					</table>
				</div>
				<div class="clearfix"></div>
				</div>
				<div><br><h4 class="h3-18">Detail Product</h4></div>
				<div>
					<div class="col-md-12 address" style="background: #eeeeee; padding: 20px;">
					<table class="tabtab">
					<tr style="border:2px solid #6a6e6f">
						<td class="border-tab">Image Product</td>
						<td class="border-tab">Name</td>
						<td class="border-tab">Price</td>
						<td class="border-tab">Color</td>
						<td class="border-tab">Size</td>
						<td class="border-tab">Quantity</td>
						<td class="border-tab">Subtotal</td>
					</tr>
					<?php foreach ($product as $key) {
					?>
						<tr>
							<td><img src="assets/uploads/product/<?php echo $key->product_id ?>/<?php echo $key->image ?>" style="width: 80px; height: 100px;"></td>
							<td><?php echo $key->name ?></td>
							<td><?php echo "Rp. ". number_format($key->price,2,",",".") ?></td>
							<td><?php echo $key->color ?></td>
							<td><?php echo $key->size ?></td>
							<td><?php echo $key->quantity ?></td>
							<td><?php echo "Rp. ".number_format($key->quantity * $key->price,2,",",".") ?></td>
						</tr>
						<?php } ?>
						<tr>
						<td colspan="7" class="text-right">
							<h5>Subtotal : Rp. <?php echo number_format($invoice->total_order,2,",",".") ?></h5>
						</td>
						</tr>
						<tr>
						<td colspan="7" class="text-right">
							<h5>Shipping Cost : Rp. <?php echo number_format($invoice->total_ship_price,2,",",".") ?></h5>
						</td>
						</tr>
						<tr>
						<td colspan="7" class="text-right">
							<h5>Discount : Rp. <?php echo number_format($invoice->total_discount,2,",",".") ?></h5>
						</td>
						</tr>
						<tr>
						<td colspan="7" class="text-right">
							<h5>Code Random : Rp. <?php echo number_format($invoice->random_code,2,",",".") ?></h5>
						</td>
						</tr>
						<tr>
						<td colspan="7" class="text-right">
							<h5>Total Payment : Rp. <?php echo number_format($invoice->total_payment,2,",",".") ?></h5>
						</td>
						</tr>
					</table>
					</div>
					<div class="clearfix"></div>
					</div>
					
				<div>
				<div style="border:2px solid #eeeeee; margin-top: 20px; padding: 10px" class="col-md-4">
					Please transfer the total amount to the following bank account. Acc. No. 0080527071<br> Acc.Name: Imanuel Hendrik Latunij<br> Choose Bank Code: 014 <br>
					<img src="https://slightkshop.files.wordpress.com/2013/04/logo-bank-mandiri.png?w=1600&h=1236" width="100"><br>
					(If you transfer from other Bank) Please confirm your payment
				</div>
				<div class="clearfix"></div>
				</div>
				</div>

			</div>
		</div>

		</div>
		</div>
		</div>