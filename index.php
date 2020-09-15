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
					<h1 id="logo"><a href="index.php">Home</a></h1>
					<nav id="nav">
						<ul>
							<li><a href="register.php">Register</a></li>
							<li><a href="login.php" class="button primary">Sign in</a></li>
						</ul>
					</nav>
				</header>

				<center>
					<div style="padding 30px;">
						<h2> URL Shortener </h2>
						<form method="post" action="index.php">
							<input type="text" name="input_url" placeholder="Enter your URL/Link here..." required style="width:50%; padding:10px; font-size:: 1.5em;">
							<input type="submit" name="submit_url" class="button primary" value="shorten">
						</form>
					</div>
				</center>

<?php
if(isset($_POST['submit_url'])) //if user clicks the submit button whose name is submit_url
{
$servername="localhost";
$username="root";
$password="";
$conn= mysqli_connect($servername,$username,$password,"multi_login"); //connection to the database multi_login

$orig_url=$_POST['input_url']; //putting the value of the input_url from html form to the variable
$random=substr(md5(microtime()), rand(0,26),3); //Generating random number of size 3
$query = "INSERT INTO urltable1 (orig_url, rand_str)
			VALUES('$orig_url', '$random')"; //Insert the values from $orig_url and $random to the respective columns in the table
mysqli_query($conn, $query);

echo "<center><div><b>Original Link:</b> </br> $orig_url </div></center>";
echo "<center><div><b>Shortened Link:</b> </div></center>";
echo "<center><a href=http://localhost/shortener/"."$random>localhost/shortener/$random</a></center>"; //Displaying the shortened link


}

$servername="localhost";
$username="root";
$password="";
$conn= mysqli_connect($servername,$username,$password,"multi_login");

if(isset($_GET)){  //Getting the string from url and redirecting to the orignial url
	foreach($_GET as $key=>$val)
	{
		$l=mysqli_real_escape_string($conn,$key);
		$l=str_replace('/','',$l);

	 	$res=mysqli_query($conn,"select orig_url from urltable1 where rand_str='$l'");
		$count=mysqli_num_rows($res);
		if($count>0){
			$row=mysqli_fetch_assoc($res);
			$link=$row['orig_url'];
			header('location:'.$link);
			die();
		}
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
