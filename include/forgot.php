
<?php
include 'connectdb.php';
//include 'check_login.php';

if (isset($_POST['btn']))
{
	
	$email = $_POST['email'];
	if($email){
		$check = mysql_query ("SELECT * FROM users WHERE email='$email'");

			if (mysql_num_rows($check)!=0)
			{
				while ($row = mysql_fetch_assoc($check))		
				{
				$email= $row ['email'];
				$random=md5(uniqid(rand()));
				$new=substr($random, 0,8);
				$encryptNew = md5($new);
				
				}
							error_reporting(E_STRICT);
									date_default_timezone_set('America/Toronto');
									require_once('class.phpmailer.php');
									$mail= new PHPMailer();
									$body = '<p>Forgotten password? Below are the temporary password that you can use to login in BALI Hardware<br />
										<br />
										Generated Password : '.$new.'<br />
										</p>
										you can make your desire password after you logged in on your account!.
									';


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


$mail->SetFrom('essentialitas@gmail.com', 'BALI Hardware!');


$mail->AddReplyTo("essentialitas@gmail.com","BALI Hardware!");


$mail->Subject    = "Reset password confirmation";


$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


$mail->MsgHTML($body);


$address = $email;

$mail->AddAddress($address, "BALI Hardware!");		
if(!$mail->Send()) 
									{ 
										echo "Mailer Error: " . $mail->ErrorInfo;
									} 
									else
									{
									//update database
									$updatePw = mysql_query("UPDATE users SET password='$encryptNew' WHERE email='$email' ");
									echo "<div class='alert alert-success'>Please check your email we send you a system generated password</div>";
									}
			}
			else
			{
				echo '<div class="fg-red">The email you entered is not existed in our database</div>';
			}
		}
	else{
		echo '<div class="fg-amber">Please fill the fields</div>';
		}
}
?>
   <form action="" method="post">

        <div id="forgotpass"></div><!--for login status output--> 
        <div class="modal-body"> 
<br/>		
  <fieldset  class="example" data-text="retrieve password form">
  <br>
  <div class="row cells2">
<div class="cell">
	<div class="form-group col-sm-offset-3 col-sm-6">
     <div class="form-group">
	 <div class="input-control text full-size" data-role="input">
      <label for="exampleInputPassword">Email</label>
      <input type="email" required="required" name="email" id="forgotemail" class="form-control" placeholder="Email Address">
    </div>
    </div></div>
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
      <input type="password" class="form-control" name="secanswer" id="repeat" placeholder="Security Answer">
    </div>
    </div>

    <br/>
	<div class="form-group col-sm-offset-3 col-sm-6">
<input type="submit" name="btn" class="btn btn-warning" value="Send"> 
         Not yet a member? Register<a href="registration.php"> here </a> 
	</div>  </div>    
	</div>
<br/>	
<br/>	
  </fieldset>
<br/>        
<br/>        
<br/>        