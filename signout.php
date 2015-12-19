<?php
//signout.php
ob_start();
include 'connect.php';
include 'header.php';


//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;

	echo '<div class="jumbotron" style="background: rgba(255,255,255,0.8)">
  <h1>Sign out</h1>
  <p>Succesfully signed out, thank you for visiting.</p>
  <p><a class="btn btn-success btn-lg" href="index.php" role="button">Sign In</a></p>
</div>';
}
else
{
	$newURL = "index.php";
	header('Location: '.$newURL);
}

include 'footer.php';
?>