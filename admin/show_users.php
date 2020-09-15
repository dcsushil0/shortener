<?php include('../functions.php');
include('header.php');
require_once('../pdoDBforTables.php');
if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php"); //redirects to login page when clicked log out
}
?>




  <div class="wraper container-fluid">
     <div class="page-title">
  <h4 class="title"><a href="create_user.php">Add New User</a></h4>
	<h5 class="title"><a href="home.php"> Go back </a></h5>
     </div>
     <div class="row">
        <div class="col-md-12">
           <div class="panel panel-default">

              <div class="panel-body">
                 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="table-responsive">


                         <table class="table">
                           <thead>
                           <tr>
                             <th>ID</th>
                             <th>Username</th>
                             <th>Email</th>
                             <th>User Type</th>
                             <th> Hashed Password </th>
                             <th>Update</th>
                             <th>Delete</th>
                           </tr>
                         </thead>
                  <tbody>
<?php
  global $ConnectingDB;
	$user_id = $_SESSION['user']['user_id'];
  $sql="SELECT *FROM users WHERE user_id!=$user_id"; //selecting all rows
  $stmt = $ConnectingDB->query($sql);
    while($DataRows=$stmt->fetch())
    {
      $NId = $DataRows["user_id"];
      $NUsername = $DataRows["username"];
      $Nemail = $DataRows["email"];
      $Nuser_type = $DataRows["user_type"];
      $Npassword = $DataRows["password"]; //fetching data from tables in users table

    ?>
  <tr>
    <td> <?php echo $NId; ?>
    <td> <?php echo $NUsername;  ?> </td>
    <td> <?php echo $Nemail; ?> </td>
    <td> <?php echo $Nuser_type; ?> </td>
    <td> <?php echo $Npassword;  ?> </td>
    <td> <a href="update.php?id=<?php echo $NId; ?>">Update </a> </td>
    <td> <a href="delete.php?id=<?php echo $NId; ?>">Delete </a> </td>
  </tr>

 <?php } ?>
</tbody>

</table>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php')?>
