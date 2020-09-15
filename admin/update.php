<?php include('../functions.php');
require_once('../pdoDBforTables.php');
$SearchQryParameter= $_GET["id"];
if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}?>


<?php

global $db;
if (isset($_POST['submit_btn'])) {
	submit();
}


function submit(){

	global $db, $errors, $username, $email;


	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
  $user_type   =  e($_POST['user_type']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

  global $ConnectingDB;

	// ensure that the form is correctly filled
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);

			$user_type = e($_POST['user_type']);
      $SearchQryParameter= $_GET["id"];
			$Uquery= "UPDATE users SET username='$username',email='$email',user_type='$user_type',password='$password' WHERE user_id='$SearchQryParameter'";
      $execute = $ConnectingDB->query($Uquery);
      if($execute){
        echo '<span class="success"> User updated successfully !</span> <br> <a href="show_users.php">Show users</a>';

      }

		}

	}


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Update Users</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background: #003366;
		}
	</style>

</head>
<body>
	<div class="header">
		<h2>Update user</h2>
  </div>

<?php
  global $ConnectingDB;
  $sql="SELECT *FROM users WHERE user_id='$SearchQryParameter'";
  $stmt = $ConnectingDB->query($sql);
    while($DataRows=$stmt->fetch())
    {
      $NId = $DataRows["user_id"];
      $NUsername = $DataRows["username"];
      $Nemail = $DataRows["email"];
      $Nuser_type = $DataRows["user_type"];
      $Npassword = $DataRows["password"];


    ?>

    <form method="post" action="update.php?id=<?php echo $SearchQryParameter;?>">
    	<?php echo display_error(); ?>
    	<div class="input-group">
    		<label>Username</label>
        <input type="text" name="username" value="<?php echo $NUsername; ?>">
    	</div>
    	<div class="input-group">
    		<label>Email</label>
    		<input type="email" name="email" value="<?php echo $Nemail; ?>">
    	</div>

      <div class="input-group">
  			<label>Change user type(<?php echo "Current User type is  $Nuser_type."; ?>) </label>
  			<select name="user_type" id="user_type" >

  				<option value="admin">Admin</option>
  				<option value="user">User</option>
  			</select>
  		</div>
    	<div class="input-group">
    		<label>Password</label>
    		<input type="password" name="password_1">
    	</div>
    	<div class="input-group">
    		<label>Confirm password</label>
    		<input type="password" name="password_2">
    	</div>
    	<div class="input-group">
    		<button type="submit" class="btn" name="submit_btn">Submit Changes</button>
    	</div>
    <?php } ?>



</body>
</html>
