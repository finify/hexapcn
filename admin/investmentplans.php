<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail']; 



if (isset($_POST['submit']))
{

    $plan_name = $_POST['plan_name'] ;
    $plan_min = $_POST['plan_min'] ;
    $plan_max = $_POST['plan_max'] ;
    $plan_roi = $_POST['plan_roi'] ;
    $plan_roi_type = $_POST['plan_roi_type'] ;
    $plan_duration = $_POST['plan_duration'] ;
    $plan_category = $_POST['plan_category'] ;
    $plan_order = $_POST['plan_order'] ;
    $plan_status = 1;
    $created = date("d/m/Y");

    $plan_name = strtoupper($plan_name);

    if($plan_max > $plan_min){
        $query = "SELECT * FROM `fx_investments_plans` WHERE plan_order='$plan_order' and plan_category='$plan_category' " ;
		$result = mysqli_query($con,$query);
		$rows = mysqli_num_rows($result);
		if($rows==1){ //plan order exists
            $error = "plan order already exists";
        }else{
            $query1 = "INSERT  into `fx_investments_plans` 
            (plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_category,plan_order,plan_status,date_created)
            VALUES 
            ('$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_category','$plan_order','$plan_status','$created')";
            $result1 = mysqli_query($con,$query1);
        }
    }elseif($plan_max == ""){
        $query = "SELECT * FROM `fx_investments_plans` WHERE plan_order='$plan_order'and plan_category='$plan_category' " ;
		$result = mysqli_query($con,$query);
		$rows = mysqli_num_rows($result);
		if($rows==1){ //plan order exists
            $error = "plan order already exists";
        }else{
            $query1 = "INSERT  into `fx_investments_plans` 
            (plan_name,plan_min,plan_max,plan_roi,plan_roi_type,plan_duration,plan_category,plan_order,plan_status,date_created)
            VALUES 
            ('$plan_name','$plan_min','$plan_max','$plan_roi','$plan_roi_type','$plan_duration','$plan_category','$plan_order','$plan_status','$created')";
            $result1 = mysqli_query($con,$query1);
        }
    }else{
        $error = "Plan max must be greater than plan min";
    }

      

}

if(isset($_POST['delete'])){
  
  $planid = $_POST['planid'];

  $sqlquery14 = "DELETE FROM fx_investments_plans WHERE ID='$planid' " ;
  $sqlresult14 = mysqli_query($con,$sqlquery14) ;
 
}


$sql1 = mysqli_query($con, "SELECT * FROM `fx_investments_plans` order by plan_order desc");   //checking no of investments
$rows1 = mysqli_num_rows($sql1) ;

$sql = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by ID desc");
$rows = mysqli_num_rows($sql) ;

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
            <li class="breadcrumb-item"><a href="#">Investment plans</a></li>
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
                <h2 class="h1 text-center text-default mb-0">Create a plan</h2>
                </div>
            </div>
            </div>
            <div class="card-body">
            <?php 
              
              if (isset($_POST['submit']))
                {
                    if(isset($result1)){
                echo "
                <div class='container'><div class='alert alert-success'>Coin Added successfully</div></div>";
                }
                else {
                        echo "<div class='container'><div class='alert alert-danger'>$error</div></div>";
                }
                }
            ?>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="pl-lg-4">
                
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label  class="form-control-label" for="input-username"
                        >Plan category</label
                        >
                        <select required name="plan_category" class="custom-select" id="inputGroupSelect02">
                        <?php
                            if($rows<1){?>
                            <option>No categories</option>
                            <?php
                            }else{
                            echo " <option value=''>Select coin</option>";
                            while($row1 = mysqli_fetch_array($sql)){
                                $category_id =$row1["ID"];

                                $category_name =$row1["category_name"];

                                echo"<option value='$category_name'>$category_name</option>
                                ";
                            }
                            }
                            ?>
                        </select>
                    </div>
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
                        />
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Plan Roi type (Daily returns roi percentage daily, after returns roi after plan expires)</label
                    >
                    <select required name="plan_roi_type" class="custom-select" id="inputGroupSelect02">
                        <option value='daily'>daily</option>
                        <option value='after'>after</option>
                    </select>
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
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Plan Order(eg plan with order 1 will show first, plan with order2 will show second etc)</label
                        > </br>
                        <input
                        name="plan_order"
                        required
                        type="number"
                        id="input-first-name"
                        class="form-control"
                        placeholder="plan order"
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
                        value="Add Plan"
                        />
                    </div>
                </div>
                </div>
            </form>
            
            
            </div>
        </div>
        </div>
    </div>
    <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">All Plans</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
          <div class="table-responsive">
            <!-- Projects table -->
            
            <?php 
              
              if (isset($_POST['delete']))
                {
                  if($sqlresult14){
                    echo "
                    <div class='container'><div class='alert alert-success'>Plan Deleted Successfully</div></div>";
                }
                else {
                        echo "<div class='container'><div class='alert alert-danger'>Couldnot delete plan try again </div></div>";
                }
                }
                ?>
           
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  
                  <th scope="col">category</th>
                  <th scope="col">Plan name</th>
                  <th scope="col">Plan min</th>
                  <th scope="col">Plan max</th>
                  <th scope="col">Plan roi</th>
                  <th scope="col">Plan type</th>
                  <th scope="col">Plan order</th>
                  <th scope="col">action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No Plan yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $planid =$row11["ID"];
                        $plan_name =$row11["plan_name"];
                        $plan_min =$row11["plan_min"];
                        $plan_max =$row11["plan_max"];
                        $plan_roi =$row11["plan_roi"];
                        $plan_roi_type =$row11["plan_roi_type"];
                        $plan_order =$row11["plan_order"];
                        $plan_status =$row11["plan_status"];
                        $plan_category =$row11["plan_category"];

                        echo"<tr>
                      
                        <td>
                        $plan_category
                        </td>
                        <td>
                        $plan_name 
                        </td>
                        <td>
                        $$plan_min
                        </td>
                        <td>
                        $$plan_max
                        </td>
                        <td>
                        $plan_roi %
                        </td>
                        <td>
                        $plan_roi_type
                        </td>
                        <td>
                        $plan_order
                        </td>
                        <td>
                          <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Actions
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                              <form method='POST' action='investmentplansedit.php'>
                                <input type='hidden' value='$planid'  name='planid'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' value='Edit plan'></input>
                              </form>
                              <form method='POST' action=''>
                                <input type='hidden' value='$planid'  name='planid'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' onclick=\"return confirm('Are you sure you want to delete plan?');\" name='delete' value='Delete'></input>
                              </form>
                            </div>
                          </div>
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

  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<?php 
require('includes/footer.php'); 
?>
</div>
