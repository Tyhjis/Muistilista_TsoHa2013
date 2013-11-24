<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
	$data = (object)$data;
	require 'views/template.php';
	require 'views/'.$sivu;
	die();
}

function alustaIstunto($kayttajatunnus, $id) {
	$_SESSION['kayttaja'] = $kayttajatunnus;
	$_SESSION['id'] = $id; 
}

function lopetaIstunto() {
	unset($_SESSION['kayttaja']);
	unset($_SESSION['id']);
}

function tarkistaKirjautuminen() {
	return isset($_SESSION['kayttaja']) && isset($_SESSION['id']);
}
?>
