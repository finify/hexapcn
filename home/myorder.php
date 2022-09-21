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

 
$sql4 = mysqli_query($con, "SELECT * FROM `fx_deposit` WHERE userid='$userid' order by ID desc");
$rows = mysqli_num_rows($sql4) ;
?>
<!-- Header -->
<div class="header pb-6" style="background-color:#288FDD;">
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
              <li class="breadcrumb-item"><a href="#">My order</a></li>
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
              <h2 class="h1 text-center text-default mb-0">Deposit Orders</h2>
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
                  <th scope="col">Status</th>
                  <th scope="col">Created</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text">You have not made any deposit yet</span>
                      </div>
                      <?php
                    }else{
                      while($row4 = mysqli_fetch_array($sql4)){
                        $gatewayamount =$row4["gatewayamount"];
                        $gateway =$row4["gateway"];
                        $created =$row4["createdat"];
                        $depositstatus =$row4["depositstatus"];
                        if($depositstatus == 0){
                          $depositstatus = "Pending";
                        }else{
                          $depositstatus = "Approved";
                        } 
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
  </div>

  <?php 
require('includes/footer.php'); 
?>
</div>
