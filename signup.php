<?php
//signup.php
ob_start();
include 'connect.php';
include 'header.php';
echo '<div class="col-md-8"></div>';
echo '<div class="col-md-4">';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" action="" class="form-4"><h1>Sign Up</h1>
 	 	<p class="field">
<label for="login">Username or email</label><input type="text" name="user_name" id="user_name" onBlur="checkAvailability()"placeholder="Username"/><i class="icon-user icon-large"></i><br/><span id="user-availability-status"></span></p>
 		<p class="field">
<label for="password">Password</label> <input type="password" name="user_pass" placeholder="Password"><i class="icon-lock icon-large"></i></p>
<p class="field">
<label for="password">Password</label> <input type="password" placeholder="Password Again" name="user_pass_check"><i class="icon-lock icon-large"></i></p>
<p class="field">
<label for="email">E-mail</label> <input type="email" name="user_email" placeholder="email"><i class="fa fa-envelope"></i></p>
			
 		<p><input type="submit" value="Sign Up" /></p>
 	 </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
		if(strlen($_POST['user_name']) < 5)
		{
			$errors[] = 'The username cannot be smaller than 5 characters.';
		}
		if(strlen($_POST['user_pass']) < 5)
		{
			$errors[] = 'passord cann is too short. it should be minimum of 5 characters.';
		}
		if(strlen($_POST['user_pass']) > 10)
		{
			$errors[] = 'The password cannot be larger than 10 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	$chck_name = ("SELECT * FROM users WHERE user_name = '" .mysql_real_escape_string($_POST['user_name']). "' OR user_email = '" .mysql_real_escape_string($_POST['user_email']). "'");
	//print_r($chck_name);die();
	$check_sql = mysql_query($chck_name);
 	if (mysql_num_rows($check_sql) > 0) {
		$a = "Username or Email Address already exists, choose a diffrent Username or Email.";
		}
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}
	
	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo '<div class="jumbotron" style="background: rgba(255,255,255,0.8)">A couple of fields are not filled correctly..<br /><br />';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul></div>';
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level)
				VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
					   '" . mysql_real_escape_string($_POST['user_pass']) . "',
					   '" . mysql_real_escape_string($_POST['user_email']) . "',
						NOW(),
						0)";
						
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo '<div class="jumbotron" style="background: rgba(255,255,255,0.8)">Something went wrong while registering.</br>'.$a.'</div>';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo '<div class="jumbotron" style="background: rgba(255,255,255,0.8)">Succesfully registered. You can now <a class="btn btn-success btn-lg" href="index.php" role="button">Sign In</a> and start posting! &#128147;</div>';
		}
	}
}

include 'footer.php';
?>
