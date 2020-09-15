		 <?php
		 include('functions.php');
		 include('pdoDBforTables.php');
		 if (!isLoggedIn()) {
		 	$_SESSION['msg'] = "You must log in first";
		 	header('location: login.php'); //This function ensures user should be logged in to access this page.
		 }

		 $conn=mysqli_connect('localhost','root','','multi_login');

		 if(isset($_POST['generate'])){
			$link=$_POST['link'];
			$txt=$_POST['txt'];


				$random=substr(md5(microtime()), rand(0,26),3); //Generating random string of size 3
				$shorten = "home.php?l=$random";
				$user_id = $_SESSION['user']['user_id']; //storing the session id that is current user id to the variable
				$query = "INSERT INTO urltable2 (orig_url, rand_str,short_url,txt,user_id)
							VALUES('$link', '$random','$shorten','$txt','$user_id')"; //Insert the values from $orig_url and $random to the respective columns in the table
				mysqli_query($conn, $query);
				header('location:list.php');
				die();
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

		 		
		 				<header id="header">
		 					<h1 id="logo"><a href="home.php">Home</a></h1>
		 					<nav id="nav">
		 						<ul>

		 							<li><a href="list.php" class="">Show my URLs</a></li>


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
						<link rel="stylesheet" href="assets/style.css">


						<div class="main-block">

							<form role="form" method="post">
								<div class="title">
									<i class="fas fa-pencil-alt"></i>
									<h2> Add a new link here</h2>
								</div>
								<div class="info">
									<input class="fname" type="text" name="link" placeholder="New Link" required>
									<input type="text" name="txt" placeholder="Link Name" required>


								</div>

								<button type="submit" name="generate">Save and Generate</button>
							</form>
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
