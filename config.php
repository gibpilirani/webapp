<?php
	sesssion_start();
	require_once "googleApi/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("550867582023-4q55nko8krn9k78iofgeicf08fhjghhk.apps.googleusercontent.com");
	$gClient->setClientSecrete("mBQtHu-8Ovzqi1boSom4vzO3");
	$gClient->setAplicationName("CPI Login");
	$gClient->setRediretUrli("http://localhost/history/client1.php");
	$gClient->addScope();
?> 
