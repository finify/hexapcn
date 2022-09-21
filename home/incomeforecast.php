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

///send selecting benifactors profile//
if(isset($_POST["submit"])){

    $plan_name = $_POST["plan_name"];
    $usdamount = $_POST["usdamount"];

    //Selecting current user 
    $query = "SELECT * FROM `fx_investments_plans` WHERE plan_name='$plan_name' ";
    $result = mysqli_query($con,$query) ;
    $row12 = mysqli_fetch_array($result);
    $planid =$row12["ID"];
    $plan_name =$row12["plan_name"];
    $plan_min =$row12["plan_min"];
    $plan_max =$row12["plan_max"];
    $plan_roi =$row12["plan_roi"];
    $plan_roi_type =$row12["plan_roi_type"];
    $plan_order =$row12["plan_order"];
    $plan_duration =$row12["plan_duration"];

    $datecreated =  date("d-m-Y");
    $d=strtotime('+'.$plan_duration.' Days');
    $endingdate = date("d-m-Y", $d);

    // $plan_duration1 = $plan_duration - 1 ;
      $plan_returns = "";
      for ($x = 1; $x <= $plan_duration; $x++) {
          $d=strtotime("+$x Days");
          $nextdate = date("d-m-Y", $d);

          $plan_returns = $plan_returns. ',' . $nextdate; 
        }

      if($plan_max == ""){
        if($usdamount >= $plan_min){
            $amountearned = ((($plan_roi / 100)*$usdamount) * $plan_duration ) + $usdamount;
            $forcast = "You will make $$amountearned in $plan_duration days";
        }
      }else{
        if($usdamount >= $plan_min && $usdamount <= $plan_max){
            $amountearned = ((($plan_roi / 100)*$usdamount) * $plan_duration)+ $usdamount;
            $forcast = "You will make $$amountearned in $plan_duration days";
        }else{
          $error = "Please choose a correct amount for plan selected";
        }
      }
    
}

$sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
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
            <li class="breadcrumb-item"><a href="#">Income forecast</a></li>
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
            <h2 class="h1 text-center text-default mb-0">Income forecast</h2>
            </div>
        </div>
        </div>
        <div class="card-body">
        <?php 
          if(isset($_POST["submit"])){
              if(isset($forcast)){
                echo  "<div class='container'><div class='alert alert-success'>$forcast</div></div>";
              }else {
                echo "<div class='container'><div class='alert alert-danger'> $error</div></div>";
              }
          
          }
        ?>
          <form method="POST" action="">
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    
                    <label style="font-size:20px;" class="form-control-label" for="input-username"
                      >Choose investment plan</label
                    >
                    <select required name="plan_name" class="custom-select" id="inputGroupSelect02">
                    <?php
                    if($rows1<1){?>
                          <option>No plan yet</option>
                      <?php }else{

                      
                        while($row11 = mysqli_fetch_array($sql1)){
                            $categoryid =$row11["ID"];
                          $category_name =$row11["category_name"];
                          $category_order =$row11["category_order"];
                          $datecreated =$row11["datecreated"];
                          
                          echo "<option disabled>$category_name PLANS</option>";
                          
                          $sql12 = mysqli_query($con, "SELECT * FROM `fx_investments_plans` WHERE plan_category='$category_name'  order by plan_order ASC");   //checking no of investments
                          $rows12 = mysqli_num_rows($sql12) ;
                          if($rows12<1){
                            echo "<option>No $category_name plan yet</option>";
                          }else{
                            while($row12 = mysqli_fetch_array($sql12)){
                              $planid =$row12["ID"];
                              $plan_name =$row12["plan_name"];
                              $plan_min =$row12["plan_min"];
                              $plan_max =$row12["plan_max"];
                              $plan_roi =$row12["plan_roi"];
                              $plan_roi_type =$row12["plan_roi_type"];
                              $plan_order =$row12["plan_order"];
                              $plan_duration =$row12["plan_duration"];
                              $plan_status =$row12["plan_status"];
                              $plan_category =$row12["plan_category"];
                              echo"<option value='$plan_name'>$plan_name PLAN</option>";
      
                              }
                            }
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                      >Amount in USD</label
                    >
                    <input
                      required
                      type="number"
                      id="input-first-name"
                      class="form-control"
                      placeholder="Amount"
                      name="usdamount"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="text-right">
                    <input
                      type="submit"
                      id="submit1"
                      class="form-control btn bg-gradient-danger text-white my-4"
                      value="Proceed to Invest"
                      name="submit"
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

<?php 
require('includes/footer.php'); 
?>
</div>
