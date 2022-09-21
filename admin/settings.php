<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail']; 

//kyc activation and deactivation
if(isset($_POST['submit2'])){

    $kyc = $_POST['kyc'] ;

    if($kyc == 1){
        $sqlquery = "UPDATE fx_settings 
          SET kyc='0'
          WHERE ID='1' " ;						
          $sqlresult = mysqli_query($con,$sqlquery) ;
    }else{
       $sqlquery = "UPDATE fx_settings 
          SET kyc='1'
          WHERE ID='1' " ;						
          $sqlresult = mysqli_query($con,$sqlquery) ; 
    }
    
  }

//updating deposit type
if(isset($_POST['submit4'])){

    $deposit_type = $_POST['deposit_type'] ;

    if($deposit_type == 1){
        $sqlquery = "UPDATE fx_settings 
          SET deposit_type='0'
          WHERE ID='1' " ;						
          $sqlresult = mysqli_query($con,$sqlquery) ;
    }else{
       $sqlquery = "UPDATE fx_settings 
          SET deposit_type='1'
          WHERE ID='1' " ;						
          $sqlresult = mysqli_query($con,$sqlquery) ; 
    }
    
  }
//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$phone_number =$row['phone_number'];
$address =$row['address'];
$location =$row['location'];
$email =$row['email'];

$kyc =$row['kyc'];
$deposit_type =$row['deposit_type'];




if(isset($_POST['submit3'])){

    $userpassword = $_POST['userpassword'] ;

    $sqlquery = "UPDATE fx_adminuser 
      SET userpassword='$userpassword'
      WHERE ID='1' " ;						
      $sqlresult = mysqli_query($con,$sqlquery) ;
  }
//Selecting current user 
$query = "SELECT * FROM `fx_adminuser` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userpassword =$row['userpassword'];











 if(isset($_POST['submit'])){

    $phone_number = $_POST['phone_number'] ;
    $address = $_POST['address'] ;
    $location = $_POST['location'] ;
    $email = $_POST['email'] ;

    $sqlquery = "UPDATE fx_settings 
      SET phone_number='$phone_number',address='$address',location='$location',email='$email'
      WHERE ID='1' " ;						
      $sqlresult = mysqli_query($con,$sqlquery) ;
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
            <li class="breadcrumb-item"><a href="#">Admin settings</a></li>
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
            <h2 class="h1 text-center text-default mb-0">Change settings</h2>
            </div>
        </div>
        </div>
        <div class="card-body">
        <?php 
        if(isset($_POST["submit"])){
          if($sqlresult){
            echo "
            <div class='container'><div class='alert alert-success'> Settings updated successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot update settings</div></div>";
           }
        }
        ?>
        
        <?php 
        if(isset($_POST["submit3"])){
          if($sqlresult){
            echo "
            <div class='container'><div class='alert alert-success'> password updated successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot update</div></div>";
           }
        }
        ?>
        <form method="POST" action="">
            <div class="pl-lg-4">
            
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Phone number</label
                    > </br>
                    <input
                    name="phone_number"
                    required
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    value="<?php echo $phone_number?>"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Address</label
                    ></br>
                    <input
                    name="address"
                    required
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    value="<?php echo $address?>"
                    />
                </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Location</label
                    ></br>
                    <input
                    name="location"
                    required
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    value="<?php echo $location?>"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >email</label
                    ></br>
                    <input
                    name="email"
                    required
                    type="email"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    value="<?php echo $email?>"
                    />
                </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <input
                    name="submit"
                    type="submit"
                    id="submit1"
                    class="form-control btn btn-primary my-4"
                    value="Update settings"
                    />
                </div>
            </div>
            </div>
        </form>
        
        <form method="POST" action="">
            <div class="pl-lg-4">
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Activate/Deactivate Kyc</label
                        ></br>
                        <?php 
                        if($kyc == 1){
                            echo '<b style="color:green; font-style:bold; font-size:30px">Active</b>';
                        }else{
                            echo '<b style="color:red; font-style:bold; font-size:30px">Not active</b>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <input name="kyc" type="hidden" value="<?php echo $kyc?>"/>
                <div class="row">
                    <div class="col-lg-12">
                        <input
                        name="submit2"
                        type="submit"
                        id="submit1"
                        class="form-control btn btn-primary my-4"
                        value="Activate / Deactivate"
                        />
                    </div>
                </div>
            </div>
        </form>

        <form method="POST" action="">
            <div class="pl-lg-4">
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Activate/Deactivate Deposit procedure</label
                        ></br>
                        <?php 
                        if($deposit_type == 0){
                            echo '<b style="color:green; font-style:bold; font-size:20px">Manually invest after deposit</b>';
                        }else{
                            echo '<b style="color:gray; font-style:bold; font-size:20px">Invest during deposit</b>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <input name="deposit_type" type="hidden" value="<?php echo $deposit_type?>"/>
                <div class="row">
                    <div class="col-lg-12">
                        <input
                        name="submit4"
                        type="submit"
                        id="submit1"
                        class="form-control btn btn-primary my-4"
                        value="Activate / Deactivate"
                        />
                    </div>
                </div>
            </div>
        </form>
        
        <form method="POST" action="">
            <div class="pl-lg-4">
            
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Admin Password</label
                    > </br>
                    <input
                    name="userpassword"
                    required
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    value="<?php echo $userpassword?>"
                    />
                </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <input
                    name="submit3"
                    type="submit"
                    id="submit"
                    class="form-control btn btn-primary my-4"
                    value="Update Password"
                    />
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
</div>
