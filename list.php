
		 <?php
		 include('functions.php');
		 if (!isLoggedIn()) {
		 	$_SESSION['msg'] = "You must log in first";
		 	header('location: login.php'); //This function ensures user should be logged in to access this page.
		 }
		 $conn=mysqli_connect('localhost','root','','multi_login');

		 if(isset($_GET['type']) && $_GET['type']=='delete'){
			$id=mysqli_real_escape_string($conn,$_GET['id']);
			mysqli_query($conn,"DELETE from urltable2 where url_id='$id'");//delete function for links
		 }
		 ?>

		 <!DOCTYPE HTML>
		<html>
		 <head>
			 <title>URL Shortener</title>
			 <meta charset="utf-8" />
			 <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
			 <link rel="stylesheet" href="assets/css/main.css" />
			 <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		 </head>
		 <body class="is-preload landing">
			 <div id="page-wrapper">

				 <!-- Header -->
					 <header id="header">
						 <h1 id="logo"><a href="home.php">Home</a></h1>
						 <nav id="nav">
							 <ul>

								 <li><a href="form.php" class="">Add a New URL</a></li>


						 <li>
							 <div>
								 <?php  if (isset($_SESSION['user'])) : ?>
									 <strong><?php echo $_SESSION['user']['username']; ?></strong>

									 <small>
										 <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
										 <a href="home.php?logout='1'" style="color: red;">logout</a>
									 </small>

								 <?php endif ?>
							 </div>
						 </li>
					 </ul>


						 </nav>
					 </header>
</div>
					 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
					 <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
					 <link rel="stylesheet" href="assets/style.css" >

					 <div class="main-block">

						 <table class="table">
 						   <thead>
 						      <tr>

 						         <th>Link name</th>
 						         <th>Original Link</th>
 						         <th>Short Link</th>


 						<th>Operation</th>
 						      </tr>
 						   </thead>
 						   <tbody>
 						<?php
						$user_id = $_SESSION['user']['user_id'];
 						$sql=mysqli_query($conn,"select * from urltable2 where user_id='$user_id'"); //Getting values from table to show all the url data for the current logged in user
 						while($row=mysqli_fetch_assoc($sql)){
 						?>
 						      <tr>
 						         <td><?php echo $row['txt']?></td>
 						         <td><a href="<?php echo $row['orig_url']?>" target="_blank"><?php echo $row['orig_url']?></a></td>
 						         <td><a href="<?php echo $row['short_url']?>"><?php echo $row['short_url']?> </a> </td>

 						<td>
 						<a href="?id=<?php echo $row['url_id']?>&type=delete">Delete</a>
					</br>
						<a href="urlupdate.php?id=<?php echo $row['url_id']?>&type=update">Update</a>





 						</td>
 						      </tr>
 						      <?php } ?>

 						   </tbody>
 						</table>

					 </div>





		<script src="assets/js/jquery.min.js"></script>
		 <script src="assets/js/jquery.scrolly.min.js"></script>
		 <script src="assets/js/jquery.dropotron.min.js"></script>
		 <script src="assets/js/jquery.scrollex.min.js"></script>
		 <script src="assets/js/browser.min.js"></script>
		 <script src="assets/js/breakpoints.min.js"></script>
		 <script src="assets/js/util.js"></script>
		 <script src="assets/js/main.js"></script>
</body>
</html>
