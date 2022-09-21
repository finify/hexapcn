<?php
session_start();
if(isset($_SESSION["username"])){
	header("Location: ../home");
	exit(); 
}

if(isset($_SESSION["refcode"])){
	$refercode = $_SESSION["refcode"];
}else{
	$refercode = '';
}

// if(!isset($_GET['refcode'])){
// 	$refercode = '';
// }else{
// 	$refercode = $_GET['refcode'];
// }
require('../includes/dbconnect.php');
require('../includes/settings.php');
require('../includes/mail.php');




//complete form

	$error='';
	$form = '
<form class="login col s12" style="background-color:#2d3785; color:white;">
	<h3><p style="color:white;" class="title">Sign Up</p> </h3>
	<p>'.$error.'</p>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="Firstname" id="user" required name="firstname" type="text" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="Lastname" id="user" required name="lastname" required type="text" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="username" id="user" required name="username" required type="text" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="Email" id="user" required name="Email" type="email" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="Password" id="userpass" required name="userpassword" type="password" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="Confirm Password" id="confirm_userpass" required name="confirm_userpassword" type="password" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="btc wallet" id="confirm_userpass" name="btc" type="text" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="eth wallet" id="confirm_userpass" name="eth" type="text" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="usdt wallet" id="confirm_userpass" name="usdt" type="text" class="validate">
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<input id="newinput" placeholder="Referral code(optional)" id="confirm_userpass" name="refcode" type="text" value="'.$refercode.'" class="validate">
		</div>
	</div>
	
	
	<center>
	Already a member
	<br><a style="font-size:20px; color:white;" href="../login">Login</a>
	<br>
	</center>
	
	<input type="submit" id="button" value="Sign Up" name="submit"/>
</form>
</div> 
	
<!--  Scripts-->
</body>
</html>
	';

  
  // If form submitted, insert values into the database.
