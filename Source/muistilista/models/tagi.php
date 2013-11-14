<?php
require_once ("utils/yhteys.php");

class Tagi {
	
	private $id;
	private $nimi;
	
	
	// Getterit
	function getTagit () {
		$sql = "SELECT * FROM tagi";
	}	
	
	function getID () {
		return $this->id;
	}
	
	function getNimi () {
		return $this->nimi;
	}
	
	// Setterit
	function setNimi ($name) {
		$this->nimi = $name;
	}
	
	// Lisäys
	function lisaaTagi () {
		$sql = "INSERT INTO tagi (nimi) VALUES ('".$this->nimi."')";
	}
	
}
?>
