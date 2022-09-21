<?php
include('includes/header.php');

?>
    <!-- START SECTION BANNER -->
<section class="hero-section ptb-100 gradient-overlay"
             style="background: url('assets2/img/header-bg-5.jpg')no-repeat center center / cover">
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
                        <h1 class="text-white mb-0">Investment Plans</h1>
                        <div class="custom-breadcrumb">
                            <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0">
                                <li class="list-inline-item breadcrumb-item active">Rock Capital Investments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
  
    <section class="pricing-section ptb-100 gray-light-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="section-heading text-center mb-5">
                        <h2>Plans</h2>
                        <p class="lead">We understand the needs of our customers very much that our investment plans covers the widest range of benefits.</p>
                    </div>
                </div>
            </div>
            <?php
                        $sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
                        $rows1 = mysqli_num_rows($sql1) ;

                        if($rows1<1){?>
                           <div class="alert alert-warning" role="alert">
                           <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                           <span class="alert-text">No Plans Yet</span>
                           </div>
                        <?php }else{

                        
                           while($row11 = mysqli_fetch_array($sql1)){
                              $categoryid =$row11["ID"];
                           $category_name =$row11["category_name"];
                           $category_order =$row11["category_order"];
                           $datecreated =$row11["datecreated"];

                           echo "<div class='row'>
                                    <div class='col-md-12'>
                                       <div class='full'>
                                          <div class='heading_main text_align_center'>";
                                             echo "<h3 style='margin-top:30px;'>$category_name <span class='theme_color'>Plans</span></h3>";
                                    echo "</div>
                                       </div>
                                    </div>
                                 </div>";
                                 echo "<div class='row justify-content-center'>";
                           
                           $sql12 = mysqli_query($con, "SELECT * FROM `fx_investments_plans` WHERE plan_category='$category_name'  order by plan_order ASC");   //checking no of investments
                           $rows12 = mysqli_num_rows($sql12) ;

                           if($rows12<1){
                              echo "<div class='alert alert-warning' role='alert'>
                              <span class='alert-icon'><i class='ni ni-fat-remove'></i></span>
                              <span class='alert-text'>No $category_name plan yet</span>
                              </div>";
                           }else{
                              while($row12 = mysqli_fetch_array($sql12)){
                                 $planid =$row12["ID"];
                                 $plan_name =$row12["plan_name"];
                                 $plan_min =$row12["plan_min"];
                                 $plan_max =$row12["plan_max"];
                                 $plan_roi =$row12["plan_roi"];
                                 $plan_roi_type =$row12["plan_roi_type"];
                                 $plan_order =$row12["plan_order"];
                                 $plan_duration =$row12["plan_duration"];
                                 $plan_status =$row12["plan_status"];
                                 $plan_category =$row12["plan_category"];

                                 $plan_min = number_format($plan_min);
                                 if($plan_max == ""){
                                 $plan_max = "UNLIMITED";
                                 }else{
                                    $plan_max = number_format($plan_max);
                                 }
                                 echo "<div class='col-lg-4 col-md mb-4'>
                                    <div class='card text-center single-pricing-pack'>
                                        <div class='pt-4'><h5>$plan_name PLAN</h5><span class='badge badge-success'>$category_name</span></div>
                                        <div class='card-header py-4 border-0 pricing-header'>
                                            <div class='h1 text-center mb-0'>
                                                <p class='pricing-rate'>$plan_roi <sup>%</sup><span>Profit $plan_roi_type for $plan_duration Days</span></p>
                                                
                                            </div>
                                        </div>
                                        <div class='card-body bg-transparent affix text-white'>
                                            <ul class='list-unstyled text-left text-sm mb-4 pricing-feature-list'>
                                                <li><span class='ti-check-box mr-2 color-secondary'></span><span>Min</span><b class='float-right'>USD $plan_min</b></li>
                                                <li><span class='ti-check-box mr-2 color-secondary'></span><span>Max</span><b class='float-right'>USD $plan_max</b></li>
                                                <li><span class='ti-check-box mr-2 color-secondary'></span><span>Profit</span><b class='float-right'>$plan_roi% Profit $plan_roi_type for $plan_duration Days</b></li>
                                                <!-- <li><span class='ti-check-box mr-2 color-secondary'></span><span>Referral Bonus</span><b class='float-right'>10%</b></li>-->
                                                <li><span class='ti-check-box mr-2 color-secondary'></span><span>Duration</span><b class='float-right'>$plan_duration Day/Days</b></li>
                                            </ul>
                                            <a href='signup' class='btn outline-white-btn p-2'>Get Started Now</a>
                                        </div>
                                    </div>
                                </div>";
                                 
                              }
                              
                           }
                           echo "</div>"; //end the row for each plan category
                        }
                     }
                  ?>
        </div>
        <div class="action-btns mt-3 text-center">
                <a href="plans.php" class="btn btn-success">View All Plans</a>
        </div>
    </section> 
        
        
        

