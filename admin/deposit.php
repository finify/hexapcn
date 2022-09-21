<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

if(isset($_POST['delete'])){
  
  $depositid = $_POST['depositid'];

  //Selecting current user 
  $query = "SELECT * FROM `fx_deposit` WHERE ID='$depositid' ";
  $result = mysqli_query($con,$query) ;
  $row2 = mysqli_fetch_array($result);
  $investmentid =$row2['investmentid'];

  if($investmentid != ""){
    $sqlquery1 = "DELETE FROM fx_investment WHERE id='$investmentid' " ;
    $sqlresult1 = mysqli_query($con,$sqlquery1) ;
  }

  $sqlquery2 = "DELETE FROM fx_deposit WHERE id='$depositid' " ;
  $sqlresult2 = mysqli_query($con,$sqlquery2) ;
 
}

$sql1 = mysqli_query($con, "SELECT * FROM `fx_deposit` order by ID desc");   //checking no of investments
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
              <li class="breadcrumb-item"><a href="#">Deposits</a></li>
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
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">All Deposit</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cryptocurrency Price Widget -->
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for deposits..">
          <?php
                        if(isset($_POST["delete"])){
                          if($sqlresult1 or $sqlresult2){
                            echo "
                            <div class='alert alert-success alert-dismissible' role='alert'>
                            Deposit was deleted successfully!
                            </div>";
                          }else {
                                echo "
                                <div class='alert alert-danger alert-dismissible' role='alert'>
                                 Could not delete
                                </div>
                                ";
                          }
                          }
                      ?>
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th style="font-size: 15px;" scope="col">Username</th>
                  <th style="font-size: 15px;" scope="col">Crypto amount</th>
                  <th style="font-size: 15px;" scope="col">USDAmount</th>
                  <th style="font-size: 15px;" scope="col">Date created</th>
                  <th style="font-size: 15px;" scope="col">Status</th>
                  <th style="font-size: 15px;" scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                


                <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No deposit made yet double your hustle</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                        $userid =$row11["userid"];
                        $depositid =$row11["ID"];
                        $investmentid =$row11["investmentid"];
                        $amount =$row11["amount"];
                        $created =$row11["createdat"];
                        $proofimage =$row11["proofimage"];
                        $amount1 = number_format($amount);

                        $gateway =$row11["gateway"];
                        $gatewayamount =$row11["gatewayamount"];
                        $depositstatus =$row11["depositstatus"];
                        if($depositstatus == 0){
                          $depositstatusalert = "Pending";
                        }else{
                          $depositstatusalert = "Approved";
                        } 

                        //Selecting current user 
                        $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
                        $result = mysqli_query($con,$query) ;
                        $row2 = mysqli_fetch_array($result);
                        $firstname =$row2['firstname'];
                        $lastname =$row2['lastname'];
                        echo"<tr>
                      
                        <td>
                        $firstname $lastname
                        </td>
                        <td>
                        $gatewayamount $gateway
                        </td>
                        <td>
                        $ $amount1
                        </td>
                        <td>
                        $created
                        </td>
                        <td>
                        $depositstatusalert
                        </td>
                        <td>
                          <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Actions
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                              <form method='POST' action='userdeposit.php'>
                                <input type='hidden' value='$userid'  name='userid'/>
                                <input type='hidden' value='$gateway'  name='gateway'/>
                                <input type='hidden' value='$depositid'  name='depositid'/>
                                <input type='hidden' value='$depositstatus' name='depositstatus'/>
                                <input type='hidden' value='$gatewayamount'  name='gatewayamount'/>
                                <input type='hidden' value='$proofimage'  name='proofimage'/>
                                <input type='hidden' value='$amount'  name='usdamount'/>
                                <input type='hidden' value='$investmentid'  name='investmentid'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' value='view'></input>
                              </form>
                              <form method='POST' action=''>
                                  <input type='hidden' value='$depositid'  name='depositid'/>
                                  
                                  <input onclick=\"return confirm('Are you sure you want to delete deposit?');\" class='dropdown-item btn btn-danger' type='submit' name='delete' value='Delete'></input>
                              </form>
                            </div>
                          </div>
                        </td>
                    ";
                      echo "</tr>";   
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
