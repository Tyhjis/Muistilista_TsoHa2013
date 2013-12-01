<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if( empty($_POST["etunimi"]) ) {
	naytaNakyma('register.php');
	exit();
}
if( empty($_POST["sukunimi"]) ) {
	naytaNakyma('register.php');
	exit();
}
if( empty($_POST["sahkoposti"]) ) {
	naytaNakyma('register.php');
	exit();
}
if( empty($_POST["kayttajatunnus"]) ) {
	naytaNakyma('register.php');
	exit();
}
if( empty($_POST["salasana1"]) ) {
	naytaNakyma('register.php');
	exit();
}
if( empty($_POST["salasana2"]) ) {
	naytaNakyma('register.php');
	exit();
}

if( !tarkistaVaaditutKentat() ) {
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
