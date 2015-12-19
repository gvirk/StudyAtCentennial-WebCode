<?php
//create_topic.php
ob_start();
include 'connect.php';
include 'header.php';


if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	$newURL = "index.php";
	header('Location: '.$newURL);
}
else
{
    
					echo '<div class="row"><div class="greeting"><div style="padding:0 0 20px;"><script type="text/javascript">
        var day = new Date();
        var hr = day.getHours();
        if (hr >= 5 && hr < 12) {
            document.write("Good morning! ");;
        }
        if (hr >= 12 && hr < 17) {
            document.write("Good Afernoon! ");
        }
        if (hr >= 17 && hr < 22) {
            document.write("Good Evening! ");
        }
        if (hr == 22 || hr == 23 || hr == 0 || hr == 1 || hr == 2 || hr == 3 || hr == 4) {
            document.write("Welcome! ");
        }
        </script><span class="user_sign">' . $_SESSION['user_name'] . ' </span>Good to see you !!</div> 
                    </br><div class="row">
                    <div class="col-md-4">
                    <a href="forum.php">
                    <div class="option_box">
                    <i class="fa fa-comments cstfa"></i>
                    <div class="caption"><div class="capt">Forum</div>
                    </div>
                    </div>
                    </a>
    </div>
    
    <div class="col-md-4">
        <div class="option_box"><a href="sem.php">
<i class="fa fa-book cstfa"></i><div class="caption"><div class="capt">Course Info</div></div></a></div>
    </div>
    <div class="col-md-4">
    <div class="option_box">
    <a href="events.php">
    <i class="fa fa-calendar cstfa"></i>
    <div class="caption">
    <div class="capt">Events</div></div></div></a>
    </div>
    <style>
    .option_box{
    text-align: center; 
    box-shadow: 0px 0px 0px 1px rgb(0, 0, 0) inset, 0px 5px 30px rgb(0, 0, 0) inset; 
    margin: 0px 20px; 
    padding: 10px;
    background:rgba(255, 255, 255, 0.5) none repeat scroll 0 0;
    }
 .option_box:hover{
    text-align: center; 
    box-shadow: 0px 0px 0px 1px rgb(0, 0, 0) inset, 0px 5px 30px rgb(0, 0, 0) inset; 
    margin: 0px 20px; 
    padding: 10px;
    background:rgba(255, 255, 255, 1) none repeat scroll 0 0;
    color:#D4DF38;
    cursor:pointer;
    }
     .option_box a{
     text-decoration:none;
     }
    .cstfa{
    font-size: 12em; padding: 10px; color: rgb(0, 0, 0);
    }
    .cstfa:hover{
    font-size: 12em; padding: 10px; color: rgb(0, 0, 0);
    color:#D4DF38;
    }
    
    </style>

    </div>
    </div>
    </div>
    </div>';
}
include 'footer.php';
?>