<!--section class="team-two-section ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8">
                    <div class="section-heading text-center mb-5">
                        <h2>Meet our lovely team</h2>
                        <p class="lead">Distinctively grow go forward manufactured products and optimal networks. Globally administrate 24/7 interfaces and end-to-end platforms.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="staff-member">
                        <div class="card gray-light-bg text-center border-0">
                            <img src="img/team-1.jpg" alt="team image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="teacher mb-0">Richard Ford</h5>
                                <span>Instructor of Mathematics</span>
                                <ul class="list-inline pt-2 social">
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-facebook"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-linkedin"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-dribbble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="overlay-inner">
                                <p class="teacher-quote">"Dramatically leverage existing fully researched platforms vis-a-vis viral." </p><a
                                    href="#" class="teacher-name">
                                <h5 class="mb-0 teacher text-white">Richard Ford</h5></a>
                                <span class="teacher-field text-white">Instructor of Mathematics</span>
                                <ul class="list-inline py-4 social">
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-facebook"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-linkedin"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-dribbble"></span></a></li>
                                </ul>
                                <p class="teacher-see-profile">
                                    <a href="#" class="btn outline-white-btn">View my profile</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="staff-member">
                        <div class="card gray-light-bg text-center border-0">
                            <img src="img/team-3.jpg" alt="team image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="teacher mb-0">Kely Roy</h5>
                                <span>Lead Designer</span>
                                <ul class="list-inline pt-2 social">
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-facebook"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-linkedin"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-dribbble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="overlay-inner">
                                <p class="teacher-quote">"Credibly extend high-payoff web-readiness via top-line relationships." </p><a
                                    href="#" class="teacher-name">
                                <h5 class="mb-0 teacher text-white">Kely Roy</h5></a><span class="teacher-field text-white">Lead Designer</span>
                                <ul class="list-inline py-4 social">
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-facebook"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-linkedin"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-dribbble"></span></a></li>
                                </ul>
                                <p class="teacher-see-profile">
                                    <a href="#" class="btn outline-white-btn">View my profile</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="staff-member">
                        <div class="card gray-light-bg text-center border-0">
                            <img src="img/team-2.jpg" alt="team image" class="img-fluid">
                            <div class="card-body">
                                <h5 class="teacher mb-0">Gerald Nichols</h5>
                                <span>Managing Director</span>
                                <ul class="list-inline pt-2 social">
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-facebook"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-linkedin"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-dribbble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="overlay-inner">
                                <p class="teacher-quote">"Authoritatively evolve stand-alone e-tailers whereas prospective partnerships." </p><a
                                    href="#" class="teacher-name">
                                <h5 class="mb-0 teacher text-white">Gerald Nichols</h5></a>
                                <span class="teacher-field text-white">Managing Director</span>
                                <ul class="list-inline py-4 social">
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-facebook"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-linkedin"></span></a></li>
                                    <li class="list-inline-item"><a href="#" target="_blank"><span
                                            class="ti-dribbble"></span></a></li>
                                </ul>
                                <p class="teacher-see-profile">
                                    <a href="#" class="btn app-store-btn">View my profile</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section--><!-- END SECTION TEAM --> 

<!--section id="Blog" class="news">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="title title-center">
					<span>News</span>
					<h2>Latest News About Us</h2>
				</div>
			</div>
			<div class="col-xl-6 offset-xl-3 col-md-8 offset-md-2">
				<span class="description-content">Onward and upward, productize the deliverables and focus on the bottom line drop-dead date translating our vision of having a market leading platfrom drop-dead date.</span>
			</div>
			<div class="col-xl-12 col-md-12">
				<article class="blog-card wow fadeInUp" data-wow-delay="0.2s">
					<a href="single-post.html" class="image"><img src="img/blog/article-1.jpg" alt="" /></a>
					<div class="article-content">
						<a href="#" class="category"><i class="far fa-folder"></i> Finance</a>
						<a href="#" class="date"><i class="far fa-clock"></i> 25.09.2018</a>
						<a href="#" class="title"><h3>Lower supply is generating high price growth</h3></a>
					</div>
				</article>
				<article class="blog-card wow fadeInUp" data-wow-delay="0.4s">
					<a href="single-post.html" class="image"><img src="img/blog/article-2.jpg" alt="" /></a>
					<div class="article-content">
						<a href="#" class="category"><i class="far fa-folder"></i> Events</a>
						<a href="#" class="date"><i class="far fa-clock"></i> 22.09.2018</a>
						<a href="#" class="title"><h3>Introduction cryptocurrency bills to Congress</h3></a>
					</div>
				</article>
				<article class="blog-card wow fadeInUp" data-wow-delay="0.6s">
					<a href="single-post.html" class="image"><img src="img/blog/article-3.jpg" alt="" /></a>
					<div class="article-content">
						<a href="#" class="category"><i class="far fa-folder"></i> Markets</a>
						<a href="#" class="date"><i class="far fa-clock"></i> 28.08.2018</a>
						<a href="#" class="title"><h3>Is relative value investing time finally here?</h3></a>
					</div>
				</article>
			</div>
			<div class="col-xl-12">
				<a href="blog.html" class="btn mt-3 mt-md-4 light_button">More News</a>
			</div>
		</div>
	</div>
</section--><!-- END SECTION BLOG -->



        </div>

<div class="client-section gray-light-bg" style="padding: 10px 0px;">
        <div class="container">
          
            <!--clients logo start-->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme clients-carousel dot-indicator">
                        <div class="item single-client">
                            <img src="we_accept.png" alt="client logo" class="client-img">
                        </div>
                      <!--  <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-02.png" alt="client logo" class="client-img">
                        </div>
                        <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-03.png" alt="client logo" class="client-img">
                        </div>
                        <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-04.png" alt="client logo" class="client-img">
                        </div>
                        <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-05.png" alt="client logo" class="client-img">
                        </div>
                        <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-06.png" alt="client logo" class="client-img">
                        </div>
                        <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-07.png" alt="client logo" class="client-img">
                        </div>
                        <div class="item single-client">
                            <img src="https://capitalgain-management.com/assets2/img/clients-logo-08.png" alt="client logo" class="client-img">
                        </div>-->
                    </div>
                </div>
            </div>
            <!--clients logo end-->
        </div>
    </div>
    <?php
include('includes/footer.php');
?>