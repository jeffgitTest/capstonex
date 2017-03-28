<?php 
	//una
	include 'connectdb.php';
  if (
  		
		isset($_POST['register'])		
		)
{
	//Recaptcha Fields....
	require_once('recaptcha/recaptchalib.php');
	$privatekey = "6LdzmNkSAAAAAKPxU1H4IvJZBspyrQB4UyZ64sGS";
  	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
	
	//Input Fields
	$usn = addslashes(strip_tags($_POST['usn']));
	$email = addslashes(strip_tags($_POST['email']));
	$password = strip_tags($_POST['password']);
	$repeat = strip_tags($_POST['repeat']);
	$fname = addslashes(strip_tags($_POST['fname']));
	$lname = addslashes(strip_tags($_POST['lname']));
	$address1 = addslashes(strip_tags($_POST['address']));
	$contact = addslashes(strip_tags($_POST['contact']));
	$date = date ("Y-m-d");

	$secquestion = mysql_real_escape_string($_POST['secquestion']);
	$secanswer = $_POST['secanswer'];

	$usertype = $_POST['regtype'];

	$birthday1 = strtotime($_POST['birthday']);

	$birthday = date("Y-m-d", $birthday1);

	
	$errors = array();
	if($usn&&$email&&$password&&$repeat&&$fname&&$lname&&$birthday&&$address1&&$contact){
		//$birthday = date("Y-m-d", mktime(0,0,0,$year, $month, $day));
		
		//check for existence
	    if ($password!=$repeat) ///check if pw match
		{
			$errors[] = '<div class="alert alert-error"><span class="icon-warning-sign"></span> Your passwords do not match!</div>';
		}
		//encrypt password
		$password = md5($password);
		//check if the email exists on database
		$check2 = mysql_query ("SELECT * FROM users WHERE email='$email'");
		if (mysql_num_rows($check2)>=1)
		{
			$errors[] = '<div class="alert alert-error"><span class="icon-warning-sign"></span> Email address already exists.</div>';
		}
		if(!preg_replace('#[^A-Za-z]#i', '',$fname))
		{
			$errors[] = '<div class="alert alert-error"><span class="icon-warning-sign"></span> The <strong>Firstname</strong> contains invalid characters</div>';
		}
		if(!preg_replace('#[^A-Za-z]#i', '',$lname))
		{
			$errors[] = '<div class="alert alert-error"><span class="icon-warning-sign"></span> The <strong>Lastname</strong> contains invalid characters</div>';
		}
		if(!preg_replace('#[^A-Za-z0-9]#i', '',$address1))
		{
			$errors[] = '<div class="alert alert-error"><span class="icon-warning-sign"> Invalid <strong>Address</strong></div>';
		}
		// if($year >= 1995 && $year <= 2013)
		// {
		// 	$errors[] = '<div class="alert alert-error"><span class="icon-warning-sign">Below 18 years old are not allowed to register</strong></div>';
		// }
	/*if (!$resp->is_valid){
   		$errors[] = "<div class='alert alert-error'>The reCAPTCHA wasn't entered correctly!!</div>";
 	 }*/
		if (!empty($errors)) 
			{
				foreach ($errors as $error2) 
					{
						echo $error2;
					}
			}
		else
			{
				// Your code here to handle a successful verification
				//generate random code
				$code = rand (11111111,99999999);
				//send activation email
				error_reporting(E_STRICT);
				date_default_timezone_set('America/Toronto');
				require_once('class.phpmailer.php');
				include("class.smtp.php");

				$queryprod=mysql_query("SELECT * FROM payment_option WHERE active='1' LIMIT 1");
							while($row=mysql_fetch_array($queryprod))
							{
								$id=$row['id'];
								$base_url=$row['base_url'];
							}
									
									$mail  = new PHPMailer();

									$body = "";
									
									if ($usertype == '2') {
										$body = 'Hello '.$username.', <br/> <br/> You registered for Author Account. Thank you for your registration, Please Verify your account.Just Click the Link below <br/> <a href="'.$base_url.'include/activate.php?code='.$code.'">'.$base_url.'include/activate.php?code='.$code.'</a><br/><br/>Thank You <br/><br/>Mutya';
									} else if ($usertype == '3') {
										$body = 'Hello '.$username.', <br/> <br/> You registered for Supplier Account. Thank you for your registration, Please Verify your account.Just Click the Link below <br/> <a href="'.$base_url.'include/activate.php?code='.$code.'">'.$base_url.'include/activate.php?code='.$code.'</a><br/><br/>Thank You <br/><br/>Mutya';
									} else {
										$body = 'Hello '.$username.', <br/> <br/> Thank you for your registration, Please Verify your account.Just Click the Link below <br/> <a href="'.$base_url.'include/activate.php?code='.$code.'">'.$base_url.'include/activate.php?code='.$code.'</a><br/><br/>Thank You <br/><br/>Mutya';
									}

									$mail->IsSMTP(); // telling the class to use SMTP
									$mail->Host       = "smtp.gmail.com"; // SMTP server
									$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           
									// 1 = errors and messages
                                           
									// 2 = messages only


									$mail->SMTPAuth   = true;                  // enable SMTP authentication

									$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

									$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

									$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

									$mail->Username   = "essentialitas@gmail.com";  // GMAIL username

									$mail->Password   = "slvmimtrvpnspeqm";            // GMAIL password


									$mail->SetFrom('essentialitas@gmail.com', 'Mutya');


									$mail->AddReplyTo("essentialitas@gmail.com","Mutya");


									$mail->Subject    = "Acount Activation";


									$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

									$mail->MsgHTML($body);


									// $address = $email;
									$address = $email;
									$mail->AddAddress($address, "Mutya");

									// $mail->AddAddress($address, "M");


					
									if(!$mail->Send()) 
									{ 
										echo "Mailer Error: " . $mail->ErrorInfo;
									} 
									else 
									{
									//register into database
											
										$register = mysql_query("INSERT INTO users VALUES ('','$usn','$fname','$lname','$birthday', '$address1', '$contact', '$email','$password', '0','$code','$date','0','','','', '$usertype')");

										$user_id = mysql_insert_id();


										$sql2 = mysql_query("INSERT INTO security_qa (user_id, question, answer) VALUES ('$user_id', '$secquestion', '$secanswer')");

										if ($register && $sql2) {
											echo '<div class="alert alert-success"><span class="icon-check"></span>You have been registered succesfully!Please check your email to verify your account </div>';
										} else {
											echo "Error!";
										}
											
									//} //email

			
									}
			}
		} else
			{
				echo '<div class="alert alert-error"><span class="icon-warning-sign">&nbsp;</span>Please fill all the fields</div>';
			}
	}	

