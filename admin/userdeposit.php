<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

if (isset($_POST['userid']))
{
 $gateway = $_POST['gateway'] ;
 $gatewayamount = $_POST['gatewayamount'] ;
 $userid = $_POST['userid'] ;
 $proofimage = $_POST['proofimage'] ;
 $depositstatus = $_POST['depositstatus'] ;
 $depositid = $_POST['depositid'] ;
 $usdamount = $_POST['usdamount'] ;
 $investmentid = $_POST['investmentid'] ;
}

//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$deposit_type =$row['deposit_type'];

if($deposit_type == 0){
    if (isset($_POST['submit']))
    {
      $usdamount = $_POST['usdamount'] ;
      $gateway = $_POST['gateway'] ;
      $gatewayamount = $_POST['gatewayamount'] ;
      $userid = $_POST['userid'] ;
      $proofimage = $_POST['proofimage'] ;
      $depositstatus = 1 ;
      $depositid = $_POST['depositid'] ;
      $userid = $_POST['userid'] ;
      
      
      //Selecting current user 
      $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
      $result = mysqli_query($con,$query) ;
      $row2 = mysqli_fetch_array($result);
      $balance =$row2['balance'];
      $firstname =$row2['firstname'];
      $lastname =$row2['lastname'];
      $email =$row2['email'];
      $reffereeid =$row2['reffereeid'];
      $refearned =$row2['refearned'];
      
      $newuserbalance = $balance + $usdamount;
      
      //Selecting current refer
      $query11 = "SELECT * FROM `fx_userprofile` WHERE refcode='$reffereeid' ";
      $result11 = mysqli_query($con,$query11) ;
      $row11 = mysqli_fetch_array($result11);
      $refereduserid =$row11['ID'];
      $refuserbalance =$row11['balance'];
      $refuserfirstname =$row11['firstname'];
      $refuserlastname =$row11['lastname'];
      $refuseremail =$row11['email'];
      
      $refearning = ($referral_commision / 100) * $usdamount;
      $newrefuserbalance = $refuserbalance + $refearning;
        $created = date("Y/m/d");




      $sqlquery1 = "UPDATE fx_userprofile 
        SET balance='$newuserbalance'
        WHERE ID='$userid' " ;
        $sqlresult1 = mysqli_query($con,$sqlquery1) ;
        
        $sqlquery2 = "UPDATE fx_deposit 
        SET amount='$usdamount', depositstatus ='1'
        WHERE ID='$depositid' " ;
        $sqlresult2 = mysqli_query($con,$sqlquery2) ;
        
      if($reffereeid === 0){
          
        }elseif($refearned === 1){
            
        }else{
          $query22 = mysqli_query($con, "INSERT INTO fx_refearnings (userid,amount,fromuser,created) VALUES ('$refereduserid','$refearning','$userid','$created')");
          $sqlquery11 = "UPDATE fx_userprofile 
          SET balance='$newrefuserbalance'
          WHERE ID='$refereduserid' " ;
          $sqlresult11 = mysqli_query($con,$sqlquery11) ;
          
          $sqlquery21 = "UPDATE fx_userprofile 
          SET refearned='1'
          WHERE ID='$userid' " ;
          $sqlresult21 = mysqli_query($con,$sqlquery21) ;
          

          //mail referee
          $to1      = $refuseremail; 

          $subject1 = 'Referral Earning'; 

          $message1 = '<html><body>';
          $message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
          $message1 .= "<h1> Hi {$refuserfirstname} {$refuserlastname}</h1>";
          $message1 .= "<h1> You earned a referral bonus of  $". $refearning ."</h1>";
          $message1 .= '<p>login to your account dashboard to see all your referral earnings</p>';
          $message1 .= '</div>';
          $message1 .= '<div style="margin-top:40px;"><center>';
          $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
          $message1 .= '</center></div>';
          $message1 .= "</body></html>";

          $message1 = wordwrap($message1, 70, "\r\n");

          mailto($to1, $subject1, $message1);  

        }

        //mail user deposit approval
        $to      = $email; 
        $subject = 'Deposit Approval'; 

        $message = '<html><body>';
        $message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
        $message .= "<h1> Hi {$firstname} {$lastname}</h1>";
        $message .= "<h1> Your Deposit of  $". $usdamount ." have been Approved and your wallet updated</h1>";
        $message .= '<p>login to your account dashboard to start Investing</p>';
        $message .= '</div>';
        $message .= '<div style="margin-top:40px;"><center>';
        $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
        $message .= '</center></div>';
        $message .= "</body></html>";

        $message = wordwrap($message, 70, "\r\n");
        mailto($to, $subject, $message);  
    }
}else{ //if deposit type is 1
  if (isset($_POST['submit']))
  {
    $usdamount = $_POST['usdamount'] ;
    $investmentid = $_POST['investmentid'] ;
    $gateway = $_POST['gateway'] ;
    $gatewayamount = $_POST['gatewayamount'] ;
    $userid = $_POST['userid'] ;
    $proofimage = $_POST['proofimage'] ;
    $depositstatus = 1 ;
    $depositid = $_POST['depositid'] ;
    $userid = $_POST['userid'] ;
    $deposit_to = $_POST['deposit_to'] ;
    
    if($deposit_to == 1){ //send to withdraw balance
      //Selecting current user 
      $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
      $result = mysqli_query($con,$query) ;
      $row2 = mysqli_fetch_array($result);
      $balance =$row2['balance'];
      $firstname =$row2['firstname'];
      $lastname =$row2['lastname'];
      $email =$row2['email'];
      $reffereeid =$row2['reffereeid'];
      $refearned =$row2['refearned'];
      $withdraw_balance =$row2['withdraw_balance'];
      
      $newwithdrawbalance = $withdraw_balance + $usdamount;
      
      //Selecting current refer
      $query11 = "SELECT * FROM `fx_userprofile` WHERE refcode='$reffereeid' ";
      $result11 = mysqli_query($con,$query11) ;
      $row11 = mysqli_fetch_array($result11);
      $refereduserid =$row11['ID'];
      $refuserbalance =$row11['balance'];
      $refuserfirstname =$row11['firstname'];
      $refuserlastname =$row11['lastname'];
      $refuseremail =$row11['email'];
      
      
      $refearning = ($referral_commision / 100) * $usdamount;
      $newrefuserbalance = $refuserbalance + $refearning;
        $created = date("Y/m/d");




        $sqlquery2 = "UPDATE fx_deposit 
        SET amount='$usdamount', depositstatus ='1'
        WHERE ID='$depositid' " ;
        $sqlresult1 = mysqli_query($con,$sqlquery2) ;

        $sqlquery3 = "UPDATE fx_userprofile 
        SET withdraw_balance='$newwithdrawbalance'
        WHERE ID='$userid' " ;
        $sqlresult3 = mysqli_query($con,$sqlquery3) ;

        $sqlquery4 = "DELETE FROM fx_investment WHERE ID='$investmentid' " ;
        $sqlresult4 = mysqli_query($con,$sqlquery4) ;


        
      if($reffereeid === 0){
          
        }elseif($refearned === 1){
            
        }else{
          $query22 = mysqli_query($con, "INSERT INTO fx_refearnings (userid,amount,fromuser,created) VALUES ('$refereduserid','$refearning','$userid','$created')");
          $sqlquery11 = "UPDATE fx_userprofile 
          SET balance='$newrefuserbalance'
          WHERE ID='$refereduserid' " ;
          $sqlresult11 = mysqli_query($con,$sqlquery11) ;
          
          $sqlquery21 = "UPDATE fx_userprofile 
          SET refearned='1'
          WHERE ID='$userid' " ;
          $sqlresult21 = mysqli_query($con,$sqlquery21) ;
          

          //mail referee
          $to1      = $refuseremail; 

          $subject1 = 'Referral Earning'; 

          $message1 = '<html><body>';
          $message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
          $message1 .= "<h1> Hi {$refuserfirstname} {$refuserlastname}</h1>";
          $message1 .= "<h1> You earned a referral bonus of  $". $refearning ."</h1>";
          $message1 .= '<p>login to your account dashboard to see all your referral earnings</p>';
          $message1 .= '</div>';
          $message1 .= '<div style="margin-top:40px;"><center>';
          $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
          $message1 .= '</center></div>';
          $message1 .= "</body></html>";

          $message1 = wordwrap($message1, 70, "\r\n");

          mailto($to1, $subject1, $message1);  

        }

        //mail user deposit approval
        $to      = $email; 
        $subject = 'Deposit Approval'; 

        $message = '<html><body>';
        $message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
        $message .= "<h1> Hi {$firstname} {$lastname}</h1>";
        $message .= "<h1> Your Deposit of  $". $usdamount ." have been Approved and your Investment have started counting.</h1>";
        $message .= '<p>login to your account dashboard to start Investing</p>';
        $message .= '</div>';
        $message .= '<div style="margin-top:40px;"><center>';
        $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
        $message .= '</center></div>';
        $message .= "</body></html>";

        $message = wordwrap($message, 70, "\r\n");
        mailto($to, $subject, $message); 

    }else{ //start counting investment
      //Selecting current user 
      $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
      $result = mysqli_query($con,$query) ;
      $row2 = mysqli_fetch_array($result);
      $balance =$row2['balance'];
      $firstname =$row2['firstname'];
      $lastname =$row2['lastname'];
      $email =$row2['email'];
      $reffereeid =$row2['reffereeid'];
      $refearned =$row2['refearned'];
      
      $newuserbalance = $balance + $usdamount;
      
      //Selecting current refer
      $query11 = "SELECT * FROM `fx_userprofile` WHERE refcode='$reffereeid' ";
      $result11 = mysqli_query($con,$query11) ;
      $row11 = mysqli_fetch_array($result11);
      $refereduserid =$row11['ID'];
      $refuserbalance =$row11['balance'];
      $refuserfirstname =$row11['firstname'];
      $refuserlastname =$row11['lastname'];
      $refuseremail =$row11['email'];
      
      $refearning = ($referral_commision / 100) * $usdamount;
      $newrefuserbalance = $refuserbalance + $refearning;
        $created = date("Y/m/d");




        $sqlquery2 = "UPDATE fx_deposit 
        SET amount='$usdamount', depositstatus ='1'
        WHERE ID='$depositid' " ;
        $sqlresult1 = mysqli_query($con,$sqlquery2) ;

        $sqlquery2 = "UPDATE fx_investment 
        SET plan_status ='0'
        WHERE ID='$investmentid' " ;
        $sqlresult2 = mysqli_query($con,$sqlquery2) ;


        
      if($reffereeid === 0){
          
        }elseif($refearned === 1){
            
        }else{
          $query22 = mysqli_query($con, "INSERT INTO fx_refearnings (userid,amount,fromuser,created) VALUES ('$refereduserid','$refearning','$userid','$created')");
          $sqlquery11 = "UPDATE fx_userprofile 
          SET balance='$newrefuserbalance'
          WHERE ID='$refereduserid' " ;
          $sqlresult11 = mysqli_query($con,$sqlquery11) ;
          
          $sqlquery21 = "UPDATE fx_userprofile 
          SET refearned='1'
          WHERE ID='$userid' " ;
          $sqlresult21 = mysqli_query($con,$sqlquery21) ;
          

          //mail referee
          $to1      = $refuseremail; 

          $subject1 = 'Referral Earning'; 

          $message1 = '<html><body>';
          $message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
          $message1 .= "<h1> Hi {$refuserfirstname} {$refuserlastname}</h1>";
          $message1 .= "<h1> You earned a referral bonus of  $". $refearning ."</h1>";
          $message1 .= '<p>login to your account dashboard to see all your referral earnings</p>';
          $message1 .= '</div>';
          $message1 .= '<div style="margin-top:40px;"><center>';
          $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
          $message1 .= '</center></div>';
          $message1 .= "</body></html>";

          $message1 = wordwrap($message1, 70, "\r\n");

          mailto($to1, $subject1, $message1);  

        }

        //mail user deposit approval
        $to      = $email; 
        $subject = 'Deposit Approval'; 

        $message = '<html><body>';
        $message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
        $message .= "<h1> Hi {$firstname} {$lastname}</h1>";
        $message .= "<h1> Your Deposit of  $". $usdamount ." have been Approved and your Investment have started counting.</h1>";
        $message .= '<p>login to your account dashboard to start Investing</p>';
        $message .= '</div>';
        $message .= '<div style="margin-top:40px;"><center>';
        $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
        $message .= '</center></div>';
        $message .= "</body></html>";

        $message = wordwrap($message, 70, "\r\n");
        mailto($to, $subject, $message); 
    }
     
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
              <li class="breadcrumb-item"><a href="#">Deposit Details</a></li>
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
    <div class="col-xl-4">
      <div class="card bg-default">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 text-white mb-0">Amount <?php echo $gatewayamount.''. $gateway ?></h5>

              <?php 
              
              if (isset($_POST['submit']))
                {
                  if($sqlresult1){
            echo "
            <div class='container'><div class='alert alert-success'>Approved Successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot Approve</div></div>";
           }
          }
           ?>
              

              <?php 
              if($depositstatus == 1){
                echo "<div class='container'><div class='alert alert-success'>Approved</div></div>";
              }else{
                if($deposit_type == 1){
                  $deposit_to = "<div class='row'>
                  <select required name='deposit_to' class='custom-select' id='inputGroupSelect02'>
                    <option value='1'>Sent to withdraw balance</option>
                    <option value='2'>Start counting investment</option>
                  </select>
                  </div>";
                }else{
                  $deposit_to = "";
                }
                echo "
                <form method='POST' action=''>
                <div class='pl-lg-4'>
                <input type='hidden' value='$userid'  name='userid'>
                <input type='hidden' value='$gateway'  name='gateway'>
                <input type='hidden' value='$depositid'  name='depositid'>
                <input type='hidden' value='$depositstatus' name='depositstatus'>
                <input type='hidden' value='$gatewayamount'  name='gatewayamount'>
                <input type='hidden' value='$proofimage'  name='proofimage'>
                <input type='hidden' value='$usdamount'  name='usdamount'>
                <input type='hidden' value='$investmentid'  name='investmentid'>
                  <div class'row'>
                      <input required disabled type='number' id='input-username' class='form-control' placeholder='amount' step='any' value='$usdamount' >
                   
                  </div>
                  $deposit_to
                  <div class='row'>
                    <div class='col-lg-12'>
                      <div class='text-right'>
                          <input type='submit' id='submit1' class='form-control btn btn-primary my-4' name='submit' value='Approve'>
                      </div>
                    </div>
                  </div>
                </div>
                
              </form>";
              }
              ?>
              

              
            </div>
          </div>
        </div>
        <div class="card-body"></div>
      </div>
    </div>
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">Deposit Proof</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cryptocurrency Price Widget -->
          <div class="text-center">
            <img
              src="../paymentproof/<?php echo $proofimage?>"
              class="img-fluid"
              alt="..."
            />
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <?php 
require('includes/footer.php'); 
?>
</div>
