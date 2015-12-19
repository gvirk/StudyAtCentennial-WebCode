<?php
//create_cat.php
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
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
       include 'forum_menu.php';
		//the form hasn't been posted yet, display it
		echo '<div class="greeting"><div style="width: 50%; margin: auto;"><form method="post" action="">
          <div class="form-group">
      <label for="usr">Category Name:</label>
      <input type="text" name="cat_name" class="form-control"/>
    </div>
    <div class="form-group">
      <label for="pwd">Category Description:</label><textarea name="cat_description" class="form-control" /></textarea>
    </div>
     <div class="form-group"><input type="submit" value="Add category" /></div></form></div></div>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
				 '" . mysql_real_escape_string($_POST['cat_description']) . "')";
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			$newURL = "forum.php";
			header('Location: '.$newURL);
		}
	}
}

include 'footer.php';
?>