if (isset($_REQUEST['firstname']))
{
	
	
  //cleaning input for db upload
	$firstname = stripslashes($_REQUEST['firstname']);
	$firstname = mysqli_real_escape_string($con,$firstname);

	$lastname = stripslashes($_REQUEST['lastname']);
	$lastname = mysqli_real_escape_string($con,$lastname);
	
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);

	$Email = stripslashes($_REQUEST['Email']);
	$Email = mysqli_real_escape_string($con,$Email);
	
	$btc = stripslashes($_REQUEST['btc']);
	$btc = mysqli_real_escape_string($con,$btc);
	
	$eth = stripslashes($_REQUEST['eth']);
	$eth = mysqli_real_escape_string($con,$eth);
	
	$usdt = stripslashes($_REQUEST['usdt']);
	$usdt = mysqli_real_escape_string($con,$usdt);

	$userpassword = stripslashes($_REQUEST['userpassword']);
	$userpassword = mysqli_real_escape_string($con,$userpassword);

	$refcode = stripslashes($_REQUEST['refcode']);
	$refcode = mysqli_real_escape_string($con,$refcode);

    if($refcode == ""){ //if refcode is empty set to 0
	    $refcode = 0;
	}
	
	$sql5 = mysqli_query($con, "SELECT * FROM `fx_userprofile` WHERE refcode='$refcode'");
	$rows1 = mysqli_num_rows($sql5) ;

	if($rows1<1){
		$refcode = 0;
	}else{
	    //Selecting referal user 
		$query = "SELECT * FROM `fx_userprofile` WHERE refcode='$refcode' ";
		$result = mysqli_query($con,$query) ;
		$row2 = mysqli_fetch_array($result);
		$referemail =$row2['email'];
		$referfirstname =$row2['firstname'];
		$referlastname =$row2['lastname'];
		
		
	}
	
	$confirm_userpassword = stripslashes($_REQUEST['confirm_userpassword']);
	$confirm_userpassword = mysqli_real_escape_string($con,$confirm_userpassword);

	$balance = 0;
	
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
	$userrefcode = substr(str_shuffle($permitted_chars), 0,5);
  
	$created = date("Y/m/d");

	$query = "SELECT * FROM `fx_userprofile` WHERE email='$Email' or username='$username' " ;//query to select input with same details as in db
	$result = mysqli_query($con,$query);
	$rows = mysqli_num_rows($result);


	if($rows==1)//if user already exist
	{
		require('signupheader.php');
		echo "<div class='form'>
		<img src='error.png' alt='errorimage' width='100px' height='100px'/>
		<br/>
		This user is registered already <br/><br/><a href='index.php'>Try Another Email/username</a></div>
		</div>  
		</body>
		</html>";
		die();
	}else{

		if($userpassword == $confirm_userpassword){
				//insert into userprofile//
			$query1 = "INSERT  into `fx_userprofile` 
			(username,firstname,lastname,email,btc,eth,usdt,userpassword,refcode,reffereeid,balance,withdraw_balance,created)
			VALUES 
			('$username','$firstname','$lastname','$Email','$btc','$eth','$usdt','$userpassword','$userrefcode','$refcode','$balance','$balance','$created')";
			$result1 = mysqli_query($con,$query1);
			if($result1)
			{ 
				if($refcode != 0){ //if refcode is set to not 0 email
					//mail referee when new user registers
					$to2     = $referemail; 

					$subject2 = 'New Referral Registration'; 

					$message2 = '<html><body>';
					$message2 .= '<div style="background-color: #2d3785; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
					$message2 .= "<h1> Hello {$referfirstname} {$referlastname} </h1>";
					$message2 .= "<h1> You Reffered : ". $firstname ." ". $lastname ."</h1>";
					$message2 .= "<p>You will recieve {$referral_commision}% of every investment this user makes</p>";
					$message2 .= '<p style="color:black;">For more info email {$site_support_email}</p>';
					$message2 .= '</div>';
					$message2 .= '<div style="margin-top:40px;"><center>';
					$message2 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
					$message2 .= '</center></div>';
					$message2 .= "</body></html>";
					
					mailto($to2, $subject2, $message2);
				}
				$to      = $Email; 

				$subject = 'Registration Confirmation'; 

				$message = '<html><body>';
				$message .= '<div style="background-color: #2d3785; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
				$message .= "<h1> Hello {$firstname} {$lastname} </h1>";
				$message .= '<p>Your restration was successful</p>';
				$message .= '<p>Your Registration details are</p>';
				$message .= "<h2>User Email : {$Email}  </h2>";
				$message .= "<h2>User Password : {$userpassword} </h2>";
				$message .= "<p>Visit {$siteurl}login to make you first deposit and start investing</p>";
				$message .= "<p>Thanks for joining {$sitename}.</p>";
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

				$subject1 = 'New User Registration'; 

				$message1 = '<html><body>';
				$message1 .= '<div style="background-color: #2d3785; text-align: center;color: white; font-family: Arial, Helvetica, sans-serif; padding-top:20px; padding-bottom:30px;">';
				$message1 .= "<h1> Hello Admin </h1>";
				$message1 .= "<h1> User name: ". $firstname ." ". $lastname ."</h1>";
				$message1 .= '<p>User Registration details are</p>';
				$message1 .= "<h2>User Email : {$Email}  </h2>";
				$message1 .= "<h2>User Password : {$userpassword} </h2>";
				$message1 .= '</div>';
				$message1 .= '<div style="margin-top:40px;"><center>';
				$message1 .= "<img src='{$sitelogo}' alt='{$sitename}' style='width:400px'>";
				$message1 .= '</center></div>';
				$message1 .= "</body></html>";

				$message1 = wordwrap($message1, 70, "\r\n"); 

				mailto($to1, $subject1, $message1); 

				require('signupheader.php');
				echo "<div class='form'>
				<img src='success.png' alt='errorimage' width='100px' height='100px'/>
				<br/>
				Your registration was successful <br/><br/><a href='../login'>Login</a></div>
				</div>  
				</body>
				</html>";
				die();
		
			}
		}else{
			require('signupheader.php');
			echo "<div class='form'>
			<img src='error.png' alt='errorimage' width='100px' height='100px'/>
			<br/>
			Password do not match<br/><br/><a href='index.php'>Try Again</a></div>
			</div>  
			</body>
			</html>";
			die();
		}

	}
}else{
require('signupheader.php');
echo $form;
}

?>