<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 

//Selecting settings
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$deposit_type =$row['deposit_type'];

$sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
$rows1 = mysqli_num_rows($sql1) ;


$sql = mysqli_query($con, "SELECT * FROM `fx_coin` order by ID desc");
$rows = mysqli_num_rows($sql) ;
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
              <li class="breadcrumb-item"><a href="#">Deposit</a></li>
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
              <h2 class="h1 text-center text-default mb-0">Deposit</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="payment.php">
            <div class="pl-lg-4">
              <?php
              if($deposit_type == 1){?>
                <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    
                    <label style="font-size:20px;" class="form-control-label" for="input-username"
                      >Choose plan</label
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

              <?php } ?>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">

                    <label style="font-size:25px;" class="form-control-label" for="input-username"
                      >Choose payment method</label
                    >
                    <select required name="coinid" class="custom-select" id="inputGroupSelect02">
                    <?php
                                if($rows<1){?>
                                  <option>No coin</option>
                                  <?php
                                }else{
                                   echo " <option value=''>Select coin</option>";
                                  while($row1 = mysqli_fetch_array($sql)){
                                    $coin_id =$row1["ID"];

                                    $coin_name =$row1["coin_name"];

                                    echo"<option value='$coin_id'>$coin_name</option>
                                    ";
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
                    <label style="font-size:25px;" class="form-control-label" for="input-first-name"
                      >Amount in USD</label
                    >
                    <input 
                      required 
                      type="number"
                      id="input-first-name"
                      class="form-control"
                      placeholder="Amount"
                      name="amount"
                      step="any"
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
                      value="Proceed to Deposit"
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
