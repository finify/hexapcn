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
	  WHERE ID='$userid' " ;
    $sqlresult12 = mysqli_query($con,$sqlquery12) ;
 
}

$sql1 = mysqli_query($con, "SELECT * FROM `fx_contact` order by ID desc");   //checking no of investments
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
              <li class="breadcrumb-item"><a href="#">Contacts</a></li>
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
              <h5 class="h3 mb-0">All Contacts message form contact us page</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cryptocurrency Price Widget -->
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
          <div class="table-responsive">
            <!-- Projects table -->
            
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">email</th>
                  <th scope="col">phone</th>
                  <th scope="col">message</th>
                  <th scope="col">date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No contacts yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $username =$row11["username"];
                          $useremail =$row11["useremail"];
                          $userphonenumber =$row11["userphonenumber"];
                          $usermessage =$row11["usermessage"];
                          $created =$row11["created"];
                        
                       
                        echo"<tr>
                      
                        <td>
                        $username
                        </td>
                        <td>
                        $useremail
                        </td>
                        <td>
                        $userphonenumber
                        </td>
                        <td>
                        $usermessage
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
