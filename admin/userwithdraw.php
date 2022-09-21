<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

if (isset($_POST['userid']))
{
 $userid = $_POST['userid'] ;
 $userwalletid = $_POST['userwalletid'] ;
 $withdrawid = $_POST['withdrawid'] ;
}


if (isset($_POST['submit']))
{
 $withdrawid = $_POST['withdrawid'] ;
 $userwalletid = $_POST['userwalletid'] ;
 $sqlquery1 = "UPDATE fx_withdrawal 
	  SET userwalletid='$userwalletid'
	  WHERE ID='$withdrawid' " ;
    $sqlresult1 = mysqli_query($con,$sqlquery1) ;

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
              <li class="breadcrumb-item"><a href="#">Change wallet</a></li>
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

              <?php 
              
              if (isset($_POST['submit']))
                {
                  if($sqlresult1){
            echo "
            <div class='container'><div class='alert alert-success'>Updated</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Not updated</div></div>";
           }
          }
           ?>
              

              <?php 
              if($depositstatus == 1){
                echo "<div class='container'><div class='alert alert-success'>Approved</div></div>";
              }else{
                echo "
                <form method='POST' action=''>
                <div class='pl-lg-4'>
                <input type='hidden' value='$userid'  name='userid'>
                <input type='hidden' value='$userwalletid'  name='userwalletid'>
                <input type='hidden' value='$withdrawid'  name='withdrawid'>
                  <div class'row'>
                    <div class='col-lg-12'>
                      <div class='form-group'>
                        <label class='text-white form-control-label' for='input-username'>wallet address</label>
                        <input required type='text' id='input-username' class='form-control' value='$userwalletid' step='any'name='userwalletid' >
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-lg-12'>
                      <div class='text-right'>
                          <input type='submit' id='submit1' class='form-control btn btn-primary my-4' name='submit' value='change'>
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
    
  </div>
  <?php 
require('includes/footer.php'); 
?>
</div>
