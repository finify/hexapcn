<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

$sql1 = mysqli_query($con, "SELECT * FROM `fx_investment`");   //checking no of investments
$rows1 = mysqli_num_rows($sql1) ;
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
              <li class="breadcrumb-item"><a href="#">All Users</a></li>
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
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">All Investment</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cryptocurrency Price Widget -->
          
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th style="font-size: 15px;" scope="col">username</th>
                  <th style="font-size: 15px;" scope="col">plan</th>
                  <th style="font-size: 15px;" scope="col">Amount</th>
                  <th style="font-size: 15px;" scope="col">Status</th>
                  <th style="font-size: 15px;" scope="col">created</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No investment made yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                        $userid  =$row11["userid"];
                        
                        //Selecting current user 
                        $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
                        $result = mysqli_query($con,$query) ;
                        $row2 = mysqli_fetch_array($result);
                        $firstname =$row2['firstname'];
                        $lastname =$row2['lastname'];
                        
                        $plan =$row11["plan"];
                        $planstatus =$row11["planstatus"];
                        $amount =$row11["amountinvested"];
                        $created =$row11["created"];
                        echo"<tr>
                      
                        <th scope='row'>
                        $firstname $lastname 
                        </th>
                        <td>
                        $plan
                        </td>
                        <td>
                        $amount
                        </td>
                        <td>
                        $planstatus
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
