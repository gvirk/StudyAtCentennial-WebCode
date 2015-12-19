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

$sql = "SELECT * FROM events WHERE  `events_day_date` >= now() ORDER BY events_day_date ASC LIMIT 5";

$result = mysql_query($sql);

if(!$result)
{
	echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Events</a></li>
</ol>events could not be displayed, please try again later.</div>';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No events defined yet.';
	}
	else
	{	
		
		//$events_sql = "DELETE FROM `events` WHERE  `events_day_date` =<" . $abc;
		//$events_result = mysql_query($events_sql);
		//prepare the table
		echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li class="active">Events</a></li>
</ol><table class="table">
			  <thead><tr>
				<th>Date</th>
				<th>Event</th>
			  </tr></thead>';	
			
		while($row = mysql_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td>';
				
				echo '<div class="datetime_event">
<div class="date_event">'.date('d', strtotime($row['events_day_date'])).'</div><div>'.date('M', strtotime($row['events_day_date']))."</div></td><td>";
					echo '<h3><i class="fa fa-calendar"></i>  ' . $row['events_topic'] . '</h3><hr/>
					<div style="text-align: justify; background: rgba(255, 255, 255, 0.7) none repeat scroll 0% 0%; color: rgb(0, 0, 0); margin-bottom: 10px; padding: 20px;">'.$row['events_desc'].'</div>';
				echo '</td>';
				
			echo '</tr>';
		}
        echo '</table></div>';
	}
}
}

include 'footer.php';
?>
