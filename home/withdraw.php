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
$useremail =$row['email'];
$withdraw_balance =$row['withdraw_balance'];
$eth =$row['eth'];
$btc =$row['btc'];
$usdt =$row['usdt'];


//data to fill out the page
if (isset($_POST['wallettype']))
{
  $wallettype = $_POST['wallettype'];
  $btc = $_POST["btc"];
  $eth = $_POST["eth"];
  $usdt = $_POST["usdt"];

  if($wallettype == 1){
    $walletname = "BTC";
    $userwalletid = $btc;
  }elseif($wallettype == 2){
    $walletname = "ETH";
    $userwalletid = $eth;
  }elseif($wallettype == 3){
    $walletname = "USDT";
    $userwalletid = $usdt;
  }

}
// On withdraw action clicked
if(isset($_POST["submit"])){

  $usdamount = $_POST["usdamount"];
 
  
  $created = date("Y/m/d");
  $status = 0;
  
  
  $to      = $site_admin_email;  

  $subject = 'New Withdrawal Request made by User'; 

  $message = '<html><body>';
  $message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
  $message .= "<h1> Hi Admin</h1>";
  $message .= "<h1> This user  ". $firstname ." ". $lastname ." made a withdrawal request</h1>";
  $message .= "<h2>Withdrawal Amount $". $usdamount ."</h2>";
  $message .= "<h2>wallet id : ". $userwalletid ."</h2>";
  $message .= "<h2>wallet type: ". $walletname ."</h2>";
  $message .= '<p>login to your account dashboard to Approve request</p>';
  $message .= '</div>';
  $message .= '<div style="margin-top:40px;"><center>';
  $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
  $message .= '</center></div>';
  $message .= "</body></html>";

  $message = wordwrap($message, 70, "\r\n");


  mailto($to, $subject, $message); 


  //mail user for withdrawal request
  $to1     = $useremail; 

  $subject1 = 'Withdrawal Request'; 

  $message1 = '<html><body>';
  $message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
  $message1 .= "<h1> Hello ". $firstname ." ". $lastname ."</h1>";
  $message1 .= "<h2>Your Withdrawal request of $". $usdamount ." have been placed successfully and will be confirmed soon</h2>";
  $message1 .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
  $message1 .= '</div>';
  $message1 .= '<div style="margin-top:40px;"><center>';
  $message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
  $message1 .= '</center></div>';
  $message1 .= "</body></html>";

  $message1 = wordwrap($message1, 70, "\r\n");


  mailto($to1, $subject1, $message1); 




  if($withdraw_balance >= $usdamount && $usdamount >=10){
    $query1 = mysqli_query($con, "INSERT INTO fx_withdrawal (userid,gateway,amount,userwalletid ,withdrawalstatus,created) VALUES ('$userid','$walletname','$usdamount','$userwalletid','$status','$created')"); 

    $newwithdraw_balance = $withdraw_balance - $usdamount;
    $sqlquery = "UPDATE fx_userprofile 
	  SET withdraw_balance='$newwithdraw_balance'
	  WHERE ID='$userid' " ;
	  $sqlresult = mysqli_query($con,$sqlquery) ;
  }else{
    $amounterror = "Invalid amount please try again";
  }
  
  }

  
$sql4 = mysqli_query($con, "SELECT * FROM `fx_withdrawal` WHERE userid='$userid' order by ID desc");
$rows = mysqli_num_rows($sql4) ;

//Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$withdraw_balance =$row['withdraw_balance'];

?>
<!-- Header -->
<div class="header pb-6"  style="background-color:#288FDD;">
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
              <li class="breadcrumb-item"><a href="#">Withdraw</a></li>
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
              <h2 class="h1 text-center text-default mb-0">
                Withdraw from your wallet
              </h2>
            </div>
          </div>
        </div>
        <div class="card-body">
        <?php 
        if(isset($_POST["submit"])){

            if($withdraw_balance >= $usdamount && $usdamount >=10){
            if($query1){
              echo "
              <div class='container'><div class='alert alert-success'>Your Withdraw order have been placed successfully</div></div>";
            }
            else {?>
                  <div class='container'><div class='alert alert-danger'> Error occured while trying to make your investment please try again</div></div>
            <?php }
          }else{?>
            <div class='container'><div class='alert alert-danger'>Please choose a valid amount</div></div>
          <?php }
        }
          ?>
          <form method="POST" action="">
            <h2 class="h2 text-default mb-4">
              Your Balance = $<?php echo number_format($withdraw_balance) ; ?>
            </h2>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username"
                      >Withdraw payment method</label
                    >
                    <select name="wallettype" class="custom-select" id="inputGroupSelect02">
                      <option selected>Choose...</option>
                      <option value="1">Bitcoin</option>
                      <option value="2">Ethereum</option>
                      <option value="3">Usdt</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                      >Amount in USD</label
                    >
                    <input
                      name="usdamount"
                      type="number"
                      id="input-first-name"
                      class="form-control"
                      placeholder="Amount"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                      >Your wallet id will be gotten from you wallet saved during signup</label
                    >
                    <p>If you don't have any wallet set please click <a href='profile.php'>HERE>> </a>to update wallet id</p>
                    <p>wallets available are</p>
                    <ul>
                      <li>BTC:<?= $btc?></li>
                      <li>ETH:<?= $eth?></li>
                      <li>USDT:<?= $usdt?></li>
                    </ul>
                  </div>
                </div>
              </div>
              <input type="hidden" name="btc" value="<?= $btc?>">
              <input type="hidden" name="eth" value="<?= $eth?>">
              <input type="hidden" name="usdt" value="<?= $usdt?>">
              <div class="row">
                <div class="col-lg-12">
                  <div class="text-right">
                    <input
                      name="submit"
                      type="submit"
                      id="submit1"
                      class="form-control btn bg-gradient-danger text-white"
                      value="Proceed to withdraw"
                    />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">Withdraw history</h5>
            </div>
          </div>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Amount</th>
                  <th scope="col">Payment method</th>
                  <th scope="col">Wallet id</th>
                  <th scope="col">Status</th>
                  <th scope="col">created</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text"><strong>Warning!</strong> You have not made any withdrawals yet</span>
                      </div>
                      <?php
                    }else{
                      while($row4 = mysqli_fetch_array($sql4)){
                        $amount =$row4["amount"];
                        $gateway =$row4["gateway"];
                        $userwalletid =$row4["userwalletid"];
                        $amount =$row4["amount"];
                        $amount =$row4["amount"];
                        $created =$row4["created"];
                        $withdrawalstatus =$row4["withdrawalstatus"];
                        if($withdrawalstatus == 0){
                          $withdrawalstatus = "Pending";
                        }else{
                          $withdrawalstatus = "Approved";
                        }
                        echo"<tr>
                      
                        <th scope='row'>
                         $$amount
                        </th>
                        <th scope='row'>
                        $gateway
                        </th>
                        <th scope='row'>
                        $userwalletid
                        </th>
                        <td>
                         $withdrawalstatus
                        </td>
                        <td>
                         $created
                        </td>
                      </tr>             
                        ";
                      }
                    }
                    ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php 
require('includes/footer.php'); 
?>
</div>
