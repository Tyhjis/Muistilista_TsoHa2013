<?php
require_once("utils/yhteys.php");

class Askare {
	
	private $id;
	private $otsikko;
	private $kuvaus;
	
	// Hakufunktiot
	function haeAskareet () {
		$sql = "SELECT * FROM askare";
	}
	
	function haeKayttajanAskareet ($kayttajaID) {
		$sql = "SELECT otsikko, kuvaus, ajankohta FROM askare LEFT JOIN muistilista ON askare.id=muistilista.askare_id WHERE kayttaja_id=".$kayttajaID;
	}
	
	function haeAskareenTagit ($askareID) {
		$sql = "SELECT nimi FROM tagi LEFT JOIN tagilista ON tagi.id=tagilista.tagi_id WHERE askare_id=".$askareID;
	}
	
	// Getterit
	function getID () {
		return $this->id;
	}
	
	function getOtsikko () {
		return $this->otsikko;
	}
	
	function getKuvaus () {
		return $this->kuvaus;
	}
	
	// Setterit
	function setOtsikko ($teksti) {
		$this->otsikko = $teksti;
	}
	
	function setKuvaus ($teksti) {
		$this->kuvaus = $teksti;
	}
	
}

?>
