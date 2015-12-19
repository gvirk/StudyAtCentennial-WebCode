<?php
//create_cat.php
ob_start();
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		
		//a real user posted a real reply
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . htmlspecialchars($_POST['editor1']) . "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";
			
		$result = mysql_query($sql);
		//			print_r($sql);
					
		//die();		
		if(!$result)
		{
			echo '<div class="greeting">Your reply has not been saved, please try again later.</div>';
		}
		else
		{
            $url = $_SERVER['HTTP_REFERER'];
			header('Location: '.$url);
			//echo '<div class="greeting">Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.</div>';
		}
	}
}

include 'footer.php';
?>