<?php

require_once("utils/yhteys.php");

class Kayttaja {
	
	private $ID;
	private $etunimi;
	private $sukunimi;
	private $tunnus;
	private $passwd;
	private $email;
	private $yllapitaja;
	
	// Hakufunktiot
	function getKayttajat () {
		$sql = "SELECT * FROM kayttaja";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute();
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$kayttaja = new Kayttaja();
			foreach($tulos as $kentta => $arvo) {
				$kayttaja->$kentta = $arvo;
			}
			$tulokset[] =$kayttaja;
		}
		return $tulokset;
	}
	
	function lisaaKayttaja() {
		$sql = "INSERT INTO kayttaja(etunimi, sukunimi, tunnus, s_posti, salasana, yllapitaja) VALUES
		('".$this->etunimi."','".$this->sukunimi."','".$this->tunnus."','".$this->email."','".$this->passwd."', false)";
	}
	
	// Getterit
	function getID () {
		return $this->ID;
	}
	
	function getEtunimi () {
		return $this->etunimi;
	}
	
	function getSukunimi () {
		return $this->sukunimi;
	}
	
	function getKokonimi () {
		$kokonimi = $this->etunimi . . $this->sukunimi;
		return $kokonimi;
	}
	
	function getTunnus () {
		return $this->tunnus;
	}
	
	function getEMail () {
		return $this->email;
	}
	
	function isYllapitaja () {
		return $this->yllapitaja;
	}
	
	// Setterit
	function setEtunimi ($nimi) {
		$this->etunimi = $nimi;
	}
	
	function setSukunimi ($nimi) {
		$this->sukunimi = $nimi;
	}
	
	function setTunnus ($nimi) {
		$this->tunnus = $nimi;
	}
	
	function setPasswd ($sana) {
		$this->passwd = $sana;
	}
	
	function setEMail ($posti) {
		$this->email = $posti;
	}
}

?>
