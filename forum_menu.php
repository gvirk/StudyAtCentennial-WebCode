<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button aria-expanded="false" data-target="#bs-example-navbar-collapse-9" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="home.php" class="navbar-brand"><i class="fa fa-home"></i> Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-example-navbar-collapse-9" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a class="item" href="forum.php"><i class="fa fa-folder-open"></i> View Categories</a></li>
<li><a class="item" href="create_topic.php"><i class="fa fa-comments"></i> Create a topic</a></li>
              <?php if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 ){}
	//the user is not an admin
	
else
{ echo '<li><a class="item" href="create_cat.php"><i class="fa fa-th-list"></i>

 Create a category</a></li>';} ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>