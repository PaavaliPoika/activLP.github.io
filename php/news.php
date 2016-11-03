<?php
	define("CONTACT_FORM", 'activka@activka.com');

	function ValidateEmail($value){
		$regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';

		if($value == '') { 
			return false;
		} else {
			$string = preg_replace($regex, '', $value);
		}

		return empty($string) ? true : false;
	}

	$post = (!empty($_POST)) ? true : false;

	if($post){

		$name = stripslashes($_POST['name']);
		$phone = stripslashes($_POST['phone']);
		$email = stripslashes($_POST['email']);
		$subject = 'Mail From Activka Landing';
        $msg = stripslashes($_POST['message']);
		$error = '';	
		$message = '
			<html>
				<head>
					<title> Mail From Activka Landing </p></title>
				</head>
				<body>
					<p>Имя: '.$name.'</p>
					<p>Телефон : '.$phone.'</p>
					<p>Email : '.$email.'</p>
                    <p>Message: '.$msg.' </p>
				</body>
			</html>';

		if (!ValidateEmail($email)){
			$error = '<p class="bg-danger">Email введен неправильно!</p>';
            
		}

		if(!$error){
			$mail = mail(CONTACT_FORM, $subject, $message,
			     "From: ".$name." <".$email.">\r\n"
			    ."Reply-To: ".$email."\r\n"
			    ."Content-type: text/html; charset=utf-8 \r\n"
			    ."X-Mailer: PHP/" . phpversion());

			if($mail){
				echo 'OK';
			}
		}else{
			echo '<div class="bg-danger">'.$error.'</div>';
		}

	}
?>
