<?php
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
$a = $_SERVER['HTTP_REFERER'];
//$url = $_SERVER['HTTP_REFERER'];
if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
            $posts_sql = "SELECT * FROM posts
            WHERE posts.post_id = ". mysql_real_escape_string($_GET['id']);
                //   print_r($p     
           $result = mysql_query($posts_sql);


    if(!$result)
    {
        echo '<div class="greeting">Sorry you have no priviligies to edit the comment, please try again later.</div>';
    }
    else{
           
           echo '<form method="post" action="">
                                    <fieldset>';
                    
            //display post data
            echo '<div class="greeting"><div style="width: 50%; margin: auto;"><form method="post" action="">';  
        while($posts_row = mysql_fetch_assoc($result))
        {
            echo'
                    <div class="form-group"><textarea class="form-control" name="editor1">'.$posts_row['post_content'].'</textarea>
            <br /><input type="submit" class="btn btn-lg btn-success btn-block" value="Save" />
<a href='.$a.' class="btn btn-lg btn-default btn-block">Cancel</a>
        <script>
            CKEDITOR.replace( "editor1" );
        </script>';
        
    }
    echo '</div></div>';
}
} else{
        $update_sql = "UPDATE `posts` SET 
                `post_content`= '".mysql_real_escape_string($_POST['editor1'])."'
                 WHERE posts.post_id =".mysql_real_escape_string($_GET['id']);
                $update_result = mysql_query($update_sql);
                if(!$update_result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while deleting. Please try again later.<br /><br />' . mysql_error();
                    $update_sql = "ROLLBACK;";
                    $update_result = mysql_query($update_sql);
                }
                else
                {
                    $post_sql = "SELECT * FROM posts INNER JOIN topics ON topics.topic_id = posts.post_topic
            WHERE posts.post_id = ". mysql_real_escape_string($_GET['id']);

            $result = mysql_query($post_sql);
            while($posts_row = mysql_fetch_assoc($result))
        {
                    $url = 'topic.php?id='.$posts_row['topic_id'];
                    //print_r($url);die();
                    header('Location: '.$url);
                    $update_sql = "COMMIT;";
                    $update_result = mysql_query($update_sql);
                }
                    
                }
}
}

include 'footer.php';
?>
                        
