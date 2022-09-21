<?php
include('includes/header.php');

//Selecting current user 
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$phone_number =$row['phone_number'];
$address =$row['address'];
$location =$row['location'];
$email =$row['email'];

?>

<!-- START SECTION BANNER -->
<section class="hero-section ptb-100 gradient-overlay"
             style="background: url('img/header-bg-5.html')no-repeat center center / cover">
        <div class="container">
            <div class='row'>
                
                <div class="col-md-12 text-center">
                    <div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
}
</script>
            <script type="text/javascript" src="../translate.google.com/translate_a/elementa0d8.js?cb=googleTranslateElementInit"></script>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <div class="page-header-content text-white text-center pt-sm-5 pt-md-5 pt-lg-0">
                        <h1 class="text-white mb-0">Get Support</h1>
                        <div class="custom-breadcrumb">
                            <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0">
                                <li class="list-inline-item breadcrumb-item active">Send Us A Message</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section><section class="contact-us-section py-5">
        <div class="container contact">
            <div class="col-12 pb-3 message-box d-none">
                <div class="alert alert-danger"></div>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <div class="contact-us-form gray-light-bg rounded p-5">
                        <h4>Ready to get started?</h4>
                        <form method="post" action="#" class="contact-us-form">
                                                        <div class="form-row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" required="required" placeholder="Enter Name *" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="email" required="required" placeholder="Enter Email *" class="form-control" name="email" id="email" value="" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" required="required" placeholder="Phone Number" class="form-control" name="phone" id="phone" value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" required="required" placeholder="Enter Subject" class="form-control" name="subject" id="subject" value="" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea required="required" placeholder="Message *" class="form-control" name="message" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <button type="submit" title="Submit Your Message!" name="_token" value="" class="btn secondary-solid-btn">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="contact-us-content">
                        <h2>Looking for a Profitable Investment Plan?</h2>
                        <p class="lead">Search no! Click on the button below to get started.</p>

                        <a href="signup" class="btn outline-btn align-items-center">Get Started <span class="ti-arrow-right pl-2"></span></a>

                        <hr class="my-5">

                        <h5>Our Headquarters</h5>
                        <address>
                           <?php echo $address; ?>
                       </address>
                        <br>
                        <span>Phone: <?php echo $phone_number; ?></span> <br>
                        <span>Email: <a href="mailto:<?php echo $email; ?>" class="link-color"><?php echo $email; ?></a></span>

                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="contact-us-promo py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card single-promo-card single-promo-hover text-center shadow-sm">
                        <div class="card-body py-5">
                            <div class="pb-2">
                                <span class="ti-mobile icon-sm color-secondary"></span>
                            </div>
                            <div><h5 class="mb-0">Call Us</h5>
                                <p class="text-muted mb-0"><?php echo $phone_number; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card single-promo-card single-promo-hover text-center shadow-sm">
                        <div class="card-body py-5">
                            <div class="pb-2">
                                <span class="ti-location-pin icon-sm color-secondary"></span>
                            </div>
                            <div><h5 class="mb-0">Visit Us</h5>
                                <p class="text-muted mb-0"><?php echo $address; ?>
</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card single-promo-card single-promo-hover text-center shadow-sm">
                        <div class="card-body py-5">
                            <div class="pb-2">
                                <span class="ti-email icon-sm color-secondary"></span>
                            </div>
                            <div><h5 class="mb-0">Mail Us</h5>
                                <p class="text-muted mb-0"><?php echo $email; ?></p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card single-promo-card single-promo-hover text-center shadow-sm">
                        <div class="card-body py-5">
                            <div class="pb-2">
                                <span class="ti-headphone-alt icon-sm color-secondary"></span>
                            </div>
                            <div><h5 class="mb-0">Live Chat</h5>
                                <p class="text-muted mb-0">Chat with Us 24/7</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        



        </div>

<div class="client-section gray-light-bg" style="padding: 10px 0px;">
        <div class="container">
          
            <!--clients logo start-->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <img src="we_accept.png" alt="client logo" class="client-img">
                    
                </div>
            </div>
            <!--clients logo end-->
        </div>
    </div>
<?php
include('includes/footer.php');
?>