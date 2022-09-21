<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail']; 



if (isset($_POST['submit']))
{

	  $coin_name = $_POST['coin_name'] ;
	  $coin_code = $_POST['coin_code'] ;
	  $coin_wallet = $_POST['coin_wallet'] ;
	  $coin_qr = $_FILES['coin_qr'] ;


$target_dir = "coin_qr/";
$target_file = $target_dir . basename($coin_qr["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$newName = $coin_name . "." . $imageFileType;
$target_file = $target_dir . $newName;
// Check if image file is a actual image or fake image
  $check = getimagesize($coin_qr["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }

// Check file size
if ($coin_qr["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($coin_qr["tmp_name"], $target_file)) {
  
    $created = date("d/m/Y");
    $query1 = "INSERT  into `fx_coin` 
      (coin_name,coin_code,coin_wallet,coin_qr,created)
      VALUES 
      ('$coin_name','$coin_code','$coin_wallet','$target_file','$created')";
      $result1 = mysqli_query($con,$query1);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

     
	  

}

if(isset($_POST['delete'])){
  
  $coinid = $_POST['coinid'];

  $sqlquery14 = "DELETE FROM fx_coin WHERE ID='$coinid' " ;
  $sqlresult14 = mysqli_query($con,$sqlquery14) ;
 
}


$sql1 = mysqli_query($con, "SELECT * FROM `fx_coin` order by ID desc");   //checking no of investments
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
            <li class="breadcrumb-item"><a href="#">coins</a></li>
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
                <h2 class="h1 text-center text-default mb-0">Create coin</h2>
                </div>
            </div>
            </div>
            <div class="card-body">
            <?php 
              
              if (isset($_POST['submit']))
                {
                  if($result1){
            echo "
            <div class='container'><div class='alert alert-success'>Coin Added successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Coin not added</div></div>";
           }
          }
           ?>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="pl-lg-4">
                
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Coin name</label
                        > </br>
                        <input
                        name="coin_name"
                        required
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Coin name"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >coin code</label
                        > </br>
                        <input
                        name="coin_code"
                        required
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="coin code"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Coin wallet id</label
                        > </br>
                        <input
                        name="coin_wallet"
                        required
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Coin wallet"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Coin qr</label
                        > </br name>
                        <input
                        name="coin_qr"
                        required
                        type="file"
                        id="input-first-name"
                        class="form-control"
                        placeholder="Coin QR"
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
                        value="Add Coin"
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
              <h5 class="h3 mb-0">All Coins</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
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
           
           
           
            <table id="myTable" class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Coin name</th>
                  <th scope="col">Coin code</th>
                  <th scope="col">coin qr</th>
                  <th scope="col">Edit</th>
                  <th scope="col">delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No Coin yet</span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                          $coinid =$row11["ID"];
                        $coin_name =$row11["coin_name"];
                        $coin_qr =$row11["coin_qr"];
                        $coin_code =$row11["coin_code"];
                        $created =$row11["created"];

                        echo"<tr>
                      
                        <td>
                       
                        $coin_name 
                        </td>
                        <td>
                        $coin_code
                        </td>
                        <td>
                        <img src='$coin_qr' width='50px'/>
                        </td>
                        <td>
                          <form method='POST' action='coinedit.php'>
                          <input type='hidden' value='$coinid'  name='coinid'/>
                          <input class='btn btn-primary btn-sm' type='submit' value='Edit'></input>
                          </form>
                        </td>
                        <td>
                          <form method='POST' action=''>
                          <input type='hidden' value='$coinid'  name='coinid'/>
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
