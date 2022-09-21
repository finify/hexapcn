<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];


if (isset($_POST['submit']))
{
 $userid = $_POST['userid'] ;

 $sqlquery12 = "UPDATE fx_kyc
	  SET kycstatus='1'
	  WHERE userid='$userid' " ;
    $sqlresult12 = mysqli_query($con,$sqlquery12) ;
 
}

// if (isset($_POST['userid']))
// {
//  $userid = $_POST['userid'] ;
//  $sqlquery4 = "DELETE FROM fx_userprofile WHERE ID='$userid' " ;
//      $sqlresult4 = mysqli_query($con,$sqlquery4) ;
 
// }

$sql1 = mysqli_query($con, "SELECT * FROM `fx_kyc` order by ID desc");   //checking no of investments
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
              <li class="breadcrumb-item"><a href="#">Users Kyc</a></li>
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
              <h5 class="h3 mb-0">All Users</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cryptocurrency Price Widget -->
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
          <div class="table-responsive">
            <!-- Projects table -->
            
            <?php 
              
              if (isset($_POST['submit']))
                    {
                      if($sqlresult12){
                echo "
                <div class='container'><div class='alert alert-success'>Kyc Activated Successfully</div></div>";
              }
              else {
                    echo "<div class='container'><div class='alert alert-danger'>Couldnot activate </div></div>";
              }
              }
              ?>
              
           
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">front image</th>
                  <th scope="col">back image</th>
                  <th scope="col">type</th>
                  <th scope="col">Action</th>
                  <th scope="col">date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No Kyc yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $userid =$row11["userid"];
                        $frontimage =$row11["frontimage"];
                        $backimage =$row11["backimage"];
                        $kycstatus =$row11["kycstatus"];
                        $kyctype =$row11["kyctype"];
                        $created =$row11["created"];
                        
                        //Selecting current user 
                         $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
                         $result = mysqli_query($con,$query) ;
                         $row2 = mysqli_fetch_array($result);
                         $balance =$row2['balance'];
                         $firstname =$row2['firstname'];
                         $lastname =$row2['lastname'];
                        
                        if($kycstatus == 0){
                            $userkycstat = "<form method='POST' action=''>
                          <input type='hidden' value='$userid'  name='userid'/>
                          <input class='btn btn-danger btn-sm' name='submit' type='submit' value='Approve'></input>
                          </form> ";
                        }else{
                            $userkycstat = "<form method='POST' action=''>
                          <input class='btn btn-success btn-sm' disabled type='submit' value='Approved'></input>
                          </form> ";
                        }
                        
                        echo"<tr>
                      
                        <td>
                        $firstname $lastname
                        </td>
                        <td>
                        <a href='../kycproof/$frontimage'>Download front</a>
                        </td>
                        <td>
                        <a href='../kycproof/$backimage'>Download back</a>
                        </td>
                        <td>
                        $kyctype
                        </td>
                        <td>
                            $userkycstat
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
