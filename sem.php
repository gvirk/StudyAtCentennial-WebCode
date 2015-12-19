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
$sql = "SELECT
			semester.sem_id,
			semester.sem_name,
			COUNT(courses.course_id) AS courses
		FROM
			semester
		LEFT JOIN
			courses
		ON
			courses.course_id = semester.sem_id
		GROUP BY
			semester.sem_name, semester.sem_id";

$result = mysql_query($sql);

if(!$result)
{
	echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Semesters</a></li>
</ol>The categories could not be displayed, please try again later.</div>';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Semesters</a></li>
</ol>No categories defined yet.</div>';
	}
	else
	{
		//prepare the table
		echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Semesters</a></li>
</ol>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
		
          ';	
			
		while($row = mysql_fetch_assoc($result))
		{				
			echo '
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" 
        href="#'.$row['sem_id'].'" aria-expanded="true" aria-controls="collapseOne">';
					echo ' <i class="fa fa-hand-o-right"></i>
 '. $row['sem_name'] . '</a>
      </h4>
    </div>';
    if($row['sem_id'] == 1){
    	$class="panel-collapse collapse in";
    }else{
    	$class="panel-collapse collapse";
    }

    echo '<div id="'.$row['sem_id'].'" class="'.$class.'" 
						role="tabpanel" aria-labelledby="headingOne">
    ';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									course_id,
									course_name,
									course_code
									course_sem
								FROM
									courses
								WHERE
									course_sem = " . $row['sem_id'];
								
					$topicsresult = mysql_query($topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysql_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysql_fetch_assoc($topicsresult))
							echo '
      <div class="panel-body">
 <a style="font-size: 15px; text-decoration: none ! important;" href="course.php?id=' . $topicrow['course_id'] . '">
 <i class="fa fa-folder"></i> &nbsp;' . 
 $topicrow['course_name'].'</a></div>';
						}
					}
				echo '</div>';
			
		}
        echo '</div></div>';
	}
}
}

include 'footer.php';
?>
