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
    include 'forum_menu.php';
$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysql_query($sql);

if(!$result)
{
	echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Forums</a></li>
</ol>The categories could not be displayed, please try again later.</div>';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Forums</a></li>
</ol><table class="table">
			  <thead><tr>
				<th>Category</th>
				<th>Last topic</th>
			  </tr></thead>';	
			
		while($row = mysql_fetch_assoc($result))
		{		
			$max = mysql_query("SELECT cat_id FROM categories ORDER BY cat_id DESC LIMIT 1 ");
			
			//$max_result = mysql_query($max);
					echo '<tr>';
				echo '<td>';
					echo '<h3> <i class="fa fa-pencil-square-o"></i>
 <a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] .'</a>';
 while($raw = mysql_fetch_assoc($max))
		{
			if($raw['cat_id'] == $row['cat_id']){
				echo '<img src="http://www.ijeat.org/attachments/Image/New.png" height="100px" style="height: 19px; margin-left: -7px;">';
			} 
			else{
				echo "";
			}
			
		}
		echo '</h3>' . $row['cat_description'];
				echo '</td>';
				echo '<td>';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
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
							echo '<div style="padding: 15px;"><i class="fa fa-folder"></i> &nbsp;
 <a style="font-size: 15px; text-decoration: underline ! important;" href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a><br /> at ' . date('d-m-Y', strtotime($topicrow['topic_date']));
						}
					}
				echo '</div></td>';
			echo '</tr>';
		}
        echo '</table></div>';
	}
}
}

include 'footer.php';
?>
