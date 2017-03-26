<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Mutya LOGO</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="catalog.php">BOOK LIBRARY</a></li>
        <li><a href="contact.php">CONTACT</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="help.php">HELP</a></li>

  <!--    <li>
        <form method="get" action="results.php" enctype="multipart/form-data"/>
            <input type="text" class="form-control" name="user_query" placeholder="Search a Book"/>
            <input type="submit" name="search" value="Search"/>
        </form></li>
-->

  
      <?php 

                          $accesslevel = @$_SESSION['accesslevel'];
                          $userid = @$_SESSION['user_id'];

                          if ($accesslevel == "author") {

                            $_SESSION['author_id'] = $userid;
                            
                            echo "
                            <li class='dropdown'>
                            <a href='#' data-toggle='dropdown' class='dropdown-toggle'>Author
                            <span class='caret'></span></a>
                            <ul class='dropdown-menu' data-role='dropdown'>
                                 <li><a href='publishedbooks.php'>Published Book</a></li>
                                 <li><a href='authorbidform.php'>Bid Portal</a></li>
                              </ul>
                            </li>
                            ";

                          }

                          if ($accesslevel == "supplier") {

                            $_SESSION['supplier_id'] = $userid;
                            
                            echo "
                            <li class='dropdown'>
                            <a href='#' data-toggle='dropdown' class='dropdown-toggle'>Supplier
                            <span class='caret'></span></a></a>
                            <ul class='dropdown-menu' data-role='dropdown'>
                                 <li><a href='supplierbidform.php'>Bid Portal</a></li>
                              </ul>
                            </li>
                            ";

                          }

                         ?>


        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">SEARCH
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <form method="get" action="results.php" enctype="multipart/form-data"/>
            <input type="text" class="form-control" name="user_query" placeholder="Search a Book"/>
            <button  name="search" data-toggle="modal">Search</button>
        </form>
          </ul>
        </li>
      </ul>
<?php
	if (loggedin())
			{     
				echo '
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="user.php">'.@$fname.'<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="user.php">Shopping Cart</a></li>
            <li><a href="include/logout.php">Logout</a></li> 
          </ul>
        </li>
</ul>';
      }
      else{
echo '
        <ul class="nav navbar-nav navbar-right">

<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
<li><a  href="login.php"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
</ul>';
      }
?>
    </div>
  </div>
</nav>