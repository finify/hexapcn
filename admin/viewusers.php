<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];

if (isset($_POST['deactivate']))
{
 $deactivate = $_POST['deactivate'] ;
 $userid = $_POST['userid'] ;
 $sqlquery11 = "UPDATE fx_userprofile 
	  SET activestat='$deactivate'
	  WHERE ID='$userid' " ;
    $sqlresult11 = mysqli_query($con,$sqlquery11) ;
 
}

if (isset($_POST['activate']))
{
 $activate = $_POST['activate'] ;
 $userid = $_POST['userid'] ;
 $sqlquery12 = "UPDATE fx_userprofile 
	  SET activestat='$activate'
	  WHERE ID='$userid' " ;
    $sqlresult12 = mysqli_query($con,$sqlquery12) ;
 
}

if (isset($_POST['delete']))
{
 $userid = $_POST['userid'] ;
 $sqlquery12 = "DELETE FROM fx_userprofile WHERE ID='$userid'" ;
    $sqlresult12 = mysqli_query($con,$sqlquery12) ;
}


$sql1 = mysqli_query($con, "SELECT * FROM `fx_userprofile` order by ID desc");   //checking no of investments
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
              <li class="breadcrumb-item"><a href="#">All Users</a></li>
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
        <div class="card-body" style="padding:0px;">
          <!-- Cryptocurrency Price Widget -->
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
          <div class="table-responsive">
            <!-- Projects table -->
            
            <?php 
              
              if (isset($_POST['deactivate']))
                {
                  if($sqlresult11){
            echo "
            <div class='container'><div class='alert alert-success'>Account deactivated Successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot deactivate </div></div>";
           }
          }
           ?>
           
           <?php 
              
              if (isset($_POST['activate']))
                {
                  if($sqlresult12){
            echo "
            <div class='container'><div class='alert alert-success'>Account activated Successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot activate </div></div>";
           }
          }
           ?>
           
           
           <?php 
              
              if (isset($_POST['delete']))
                {
                  if($sqlresult12){
                  echo "
                  <div class='container'><div class='alert alert-success'>Account deleted</div></div>";
                }
                else {
                      echo "<div class='container'><div class='alert alert-danger'>Couldnot delete</div></div>";
                }
                }
              ?>
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Full name</th>
                  <th scope="col">userpassword</th>
                  <th scope="col">Email</th>
                  <th scope="col">balance</th>
                  <th scope="col">Date joined</th>
                  <th scope="col">Status</th>
                  <th scope="col">actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No new user registered today</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $userid =$row11["ID"];
                        $firstname =$row11["firstname"];
                        $lastname =$row11["lastname"];
                        $email =$row11["email"];
                        $userpassword =$row11["userpassword"];
                        $created =$row11["created"];
                        $activestat =$row11["activestat"];
                        $balance =$row11["balance"];
                        
                        if($activestat == 0){
                            $useractivestat = "<form method='POST' action=''>
                          <input type='hidden' value='1'  name='deactivate'/>
                          <input type='hidden' value='$userid'  name='userid'/>
                          <input class='btn btn-success btn-sm' type='submit' value='Deactivate'></input>
                          </form> ";
                        }else{
                            $useractivestat = "<form method='POST' action=''>
                          <input type='hidden' value='0'  name='activate'/>
                          <input type='hidden' value='$userid'  name='userid'/>
                          <input class='btn btn-danger btn-sm' type='submit' value='Activate'></input>
                          </form> ";
                        }
                        
                        echo"<tr>
                      
                        <td>
                        $firstname $lastname
                        </td>
                        <td>
                        $userpassword
                        </td>
                        <td>
                        $email
                        </td>
                        <td>
                        $$balance
                        </td>
                        <td>
                        $created
                        </td>
                        <td>
                            $useractivestat
                        </td>
                        <td>
                          <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                              Actions
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                              <form method='POST' action='user.php'>
                                <input type='hidden' value='$email'  name='useremail'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' value='Email user'></input>
                              </form>
                              <form method='POST' action='bonus.php'>
                                <input type='hidden' value='$email'  name='useremail'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' value='bonus'></input>
                              </form>
                              <form method='POST' action=''>
                                <input type='hidden' value='$userid'  name='userid'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' onclick=\"return confirm('Are you sure you want to delete?');\" name='delete' value='Delete'></input>
                              </form>
                              <form method='POST' action='useredit.php'>
                                <input type='hidden' value='$email'  name='useremail'/>
                                <input class='dropdown-item btn btn-primary btn-sm' type='submit' value='view user'></input>
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
