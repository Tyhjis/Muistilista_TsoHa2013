<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if( isset($_GET["rekisteroi"]) ) {
	naytaNakyma('register.php', array('virhe' => " "));
	exit();
}

if( empty($_POST["etunimi"]) && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Etunimesi puuttuu."));
	exit();
}
if( empty($_POST["sukunimi"]) && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Sukunimesi puuttuu."));
	exit();
}
if( empty($_POST["sahkoposti"]) && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Sähköpostiosoitteesi puuttuu."));
	exit();
}
if( empty($_POST["kayttajatunnus"]) && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Käyttäjätunnuksesi puuttuu."));
	exit();
}
if( empty($_POST["salasana1"]) && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Salasanasi puuttuu."));
	exit();
}
if( empty($_POST["salasana2"]) && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Muista täyttää molemmat salasanakentät."));
	exit();
}

if( !tarkistaVaaditutKentat() && isset($_POST["nappi"]) ) {
	naytaNakyma('register.php', array('virhe' => "Täytä vaaditut kentät"));
} else {
	if( !tarkistaSalasanat() ) {
		naytaNakyma('register.php', array('virhe' => "Salasanat eivät ole samat"));
	} else {
		Kayttaja::lisaaKayttaja($_POST["etunimi"], $_POST["sukunimi"], $_POST["kayttajatunnus"], $_POST["sahkoposti"], $_POST["salasana1"]);
		header('Location: kirjautuminen.php');
		exit();
	}
}

// Lomakkeen kenttien tarkistaminen
function tarkistaVaaditutKentat() {
	return !empty($_POST["etunimi"]) && !empty($_POST["sukunimi"]) && !empty($_POST["sahkoposti"]) && !empty($_POST["kayttajatunnus"]) && !empty($_POST["salasana1"]) && !empty($_POST["salasana2"]);
}

// Salasanojen samuuden tarkistaminen
function tarkistaSalasanat() {
	return $_POST["salasana1"] == $_POST["salasana2"];
}
?>
