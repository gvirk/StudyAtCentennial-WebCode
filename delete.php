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

//$url = $_SERVER['HTTP_REFERER'];
            $posts_sql = "DELETE FROM `test`.`posts` WHERE `posts`.`post_id` = ". mysql_real_escape_string($_GET['id']);
                        
           
                $update_result = mysql_query($posts_sql);
                if(!$update_result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while deleting. Please try again later.<br /><br />' . mysql_error();
                    $update_sql = "ROLLBACK;";
                    $update_result = mysql_query($update_sql);
                }
                else
                {
                    $url = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$url);
                    $update_sql = "COMMIT;";
                    $update_result = mysql_query($update_sql);
                    
                }
}

include 'footer.php';
?>
                        
