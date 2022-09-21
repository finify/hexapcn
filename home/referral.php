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
$userrefcode =$row['refcode'];
$username =$row['username'];

$sql = mysqli_query($con, "SELECT * FROM `fx_refearnings` WHERE userid='$userid'");
$rows = mysqli_num_rows($sql) ;

$sql1 = mysqli_query($con, "SELECT * FROM `fx_userprofile` WHERE reffereeid='$userrefcode'");

$rows1 = mysqli_num_rows($sql1) ;
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
              <li class="breadcrumb-item"><a href="#">Referral</a></li>
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
              <h5 class="h3 text-white mb-0">Your Ref link</h5>
              <h4
                class="card-title text-center text-white font-style-arial mb-0"
              >
                <?= $siteurl ?>index.php?refcode=<?php echo $userrefcode;?>
              </h4>
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
              <h5 class="h3 mb-0">Referral Earning history</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">username</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text"><strong>Warning!</strong> you do not have any referral earnings yet</span>
                      </div>
                      <?php
                    }else{
                      while($row = mysqli_fetch_array($sql)){

                        $fromuser=$row['fromuser'];
                        $amount=$row['amount'];
                        $created=$row['created'];

                        $query1 = "SELECT * FROM `fx_userprofile` WHERE ID='$fromuser' ";
                        $result1 = mysqli_query($con,$query1) ;
                        $row11 = mysqli_fetch_array($result1);
                        $userreffirstname =$row11['firstname'];
                        $userreflastname =$row11['lastname'];
                        echo"<tr>
                      
                        <th scope='row'>
                          $userreffirstname $userreflastname
                        </th>
                        <td>
                        $amount
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
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">People you referred</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">username</th>
                  <th scope="col">email</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-text"><strong>Warning!</strong> you have no referral yet</span>
                      </div>
                      <?php
                    }else{
                      while($row1 = mysqli_fetch_array($sql1)){

                        $firstname=$row1['firstname'];
                        $lastname=$row1['lastname'];
                        $email=$row1['email'];

                        echo"<tr>
                      
                        <th scope='row'>
                          $firstname $lastname
                        </th>
                        <td>
                        $email
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
