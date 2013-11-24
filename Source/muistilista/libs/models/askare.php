<?php
require_once("yhteys.php");

class Askare {
	private $otsikko;
	private $kuvaus;
	private $ajankohta;
	
	// Hakufunktiot
	function haeAskareet () {
		$sql = "SELECT * FROM askare";
	}
	
	function haeKayttajanAskareet ($kayttaja) {
		$sql = "SELECT otsikko, kuvaus, ajankohta FROM askare LEFT JOIN muistilista ON askare.id=muistilista.askare_id WHERE kayttaja_id=(SELECT id FROM kayttaja WHERE tunnus=?)";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($kayttaja));
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$askare = new Askare();
			foreach($tulos as $kentta => $arvo) {
				$askare->$kentta = $arvo;
			}
			$tulokset[] =$askare;
		}
		return $tulokset;
	}
	

	// Lisäysfunktiot
	
	function lisaaAskare ($heading, $kuvailu, $pvm, $kayttaja) {
		$sql1 = "INSERT INTO askare(otsikko, kuvaus, ajankohta) VALUES(?, ?, ?)";
		$sql2 = "INSERT INTO muistilista(kayttaja_id, askare_id) VALUES((SELECT id FROM kayttaja WHERE tunnus=?), (SELECT id FROM askare WHERE otsikko=?))";
		
		// Ensin lisätään askare
		$kysely = getTietokanta()->prepare($sql1);
		$kysely->execute(array($heading, $kuvailu, $pvm));
		
		// Liitetään käyttäjä ja askare yhteen.
		$kysely = getTietokanta()->prepare($sql2);
		$kysely->execute(array($kayttaja, $heading));
	}
	
	// Muokkaus
	
	function muokkaaAskaretta ($heading, $kuvailu, $pvm, $vanhaotsikko) {
		$sql = "UPDATE askare SET otsikko=?, kuvaus=?, ajankohta=? WHERE otsikko=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($heading, $kuvailu, $pvm, $vanhaotsikko));		
	}
	
	// POISTO
	
	function poistaAskare ($heading) {
		$sql1 = "DELETE FROM muistilista WHERE askare_id=(SELECT id FROM askare WHERE otsikko=?)";
		$sql2 = "DELETE FROM askare WHERE otsikko=?";
		
		$kysely = getTietokanta()->prepare($sql1);
		$kysely->execute(array($heading));
		
		$kysely = getTietokanta()->prepare($sql2);
		$kysely->execute(array($heading));		
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
	
	function getAjankohta () {
		return $this->ajankohta;
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
