<?php echo $this->load->view('frontend/sidebar.php') ?>
<!-- contact-details -->
<div class="fieldset-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <?php if(isset($_GET['submit'])) { if($_GET['submit'] == 'success') { ?>
                <div class="alert alert-success"><strong>Terima Kasih, kami akan segera menghubungi Anda </strong><span></span></div>
                <?php } else { ?>
                <div class="alert alert-danger"><strong>Pesan Gagal, silahkan Coba Lagi</strong><span></span></div>
                <?php }} ?>
                <div class="row">
                    <form action="contact/save_guest_book" class="contactform" method="post">
                        <h4>Leave A Message!</h4>
                        <div class="col-sm-5">
                            <div class="input-box mb-10">
                                <input id="name" class="input-text required-entry" type="text"
                                       placeholder="Your Name *" value="" title="Name" name="name" required>
                            </div>

                            <div class="input-box mb-10">
                                <input id="email" class="input-text required-entry" type="text"
                                       placeholder="Your Email *" value="" title="Name" name="email" required>
                            </div>
                            <div class="input-box mb-10">
                                <input id="phone" class="input-text required-entry" type="text"
                                       placeholder="Your Phone *" value="" title="Name" name="phone" required>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="input-box mb-10">
                                <input id="phone" class="input-text required-entry" type="text"
                                       placeholder="Subject" value="" title="Subject *" name="subject" required>
                            </div>
                            <div class="input-box">
                                <textarea class="message" style="height:93px" placeholder="Your Message *" name="content" required></textarea>
                            </div>
                        </div>
                        <div class="button-set">
                            <h4>* Recuired Fields</h4>
                            <button class="btnb-l" type="submit">submit</button>
                        </div>						
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="peer-wrapper">
                    <h4>HijabDept</h4>
                    <div class="grid-4">
                        <h4>Address:</h4>
                    </div>
                    <div class="grid-8">
                        <h4><?php echo $address->content ?></h4>
                    </div>
                </div>
                <div class="peer-wrapper">
                    <div class="grid-4">
                        <h4>Mobile:</h4>
                    </div>
                    <div class="grid-8">
                        <h5><?php echo $phone->content ?></h5>
                        <h4></h4>
                    </div>
                </div>
                <div class="peer-wrapper">
                    <div class="grid-4">
                        <h4>Skype:</h4>
                    </div>
                    <div class="grid-8">
                        <h5>Ikramulislam69</h5>
                        <h4>Peerforest.com</h4>
                    </div>
                </div>
                <div class="peer-wrapper">
                    <div class="grid-4">
                        <h4>Email:</h4>
                    </div>
                    <div class="grid-8">
                        <h5>Mahin5042@gmail.com</h5>
                        <h4>support@peerforest.com</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>