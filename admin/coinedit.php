<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail']; 


if (isset($_POST['coinid']))
{
 $coinid = $_POST['coinid'] ;

 //Selecting current refer
 $query1 = "SELECT * FROM `fx_coin` WHERE ID='$coinid' ";
 $result1 = mysqli_query($con,$query1) ;
 $row1 = mysqli_fetch_array($result1);
 $coinid =$row1['ID'];
 $coin_name =$row1['coin_name'];
 $coin_code =$row1['coin_code'];
 $coin_qr =$row1['coin_qr'];
 $coin_wallet =$row1['coin_wallet'];
}



if (isset($_POST['submit']))
{

	  $coin_id = $_POST['coinid'] ;
	  $coin_name = $_POST['coin_name'] ;
	  $coin_code = $_POST['coin_code'] ;
	  $coin_wallet = $_POST['coin_wallet'] ;

      $sqlquery1 = "UPDATE fx_coin 
	  SET coin_name='$coin_name',coin_code='$coin_code',coin_wallet='$coin_wallet'
	  WHERE ID='$coin_id' " ;
    $sqlresult1 = mysqli_query($con,$sqlquery1) ;

}



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
            <li class="breadcrumb-item"><a href="#">tokens</a></li>
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
                <h2 class="h1 text-center text-default mb-0">Create token</h2>
                </div>
            </div>
            </div>
            <div class="card-body">
            <?php 
              
              if (isset($_POST['submit']))
                {
                  if( $sqlresult1){
            echo "
            <div class='container'><div class='alert alert-success'>Coin updated successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Coin not Updated</div></div>";
           }
          }
           ?>
           <center><img src="<?php echo $coin_qr;?>" width="100px"/></center>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="pl-lg-4">
                <input
                        name="coinid"
                        required
                        type="hidden"
                        id="input-first-name"
                        class="form-control"
                        placeholder="coinid"
                        value="<?php echo $coinid; ?>"
                        />
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
                        placeholder="coin name"
                        value="<?php echo $coin_name; ?>"
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
                        value="<?php echo $coin_code; ?>"
                        />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username"
                        >Coin wallet</label
                        > </br>
                        <input
                        name="coin_wallet"
                        required
                        type="text"
                        id="input-first-name"
                        class="form-control"
                        placeholder="coin wallet"
                        value="<?php echo $coin_wallet; ?>"
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
                        value="Update Coin"
                        />
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
