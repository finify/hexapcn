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
$withdraw_balance =$row['withdraw_balance'];
$userid =$row['ID'];
$userrefferee =$row['reffereeid'];


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

    if($withdraw_balance >= $usdamount){
      if($plan_max == ""){
        $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','0','$datecreated','$endingdate','$usdamount')"); 
        
          $newbalance = $withdraw_balance - $usdamount;
          $sqlquery = "UPDATE fx_userprofile 
          SET withdraw_balance='$newbalance'
          WHERE ID='$userid' " ;
          $sqlresult = mysqli_query($con,$sqlquery) ;
      }else{
        if($usdamount >= $plan_min && $usdamount <= $plan_max){
          $query1 = mysqli_query($con, "INSERT INTO `fx_investment` (userid,plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_returns,amount_earned,plan_status,created,endingdate,amountinvested) VALUES ('$userid','$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_returns','0','0','$datecreated','$endingdate','$usdamount')"); 

          $newbalance = $withdraw_balance - $usdamount;
          $sqlquery = "UPDATE fx_userprofile 
          SET withdraw_balance='$newbalance'
          WHERE ID='$userid' " ;
          $sqlresult = mysqli_query($con,$sqlquery) ;

        }else{
          $error = "Please choose a correct amount for plan selected";
        }
      }
    }else{
      $error = "Please you do not have sufficent balance to make this investment";
    }
}

  $sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
  $rows1 = mysqli_num_rows($sql1) ;

  //Selecting current user 
$query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$userbalance =$row['withdraw_balance'];
$userid =$row['ID'];
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
              <li class="breadcrumb-item"><a href="#">Invest</a></li>
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
              <h2 class="h1 text-center text-default mb-0">Make investment</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
        <?php 
          if(isset($_POST["submit"])){
              if(isset($sqlresult) && isset($query1)){
                echo "
                <div class='container'><div class='alert alert-success'>Your Investment have been made successfully</div></div>";
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
                    <h3>Your balance available for investing is $<?= number_format($withdraw_balance)?></h3>
                    <label style="font-size:20px;" class="form-control-label" for="input-username"
                      >Choose Plan</label
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
          

          <?php
          $sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
          $rows1 = mysqli_num_rows($sql1) ;

          if($rows1<1){?>
            <div class="alert alert-warning" role="alert">
            <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
            <span class="alert-text">No Plans Yet</span>
            </div>
          <?php }else{

           
            while($row11 = mysqli_fetch_array($sql1)){
                $categoryid =$row11["ID"];
              $category_name =$row11["category_name"];
              $category_order =$row11["category_order"];
              $datecreated =$row11["datecreated"];

              echo "<center><h1>$category_name PLANS</h1> </center>";
              echo "<div class='card-deck'>";
              
              $sql12 = mysqli_query($con, "SELECT * FROM `fx_investments_plans` WHERE plan_category='$category_name'  order by plan_order ASC");   //checking no of investments
              $rows12 = mysqli_num_rows($sql12) ;

              if($rows12<1){
                echo "<div class='alert alert-warning' role='alert'>
                <span class='alert-icon'><i class='ni ni-fat-remove'></i></span>
                <span class='alert-text'>No $category_name plan yet</span>
                </div>";
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

                  if($plan_max == ""){
                    $plan_max = "∞";
                  }

                  echo" 
                  <div class='card'>
                    <div class='text-default text-center card-header'>$plan_name PLAN</div>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                      (minimum)
                    </h4>
                    <h1
                      class='card-title h1 text-center text-default font-style-arial mb-0'
                    >
                      $$plan_min
                    </h1>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                      (maximum)
                    </h4>
                    <h1
                      class='card-title h1 display-1 text-center text-default font-style-arial mb-0'
                    >
                      $$plan_max
                    </h1>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                    $plan_roi% Profit $plan_roi_type for $plan_duration Days
                    </h4>
                    <h4
                      class='card-title h4 text-center text-default font-style-arial mb-0'
                    >
                    <i class='ni text-center ni-check-bold text-primary'></i
                          > $plan_category plan
                    </h4>
                  </div>         
                  ";
                }
              }

              echo "</div>";          
            }
          }
        ?>
        </div>
      </div>
    </div>
  </div>

  <?php 
require('includes/footer.php'); 
?>
</div>