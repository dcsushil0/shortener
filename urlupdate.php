<?php
include('functions.php');
include('pdoDBforTables.php');
if (!isLoggedIn()) {
 $_SESSION['msg'] = "You must log in first";
 header('location: login.php'); //This function ensures user should be logged in to access this page.
}

$conn=mysqli_connect('localhost','root','','multi_login');
$url_id = $_GET["id"];

if(isset($_POST['save'])){
 $link=$_POST['link'];
 $random =$_POST['rand_str'];
 $short =  "home.php?l=$random";

 $txt=$_POST['txt'];
 // $count=mysqli_num_rows(mysqli_query($conn,"SELECT * from urltable2 where orig_url='$link'"));
 // if($count>0){
 // 	echo "Short Link already exist"; //This is for not storing same url


   $user_id = $_SESSION['user']['user_id']; //storing the session id that is current user id to the variable
   $query = "UPDATE urltable2 SET orig_url='$link', rand_str='$random', short_url='$short',txt='$txt' WHERE url_id='$url_id'";
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

     <!-- Header -->
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

       <?php
         global $ConnectingDB;
         $sql="SELECT *FROM urltable2 WHERE url_id='$url_id'";
         $stmt = $ConnectingDB->query($sql);
           while($DataRows=$stmt->fetch())
           {
             $orig_url = $DataRows["orig_url"];
             $short_url = $DataRows["rand_str"];
             $txt = $DataRows["txt"];

           ?>

       <div class="main-block">

         <form role="form" method="post">
           <div class="title">
             <i class="fas fa-pencil-alt"></i>
             <h2> Update link</h2>
           </div>
           <div class="info">
             <label>Link</label>
             <input class="fname" type="text" name="link" value="<?php echo $orig_url; ?>" required>
             <label>Short Url String </label>
             <input type="text" name="rand_str" value="<?php echo $short_url; ?>" required>
             <label> Link Name </label>
             <input type="text" name="txt" value="<?php echo $txt; ?>" required>


           </div>
         <?php } ?>

           <button type="submit" name="save">Save Link</button>
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
