<?php
require_once 'libs/common.php';
require_once 'libs/models/askare.php';

if( !tarkistaKirjautuminen() ) {
	header("Location: kirjautuminen.php");
	exit();
}

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

if( (!empty($_POST['paiva']) && !empty($_POST['kuukausi']) && !empty($_POST['vuosi'])) && (tarkistaPaiva($_POST['vuosi'], $_POST['kuukausi'], $_POST['paiva'])) ) {
        if( (!empty($_POST['tunti']) && !empty($_POST['minuutti'])) && (tarkistaMinuutit($_POST['minuutti']) && tarkistaTunnit($_POST['tunnit'])) ) {
                $ajankohta = $_POST['vuosi'] ."-". $_POST['kuukausi'] ."-". $_POST['paiva'] ." ". $_POST['tunti'] .":". $_POST['minuutti'];
        } else {
                $ajankohta = $_POST['vuosi'] ."-". $_POST['kuukausi'] ."-". $_POST['paiva'];
        }
}

Askare::lisaaAskare($otsikko, $kuvaus, $ajankohta, $_SESSION["id"]);
header("Location: etusivu.php");

?>
