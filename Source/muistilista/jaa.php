<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';
require_once 'libs/models/askare.php';

if( !tarkistaKirjautuminen() ) {
	header("Location: kirjautuminen.php");
	exit();
}

if( !empty($_GET['kayttajaID']) && !empty($_GET['askareID']) ) {
	$kayttajaID = $_GET['kayttajaID'];
	$askareID = $_GET['askareID'];
	Askare::jaaAskare($kayttajaID, $askareID);
	$kayttajat = Kayttaja::getKayttajat();
	$askareenKayttajat = Kayttaja::haeAskareenKayttajat($askareID);
	$askareolio = Askare::haeAskare($askareID);
	$kayttajat = karsiKayttajia($kayttajat, $askareenKayttajat);
	naytaNakyma( 'share.php', array('kayttajat' => $kayttajat, 'askare' => $askareolio, 'askareenKayttajat' => $askareenKayttajat) );
	exit();
}

if ( !tarkistaKirjautuminen() ) {
	header("Location: kirjautuminen.php");
	exit();
}

$kayttajat = Kayttaja::getKayttajat();
$askareenKayttajat = Kayttaja::haeAskareenKayttajat($_GET["id"]);
$askareolio = Askare::haeAskare($_GET["id"]);

$kayttajat = karsiKayttajia( $kayttajat, $askareenKayttajat );

naytaNakyma( 'share.php', array('kayttajat' => $kayttajat, 'askare' => $askareolio, 'askareenKayttajat' => $askareenKayttajat) );

function karsiKayttajia( $kayttajat, $askareenKayttajat ) {
	foreach( $kayttajat as $kayttaja => $id) {
		foreach( $askareenKayttajat as $karsittava) {
			if($id->getID() == $karsittava->getID()) {
				unset($kayttajat[$kayttaja]);
			}
		}
	}
	return $kayttajat;
}

?>
