<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/askare.php';

if( !tarkistaKirjautuminen() || $_SESSION["yllapitaja"] == false ) {
	header("Location: kirjautuminen.php");
	exit();
}


if( isset($_GET['korotus']) ) {
	$korotettava = $_GET['korotus'];
	Kayttaja::korotaKayttajaAdminiksi($korotettava);
	header("Location: yllapitaja.php");
	exit();
}

if( isset($_GET['erotus']) ) {
	$askareet = Askare::haeKayttajanAskareet( $_GET['erotus'] );
	
	foreach( $askareet as $askare ) {
		Askare::poistaAskare( $askare->getID(), $_GET['erotus'] );
	}
	Kayttaja::poistaKayttaja( $_GET['erotus'] );
	header("Location: yllapitaja.php");
	exit();
}

if( isset($_GET['poistatagi']) ) {
	Askare::poistaTagiTietokannasta($_GET['poistatagi']);
	header("Location: yllapitaja.php");
	exit();
}

$tagit = Askare::haeTagit();
$kayttajat = Kayttaja::getKayttajat();
naytaNakyma('adminpage.php', array('kayttajat' => $kayttajat, 'tagit' => $tagit));
exit();
