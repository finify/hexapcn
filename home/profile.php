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
$userfirstname =$row['firstname'];
$userlastname =$row['lastname'];
$useremail =$row['email'];
$btc =$row['btc'];
$eth =$row['eth'];
$usdt =$row['usdt'];

if(isset($_POST['submit'])){

  $userfirstname = stripslashes($_POST['userfirstname']);
  $userfirstname = mysqli_real_escape_string($con,$userfirstname);
  
  $useremail = stripslashes($_POST['useremail']);
  $useremail = mysqli_real_escape_string($con,$useremail);
  
  $userlastname = stripslashes($_POST['userlastname']);
	$userlastname = mysqli_real_escape_string($con,$userlastname);

  $btc = stripslashes($_POST['btc']);
	$btc = mysqli_real_escape_string($con,$btc);

  $eth = stripslashes($_POST['eth']);
	$eth = mysqli_real_escape_string($con,$eth);

  $usdt = stripslashes($_POST['usdt']);
	$usdt = mysqli_real_escape_string($con,$usdt);

  $sqlquery = "UPDATE fx_userprofile 
	SET firstname='$userfirstname',lastname='$userlastname',email='$useremail',btc='$btc',eth='$eth',usdt='$usdt'
	WHERE ID='$userid' " ;						
	$sqlresult = mysqli_query($con,$sqlquery) ;

}

?>
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= $siteurl ?>home/assets/img/profile.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <h2 class="text-white">Hello <?php echo $username;?></h2>
            <a href="#!" class="btn btn-neutral">Edit profile</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
    
      <div class="row">
      
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?= $siteurl ?>home/assets/img/profile.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/brand/favicon.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="text-center">
                <h5 class="h3">
                  <?php echo $userfirstname ." ". $userlastname?>
                </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            <?php 
        if(isset($_POST["submit"])){
          if($sqlresult){
            echo "
            <div class='container'><div class='alert alert-success'> Profile updated successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot update</div></div>";
           }
        }
        ?>
              <form method="POST" action="">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Firstname</label>
                        <input required type="text" id="input-username" class="form-control" placeholder="Firstname" name="userfirstname" value="<?php echo $userfirstname?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Lastname</label>
                        <input required type="text" id="input-email" class="form-control" placeholder="Lastname" name="userlastname" value="<?php echo $userlastname?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Useremail</label>
                        <input required type="text" id="input-first-name" class="form-control"  placeholder="Email" name="useremail" value="<?php echo $useremail?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Btc wallet</label>
                        <input required type="text" id="input-username" class="form-control" placeholder="btc wallet" name="btc" value="<?php echo $btc?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Eth wallet</label>
                        <input required type="text" id="input-email" class="form-control" placeholder="eth wallet" name="eth" value="<?php echo $eth?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Usdt wallet</label>
                        <input required type="text" id="input-username" class="form-control" placeholder="Usdt wallet" name="usdt" value="<?php echo $usdt?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="text-right">
                            <input type="submit" id="submit1" class="form-control btn bg-gradient-danger text-white my-4" name="submit" value="Update changes">
                        </div>
                    </div>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
<?php 
require('includes/footer.php'); 
?>   