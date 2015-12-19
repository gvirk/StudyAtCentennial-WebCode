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
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo '<div class="greeting"><ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li>Semesters</a></li>
 <li class="active">Topics</a></li>
</ol>The topic could not be displayed, please try again later.</div>';
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
			echo '<div class="greeting">
  <ol class="breadcrumb">
  <li><a href="home.php">Home</a></li>
  <li><a href="forum.php">Forums</a></li>
 <li class="active">' . $row['topic_subject'] . '</a></li>
</ol></li><table class="table" style="background: rgba(255, 255, 255, 0.8) none repeat scroll 0% 0%; color: rgb(0, 0, 0);">
            <thead>
            <tr>
            <th style="padding: 10px 20px;font-size:20px;background: #D4DF38"><i class="fa fa-folder-open"></i>
 &nbsp;' . $row['topic_subject'] . '</th>
					</tr></thead>';
		

if (isset($_GET["page"])) { 
	$page  = $_GET["page"]; } else { $page=1; }; 
$num_rec_per_page = 10;
$start_from = ($page-1) * $num_rec_per_page;

			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_id,
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name,
						users.user_email,
						users.user_date
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = ".mysql_real_escape_string($_GET['id']) ." "."LIMIT ". $start_from .",".$num_rec_per_page;
						
			$posts_result = mysql_query($posts_sql);
			
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{

						
                   $newTime = date('m/d/Y H:i:s', strtotime($posts_row['post_date']));
                    //function elapsedTimeAgo ($newTime) {
                   date_default_timezone_set('America/New_York');
					$l = date('m/d/Y H:i:s', time());
					
                      $a = strtotime($l);
                        $b = strtotime($newTime);
                        $timeCalc = $a - $b;
                        $elapsedTimeText = "";

                        if ($timeCalc > (60*60*24*7)) {
                            $elapsedTimeText = round($timeCalc/60/60/24/7) . "&nbsp; weeks ago";
                        } 
                        elseif ($timeCalc > (60*60*24)) {
                            $elapsedTimeText = round($timeCalc/60/60/24) . "&nbsp; days ago";
                        }
                       	else if ($timeCalc > (60*60)) {
                            $elapsedTimeText = round($timeCalc/60/60) .  "&nbsp; Hours ago";
                        }else if ($timeCalc > (60)) {
                            $elapsedTimeText = round($timeCalc/60) .  "&nbsp; Minutes ago";
                        } else if ($timeCalc > 0) {
                            $elapsedTimeText .= round($timeCalc/2) ."&nbsp; seconds ago";
                        } else {
                            $elapsedTimeText .=  "&nbsp; Just Posted";
                        } 
                        
                        
                    //    return $elapsedTimeText;
                  //  } 
                       if($_SESSION['user_id']==$posts_row['user_id']){
                        	$delete ="<a href='delete.php?id=" . $posts_row['post_id'] ."'>".'<i class="icon-remove-sign"></i>'."</a>";
                        	$edit ="<a href='edit.php?id=" . $posts_row['post_id'] ."'>".'<i class="fa fa-pencil-square-o"></i>'."</a>";
                        	
                        }
                        elseif ($_SESSION['user_level'] == 1)
						{
							$delete ="<a href='delete.php?id=" . $posts_row['post_id'] ."'>".'<i class="icon-remove-sign"></i>'."</a>";
                        	$edit ="";
						}
                        else{
                        	$delete = "";
                        	$edit="";
                        }
                        
					echo '<tr class="topic-post">
							<td><div class="user-post col-md-4_d"><i class="fa fa-user"></i>
 &nbsp;' . $posts_row['user_name'] . '<br /><hr size="1" style="color:#D1D1E1;margin:6px 0;"/><a href="mailto:'.$posts_row['user_email'].'?Subject=Hello%20again" target="_top">'.
 $posts_row['user_email'] . '</a><br /><hr size="1" style="color:#D1D1E1;margin:6px 0;"/>
 Joined on '.date('d-M-y', strtotime($posts_row['user_date'])) . '<br />
 </div>
							<div class="post-content col-md-8_d" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-radius: 0px 20px; padding: 15px;">
<div style="margin-bottom: 20px"><div style="float:right">'.$edit.' '.$delete.'</div>' . 
							html_entity_decode(stripslashes($posts_row['post_content'])) . '</div>
<hr size="1" style="color:#D1D1E1;margin:6px 0;"><div style="display: inline;
    float: left;
    width: 100%;font-size: 10px;padding: 0 20px"><em>'.date('h:i A', strtotime($posts_row['post_date']))." (".$elapsedTimeText.")<em></div></div></div></td>
						  </tr>";
				}
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td>
					<form method="post" action="reply.php?id=' . $row['topic_id'] .'">
						
						<textarea name="editor1" ></textarea>
        <script>
            CKEDITOR.replace( "editor1" );
        </script>
						<input type="submit" value="Reply" />

        
					</form></td></tr>';
			}
			$post_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name,
						users.user_email,
						users.user_date
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = ".mysql_real_escape_string($_GET['id']) ;
						$post_result = mysql_query($post_sql);
			$total_records = mysql_num_rows($post_result);  
			//count number of records
			$total_pages = ceil($total_records / $num_rec_per_page); 

			echo "<ul class='pagination' style='float:right;margin:0px!important;'><li><a href='topic.php?id=" . $row['topic_id'] . "&page=1'>".'First'."</a> </li>"; // Goto 1st page  

			for ($i=1; $i<=$total_pages; $i++) { 
			            echo "<li><a href='topic.php?id=" . $row['topic_id'] . "&page=".$i."'>".$i."</a></li>"; 
			}; 
			echo "<li><a href='topic.php?id=" . $row['topic_id'] . "&page=$total_pages'>".'Last'."</a> </li><ul>";
						//finish the table
			echo '</table></div>';
			
		}
	}
}
}
include 'footer.php';
?>