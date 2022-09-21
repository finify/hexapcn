<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php');
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];


if (isset($_POST['submit']))
{
  $userid = $_POST['userid'] ;
  $withdrawid = $_POST['withdrawid'] ;
 $withdrawamount = $_POST['withdrawamount'] ;
 
 //Selecting current user 
 $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
 $result = mysqli_query($con,$query) ;
 $row2 = mysqli_fetch_array($result);
 $email =$row2['email'];
 $firstname =$row2['firstname'];
 $lastname =$row2['lastname'];


  $sqlquery1 = "UPDATE fx_withdrawal 
	  SET withdrawalstatus='1'
	  WHERE ID='$withdrawid' " ;
    $sqlresult1 = mysqli_query($con,$sqlquery1) ;
    

$to      = $email; 

$subject = 'Withdrawal Approval'; 

$message = '<html><body>';
$message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
$message .= "<h1> Hi ". $firstname ." ". $lastname ."</h1>";
$message .= "<h2>Your request for Withdrawal of $". $withdrawamount ." Have been approved and payment sent to your wallet</h2>";
$message .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
$message .= '</div>';
$message .= '</div>';
$message .= '<div style="margin-top:40px;"><center>';
$message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
$message .= '</center></div>';
$message .= "</body></html>";

$message = wordwrap($message, 70, "\r\n");


mailto($to, $subject, $message); 
}

if (isset($_POST['submit1']))
{
    $userid = $_POST['userid'] ;
    $withdrawid = $_POST['withdrawid'] ;
    $withdrawamount = $_POST['withdrawamount'] ;
     
    //Selecting current user 
    $query = "SELECT * FROM `fx_userprofile` WHERE email='$userid' ";
    $result = mysqli_query($con,$query) ;
    $row = mysqli_fetch_array($result);
    $userbalance =$row['balance'];
    
     $newbalance = $userbalance + $withdrawamount;
    $sqlquery = "UPDATE fx_userprofile 
	  SET balance='$newbalance'
	  WHERE ID='$userid' " ;
	  $sqlresult = mysqli_query($con,$sqlquery) ;
	  
	  $sqlquery4 = "DELETE FROM fx_withdrawal WHERE ID='$withdrawid' " ;
    $sqlresult4 = mysqli_query($con,$sqlquery4) ;
}


$sql1 = mysqli_query($con, "SELECT * FROM `fx_withdrawal` order by ID desc");   //checking no of investments
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
              <h5 class="h3 mb-0">All Withdrawal</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php 
              
              if (isset($_POST['submit']))
                {
                  if($sqlresult1){
            echo "
            <div class='container'><div class='alert alert-success'>Approved Successfully</div></div>";
           }
           else {
                echo "<div class='container'><div class='alert alert-danger'>Couldnot Approve</div></div>";
           }
          }
           ?>
               
          
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th style="font-size: 15px;" scope="col">username</th>
                  <th style="font-size: 15px;" scope="col">wallet id</th>
                  <th style="font-size: 15px;" scope="col">gateway</th>
                  <th style="font-size: 15px;" scope="col">Amount</th>
                  <th style="font-size: 15px;" scope="col">Date</th>
                  <th style="font-size: 15px;" scope="col">Status</th>
                  <th style="font-size: 15px;" scope="col">action</th>
                  <th style="font-size: 15px;" scope="col">Edit Wallet</th>
                  <th style="font-size: 15px;" scope="col">Cancel</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No withdrawal made yet </span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                        $userid =$row11["userid"];
                        $gateway =$row11["gateway"];
                        $userwalletid =$row11["userwalletid"];
                        $withdrawid =$row11["ID"];
                        $amount =$row11["amount"];
                        $created =$row11["created"];

                        $gateway =$row11["gateway"];
                        $withdrawstatus =$row11["withdrawalstatus"];
                        if($withdrawstatus == 0){
                          $withdrawstatusalert = "Pending";
                        }else{
                          $withdrawstatusalert = "Approved";
                        } 

                        //Selecting current user 
                        $query = "SELECT * FROM `fx_userprofile` WHERE ID='$userid' ";
                        $result = mysqli_query($con,$query) ;
                        $row2 = mysqli_fetch_array($result);
                        $firstname =$row2['firstname'];
                        $lastname =$row2['lastname'];
                        echo"<tr>
                      
                        <th scope='row'>
                        $firstname $lastname
                        </th>
                        <td>
                        $userwalletid
                        </td>
                        <td>
                        $gateway
                        </td>
                        <td>
                        $amount
                        </td>
                        <td>
                        $created
                        </td>
                        <td>
                        $withdrawstatusalert
                        </td>
                        <td>
                          <form method='POST' action=''>
                          <input type='hidden' value='$userid'  name='userid'/>
                          <input type='hidden' value='$gateway'  name='gateway'/>
                          <input type='hidden' value='$withdrawid'  name='withdrawid'/>
                          <input type='hidden' value='$amount' name='withdrawamount'/>
                          <input class='btn btn-primary btn-sm' type='submit' value='Approve' name='submit'></input>
                          </form>
                        </td>
                        <td>
                          <form method='POST' action='userwithdraw.php'>
                          <input type='hidden' value='$userid'  name='userid'/>
                          <input type='hidden' value='$userwalletid' name='userwalletid'/>
                          <input type='hidden' value='$withdrawid'  name='withdrawid'/>
                          <input class='btn btn-primary btn-sm' type='submit' value='Edit'></input>
                          </form>
                        </td>
                        <td>
                          <form method='POST' action=''>
                          <input type='hidden' value='$userid'  name='userid'/>
                          <input type='hidden' value='$gateway'  name='gateway'/>
                          <input type='hidden' value='$withdrawid'  name='withdrawid'/>
                          <input type='hidden' value='$amount' name='withdrawamount'/>
                          <input class='btn btn-danger btn-sm' type='submit' value='Cancel' name='submit1'></input>
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

  <?php 
require('includes/footer.php'); 
?>
</div>
