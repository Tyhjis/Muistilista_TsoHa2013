<?php

require_once("yhteys.php");

class Kayttaja {
	
	private $id;
	private $etunimi;
	private $sukunimi;
	private $tunnus;
	private $s_posti;
	private $salasana;
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
	
	function getKayttaja ($tunnus, $salasana) {
		$sql = "SELECT * FROM kayttaja WHERE tunnus = ? AND salasana = ?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($tunnus, $salasana));
		
		$tulos = $kysely->fetchObject();
		if ($tulos == null) {
			return null;
		} else {
			$kayttaja = new Kayttaja();
			
			foreach ($tulos as $kentta => $arvo) {
				$kayttaja->$kentta = $arvo;
			}
			return $kayttaja;
		}
	}
	
	function lisaaKayttaja($enimi, $snimi, $username, $email, $pword) {
		$sql = "INSERT INTO kayttaja(etunimi, sukunimi, tunnus, s_posti, salasana, yllapitaja) VALUES
		(?, ?, ?, ?, ?, false)";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($enimi, $snimi, $username, $email, $pword));
	}
	
	function haeAskareenKayttajat ($askareID) {
		$sql = "SELECT kayttaja.id, tunnus FROM kayttaja LEFT JOIN muistilista ON kayttaja.id=muistilista.kayttaja_id WHERE askare_id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($askareID));
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$kayttaja = new Kayttaja();
			foreach($tulos as $kentta => $arvo) {
				$kayttaja->$kentta = $arvo;
			}
			$tulokset[] = $kayttaja;
		}
		return $tulokset;
	}
	
	// Getterit
	function getID () {
		return $this->id;
	}
	
	function getEtunimi () {
		return $this->etunimi;
	}
	
	function getSukunimi () {
		return $this->sukunimi;
	}
	
	function getKokonimi () {
		$kokonimi = $this->etunimi ." ". $this->sukunimi;
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
