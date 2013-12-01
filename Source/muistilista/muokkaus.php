<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( !tarkistaKirjautuminen() ) {
	header("Location: kirjautuminen.php");
	exit();
}

if( isset($_GET["tagilisays"]) && isset($_GET["tagiAsk"]) ) {
	Askare::lisaaTagiAskareeseen( $_GET["tagilisays"], $_GET["tagiAsk"] );
	$askareolio = Askare::haeAskare($_GET["tagiAsk"]);
	$tagit = Askare::haeTagit();
	$askareentagit = Askare::haeAskareenTagit($askareolio->getID());
	$tagit = karsiTageja( $tagit, $askareentagit );
	$id = $askareolio->getID();
	$vanhaotsikko = $askareolio->getOtsikko();
	$vanhakuvaus = $askareolio->getKuvaus();
	$vanha_aika = $askareolio->getAjankohta();
	$ajanOsat = explode(" ", $vanha_aika);
	$pvm = explode("-", $ajanOsat[0]);
	$klo = explode(":", $ajanOsat[1]);
	//Päivämäärän eri osien määrittaminen
	$vuosi = $pvm[0];
	$kuukausi = $pvm[1];
	$paiva = $pvm[2];
	//Kellonajan eri osien määrittäminen
	$tunti = $klo[0];
	$minuutti = $klo[1];
	naytaNakyma('edit.php', array('id' => $id, 'vanhaotsikko' => $vanhaotsikko, 'vanhakuvaus' => $vanhakuvaus, 'vuosi' => $vuosi, 'kuukausi' => $kuukausi, 'paiva' => $paiva, 'tunti' => $tunti, 'minuutti' => $minuutti, 'tagit' => $tagit, 'askareentagit' => $askareentagit));
	unset($_GET["tagilisays"]);
	unset($_GET["tagiAsk"]);
	exit();
}

if( isset($_GET["uid"]) ) {	
	$id = $_GET["uid"];
	$uusiotsikko = $_GET["uusiotsikko"];
	$uusikuvaus = $_GET["uusikuvaus"];
	$uusiajankohta = "2013-01-01 00:00:00";
	if( (!empty($_GET['paiva']) && !empty($_GET['kuukausi']) && !empty($_GET['vuosi'])) && (tarkistaPaiva($_GET['vuosi'], $_GET['kuukausi'], $_GET['paiva'])) ) {
        if( (!empty($_GET['tunti']) && !empty($_GET['minuutti'])) && (tarkistaMinuutit($_GET['minuutti']) && tarkistaTunnit($_GET['tunnit'])) ) {
                $uusiajankohta = $_GET['vuosi'] ."-". $_GET['kuukausi'] ."-". $_GET['paiva'] ." ". $_GET['tunti'] .":". $_GET['minuutti'];
        } else {
                $uusiajankohta = $_GET['vuosi'] ."-". $_GET['kuukausi'] ."-". $_GET['paiva'];
        }
	}
	Askare::muokkaaAskaretta($id, $uusiotsikko, $uusikuvaus, $uusiajankohta);
	header("Location: etusivu.php");
	exit();
}

if( isset($_GET["id"]) ) {
	$askareolio = Askare::haeAskare($_GET["id"]);
	$tagit = Askare::haeTagit();
	$askareentagit = Askare::haeAskareenTagit($askareolio->getID());
	$uudettagit = karsiTageja( $tagit, $askareentagit );
	$id = $askareolio->getID();
	$vanhaotsikko = $askareolio->getOtsikko();
	$vanhakuvaus = $askareolio->getKuvaus();
	$vanha_aika = $askareolio->getAjankohta();
	$ajanOsat = explode(" ", $vanha_aika);
	$pvm = explode("-", $ajanOsat[0]);
	$klo = explode(":", $ajanOsat[1]);
	//Päivämäärän eri osien määrittaminen
	$vuosi = $pvm[0];
	$kuukausi = $pvm[1];
	$paiva = $pvm[2];
	//Kellonajan eri osien määrittäminen
	$tunti = $klo[0];
	$minuutti = $klo[1];
	naytaNakyma('edit.php', array('id' => $id, 'vanhaotsikko' => $vanhaotsikko, 'vanhakuvaus' => $vanhakuvaus, 'vuosi' => $vuosi, 'kuukausi' => $kuukausi, 'paiva' => $paiva, 'tunti' => $tunti, 'minuutti' => $minuutti, 'tagit' => $uudettagit, 'askareentagit' => $askareentagit));
	unset($_GET["id"]);
	exit();
} else {
	naytaNakyma('edit.php', array('virhe' => "Askaretta ei löytynyt"));
	exit();
}

function karsiTageja( $tagit, $askareentagit ) {
	foreach($tagit as $tagi => $id) {
		foreach( $askareentagit as $karsittava) {
			if($id->id == $karsittava->id) {
				unset($tagit[$tagi]);
			}
		}
	}
	return $tagit;
}
