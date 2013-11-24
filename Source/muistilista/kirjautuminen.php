<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if (empty($_POST["username"])) {
	naytaNakyma('login.php');
}

if (empty($_POST["password"])) {
	naytaNakyma('login.php');
}

$salasana = $_POST["password"];
$kayttaja = $_POST["username"];
$userolio = Kayttaja::getKayttaja($kayttaja, $salasana);

if ($userolio != null) {
	alustaIstunto($userolio->getTunnus(), $userolio->getID());
	header('Location: http://krha.users.cs.helsinki.fi/muistilista/etusivu.php');
} else {
	naytaNakyma("login.php", array('virhe' => "Käyttäjää ei löydy. Sori."));
}
?>
