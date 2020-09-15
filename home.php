<?php
include('functions.php');
include('pdoDBforTables.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php'); //This function ensures user should be logged in to access this page.
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
							<li><a href="form.php">Add a new URL</a></li>
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

				<center>
					<div style="padding 30px;">
						<h2> URL Shortener </h2>
						<form method="post" action="home.php">
							<input type="text" name="input_url" placeholder="Enter your URL/Link here..." required style="width:50%; padding:10px; font-size:: 1.5em;">
							<input type="submit" name="submit_url" class="button primary" value="shorten">
						</form>
					</div>
				</center>
			</div>

<?php
if(isset($_POST['submit_url'])) //if user clicks the submit button whose name is submit_url
{
$servername="localhost";
$username="root";
$password="";
$conn= mysqli_connect($servername,$username,$password,"multi_login"); //connection to the database multi_login

$orig_url=$_POST['input_url']; //putting the value of the input_url from html to the variable
$random=substr(md5(microtime()), rand(0,26),3); //Generating random number of size 3
$short_url = "localhost/shortener/home.php?l=$random";
$user_id = $_SESSION['user']['user_id'];
$query = "INSERT INTO urltable2 (orig_url, rand_str,short_url,user_id)
			VALUES('$orig_url', '$random','$short_url','$user_id')"; //Insert the values from $orig_url and $random to the respective columns in the table
mysqli_query($conn, $query);

echo "<center><div><b>Original Link:</b> </br> $orig_url </div></center>";
echo "<center><div><b>Shortened Link:</b> </div></center>";
echo "<center><a href=http://localhost/shortener/home.php?l="."$random>localhost/shortener/home.php?l=$random</a></center>";


}

$servername="localhost";
$username="root";
$password="";
$conn= mysqli_connect($servername,$username,$password,"multi_login");

if(isset($_GET['l'])){   //getting value of L from href URL above which is random key.
  $l=mysqli_real_escape_string($conn,$_GET['l']);
	$res=mysqli_query($conn,"SELECT orig_url FROM urltable2 WHERE rand_str='$l'"); //retrieving original url whose rand_str is same as random key.
	$count=mysqli_num_rows($res);

	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$link=$row['orig_url'];
		header('location:'.$link); //redirecting the page to the original link.
		die();

	}
 }

 ?>
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
