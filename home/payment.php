<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['useremail'];

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userbalance =$row['balance'];
$userid =$row['ID'];
$firstname =$row['firstname'];
$lastname =$row['lastname'];

//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$deposit_type =$row['deposit_type'];

if($deposit_type == 0){
    //data to fill out the page
    if (isset($_POST['coinid']))
    {
      $coinid = $_POST['coinid'];
      $amount = $_POST['amount'];

      //Selecting current refer
    $query1 = "SELECT * FROM `fx_coin` WHERE ID='$coinid' ";
    $result1 = mysqli_query($con,$query1) ;
    $row1 = mysqli_fetch_array($result1);
    $coin_id =$row1['ID'];
    $coin_name =$row1['coin_name'];
    $coin_code =$row1['coin_code'];
    $coin_qr =$row1['coin_qr'];
    $coin_wallet =$row1['coin_wallet'];

    $coin_code = strtoupper($coin_code);

    $url = "https://min-api.cryptocompare.com/data/price?tsyms=USD&fsym=".$coin_code;
      $json = json_decode(file_get_contents($url));
      foreach($json as $obj){
        $avalue = $obj;
        $amountusd =  $amount;
        $coinamount = $amountusd / $avalue ;
      }

    }

    //making deposit
    if(isset($_POST["submit1"])){

      $gateway = $_POST["walletname"];
      $usdamount = $_POST["usdamount"];
      $gatewayamount = $_POST["coinamount"];
      $gatewaywallet = $_POST["coin_code"];
      $message = $_POST['message'];
      $status = "0";
      $created = date("Y/m/d");

      
      $query1 = mysqli_query($con, "INSERT INTO fx_deposit (userid,gateway,amount,gatewayamount,gatewaywallet,usermessage,depositstatus,createdat) VALUES ('$userid','$gateway','$usdamount','$gatewayamount','$gatewaywallet','$message','0','$created')");
          
          
          //mail admin for user deposit
      $to      = $site_admin_email; 

      $subject = 'New Deposit Request made by User'; 

      $message = '<html><body>';
      $message .= '<div style="background-color: #288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
      $message .= "<h1> Hi Admin</h1>";
      $message .= "<h1> This user  ". $firstname ." ". $lastname ." made a Deposit request</h1>";
      $message .= "<h2>Deposit Amount $". $usdamount ."</h2>";
      $message .= '<p>login to your account dashboard to Approve request</p>';
      $message .= '</div>';
      $message .= '<div style="margin-top:40px;"><center>';
      $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
      $message .= '</center></div>';
      $message .= "</body></html>";

      $message = wordwrap($message, 70, "\r\n");


      mailto($to, $subject, $message); 


          
      //mail user for deposit request
      $to1     = $useremail; 

      $subject1 = 'Deposit Request'; 

      $message1 = '<html><body>';
      $message1 .= '<div style="background-color: #288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
      $message1 .= "<h1> Hello ". $firstname ." ". $lastname ."</h1>";
      $message1 .= "<h2>Your Deposit request of $". $usdamount ." have been placed successfully and will be confirmed soon</h2>";
      $message1 .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
      $message1 .= '</div>';
      $message1 .= '<div style="margin-top:40px;"><center>';
      $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
      $message1 .= '</center></div>';
      $message1 .= "</body></html>";

      $message1 = wordwrap($message1, 70, "\r\n");


      mailto($to1, $subject1, $message1); 
            
    }
}else{ //what happens if deposit type is 1
  //data to fill out the page
  if (isset($_POST['coinid']))
  {
    $coinid = $_POST['coinid'];
    $amount = $_POST['amount'];

    //Selecting current refer
    $query1 = "SELECT * FROM `fx_coin` WHERE ID='$coinid' ";
    $result1 = mysqli_query($con,$query1) ;
    $row1 = mysqli_fetch_array($result1);
    $coin_id =$row1['ID'];
    $coin_name =$row1['coin_name'];
    $coin_code =$row1['coin_code'];
    $coin_qr =$row1['coin_qr'];
    $coin_wallet =$row1['coin_wallet'];

    $coin_code = strtoupper($coin_code);

    $url = "https://min-api.cryptocompare.com/data/price?tsyms=USD&fsym=".$coin_code;
      $json = json_decode(file_get_contents($url));
      foreach($json as $obj){
        $avalue = $obj;
        $amountusd =  $amount;
        $coinamount = $amountusd / $avalue ;
      }

    }
   $plan_name = $_POST["plan_name"];
   $amount = $_POST['amount'];

    //Selecting current user 
    $query = "SELECT * FROM `fx_investments_plans` WHERE plan_name='$plan_name' ";
    $result = mysqli_query($con,$query) ;
    $row12 = mysqli_fetch_array($result);
    $planid =$row12["ID"];
    $plan_name =$row12["plan_name"];
    $plan_min =$row12["plan_min"];
    $plan_max =$row12["plan_max"];
    $plan_roi =$row12["plan_roi"];
    $plan_roi_type =$row12["plan_roi_type"];
    $plan_order =$row12["plan_order"];
    $plan_duration =$row12["plan_duration"];

    $datecreated =  date("d-m-Y");
    $d=strtotime('+'.$plan_duration.' Days');
    $endingdate = date("d-m-Y", $d);

    // $plan_duration1 = $plan_duration - 1 ;
      $plan_returns = "";
    for ($x = 1; $x <= $plan_duration; $x++) {
      $d=strtotime("+$x Days");
      $nextdate = date("d-m-Y", $d);

      $plan_returns = $plan_returns. ',' . $nextdate; 
    }

    if($plan_max == ""){
      if($amount >= $plan_min){
        $status="passed";
      }else{
        $error = "Please choose a correct amount for plan selected";
      }
    }else{
      if($amount >= $plan_min && $amount <= $plan_max){
        $status="passed";
      }else{
        $error = "Please choose a correct amount for plan selected";
      }
    }

    //making deposit
    if(isset($_POST["submit1"])){

      $gateway = $_POST["walletname"];
      $usdamount = $_POST["usdamount"];
      $gatewayamount = $_POST["coinamount"];
      $gatewaywallet = $_POST["coin_code"];
      $message = $_POST['message'];
      $status = "0";
      $created = date("Y/m/d");

      $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','3','$datecreated','$endingdate','$usdamount')");

      $last_id = mysqli_insert_id($con);

      $query1 = mysqli_query($con, "INSERT INTO fx_deposit (userid,gateway,amount,gatewayamount,gatewaywallet,usermessage,depositstatus,createdat,investmentid) VALUES ('$userid','$gateway','$usdamount','$gatewayamount','$gatewaywallet','$message','0','$created',$last_id)");

      
          
          
          //mail admin for user deposit
      $to      = $site_admin_email; 

      $subject = 'New Deposit Request made by User'; 

      $message = '<html><body>';
      $message .= '<div style="background-color: #288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
      $message .= "<h1> Hi Admin</h1>";
      $message .= "<h1> This user  ". $firstname ." ". $lastname ." made a Deposit request</h1>";
      $message .= "<h2>Deposit Amount $". $usdamount ."</h2>";
      $message .= '<p>login to your account dashboard to Approve request</p>';
      $message .= '</div>';
      $message .= '<div style="margin-top:40px;"><center>';
      $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
      $message .= '</center></div>';
      $message .= "</body></html>";

      $message = wordwrap($message, 70, "\r\n");


      mailto($to, $subject, $message); 


          
      //mail user for deposit request
      $to1     = $useremail; 

      $subject1 = 'Deposit Request'; 

      $message1 = '<html><body>';
      $message1 .= '<div style="background-color: #288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
      $message1 .= "<h1> Hello ". $firstname ." ". $lastname ."</h1>";
      $message1 .= "<h2>Your Deposit request of $". $usdamount ." have been placed successfully and will be confirmed soon</h2>";
      $message1 .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
      $message1 .= '</div>';
      $message1 .= '<div style="margin-top:40px;"><center>';
      $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
      $message1 .= '</center></div>';
      $message1 .= "</body></html>";

      $message1 = wordwrap($message1, 70, "\r\n");


      mailto($to1, $subject1, $message1); 
            
    }

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
              <li class="breadcrumb-item"><a href="#">Payment Checkout</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Header end -->

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="h1 text-center text-default mb-0">Sending details</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
        <?php 
        if(isset($_POST["submit1"])){
          if($query1){
            echo "
            <center><img width='20%' height='100%' src='assets/img/uploaddone.gif'/></center>
             
            <div class='container'><div class='alert alert-success'>Your deposit order have been placed Successfully , it will be approved shortly if you have made the payment</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot Upload File</div></div>";
           }
        }else{
          ?>
          <?php
            if(isset($error)){
              echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
            }else{
            }
          ?>
          <div class="text-center">
            <img
              src="../admin/<?php echo $coin_qr;?>"
              width="200px"
              height="200px"
              class="rounded"
              alt="..."
            />
          </div>
          <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>" enctype='multipart/form-data'>
            <h1 class="h1 display-1 text-center text-default">
              <?php echo $coinamount ?> <?php echo $coin_code ?>
            </h1>
            <h3 class="h3 text-center text-default">
              Send <?php echo $coinamount ?> <?php echo $coin_code ?> (in ONE payment) to:
            </h3>
            <h3 class="h3 display-3 text-center text-red">
            <?php echo $coin_wallet ?>
            </h3>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input
                      value="<?php echo $coin_code?>"
                      name="walletname"
                      type="hidden"
                    />
                    <input
                      value="<?php echo $amount?>"
                      name="usdamount"
                      type="hidden"
                    />
                    <input
                      value="<?php echo $amount?>"
                      name="amount"
                      type="hidden"
                    />
                    <input
                      value="<?php echo $plan_name?>"
                      name="plan_name"
                      type="hidden"
                    />
                    <input
                      value="<?php echo $coinamount?>"
                      name="coinamount"
                      type="hidden"
                    />
                    <input
                      value="<?php echo $coin_code?>"
                      name="coin_code"
                      type="hidden"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                      >Message(optional)</label
                    >
                    <textarea
                        value="message"
                      name="message"
                      class="form-control"
                      id="exampleFormControlTextarea1"
                      rows="3"
                      placeholder="your message"
                    ></textarea>
                  </div>
                </div>
              </div>
              <?php
                if(isset($error)){
                }else{
                  echo '<div class="row">
                  <div class="col-lg-12">
                    <div class="text-right">
                      <input
                        name="submit1"
                        type="submit"
                        id="submit1"
                        class="form-control btn btn-primary my-4"
                        value="Complete deposit"
                      />
                    </div>
                  </div>
                </div>';
                }
              ?>
              
            </div>
          </form>
        <?php }?>
        </div>
      </div>
    </div>
  </div>

  <?php 
require('includes/footer.php'); 
?>
</div>
