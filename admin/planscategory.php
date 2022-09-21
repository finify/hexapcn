<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail']; 



if (isset($_POST['submit']))
{

	  $category_name = $_POST['category_name'] ;
	  $category_order = $_POST['category_order'] ;
      $category_name = strtoupper($category_name);
      $created = date("d/m/Y");

      $query = "SELECT * FROM `fx_plan_category` WHERE category_order='$category_order' OR category_name='$category_name' " ;
		$result = mysqli_query($con,$query);
		$rows = mysqli_num_rows($result);
		if($rows==1){ //plan order exists
            $error = "Category exists";
        }else{
            $query1 = "INSERT  into `fx_plan_category` 
            (category_name,category_order,datecreated)
            VALUES 
            ('$category_name','$category_order','$created')";
            $result1 = mysqli_query($con,$query1);
        }

      

}

if(isset($_POST['delete'])){
  
  $categoryid = $_POST['categoryid'];

  $sqlquery14 = "DELETE FROM fx_plan_category WHERE ID='$categoryid' " ;
  $sqlresult14 = mysqli_query($con,$sqlquery14) ;
 
}


$sql1 = mysqli_query($con, "SELECT * FROM `fx_plan_category` order by category_order ASC");   //checking no of investments
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
            <li class="breadcrumb-item"><a href="#">Investment plans Categories</a></li>
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
                <h2 class="h1 text-center text-default mb-0">Create investment plan category</h2>
                </div>
            </div>
            </div>
            <div class="card-body">
            <?php 
              
              if (isset($_POST['submit']))
                {
                        if(isset($result1)){
                    echo "
                    <div class='container'><div class='alert alert-success'>Category Added successfully</div></div>";
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
                        <label class="form-control-label" for="input-username"
                        >Category name</label
                        > </br>
                        <input
                        name="category_name"
                        required
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Category name"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Category order (determines how categories are displayed)</label
                        > </br>
                        <input
                        name="category_order"
                        required
                        type="number"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Category order"
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
                        value="Add Category"
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
              <h5 class="h3 mb-0">All Categories</h5>
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
                    <div class='container'><div class='alert alert-success'>Category Deleted Successfully</div></div>";
                }
                else {
                        echo "<div class='container'><div class='alert alert-danger'>Category couldn't delete </div></div>";
                }
                }
                ?>
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Category name</th>
                  <th scope="col">Category order</th>
                  <th scope="col">created</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No Category yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $categoryid =$row11["ID"];
                        $category_name =$row11["category_name"];
                        $category_order =$row11["category_order"];
                        $datecreated =$row11["datecreated"];

                        echo"<tr>
                      
                        <td>
                        $category_name 
                        </td>
                        <td>
                        $category_order 
                        </td>
                        <td>
                        $datecreated
                        </td>
                        <td>
                          <form method='POST' action=''>
                          <input type='hidden' value='$categoryid'  name='categoryid'/>
                          <input class='btn btn-danger btn-sm' name='delete' type='submit' value='delete'></input>
                          </form>
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
