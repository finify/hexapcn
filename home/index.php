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
$withdraw_balance =$row['withdraw_balance'];
$userid =$row['ID'];
$userfirstname =$row['firstname'];
$userlastname =$row['lastname'];
$useractivestat =$row['activestat'];

//returns will come in here
require('return.php');//automatic returns
//returns will come in here



//counting user details 
$sql1 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid'");   //checking no of investments
$sql2 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid'");   //checking no of investments
$sql3 = mysqli_query($con, "SELECT * FROM `fx_total_earned` WHERE userid='$userid'");   //checking no of earnings

$no_investment = "0";
$amount_invested = "0";
$total_amount_earned = "0";
while($row = mysqli_fetch_array($sql1)){
	$no_investment++;
}
while($row2 = mysqli_fetch_array($sql2)){
	$amount_invested+= $row2['amountinvested'] ;
}
while($row3 = mysqli_fetch_array($sql3)){
	$total_amount_earned+= $row3['amount_earned'] ;
}

$sql4 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid' order by ID desc");
$rows = mysqli_num_rows($sql4) ;

$sql5 = mysqli_query($con, "SELECT * FROM `fx_notification` WHERE userid='$userid' order by ID desc");
$rows1 = mysqli_num_rows($sql5) ;


?>
  <!-- Header -->
    <div class="header pb-6" style="background-color:#288FDD;">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h6 class="h2 text-white d-inline-block mb-0">Home</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
              </nav> </br>
              <h6 class="h2 text-white d-inline-block mb-0">
                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-air-baloon"></i>
                      </div> Hello, <?php echo $userfirstname ;?></h6>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">
          <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Wallet Balance</h5>
                      <span class="h2 font-weight-bold mb-0">$<?php echo number_format($userbalance);?></span>
                    </div>
                    
                    <a href="deposit.php" style="margin-top:10px;" class="btn mt-10 btn-block btn-sm bg-gradient-danger text-white">Make a Deposit</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Earnings</h5>
                      <span class="h3 font-weight-bold mb-0">$<?php echo number_format($total_amount_earned); ?></span>
                    </div>
                    <!--<div class="col-auto">-->
                    <!--  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">-->
                    <!--    <i class="ni ni-chart-pie-35"></i>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <a href="withdraw.php" style="margin-top:10px;" class="btn btn-block btn-sm bg-gradient-danger text-white">Request payment</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Withdrawable Balance</h5>
                      <span class="h2 font-weight-bold mb-0">$<?php echo number_format($withdraw_balance) ; ?></span>
                    </div>
                    <!--<div class="col-auto">-->
                    <!--  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">-->
                    <!--    <i class="ni ni-money-coins"></i>-->
                    <!--  </div>-->
                    <!--</div>-->
                     <a href="withdraw.php" style="margin-top:10px;" class="btn mt-10 btn-block btn-sm bg-gradient-danger text-white">Withdraw</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Invested in USD</h5>
                      <span class="h3 font-weight-bold mb-0">$<?php echo number_format($amount_invested); ?></span>
                    </div>
                    <!--<div class="col-auto">-->
                    <!--  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">-->
                    <!--    <i class="ni ni-active-40"></i>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  
                </div>
              </div>
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
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">Investment</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-dark">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">package</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Amount earned</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created</th>
                      <th scope="col">Expire</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($rows<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">Sorry you have not made any investment yet</span>
                      </div>
                      <?php
                    }else{
                      while($row4 = mysqli_fetch_array($sql4)){
                        $plan_name =$row4["plan_name"];
                        $amountinvested =$row4["amountinvested"];
                        $amount_earned =$row4["amount_earned"];
                        $plan_status =$row4["plan_status"];
                        $created =$row4["created"];
                        $endingdate =$row4["endingdate"];
                        
                        
                        if($plan_status == 0){
                          $plan_status = "<span class='bg-primary badge badge-dot p-2'>
                          <i class='bg-default'></i>
                          <span class='status'>ACTIVE</span>
                        </span>";
                        }elseif($plan_status == 3){
                          $plan_status = "<span class='bg-default badge badge-dot p-2'>
                          <i class='bg-primary'></i>
                          <span class='status'>PENDING</span>
                        </span>";
                        }else{
                          $plan_status = "<span class='bg-danger badge badge-dot p-2'>
                          <i class='bg-primary'></i>
                          <span class='status'>EXPIRED</span>
                        </span>";
                        } 
                        echo"<tr>
                      
                        <th scope='row'>
                          $plan_name
                        </th>
                        <td>
                         $$amountinvested
                        </td>
                        <td>
                         $$amount_earned
                        </td>
                        <td>
                        $plan_status
                        </td>
                        <td>
                         $created
                        </td>
                        <td>
                         $endingdate
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
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Cryptocurreny Prices(live)</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
               <!-- Cryptocurrency Price Widget --><script>!function(){var e=document.getElementsByTagName("script"),t=e[e.length-1],n=document.createElement("script");function r(){var e=crCryptocoinPriceWidget.init({base:"USD,EUR,CNY",items:"BTC,ETH,LTC,XMR",backgroundColor:"FFFFFF",streaming:"1",rounded:"1",boxShadow:"1",border:"1"});t.parentNode.insertBefore(e,t)}n.src="https://co-in.io/widget/pricelist.js?items=BTC%2CETH%2CLTC%2CXMR",n.async=!0,n.readyState?n.onreadystatechange=function(){"loaded"!=n.readyState&&"complete"!=n.readyState||(n.onreadystatechange=null,r())}:n.onload=function(){r()},t.parentNode.insertBefore(n,null)}();</script><!-- /Cryptocurrency Price Widget -->
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-default">
        	
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification"><?= $sitename ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
            	
                <div class="py-3 text-center">
                    <i class="ni ni-diamond ni-3x"></i>
                    <h4 class="heading mt-4">Welcome <?php echo $userfirstname ." ".$userlastname ;?></p>
                </div>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>
      
<?php 
require('includes/footer.php'); 
?>     
<script>
	$(document).ready(function(){
		$("#modal-notification").modal('show');
	});
	
</script>