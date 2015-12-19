<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
   <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="../css/agency.css" rel="stylesheet">
    <!-- Fontawesome CSS -->
     <link href="../css/font-custom.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
    
<title>Study at Centennial : Admin </title>
</head>
<body>
<?php
include 'connect.php';
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	 $newURL = "/pages/home.php";
	header('Location: '.$newURL);
}

else
{
if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		/*the form hasn't been posted yet, display it
		  note that the action="" will cause the form to post to the same page it is on */
		echo '<form method="post" action="" class="form-4">
        <h1>Login</h1>
			<p class="field">
<label for="login">Username or email</label><input type="text" name="user_name" placeholder="Username or email" name="login"/><i class="icon-user icon-large"></i></p>
			<p class="field">
<label for="password">Password</label> <input type="password" name="user_pass" placeholder="Password" name="password"><i class="icon-lock icon-large"></i></p>
			<p><input type="submit" value="Sign in" /></p>
		 </form>';
	}
	else
	{
		/* so, the form has been posted, we'll process the data in three steps:
			1.	Check the data
			2.	Let the user refill the wrong fields (if necessary)
			3.	Varify if the data is correct and return the correct response
		*/
		$errors = array(); /* declare the array for later use */
		
		if(!isset($_POST['user_name']))
		{
			$errors[] = 'The username field must not be empty.';
		}
		
		if(!isset($_POST['user_pass']))
		{
			$errors[] = 'The password field must not be empty.';
		}
		
		if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
		{
			echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
			echo '<ul>';
			foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
			{
				echo '<li>' . $value . '</li>'; /* this generates a nice error list */
			}
			echo '</ul>';
		}
		else
		{
			//the form has been posted without errors, so save it
			//notice the use of mysql_real_escape_string, keep everything safe!
			//also notice the sha1 function which hashes the password
			$sql = "SELECT 
						user_id,
						user_name,
						user_level
					FROM
						users
					WHERE
						user_name = '" . mysql_real_escape_string($_POST['user_name']) . "'
					AND
						user_pass = '" . $_POST['user_pass'] . "'And user_level = 2";
						
			$result = mysql_query($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'Something went wrong while signing in. Please try again later.';
				//echo mysql_error(); //debugging purposes, uncomment when needed
			}
			else
			{
				//the query was successfully executed, there are 2 possibilities
				//1. the query returned data, the user can be signed in
				//2. the query returned an empty result set, the credentials were wrong
				if(mysql_num_rows($result) == 0)
				{
					echo 'You have supplied a wrong user/password combination. Please try again.';
				}
				else
				{
					//set the $_SESSION['signed_in'] variable to TRUE
					$_SESSION['signed_in'] = true;
                    $result = mysql_query($sql);
    				while($row = mysql_fetch_assoc($result))
					{
						$_SESSION['user_id'] 	= $row['user_id'];
						$_SESSION['user_name'] 	= $row['user_name'];
						$_SESSION['user_level'] = $row['user_level'];
					}
					

                    $URL = "/pages/home.php";
					header('Location: '.$URL);
				}

			}
		}
	}
}
?>
</body>
</html>
