<?php
session_start();
include('settings.php');
require('includes/dbconnect.php');//DBCONNECTION
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $sitetitle; ?></title>
    <!-- SEO Meta description -->
   <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="Pinecapitalnetwork"/> <!-- website name -->
    <meta property="og:site" content="pinecapitalnetwork.com"/> <!-- website link -->
    <meta property="og:title" content="investment made easy for everyone"/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="Pine capital network is a safe and secured option, which ensures steady growth on your investments with daily returns on an ongoing basis with no hustle and instantly"/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="<?php echo $sitelogo; ?>"/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>
   <meta name="theme-color" content="#007cc5">
    <!--Google Tracking-->
   
    <!--favicon icon-->
    <link rel="shortcut icon" href="<?php echo $sitefavicon; ?>">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans:400,600&amp;display=swap" rel="stylesheet">

    <!--Bootstrap css-->
    <link rel="stylesheet" href="assets2/css/bootstrap.min.css">
    <!--Magnific popup css-->
    <link rel="stylesheet" href="assets2/css/magnific-popup.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="assets2/css/themify-icons.css">
    <!--Fontawesome icon css-->
    <link rel="stylesheet" href="assets2/css/all.min.css">
    <!--animated css-->
    <link rel="stylesheet" href="assets2/css/animate.min.css">
    <!--ytplayer css-->
    <link rel="stylesheet" href="assets2/css/jquery.mb.YTPlayer.min.css">
    <!--Owl carousel css-->
    <link rel="stylesheet" href="assets2/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets2/css/owl.theme.default.min.css">
    <!--custom css-->
    <link rel="stylesheet" href="assets2/css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="assets2/css/responsive.css">
    
    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="assets2/style.html">
        <style>
            .lead {
    font-size: 1rem;
    font-weight: 300;
}
            .btn-custom {
  color: #bdc3c7;
  font-size: 18px;
  border: 1px solid #bdc3c7;
}
.btn-custom:hover {
  color: #ffffff;
  border: 1px solid #ffffff;
}
#pricing-table {
  padding-top: 50px;
}
.pricing {
  margin: 0;
  padding: 0;
  font-family: 'Robot', sans-serif;
}
.pricing .pricing-table {
  padding-bottom: 30px;
}
.pricing .pricing-table .pricing-header {
  position: relative;
  background: #0e1746;
  padding: 22px 22px;
  text-align: center;
  border-top-right-radius: 8px;
  border-top-left-radius: 8px;
}
.pricing .pricing-table .pricing-header .pricing-title {
  color: #ffffff;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 24px;
  text-align: center;
  font-weight: 700;
}
.pricing .pricing-table .pricing-header .pricing-rate {
  font-size: 70px;
  font-weight: 700;
  color: #ffffff;
  position: relative;
  text-align: center;
}
.pricing .pricing-table .pricing-header .pricing-rate sup {
  font-size: 24px;
  position: relative;
  top: -30px;
  color: #bdc3c7;
}
.pricing .pricing-table .pricing-header .pricing-rate span {
  font-size: 16px;
  color: #bdc3c7;
  text-transform: uppercase;
}
.pricing .pricing-list {
  padding: 20px 0 40px 0;
  border: 1px solid #0e1746;
}
.pricing .pricing-list ul {
  padding: 0px;
  display: table;
  margin: 0px auto;
}
.pricing .pricing-list ul li {
  list-style: none;
  border-bottom: 1px solid #EAECEB;
  color: #bdc3c7;
  font-size: 16px;
  line-height: 42px;
}
.pricing .pricing-list ul li:last-child {
  border: none;
}
.pricing .pricing-list ul li i {
  margin-right: 12px;
  color: #fff;
}
.pricing .pricing-list ul li span {
  color: #fff;
  font-weight: 700;
}




.cah2 {
	color: #0998ec;
	font-size: 20px;
	font-weight: 800;
	text-align: center;
	text-transform: uppercase;
	position: relative;
}
.cah2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 4px;
	border-radius: 1px;
	background: #0998ec;
	left: 0;
	right: 0;
	bottom: -20px;
}
.carousel_test {
	margin: 50px auto;
	padding: 0 10px;
}
.carousel_test .item {
	color: #ffffff;
	overflow: hidden;
    min-height: 120px;
	font-size: 13px;
}
.carousel_test .media img {
	width: 40px;
	height: 40px;
	display: block;
	border-radius: 50%;
}
.carousel_test .testimonial {
	padding: 0 10px 0 10px ;
	position: relative;
}
.carousel_test .overview b {
	text-transform: uppercase;
	color: #0998ec;
}

