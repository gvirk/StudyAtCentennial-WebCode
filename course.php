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
	
$sql = "SELECT * FROM courses INNER JOIN software ON courses.course_soft = software.soft_id WHERE courses.course_id =" . mysql_real_escape_string($_GET['id']);
			

$result = mysql_query($sql);

if(!$result)
{
	echo '<div class="greeting">The topic could not be displayed, please try again later.</div>';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo '<div class="greeting">This topic doesn&prime;t exist.</div>';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			//display post data
			echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li><a href="sem.php">Semesters</a></li>
  <li class="active">'.$row['course_name'].'</li>
</ol><table class="table" style="background: rgba(255, 255, 255, 0.8) none repeat scroll 0% 0%; color: rgb(0, 0, 0);">
            <thead>
            <tr>
            <th style="padding: 10px 20px; font-size: 20px; background: transparent repeating-linear-gradient(45deg, rgb(212, 223, 56), rgb(212, 223, 56) 10px, rgb(209, 220, 53) 10px, rgb(207, 218, 51) 20px) repeat scroll 0px 0px;"><i class="fa fa-desktop"></i>

 &nbsp;' . $row['course_code']." | ".$row['course_name'] . '</th>
					</tr></thead>';
						  
						  echo'<tr class="topic-post">
							<td><div class="col-md-8" style="text-align: justify;">'.$row['course_details'].'</div><div class="col-md-4">
							<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Centennial_College_logo.svg/2000px-Centennial_College_logo.svg.png" style="height: 400px; float: right;"></div></td></tr>
							<tr><td style="background: transparent repeating-linear-gradient(45deg, rgb(221, 221, 221), rgb(221, 221, 221) 10px, transparent 10px, transparent 20px) repeat scroll 0px 0px;"><span>Recomended Software</span></td></tr>
							<tr><td>
							<a style="padding-left:40px;color: rgb(0, 0, 0); text-decoration: underline ! important;" href='.$row['soft_link'].'>'
							.$row['soft_name'].'</a>
							</td></tr>';
				}
			}
			
			
						//finish the table
			echo '</table></div>';
			
		}
	}
	
include 'footer.php';
?>