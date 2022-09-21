<?php
session_start();
if(isset($_SESSION["username"])){
	header("Location: ../home");
	exit(); 
}
require('../includes/dbconnect.php');//DBCONNECTION
$googleerror = "";

if (isset($_POST['Email']))
{
    // removes backslashes
	$Email = stripslashes($_REQUEST['Email']);
    //escapes special characters in a string
	$Email = mysqli_real_escape_string($con,$Email);	
	$userpassword = stripslashes($_REQUEST['userpassword']);
	$userpassword = mysqli_real_escape_string($con,$userpassword);
	//Checking is user existing in the database or not
	$query = "SELECT * FROM `fx_userprofile` WHERE email='$Email' and userpassword='$userpassword' ";
	
	
	FUNCTION error(){
	echo '<form class="login col s12" METHOD="POST"  style="background-color:#2d3785; color:white;">
	
	<h3> Login to track your investment</h3>
	<br/>
    <p class="title" style="color:red;">Wrong user and password combination</p>
    <div class="row">
			<div class="input-field col s12">
				<input id="newinput" placeholder="Email" id="user" required name="Email" type="Email" class="validate">
			</div>
		</div>
		
		<div class="row">
			<div class="input-field col s12">
				<input id="newinput" placeholder="Password" id="userpass" required name="userpassword" type="password" class="validate">
			</div>
		</div>

	

		
	<center>
	Not yet a member
	<br><a style="font-size:20px; color:white;" href="../signup">Signup</a>
	<br>
	</center>
    <input type="submit" id="button" value="Login"/>
	</form>
	<footer>
	<a href="../">
		BACK TO HOMEPAGE <br>
  	</a></footer>
	</div>

	<!--  Scripts-->
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	</body>
	</html>';
	}

	FUNCTION error1(){
		echo '<form class="login col s12" METHOD="POST"  >
		
		<h3> Login to track your investment</h3>
		<br/>
		<p class="title" style="color:red;">Please Verify your not a Robot</p>
		<div class="row">
				<div class="input-field col s12">
					<input id="newinput" placeholder="Email" id="user" required name="Email" type="Email" class="validate">
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					<input id="newinput" placeholder="Password" id="userpass" required name="userpassword" type="password" class="validate">
				</div>
			</div>
	
		<center>
		Not yet a member
		<br><a style="font-size:20px; color:white;" href="../signup">Signup</a>
		<br>
		</center>
		<input type="submit" id="button" value="Login"/>
		</form>
		<footer>
		<a href="../">
			BACK TO HOMEPAGE <br>
		  </a></footer>
		</div>
	
		<!--  Scripts-->
		<script src="../js/jquery-3.4.1.min.js"></script>
		<script src="../js/materialize.js"></script>
		<script src="../js/init.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		</body>
		</html>';
		}



			$query2 = "SELECT * FROM `fx_adminuser` WHERE useremail='$Email' and userpassword='$userpassword' ";
	$result2 = mysqli_query($con,$query2) ;
	$rows2 = mysqli_num_rows($result2) ;

	$result = mysqli_query($con,$query) ;
	$rows = mysqli_num_rows($result) ;
	if($rows==1)
	{
		$_SESSION['useremail'] = $Email;
		// Redirect user to index.php
		header("Location:../home");
	}elseif($rows2==1){
		$_SESSION['fx_adminemail'] = $Email;
		// Redirect user to index.php
		header("Location:../admin");
	}else{
		require('header.php');
		error();
	}
		
            

	
}else{

	require('header.php');
?>
	<form id="loginform" class="login col s12" METHOD="POST" style="background-color:#2d3785; color:white;">
	
		<?php echo "<p class='title' style='color:red;'>$googleerror</p>" ;?>
		
		<h3> Login to track your investment</h3>
		<br/>

		<div class="row">
			<div class="input-field col s12">
				<input id="newinput" placeholder="Email" id="user" required name="Email" type="Email" class="validate">
			</div>
		</div>
		
		<div class="row">
			<div class="input-field col s12">
				<input id="newinput" placeholder="Password" id="userpass" required name="userpassword" type="password" class="validate">
			</div>
		</div>

		<input type="submit" id="button" value="Login"/>
		<center>
		Not yet registered
		<br><a style="font-size:20px; color:white;" href="../signup">Signup</a>
		<br>
		
		</center>

		
	</form>
	<footer>
	<a href="../">
      BACK TO HOMEPAGE <br>
    </a>
	</footer>
</div>

 <!--  Scripts-->
 <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
</body>
</html>
<?php } ?>
