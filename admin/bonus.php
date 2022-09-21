<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['fx_adminemail'];



if (isset($_POST['useremail']))
{
 $useremail = $_POST['useremail'] ;
}

//Selecting current user 
 $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
 $result = mysqli_query($con,$query) ;
 $row2 = mysqli_fetch_array($result);
 $userrefcode =$row2['refcode'];


if (isset($_POST['submit']))
{

	  $useremail = $_POST['useremail'] ;
	  $usdamount = $_POST['usdamount'] ;
	  $usersubject = $_POST['subject'] ;
	  $usermessage = $_POST['message'] ;
	  $bonustype = $_POST['bonustype'] ;

    if($bonustype == 1){
        //Selecting current user 
        $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
        $result = mysqli_query($con,$query) ;
        $row2 = mysqli_fetch_array($result);
        $balance =$row2['balance'];
        $firstname =$row2['firstname'];
        $lastname =$row2['lastname'];
        $email =$row2['email'];
        $userid =$row2['ID'];
        $userrefcode =$row2['refcode'];
        $withdraw_balance =$row2['withdraw_balance'];
        
        $newuserbalance = $balance + $usdamount;
        
        $sqlquery1 = "UPDATE fx_userprofile 
            SET balance='$newuserbalance'
            WHERE ID='$userid' " ;
            $sqlresult1 = mysqli_query($con,$sqlquery1) ;

        $to      = $useremail; 

        $subject = $usersubject; 

        $message = '<html><body>';
        $message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
        $message .= "<h1> Hello {$firstname} {$lastname} </h1>";
        $message .= "<h1> Bonus Amount :$ {$usdamount} </h1>";
        $message .= "<p> {$usermessage} </p>";
        $message .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
        $message .= '</div>';
        $message .= '<div style="margin-top:40px;"><center>';
        $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
        $message .= '</center></div>';
        $message .= "</body></html>";

        $message = wordwrap($message, 70, "\r\n");


        mailto($to, $subject, $message); 

        //mail admin when new user registers
        $to1     = $site_admin_email; 

        $subject1 = 'Email sent to user'; 

        $message1 = '<html><body>';
        $message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
        $message1 .= "<h1> Hello Admin </h1>";
        $message1 .= "<h1> You sent an email to ". $useremail ."</h1>";
        $message1 .= "<h1> Email Subject: ". $usersubject ."</h1>";
        $message .= "<h1> Bonus Amount :${$usdamount} </h1>";
        $message1 .= '<p>Message Sent</p>';
        $message1 .= "<p>{$usermessage}</p>";
        $message1 .= '</div>';
        $message1 .= '<div style="margin-top:40px;"><center>';
        $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
        $message1 .= '</center></div>';
        $message1 .= "</body></html>";

        $message1 = wordwrap($message1, 70, "\r\n");
    }elseif($bonustype == 2){
      //Selecting current user 
    $query = "SELECT * FROM `fx_userprofile` WHERE email='$useremail' ";
    $result = mysqli_query($con,$query) ;
    $row2 = mysqli_fetch_array($result);
    $balance =$row2['balance'];
    $firstname =$row2['firstname'];
    $lastname =$row2['lastname'];
    $email =$row2['email'];
    $userid =$row2['ID'];
    $userrefcode =$row2['refcode'];
    $withdraw_balance =$row2['withdraw_balance'];
    
    $newwithdraw_balance = $withdraw_balance + $usdamount;
    
    $sqlquery1 = "UPDATE fx_userprofile 
        SET withdraw_balance='$newwithdraw_balance'
        WHERE ID='$userid' " ;
        $sqlresult1 = mysqli_query($con,$sqlquery1) ;

    $to      = $useremail; 

    $subject = $usersubject; 

    $message = '<html><body>';
    $message .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
    $message .= "<h1> Hello {$firstname} {$lastname} </h1>";
    $message .= "<h1> Bonus Amount :$ {$usdamount} </h1>";
    $message .= "<p> {$usermessage} </p>";
    $message .= "<p style='color:black;'>For more info email {$site_support_email}</p>";
    $message .= '</div>';
    $message .= '<div style="margin-top:40px;"><center>';
    $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
    $message .= '</center></div>';
    $message .= "</body></html>";

    $message = wordwrap($message, 70, "\r\n");


    mailto($to, $subject, $message); 

    //mail admin when new user registers
    $to1     = $site_admin_email; 

    $subject1 = 'Email sent to user'; 

    $message1 = '<html><body>';
    $message1 .= '<div style="background-color:#288FDD; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
    $message1 .= "<h1> Hello Admin </h1>";
    $message1 .= "<h1> You sent an email to ". $useremail ."</h1>";
    $message1 .= "<h1> Email Subject: ". $usersubject ."</h1>";
    $message1 .= "<h1> Bonus Amount :${$usdamount} </h1>";
    $message1 .= '<p>Message Sent</p>';
    $message1 .= "<p>{$usermessage}</p>";
    $message1 .= '</div>';
    $message1 .= '<div style="margin-top:40px;"><center>';
    $message .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
    $message1 .= '</center></div>';
    $message1 .= "</body></html>";

    $message1 = wordwrap($message1, 70, "\r\n");

    mailto($to1, $subject1, $message1);
    }
	  
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
              <li class="breadcrumb-item"><a href="#">Bonus</a></li>
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
    <div class="col-xl-6">
      <div class="card bg-default">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 text-white mb-0">Bonus user <?php echo $useremail ?></h5>

              <?php 
              
              if (isset($_POST['submit']))
                {
                  if($sqlresult1){
                    echo "
                    <div class='container'><div class='alert alert-success'>Bonus Sent</div></div>";
                  }
                  else {
                        echo "<div class='container'><div class='alert alert-danger'>Bonus not sent</div></div>";
                  }
                  }
                ?>
              

                <form method="POST" action="">
            <div class="pl-lg-4">
            <input type='hidden' value='<?php echo $useremail ?>'  name='useremail'/>   
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Subject</label
                    >
                    <input
                    name="subject"
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    />
                </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Amount</label
                    >
                    <input
                    name="usdamount"
                    type="number"
                    id="input-first-name"
                    class="form-control"
                    placeholder="amount"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                    >Write message</label
                    >
                    <textarea
                    name="message"
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    placeholder="your message"
                    ></textarea>
                </div>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                  <label  class="form-control-label" for="input-username"
                    >Choose bonus type</label
                  >
                  <select required name="bonustype" class="custom-select" id="inputGroupSelect02">
                    <option value='1'>balance</option>
                    <option value='2'>withdraw balance</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="text-right">
                    <input
                    name="submit"
                    type="submit"
                    id="submit1"
                    class="form-control btn btn-primary my-4"
                    value="Send Bonus"
                    />
                </div>
                </div>
            </div>
            </div>
        </form>
              

              
            </div>
          </div>
        </div>
        <div class="card-body"></div>
      </div>
    </div>
    <div class="col-xl-6">
        <h5 class="h3 mb-0" style="background-color: white; color:black;">All Referrals for this user</h5>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th style="font-size: 15px;" scope="col">username</th>
                  <th style="font-size: 15px;" scope="col">useremail</th>
                  <th style="font-size: 15px;" scope="col">refer earned</th>
                </tr>
              </thead>
              <tbody>
                <?php
                
                
                 
                $sql1 = mysqli_query($con, "SELECT * FROM `fx_userprofile` WHERE reffereeid='$userrefcode' order by ID desc");   //checking no of investments  order by ID desc
                $rows1 = mysqli_num_rows($sql1) ;
                // order by ID desc
                
                    if($rows1<1){?>
                      <div class="alert alert-warning" role="alert">
                      <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                      <span class="alert-text">No referals yet </span>
                      </div>
                      <?php
                    }else{
                      while($row11 = mysqli_fetch_array($sql1)){
                         $email =$row11['email'];
                         $firstname =$row11['firstname'];
                         $lastname =$row11['lastname'];
                         $refearned =$row11['refearned'];
                         
                        if($refearned == 0){
                          $refalert = "No";
                        }else{
                          $refalert = "Yes";
                        } 

                        echo"<tr>
                      
                        <th scope='row'>
                        $firstname $lastname
                        </th>
                        <td>
                        $email
                        </td>
                        <td>
                        $refalert
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
  <?php 
require('includes/footer.php'); 
?>
</div>