?>
     	  
		  
<form action="" method="post">
         <div id="register"></div><!--for contact status output-->
		 <br/>
		 <div class="row cells2">
		 <div class="cell">
		 <hr class="bg-magenta">
		 		 <br/>

		 <div class="form-group  col-sm-offset-3 col-sm-6">
		 	<div class="input-control text full-size" data-role="input">
		 		<label for="regtype">Registration Type</label>
		 		<select id="regtype" name="regtype" class="form-control">
				  <option value=""></option>
				  <option value="1">Client</option>
				  <option value="2">Author</option>
				  <option value="3">Supplier</option>
				</select>
		 	</div>
		 </div>
		 <br/>
          <div class="form-group col-sm-offset-3 col-sm-6">
		  <div class="input-control text full-size" data-role="input">
      	  <label for="exampleInputEmail">Username</label>
     	  <input type="text" class="form-control"  name="usn" id="usn" placeholder="Enter Username" value="<?php if(!empty($_POST['usn'])){ echo $_POST['usn'];}?>" required >
   		 </div>
   		 </div>
		 <br/>
          <div class="form-group col-sm-offset-3 col-sm-6">
		  <div class="input-control text full-size" data-role="input">
      	  <label for="exampleInputEmail">Email address</label>
     	  <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email" value="<?php if(!empty($_POST['email'])){ echo $_POST['email'];}?>" required >
   		 </div>
   		 </div>
		 <br/>
    <div class="form-group col-sm-offset-3 col-sm-6">
	<div class="input-control password full-size" data-role="input">
      <label for="exampleInputEmail">Password</label>
      <input type="password" name="password" maxlength="12" class="form-control"  id="password" placeholder="Enter password">
    </div>
    </div>
	<br/>
    <div class="form-group col-sm-offset-3 col-sm-6">
	<div class="input-control password full-size" data-role="input">
      <label for="exampleInputEmail">Repeat Password</label>
      <input type="password" name="repeat" maxlength="12" class="form-control"  id="repeat" placeholder="Repeat password">
    </div>
    </div>
    <br/>
    <div class="form-group col-sm-offset-3 col-sm-6">
	<div class="input-control password full-size" data-role="input">
      <label for="exampleInputEmail">Security Question</label>
      <select class="form-control" name="secquestion">
      	<option value="What is the first and last name of your first boyfriend or girlfriend?">What is the first and last name of your first boyfriend or girlfriend?</option>
      	<option value="Which phone number do you remember most from your childhood?">Which phone number do you remember most from your childhood?</option>
      	<option value="What was your favorite place to visit as a child?">What was your favorite place to visit as a child?</option>
      	<option value="Who is your favorite actor, musician, or artist?">Who is your favorite actor, musician, or artist?</option>
      	<option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
      	<option value="In what city were you born?">In what city were you born?</option>
      	<option value="What high school did you attend?">What high school did you attend?</option>
      	<option value="What is the name of your first school?">What is the name of your first school?</option>
      	<option value="What is your favorite movie?">What is your favorite movie?</option>
      	<option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
      </select>
    </div>
    </div>
	<br/>
    <div class="form-group col-sm-offset-3 col-sm-6">
	<div class="input-control password full-size" data-role="input">
      <label for="exampleInputEmail">Security Answer</label>
      <input type="text" class="form-control" name="secanswer" id="repeat" placeholder="Security Answer">
    </div>
    </div>
	


    </div>
	<div class="cell"> 
    <br/>   
	
   <div class="form-group  col-sm-offset-3 col-sm-6">
   <div class="input-control text full-size" data-role="input">
      <label for="exampleInputPassword">Firstname</label>
      <input type="text" class="form-control"  name="fname" id="fname" placeholder="Firstname" value="<?php if(!empty($_POST['fname'])){ echo $_POST['fname'];}?>">
    </div>
    </div>
	<br/>
    <div class="form-group col-sm-offset-3 col-sm-6">
	<div class="input-control text full-size" data-role="input">
      <label for="exampleInputPassword">Lastname</label>
      <input type="text" class="form-control"  name="lname" id="lname" placeholder="Lastname" value="<?php if(!empty($_POST['lname'])){ echo $_POST['lname'];}?>">
    </div>
    </div>
    <br/>
    <div class="form-group col-sm-offset-3 col-sm-6">
      <label for="exampleInputPassword">Birthday</label>
      <input type="text" id="datepicker" class="form-control" name="birthday" placeholder="Birthday" required="required">
    </div>
     <br/>
     <br/>
	  <div class="form-group col-sm-offset-3 col-sm-6">
	  <div class="input-control text full-size" data-role="input">
      <label for="exampleInputEmail">Address</label>
      <input type="text" class="form-control"  name="address" id="address" placeholder="Enter your address">
    </div>
    </div>
    <br/>
	 <div class="form-group col-sm-offset-3 col-sm-6">
	 <div class="input-control number full-size" data-role="input">
      <label for="exampleInputEmail">Mobile Number</label>
      <input type="number" class="form-control"  name="contact" id="contact" placeholder="Enter contact">
    </div>
    </div>
    </div>
    </div>
	<br/>
	
