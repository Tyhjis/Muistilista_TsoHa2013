<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( !isset($_SESSION["vanhakuvaus"]) ) {
	$_SESSION["vanhakuvaus"] = $_GET["kuvaus"];
}

if( !isset($_SESSION["vanhaotsikko"]) ) {
	$_SESSION["vanhaotsikko"] = $_GET["otsikko"];
}
if( !isset($_SESSION["vanha_aika"]) ) {
	$_SESSION["vanha_aika"] = $_GET["ajankohta"];
}
$vanhakuvaus = $_SESSION["vanhakuvaus"];
$vanhaotsikko = $_SESSION["vanhaotsikko"];
$vanha_aika = $_SESSION["vanha_aika"];

if( empty($_GET["uusiotsikko"]) ) {
	naytaNakyma('edit.php', array('vanhakuvaus' => $vanhakuvaus, 'vanhaotsikko' => $vanhaotsikko, 'aika' => $vanha_aika));
	exit();
}

if( isset($_GET["uusiotsikko"]) && isset($_GET["uusikuvaus"]) ) {	
	$uusiotsikko = $_GET["uusiotsikko"];
	$uusikuvaus = $_GET["uusikuvaus"];
	Askare::muokkaaAskaretta($uusiotsikko, $uusikuvaus, $vanha_aika, $vanhaotsikko);
	header("Location: etusivu.php");
	unset($_SESSION["vanhaotsikko"]);
	unset($_SESSION["vanhakuvaus"]);
	unset($_SESSION["vanha_aika"]);
	exit();
}
?>
