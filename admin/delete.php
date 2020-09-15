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
if (isset($_POST['delete_btn'])) {
	delete();
}

function delete(){
	
	global $db, $errors, $username, $email;

	// receive all input values from the form.
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
  $user_type   =  e($_POST['user_type']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

  global $ConnectingDB;
	    $SearchQryParameter= $_GET["id"];
			$Uquery= "DELETE FROM users  WHERE user_id='$SearchQryParameter'";
      $execute = $ConnectingDB->query($Uquery);
      if($execute){
        echo '<script>window.open("show_users.php?id=Record deleted succesfully !","_self") </script>';


      }
    }

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Delete User</title>
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

    <form method="post" action="delete.php?id=<?php echo $SearchQryParameter;?>">
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
  			<label>User type </label>
  			<select name="user_type" id="user_type" >

  				<option value="admin"><?php echo $Nuser_type; ?> </option>

  			</select>
  		</div>
    	<div class="input-group">
    		<label>Password</label>
    		<input type="password" name="password_1" value="<? php echo $Npassword;?>">
    	</div>

    	<div class="input-group">
    		<button type="submit" class="btn" name="delete_btn">Delete record</button>
    	</div>
    <?php } ?>



</body>
</html>
