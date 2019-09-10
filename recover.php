<?php
	include('conn.php');
	session_start();
	if(isset($_GET['code'])){
	echo $email=$_GET['uid'];
	echo $code=$_GET['code'];
	
	function check_input($data) {
		$//data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysql_escape_string($data);
		return $data;
		}
		
	
	$pass = check_input($_POST['pwd']);
	$conpass = check_input($_POST['pwd1']);
	if($pass == $conpass){
		
	
	
	$query=mysqli_query($conn,"select * from user where email='$email'");
	$row=mysqli_fetch_array($query);

	if($row['email']==$email){
		echo $newpass  = md5($pass);
		//change the password
		mysqli_query($conn,"update user set password='$newpass' where email='$email'");
		?>
		<p>Password changed successfully</p>
		<p><a href="index.php">Login Now</a></p>
		<?php
	}
	else{
		$_SESSION['sign_msg'] = "Something went wrong. Please sign up again.";
  		header('location:signup.php');
	}
	}else{
		echo 'the Password and confirm password are not the same';
	}
	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Password Recovery App</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+San">
	<link href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">  
<style>
	#login_form{
		width:350px;
		position:relative;
		top:50px;
		margin: auto;
		padding: auto;
	}
</style>
</head>
<body>
<div class="container">
	<div id="login_form" class="well">
		<h2><center><span class="glyphicon glyphicon-lock"></span> Please Login</center></h2>
		<hr>
		<form method="POST" action="recover.php">
		New Password: <input type="text" name="pwd" class="form-control" required>
		<div style="height: 10px;"></div>		
		Confirm Password: <input type="password" name="pwd1" class="form-control" required> 
		
		<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Change Password</button> <!--No account? <a href="signup.php"> Sign up</a><br/>Login?<a href="index.php"> Click here</a>-->
		</form>
		<div style="height: 15px;"></div>
		<?php
			if(isset($_SESSION['log_msg'])){
				?>
				<div style="height: 30px;"></div>
				<div class="alert alert-danger">
					<span><center>
					<?php echo $_SESSION['log_msg'];
						unset($_SESSION['log_msg']); 
					?>
					</center></span>
				</div>
				<?php
			}
		?>
	</div>
</div>
</body>
</html>