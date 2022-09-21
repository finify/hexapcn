<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

if (isset($_POST['useremail']))
{
 $useremail = $_POST['useremail'] ;
}


if (isset($_POST['submit']))
{

	  $useremail = $_POST['useremail'] ;
	  $usersubject = $_POST['subject'] ;
	  $usermessage = $_POST['message'] ;
	  
	  //Selecting current user 
 $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
 $result = mysqli_query($con,$query) ;
 $row2 = mysqli_fetch_array($result);
 $firstname =$row2['firstname'];
 $lastname =$row2['lastname'];

$to      = $useremail; 

$subject = $usersubject; 

$message = '<html><body>';
$message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
$message .= "<h1> Hello {$firstname} {$lastname} </h1>";
$message .= "<p> {$usermessage} </p>";
$message .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
$message .= '</div>';
$message .= '<div style="margin-top:40px;"><center>';
$message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
$message .= '</center></div>';
$message .= "</body></html>";

$message = wordwrap($message, 70, "\r\n");


mailto($to, $subject, $message); 

//mail admin when new user registers
$to1     = $site_admin_email ; 

$subject1 = 'Email sent to user'; 

$message1 = '<html><body>';
$message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
$message1 .= "<h1> Hello Admin </h1>";
$message1 .= "<h1> You sent an email to ". $useremail ."</h1>";
$message1 .= "<h1> Email Subject: ". $usersubject ."</h1>";
$message1 .= '<p>Message Sent</p>';
$message1 .= "<p>{$usermessage}</p>";
$message1 .= '</div>';
$message1 .= '<div style="margin-top:40px;"><center>';
$message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
$message1 .= '</center></div>';
$message1 .= "</body></html>";

$message1 = wordwrap($message1, 70, "\r\n");



}
?>
<!-- Header -->
<div class="header bg-dark pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Home</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item">
                <a href="#"><i class="fas fa-home"></i></a>
              </li>
              <li class="breadcrumb-item"><a href="#">Email User</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-8">
      <div class="card bg-default">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 text-white mb-0">Email user <?php echo $useremail ?></h5>

              <?php 
              
              if (isset($_POST['submit']))
                {
                  if(mailto($to1, $subject1, $message1)){
            echo "
            <div class='container'><div class='alert alert-success'>Email Sent</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Email not sent</div></div>";
           }
          }
           ?>
              

                <form method="POST" action="">
            <div class="pl-lg-4">
            <input type='hidden' value='<?php echo $useremail ?>'  name='useremail'/>   
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Subject</label
                    >
                    <input
                    name="subject"
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                    >Write message</label
                    >
                    <textarea
                    name="message"
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    placeholder="your message"
                    ></textarea>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="text-right">
                    <input
                    name="submit"
                    type="submit"
                    id="submit1"
                    class="form-control btn btn-primary my-4"
                    value="Send Email"
                    />
                </div>
                </div>
            </div>
            </div>
        </form>
              

              
            </div>
          </div>
        </div>
        <div class="card-body"></div>
      </div>
    </div>
    <div class="col-xl-4">
    </div>
  </div>
  <?php 
require('includes/footer.php'); 
?>
</div>
