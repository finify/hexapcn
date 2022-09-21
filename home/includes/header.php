<?php 
require_once('../includes/settings.php'); 
require_once('../includes/dbconnect.php');//DBCONNECTION
require_once('../includes/mail.php');
$username = $_SESSION['useremail'];

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$username' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userbalance =$row['balance'];
$userid =$row['ID'];
$userfirstname =$row['firstname'];
$userlastname =$row['lastname'];
$useremail =$row['email'];
$username =$row['username'];

$uri = $_SERVER['REQUEST_URI'];

$uri = $siteurl . $uri;

$home = $siteurl."home/index.php";
$home1 = $siteurl."home/";

$deposit = $siteurl."home/deposit.php";
$earnings = $siteurl."home/earnings.php";
$incomeforecast = $siteurl."home/incomeforecast.php";
$invest = $siteurl."home/invest.php";
$investmentservices = $siteurl."home/investmentservices.php";
$kyc = $siteurl."home/kyc.php";
$payment = $siteurl."home/payment.php";
$profile = $siteurl."home/profile.php";
$myorder = $siteurl."home/myorder.php";
$referral = $siteurl."home/referral.php";
$withdraw = $siteurl."home/withdraw.php";


if($uri == $home ){
    $pagename = "Dashboard";
}elseif($uri == $home1){
    $pagename = "Dashboard";
}elseif($uri == $deposit){
    $pagename = "deposit";
}elseif($uri == $earnings){
    $pagename = "earnings";
}elseif($uri == $incomeforecast){
    $pagename = "incomeforecast";
}elseif($uri == $invest){
    $pagename = "invest";
}elseif($uri == $kyc){
    $pagename = "kyc";
}elseif($uri == $payment){
    $pagename = "payment";
}elseif($uri == $profile){
    $pagename = "profile";
}elseif($uri == $myorder){
    $pagename = "myorder";
}elseif($uri == $referral){
    $pagename = "referral";
}elseif($uri == $withdraw){
    $pagename = "withdraw";
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <title><?php echo $sitetitle ;?> - <?php echo $username ?> <?php echo $pagename ?> page</title>
  <!-- Favicon -->
  <link rel="icon" href="<?= $sitefavicon ?>" />
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head
