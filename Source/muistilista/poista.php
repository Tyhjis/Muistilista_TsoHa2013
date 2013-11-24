<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( isset($_SESSION["vanhakuvaus"]) ) {
	unset($_SESSION["vanhakuvaus"]);
}

if( isset($_SESSION["vanhaotsikko"]) ) {
	unset($_SESSION["vanhaotsikko"]);
}
if( isset($_SESSION["vanha_aika"]) ) {
	unset($_SESSION["vanha_aika"]);
}

if( isset($_GET["uusiotsikko"]) ) {
	Askare::poistaAskare($_GET["uusiotsikko"]);
	header("Location: etusivu.php");
	exit();
} else {
	header("Location: etusivu.php");
}
?>