<!----------Recaptcha---------------------->
	    <div class="form-group col-sm-offset-3 col-sm-6">	
      <label for="exampleInputEmail">Are you Human?</label>
  <?php
          require_once('recaptcha/recaptchalib.php');
          $publickey = "6LctstwSAAAAACGr1i8yfn94EENmuQjqrkL7gpxV"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
        <!--  <script type="text/javascript"
   src="http://www.google.com/recaptcha/api/challenge?k=6LctstwSAAAAACGr1i8yfn94EENmuQjqrkL7gpxV">
</script>
<noscript>
  <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LctstwSAAAAACGr1i8yfn94EENmuQjqrkL7gpxV"
       height="300" width="500" frameborder="0"></iframe><br />
  <textarea name="recaptcha_challenge_field" rows="3" cols="40">
  </textarea>
  <input type="hidden" name="recaptcha_response_field"
       value="manual_challenge" />
</noscript> -->	
    </div>

 <div class="form-group align-center col-sm-offset-3 col-sm-6">
 
 <label class="input-control checkbox small-check">
    <input type="checkbox" required>
    <span class="check"></span>
    <span class="caption"></span>
	</label>
 <a href="terms.php"target="_blank">Terms and Condition</a>
 </div> 

    <div class="form-group align-center col-sm-offset-3 col-sm-6">
    	<input type="submit" name="register" value="Register" class="btn btn-default">
 </div> 
 
 </form>
