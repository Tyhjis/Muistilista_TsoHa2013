<?php
require_once 'libs/common.php';
require_once "libs/models/askare.php";

if( !isset($_SESSION['kayttaja']) && !isset($_SESSION['id']) ) {
	header("Location: kirjautuminen.php");
	exit();
}

$kayttaja = $_SESSION['kayttaja'];
$lista = Askare::haeKayttajanAskareet($kayttaja);
naytaNakyma("frontpage.php", array('hello' => "Tervetuloa! ".$_SESSION['kayttaja'], 'lista' => $lista));
?>
