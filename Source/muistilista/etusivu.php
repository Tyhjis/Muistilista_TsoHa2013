<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( !isset($_SESSION['kayttaja']) && !isset($_SESSION['id']) ) {
	header("Location: kirjautuminen.php");
	exit();
}

$kayttaja = $_SESSION['kayttaja'];
$id = $_SESSION['id'];
$tagit = Askare::haeTagit();
$lista = Askare::haeKayttajanAskareet($id);



if( !empty($_GET['tagi']) ) {
	$tagi = $_GET['tagi'];
	if($tagi != "kaikki") {
		$lista = Askare::haeKayttajanAskareetTaginKanssa($id, $tagi);
	}
}

naytaNakyma("frontpage.php", array('hello' => "Tervetuloa! ".$_SESSION['kayttaja'], 'lista' => $lista, 'tagit' => $tagit));
?>
