<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];



$sql3 = mysqli_query($con, "SELECT * FROM `fx_userprofile`");   //checking no of earnings
$no_user = "0";
while($row3 = mysqli_fetch_array($sql3)){
	$no_user++;
}

$sql1 = mysqli_query($con, "SELECT * FROM `fx_investment`");   //checking no of earnings
$amount_invested = "0";
while($row1 = mysqli_fetch_array($sql1)){
	$amount_invested += $row1['amountinvested'] ;
}

$sql2 = mysqli_query($con, "SELECT * FROM `fx_deposit`");   //checking no of earnings
$amount_deposited = "0";
while($row2 = mysqli_fetch_array($sql2)){
	$amount_deposited += $row2['amount'] ;
}
$today = date("Y/m/d");


$sql4 = mysqli_query($con, "SELECT * FROM `fx_userprofile` WHERE created='$today' order by ID desc");   //checking no of investments
$rows4 = mysqli_num_rows($sql4) ;

$sql5 = mysqli_query($con, "SELECT * FROM `fx_deposit` WHERE createdat='$today' order by ID desc");   //checking no of investments
$rows5 = mysqli_num_rows($sql5) ;
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
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
              </nav>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Users</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $no_user ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Deposits</h5>
                      <span class="h3 font-weight-bold mb-0">$<?php echo $amount_deposited ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Investments</h5>
                      <span class="h3 font-weight-bold mb-0">$<?php echo $amount_invested ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
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
                  <h5 class="h3 text-white mb-0">New users Today</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-dark">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Username</th>
                      <th scope="col">Useremail</th>
                      <th scope="col">time created</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    if($rows4<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No new user registered today</span>
                      </div>
                      <?php
                    }else{
                      while($row41 = mysqli_fetch_array($sql4)){
                        $firstname =$row41["firstname"];
                        $lastname =$row41["lastname"];
                        $email =$row41["email"];
                        $created =$row41["created"];
                        echo"<tr>
                      
                        <th scope='row'>
                        $firstname $lastname
                        </th>
                        <td>
                          $email
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
      <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Deposit made today</h3>
                </div>
              </div>
            </div>
            
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if($rows5<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No deposit was made today</span>
                      </div>
                      <?php
                    }else{
                      while($row51 = mysqli_fetch_array($sql5)){
                        $gateway =$row51["gateway"];
                        $gatewayamount =$row51["gatewayamount"];
                        $depositstatus =$row51["depositstatus"];
                        
                        if($depositstatus == 0){
                          $depositstatus = "Pending";
                        }else{
                          $depositstatus = "Approved";
                        } 
                        $created =$row51["createdat"];
                        echo"<tr>
                      
                        <th scope='row'>
                        $gatewayamount $gateway
                        </th>
                        <td>
                        $depositstatus
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
<?php 
require('includes/footer.php'); 
?>     