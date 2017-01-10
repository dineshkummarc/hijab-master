<?php echo $this->load->view('frontend/sidebar.php') ?>
<!-- contact-details -->
<div class="fieldset-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <form action="order_confirmation/confirm" class="contactform" method="post">
                        <h4>Order Confirmation</h4>
                        <div class="col-sm-8 col-md-6" >
                            <div class="input-box mb-10">
                                <input id="order_id" class="input-text required-entry" type="text"
                                       placeholder="INVOICE NUMBER *" value="" title="order_id" name="order_id" required>
                            </div>
                            <div class="input-box mb-10">
                                <input id="bank_target" class="input-text required-entry" type="text"
                                       placeholder="Bank Target *" value="" title="bank_target" name="bank_target" required>
                            </div>
                            <div class="input-box mb-10">
                                <input id="total_payment" class="input-text required-entry" type="text"
                                       placeholder="Total Payment *" value="" title="total_payment" name="total_payment" required>
                            </div>



                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="input-box mb-10">
                                <input id="account_bank" class="input-text required-entry" type="text"
                                       placeholder="Account Bank *" value="" title="account_bank" name="account_bank" required>
                            </div>
                            <div class="input-box mb-10">
                                <input id="account_name" class="input-text required-entry" type="text"
                                       placeholder="Account Name *" value="" title="account_name" name="account_name" required>
                            </div>
                            <div class="input-box mb-10">
                                <input type="date" name="date_transfer" id="px-customer-form-tgl_lahir" placeholder="Date Transfer" class="datepicker" required/>
                            </div>

                        </div>
                        <div class="button-set">
                            <h4>* Required Fields</h4>
                            <button class="btnb-l" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/backend_assets/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/backend_assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript">
        $('.datepicker').datepicker({format:"yyyy-mm-dd"});
</script>