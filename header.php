<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Study at Centennial</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    <!-- Fontawesome CSS -->
     <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/font-custom.css" rel="stylesheet">
    <!-- Custom Fonts --><link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_username.php",
data:'user_name='+$("#user_name").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>

<body id="page-top" class="index">
<div class="container-fluid" id="ovarlay">
    <!-- Navigation -->
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" style="padding:3px!important" href="home.php"><div class="logo"></div></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                    <div id="userbar">
		<?php
		if($_SESSION['signed_in'])
		{
			echo '<div class="well well-sm" style="float: left; margin-right: 10px; padding: 6px ! important; background: rgba(255, 255, 255, 0.8) none repeat scroll 0px 0px;">Signed in as  <b>' . htmlentities($_SESSION['user_name']) . '</b></div> <a class="btn btn-danger item" role="button" href="signout.php">Sign out <i class="fa fa-sign-out"></i></a>';
		}
		else
		{
			echo '<a class="btn btn-default item" role="button"  style="color: #000" href="index.php"> <i class="fa fa-sign-in"></i> Sign in</a> &nbsp;or &nbsp;<a class="btn btn-success item" role="button" href="signup.php"> <i class="fa fa-user"></i>

 create an account</a>';
		}
		?>
		</div></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">
    <section id="services">
        