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
							<li>FAQ</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- faq-area -->
	<div class="faq-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xs-12 col-sm-12">
					<div class="faq-title">
						<h4>FREQUENTLY ASKED QUESTIONS</h4>
<!--						<h5>Last Updated on --><?php //echo $last_update->date_modified; ?><!--</h5>-->
					</div>
					<div class="faq-accordion">
						<div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
							<?php $i=1; foreach ($data as $faq){?>
							<div class="panel">
								<div id="heading<?php echo $i; ?>" role="tab" class="panel-heading">
								  <h4 class="panel-title">
									<a aria-controls="collapse<?php echo $i; ?>" aria-expanded="false" href="#collapse<?php echo $i; ?>" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
									    <?php echo $faq->title;?>
										<span class="counter"><?php echo $i.'.'; ?></span>
										<span class="opener"></span>										
									</a>
								  </h4>
								</div>
								<div aria-labelledby="heading<?php echo $i; ?>" role="tabpanel" class="panel-collapse collapse" id="collapse<?php echo $i; ?>" aria-expanded="false" style="height: 0px;">
								  <div class="panel-body">
									  <?php echo $faq->content;?>
								  </div>
								</div>								
							</div>
							<?php $i++; }?>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>