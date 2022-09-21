<!-- footer -->
<?php
//Selecting current user 
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$phone_number =$row['phone_number'];
$address =$row['address'];
$location =$row['location'];
$email =$row['email'];

?>


<footer class="footer-section">
    <!--footer top start-->
    <div class="footer-top gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row footer-top-wrap">
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-nav-wrap text-white">
                                <h4 class="text-white">QUICK LINKS</h4>
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="signup">Sign Up</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="plans.php">Investment Plans</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Where to Buy Bitcoin</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-nav-wrap text-white">
                                <h4 class="text-white">COMPANY</h4>
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="plans.php">Plans</a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-nav-wrap text-white">
                                <h4 class="text-white">LEGAL</h4>
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Legal Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Report Abuse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Terms of Service</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-nav-wrap text-white">
                                <h4 class="text-white">SUPPORT</h4>
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Knowledge Base</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">System Status</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row footer-top-wrap">
                        <div class="col-12">
                            <div class="footer-nav-wrap text-white">
                                <h4 class="text-white">GET IN TOUCH</h4>
                                <ul class="get-in-touch-list">
                                    <li class="d-flex align-items-center py-2"><span class="fas fa-map-marker-alt mr-2"></span><?php echo $address; ?></li>
                                    <li class="d-flex align-items-center py-2"><span class="fas fa-envelope mr-2"></span><?php echo $email; ?></li>
                                    <li class="d-flex align-items-center py-2"><span class="fas fa-phone-alt mr-2"></span> <?php echo $phone_number; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer top end-->

    <!--footer copyright start-->
    <div class="footer-bottom gray-light-bg py-2 mb-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-5 col-lg-5">
                    <p class="copyright-text pb-0 mb-0">Pine capital network Copyrights © 2022. All
                        rights reserved
                        <a href="index.html" target="_blank">Pine capital network</a></p>
                </div>
                <div class="col-md-7 col-lg-6 d-none d-md-block d-lg-block">
                    <div class="social-nav text-right">
                        <ul class="list-unstyled social-list mb-0">
                            <li class="list-inline-item tooltip-hover">
                                <a href="http://facebook.com/" target="_blank" class="rounded"><span class="ti-facebook"></span></a>
                                <div class="tooltip-item">Facebook</div>
                            </li>
                            <li class="list-inline-item tooltip-hover"><a href="http://twitter.com/" target="_blank" class="rounded"><span class="ti-twitter"></span></a>
                                <div class="tooltip-item">Twitter</div>
                            </li>
                            <li class="list-inline-item tooltip-hover"><a href="http://linkedin.com/" target="_blank" class="rounded"><span class="ti-linkedin"></span></a>
                                <div class="tooltip-item">Linkedin</div>
                            </li>
                            <li class="list-inline-item tooltip-hover"><a href="http://instagram.com/" target="_blank" class="rounded"><span class="ti-instagram"></span></a>
                                <div class="tooltip-item">Instagram</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer copyright end-->
</footer>
<!--footer section end-->

<!--bottom to top button start-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="ti-angle-up"></span>
</button>
<!--bottom to top button end-->
<div style="position: fixed; left: 0; bottom: 0; z-index: 1; width: 100%;">
                <div style="width: 100%; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; text-align: right; line-height:14px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; padding:1px;padding: 0px; margin: 0px;">
                    <div style="height:40px;">
                        <iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=" width="100%" height="36" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;">
                         </iframe>
                    </div>
                    </div>
                </div>




<script async src="../s.widgetwhats.com/wwwa.js" data-wwwa=""></script>
<!--jQuery-->
<script src="assets2/js/jquery-3.4.1.min.js"></script>
<!--Popper js-->
<script src="assets2/js/popper.min.js"></script>
<!--Bootstrap js-->
<script src="assets2/js/bootstrap.min.js"></script>
<!--Magnific popup js-->
<script src="assets2/js/jquery.magnific-popup.min.js"></script>
<!--jquery easing js-->
<script src="assets2/js/jquery.easing.min.js"></script>
<!--jquery ytplayer js-->
<script src="assets2/js/jquery.mb.YTPlayer.min.js"></script>
<!--Isotope filter js-->
<script src="assets2/js/mixitup.min.js"></script>
<!--wow js-->
<script src="assets2/js/wow.min.js"></script>
<!--owl carousel js-->
<script src="assets2/js/owl.carousel.min.js"></script>
<!--countdown js-->
<script src="assets2/js/jquery.countdown.min.js"></script>
<!--custom js-->
<script src="assets2/js/scripts.js"></script>


<script>
function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h === 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();
</script>

<script>
// WORK IN PROGRESS BELOW
      	
$('document').ready(function () {


		// RESTYLE THE DROPDOWN MENU
    $('#google_translate_element').on("click", function () {

        // Change font family and color
        $("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div, .goog-te-menu2 *")
            .css({
                'color': '#544F4B',
                'font-family': 'Roboto',
								'width':'100%'
            });
        // Change menu's padding
        $("iframe").contents().find('.goog-te-menu2-item-selected').css ('display', 'none');
			
				// Change menu's padding
        $("iframe").contents().find('.goog-te-menu2').css ('padding', '0px');
      
        // Change the padding of the languages
        $("iframe").contents().find('.goog-te-menu2-item div').css('padding', '20px');
      
        // Change the width of the languages
        $("iframe").contents().find('.goog-te-menu2-item').css('width', '100%');
        $("iframe").contents().find('td').css('width', '100%');
      
        // Change hover effects
        $("iframe").contents().find(".goog-te-menu2-item div").hover(function () {
            $(this).css('background-color', '#4385F5').find('span.text').css('color', 'white');
        }, function () {
            $(this).css('background-color', 'white').find('span.text').css('color', '#544F4B');
        });

        // Change Google's default blue border
        $("iframe").contents().find('.goog-te-menu2').css('border', 'none');

        // Change the iframe's box shadow
        $(".goog-te-menu-frame").css('box-shadow', '0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3)');
        
      
      
        // Change the iframe's size and position?
        $(".goog-te-menu-frame").css({
            'height': '100%',
            'width': '100%',
            'top': '0px'
        });
        // Change iframes's size
        $("iframe").contents().find('.goog-te-menu2').css({
            'height': '100%',
            'overflow': 'scroll',
            'width': '100%'
        });
    });
});
</script>


</body>


</html>