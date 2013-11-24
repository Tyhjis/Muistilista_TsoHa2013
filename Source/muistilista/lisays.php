<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( empty($_POST['otsikko']) ) {
	naytaNakyma('add.php');
	exit();
}

$otsikko = $_POST['otsikko'];
$kuvaus = " ";
$ajankohta = "2013-01-01 00:00:00";
$kayttaja = $_SESSION['kayttaja'];

if( !empty($_POST['kuvaus']) ) {
	$kuvaus = $_POST['kuvaus'];
}

Askare::lisaaAskare($otsikko, $kuvaus, $ajankohta, $kayttaja);
header("Location: etusivu.php");

?>
