<?php
require_once ("yhteys.php");

class Tagi {
	
	private $id;
	private $nimi;
	
	
	// Getterit
	
	function haeAskareenTagit ($askareotsikko) {
		$sql = "SELECT id, nimi FROM tagi LEFT JOIN tagilista ON tagi.id=tagilista.tagi_id WHERE askare_id=(SELECT id FROM askare WHERE otsikko=?)";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($askareotsikko));
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$tagi = new Tagi();
			foreach($tulos as $kentta => $arvo) {
				$tagi->$kentta = $arvo;
			}
			$tulokset[] =$tagi;
		}
	}
	
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
