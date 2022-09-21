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

$sql = mysqli_query($con, "SELECT * FROM `fx_earnings` WHERE userid='$userid'");
$rows = mysqli_num_rows($sql) ;
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
              <li class="breadcrumb-item"><a href="#">Earnings</a></li>
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
              <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
              <h5 class="h3 text-white mb-0">Wallet Balance</h5>
              <h1
                class="card-title h1 display-1 text-center text-white font-style-arial mb-0"
              >
                $<?php echo $userbalance;?>
              </h1>
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
              <h5 class="h3 mb-0">Earning history</h5>
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
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text"><strong>Warning!</strong> Sorry you have no earning yet choose plan to start earning today</span>
                      </div>
                      <?php
                    }else{
                      while($row = mysqli_fetch_array($sql)){
                        $plan =$row["plan"];
                        $amountearned =$row["amountearned"];
                        $created =$row["created"];
                        echo"<tr>
                      
                        <th scope='row'>
                          $plan
                        </th>
                        <td>
                        $$amountearned
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