@media  screen and (max-width: 992px) {
  .me_table::-webkit-scrollbar {
  display: none !important;
  overflow-x: scroll;
}

.rem-home{
        padding: 9rem 0 5rem 0;
    } 
    
@media  screen and (max-width: 992px) {
    .rem-home{
        padding: 6rem 0 5rem 0;
    } 
}

/* Hide scrollbar for IE and Edge */
.me-table {
  -ms-overflow-style: none !important;
  overflow-x: scroll;
}
}

.me_icon {
    margin-top: 10px;
    color: #fff;
}

.token_rtinfo {
    color: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
    margin-top: -80px;
    padding: 40px 15px;
    background-color: rgba(255,255,255,0.10);
    box-shadow: none !important;
}

.token_rt_value {
    padding: 0 25px;
}

.me_big{
    font-size: 1rem !important;
    line-height: normal !important;
}

.tradingview-widget-copyright{
    display: none !important;
}

.badge {
    border-radius: 50px;
    padding: 0.2rem 1rem;
    color: #fff;
    text-align: center;
}

.pricing-rate sup {
  font-size: 24px;
  position: relative;
  left: -20px;
  top: -30px;
}

.pricing-rate span {
  font-size: 12px;
  color: #707070;
  text-transform: uppercase;
  right: -600px;
}

.pricing-rate {
  font-size: 70px;
  font-weight: 700;
  color: #1a2c79;
  position: relative;
  text-align: center;
}



            
        </style>
        
        <style>
            
            * {
  box-sizing: border-box;
}

#google_translate_element {
  z-index: 9999;
}

.goog-te-gadget {
  font-family: Roboto, "Open Sans", sans-serif !important;
  text-transform: uppercase;
}

.goog-te-gadget-simple {
  background-color: rgba(0, 0, 0, 0.5) !important;
  border: 1px solid rgba(255, 255, 255, 0.5) !important;
  padding: 3px !important;
  border-radius: 4px !important;
  font-size: 0.8rem !important;
  line-height: 2rem !important;
  display: inline-block;
  cursor: pointer;
  zoom: 1;
  margin-bottom: 4px;
}

.goog-te-menu2 {
  max-width: 100%;
}

.goog-te-menu-value {
  color: #fff !important;
}
.goog-te-menu-value:before {
  font-family: 'Material Icons';
  content: "\E927";
  margin-right: 16px;
  font-size: 2rem;
  vertical-align: -10px;
}

.goog-te-menu-value span:nth-child(5) {
  display: none;
}

.goog-te-menu-value span:nth-child(3) {
  border: none !important;
  font-family: 'Material Icons';
}
.goog-te-menu-value span:nth-child(3):after {
  font-family: 'Material Icons';
  content: "\E5C5";
  font-size: 1.5rem;
  vertical-align: -6px;
}

.goog-te-gadget-icon {
  background-position: 0px 0px;
  height: 32px !important;
  width: 32px !important;
  margin-right: 8px !important;
  display: none;
}

.goog-te-banner-frame.skiptranslate {
  display: none !important;
}


body {
  top: 0px !important;
}

/* ================================== *\
    Mediaqueries
\* ================================== */
/* @media (max-width: 667px) {
  #google_translate_element {
  }
  #google_translate_element goog-te-gadget {
  }
  #google_translate_element .skiptranslate {
  }
  #google_translate_element .goog-te-gadget-simple {
    text-align: center;
  }
} */
        </style>
        

  <!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
             whatsapp: "+13053303512", // WhatsApp number
            
            call_to_action: "Contact Pine capital network on Whatsapp", // Call to action
            button_color: "#25d366", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "facebook,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
</head>
<body>

<div id="preloader">
    <div class="loader1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="images/pinecapitalnetworklogo.png" style="width: 230px;height: 70px;" alt="logo" class="img-fluid"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto menu">
                    
                    <li><a  href="index.php">Home</a></li>
                    <li><a  href="about">About Us</a></li>
                    <li><a href="plans.php">Investment Plans</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    
                    <li><a style="opacity: 1;" href="signup" class="btn btn-sm btn-success p-2 mb-2">Create Account</a></li>
                     
                        <li><a style="opacity: 1;" href="login" class="btn outline-white-btn p-2">Login</a></li>  
                       
                </ul>
            </div>
        </div>
    </nav>
</header>

 <div class="main">