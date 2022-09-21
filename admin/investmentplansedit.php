<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail']; 


if (isset($_POST['planid']))
{
    $planid = $_POST['planid'] ;

    //Selecting current refer
    $query1 = "SELECT * FROM `fx_investments_plans` WHERE ID='$planid' ";
    $result1 = mysqli_query($con,$query1) ;
    $row1 = mysqli_fetch_array($result1);
    $planid =$row1['ID'];
    $plan_name = $row1['plan_name'] ;
    $plan_min = $row1['plan_min'] ;
    $plan_max = $row1['plan_max'] ;
    $plan_roi = $row1['plan_roi'] ;
    $plan_duration = $row1['plan_duration'] ;
}



if (isset($_POST['submit']))
{

    $planid = $_POST['planid'] ;
    $plan_name = $_POST['plan_name'] ;
    $plan_min = $_POST['plan_min'] ;
    $plan_max = $_POST['plan_max'] ;
    $plan_roi = $_POST['plan_roi'] ;
    $plan_duration = $_POST['plan_duration'] ;

    $plan_name = strtoupper($plan_name);

      $sqlquery1 = "UPDATE fx_investments_plans 
	  SET plan_name='$plan_name',plan_min='$plan_min',plan_max='$plan_max',plan_roi='$plan_roi',plan_duration='$plan_duration'
	  WHERE ID='$planid' " ;
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
            <li class="breadcrumb-item"><a href="#">edit plan</a></li>
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
                <h2 class="h1 text-center text-default mb-0">Edit plan details</h2>
                </div>
            </div>
            </div>
            <div class="card-body">
            <?php 
              
              if (isset($_POST['submit']))
                {
                  if( $sqlresult1){
            echo "
            <div class='container'><div class='alert alert-success'>Plan updated successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Coin not Updated</div></div>";
           }
          }
           ?>
           
            <form method="post" enctype="multipart/form-data" action="">
                <div class="pl-lg-4">
                <input
                        name="planid"
                        required
                        type="hidden"
                        value="<?php echo $planid; ?>"
                        />
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username"
                            >Plan name</label
                            > </br>
                                <input
                                name="plan_name"
                                required
                                type="text"
                                id="input-first-name"
                                class="form-control"
                                placeholder="Plan name"
                                value="<?=$plan_name?>"
                                />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Plan mininum</label
                        > </br>
                        <input
                        name="plan_min"
                        required
                        type="number"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Plan mininum investment"
                        value="<?=$plan_min?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Plan maximum investment (if left empty means no max limit</label
                        > </br>
                        <input
                        name="plan_max"
                        type="number"
                        id="input-first-name"
                        class="form-control"
                        placeholder="plan maximum"
                        value="<?=$plan_max?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Plan Roi in %</label
                        > </br>
                        <input
                        name="plan_roi"
                        required
                        type="number"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Plan roi"
                        value="<?=$plan_roi?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Plan Duration in days</label
                        > </br>
                        <input
                        name="plan_duration"
                        required
                        type="number"
                        id="input-first-name"
                        class="form-control"
                        placeholder="plan duration"
                        value="<?=$plan_duration?>"
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
                        value="Update Coin"
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
