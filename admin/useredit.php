<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

if (isset($_POST['useremail']))
{
 $useremail = $_POST['useremail'] ;
    //Selecting current user 
    $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
    $result = mysqli_query($con,$query) ;
    $row = mysqli_fetch_array($result);
    $balance =$row['balance'];
    $userid =$row['ID'];
    $firstname =$row['firstname'];
    $lastname =$row['lastname'];
    $email =$row['email'];
    $btc =$row['btc'];
    $eth =$row['eth'];
    $usdt =$row['usdt'];
    $userpassword =$row['userpassword'];
    $withdraw_balance =$row['withdraw_balance'];
}


if (isset($_POST['submit']))
{

	  $firstname = $_POST['firstname'] ;
	  $lastname = $_POST['lastname'] ;
	  $email = $_POST['email'] ;
	  $userpassword = $_POST['userpassword'] ;
	  $btc = $_POST['btc'] ;
	  $eth = $_POST['eth'] ;
	  $usdt = $_POST['usdt'] ;
	  
    $sqlquery = "UPDATE fx_userprofile 
        SET firstname='$firstname',lastname='$lastname',email='$email',btc='$btc',eth='$eth',usdt='$usdt',userpassword='$userpassword'
        WHERE ID='$userid' " ;						
        $sqlresult = mysqli_query($con,$sqlquery) ;
}

$sql4 = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid' order by ID desc");
$rows = mysqli_num_rows($sql4) ;

$sql1 = mysqli_query($con, "SELECT * FROM `fx_deposit` WHERE userid='$userid' order by ID desc");
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
              <li class="breadcrumb-item"><a href="#">Edit User</a></li>
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
    <div class="col-xl-6">
      <div class="card bg-default">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 text-white mb-0">Edit user details <?php echo $useremail ?></h5>

              <?php 
              
              if (isset($_POST['submit']))
                {
                  if($sqlresult){
                    echo "
                    <div class='container'><div class='alert alert-success'>Updated Successfully</div></div>";
                }
                else {
                        echo "<div class='container'><div class='alert alert-danger'>Not updated successfully</div></div>";
                }
                }
                ?>
              

            <form method="POST" action="">
                <div class="pl-lg-4">
                <input type='hidden' value='<?php echo $useremail ?>'  name='useremail'/>   
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >first name</label
                        >
                        <input
                        name="firstname"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="firstname"
                        value="<?= $firstname?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >last name</label
                        >
                        <input
                        name="lastname"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="lastname"
                        value="<?= $lastname?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >email</label
                        >
                        <input
                        name="email"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="email"
                        value="<?= $email?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >user password</label
                        >
                        <input
                        name="userpassword"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="userpassword"
                        value="<?= $userpassword?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >btc wallet</label
                        >
                        <input
                        name="btc"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="btc"
                        value="<?= $btc?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >eth wallet</label
                        >
                        <input
                        name="eth"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="eth"
                        value="<?= $eth?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >usdt wallet</label
                        >
                        <input
                        name="usdt"
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="usdt"
                        value="<?= $usdt?>"
                        />
                    </div>
                    </div>
                </div>
                <input type="hidden" value="<?=$useremail?>" name="useremail">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="text-right">
                        <input
                        name="submit"
                        type="submit"
                        id="submit1"
                        class="form-control btn btn-primary my-4"
                        value="Update user"
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
    </div>
    <div class="col-xl-6">
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
                        if($rows1<1){?>
                        <div class="alert alert-warning" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text">You have not made any deposit yet</span>
                        </div>
                        <?php
                        }else{
                        while($row1 = mysqli_fetch_array($sql1)){
                            $gatewayamount =$row1["gatewayamount"];
                            $gateway =$row1["gateway"];
                            $created =$row1["createdat"];
                            $depositstatus =$row1["depositstatus"];
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
