<?php
include 'connectdb.php';
if (isset($_POST['register']))
{
	//get data
	$username = addslashes(strip_tags($_POST['username']));
	$password = addslashes(strip_tags($_POST['password']));
	
	if ($username&&$password)
	{
				$login = mysql_query("SELECT * FROM users WHERE usn='$username'");//filtering the database and compare if the username macth the variable inputed in the username field.
				
				if (mysql_num_rows($login)!=0)
				{
					//code to login
					while ($row = mysql_fetch_assoc($login))
					{
						$dbpassword = $row ['password'];
						$password = md5($password);
						
						if ($password != $dbpassword){
							echo '<div class="fg-red">Incorrect username or password</div>';
							    
							}
							
						else
						{
							$activate = $row['activate'];
							$usn = $row['usn'];
							
							if ($activate==0)
							{
								echo '<div class="fg-amber">You have not activated your account. Please check your email</div>';
							}
							else{
							
							$fname = $row ['fname'];
							$usertype = $row['user_type'];
							 /*session_start();*/
							$_SESSION['username']=$username;
							$_SESSION['user_id']=$row['id'];

							$accesslevel = "";

							if ($usertype == 1) {
								$accesslevel = "client";
							}

							if ($usertype == 2) {
								$accesslevel = "author";
							}

							if ($usertype == 3) {
								$accesslevel = "supplier";
							}

							if ($usertype == 4) {
								$accesslevel = "admin";
							}
							

							$_SESSION['accesslevel'] = $accesslevel;


							
							//echo'<div class="alert alert-success"> Welcome '.$fname .' | <a href="'.$_SERVER['HTTP_REFERER'].'">Shop now!</a>';
							header("Location:index.php");
		//	exit();
							}
							
						}
					}
				}
				else
				{
				echo '<div class="fg-red">That user doesnt exist!</div>';
						
				}			
	}
	else
	
	echo '<div class="fg-amber">Please enter a username and password</div>';
			}
?>

			 <form role="form"method="POST" action="" >
  <div class="form-group col-sm-offset-3 col-sm-6" >
    <label for="email">Username:</label>
    <input type="text" name="username" class="form-control" placeholder="Enter Username">
  </div>
  <div class="form-group col-sm-offset-3 col-sm-6" >
    <label for="pwd">Password:</label>
    <input type="password" name="password" class="form-control" placeholder="Enter Password">
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
        <a href="forgot.php">Forgotten password?</a>
		<br/>
		 Not yet a member? Register<a href="register.php"> here</a>
		<br/>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
	<br/>
	<input type="hidden" name="save" value="contact">
      <button type="submit" name="register" class="btn btn-default">Submit</button>
    </div>
  </div>

</form>
