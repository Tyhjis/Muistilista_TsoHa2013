<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( !tarkistaKirjautuminen() ) {
	header("Location: kirjautuminen.php");
	exit();
}

if( !empty($_GET["id"]) ) {
	Askare::poistaAskare($_GET['id'], $_SESSION['id']);
	header("Location: etusivu.php");
	exit();
	
} else {
	header("Location: etusivu.php");
	exit();
}
?>
