<?php
require_once("yhteys.php");
require_once("kayttaja.php");
require_once("tagi.php");

class Askare {
	private $id;
	private $prioriteetti;	
	private $otsikko;
	private $kuvaus;
	private $ajankohta;
	private $tagit;
	// Hakufunktiot
	function haeAskare ($askareID) {
		$sql = "SELECT * FROM askare where id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($askareID));
		
		$tulos = $kysely->fetchObject();
		if ($tulos == null) {
			return null;
		} else {
			$askare = new Askare();
			
			foreach ($tulos as $kentta => $arvo) {
				$askare->$kentta = $arvo;
			}
			return $askare;
		}
	}
	
	function haeKayttajanAskareet ($kayttajaid) {
		$sql = "SELECT prioriteetti, askare.id, otsikko, kuvaus, ajankohta FROM askare LEFT JOIN muistilista ON askare.id=muistilista.askare_id WHERE kayttaja_id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($kayttajaid));
		
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
	
	function haeKayttajanAskareetTaginKanssa ($kayttajaID, $tagiID) {
		$sql = "SELECT askare.id, otsikko, kuvaus, ajankohta FROM askare LEFT JOIN muistilista ON askare.id=muistilista.askare_id LEFT JOIN tagilista ON askare.id=tagilista.askare_id WHERE kayttaja_id=? AND tagi_id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($kayttajaID, $tagiID));
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$askare = new Askare();
			foreach($tulos as $kentta => $arvo) {
				$askare->$kentta = $arvo;
			}
			$tulokset[] = $askare;
		}
		return $tulokset;
	}
	
	function haeTagit() {
		$sql = "SELECT * FROM tagi";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute();
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$tagi = new Tagi();
			foreach($tulos as $kentta => $arvo) {
				$tagi->$kentta = $arvo;
			}
			$tulokset[]=$tagi;
		}
		return $tulokset;
	}
	
	function haeAskareenTagit($askareID) {
		$sql = "SELECT tagi.id, nimi FROM tagi LEFT JOIN tagilista ON tagi.id=tagilista.tagi_id WHERE askare_id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($askareID));
				
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$tagi = new Tagi();
			foreach($tulos as $kentta => $arvo) {
				$tagi->$kentta = $arvo;
			}
			$tulokset[] = $tagi;
		}
		return $tulokset;
	}

	// Lisäysfunktiot
	
	function lisaaAskare ($heading, $kuvailu, $pvm, $kayttajaID, $prioriteetti) {
		$sql1 = "INSERT INTO askare(prioriteetti, otsikko, kuvaus, ajankohta) VALUES(?, ?, ?, ?)";
		$sql2 = "INSERT INTO muistilista(kayttaja_id, askare_id) VALUES(?, (SELECT id FROM askare WHERE otsikko=? AND ajankohta=?))";
		
		// Ensin lisätään askare
		$kysely = getTietokanta()->prepare($sql1);
		$kysely->execute(array($prioriteetti, $heading, $kuvailu, $pvm));
		
		// Liitetään käyttäjä ja askare yhteen.
		$kysely = getTietokanta()->prepare($sql2);
		$kysely->execute(array($kayttajaID, $heading, $pvm));
	}
	
	function jaaAskare ($kayttajaID, $askareID) {
		$sql = "INSERT INTO muistilista(kayttaja_id, askare_id) VALUES(?, ?)";
		
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($kayttajaID, $askareID));
	}
	
	function lisaaTagiAskareeseen($tagiID, $askareID) {
		$sql = "INSERT INTO tagilista(tagi_id, askare_id) VALUES(?,?)";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($tagiID, $askareID));
	}
	
	// Muokkaus
	
	function muokkaaAskaretta ($askareID, $heading, $kuvailu, $pvm, $prioriteetti) {
		$sql = "UPDATE askare SET prioriteetti=?, otsikko=?, kuvaus=?, ajankohta=? WHERE id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($prioriteetti, $heading, $kuvailu, $pvm, $askareID));	
	}
	
	// POISTO
	
	function poistaAskare ($id, $kayttajaID) {
		$sql1 = "DELETE FROM muistilista WHERE askare_id=? AND kayttaja_id=?";
		$sql3 = "DELETE FROM tagilista WHERE askare_id=?";
		$sql2 = "DELETE FROM askare WHERE id=?";
		
		$kysely = getTietokanta()->prepare($sql1);
		$kysely->execute(array($id, $kayttajaID));
		
		$kayttajia = Askare::tarkistaOnkoAskareellaKayttajia( $id );
		if( !$kayttajia ) {
			$kysely = getTietokanta()->prepare($sql3);
			$kysely->execute(array($id));
			
			$kysely = getTietokanta()->prepare($sql2);
			$kysely->execute(array($id));
		}
	}
	
	function poistaTagiAskareesta ($askareID, $tagiID) {
		$sql = "DELETE FROM tagilista WHERE askare_id=? AND tagi_id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($askareID, $tagiID));
	}
	
	function tarkistaOnkoAskareellaKayttajia( $askareID ) {
		$sql = "SELECT id FROM muistilista WHERE askare_id=?";
		$kysely = getTietokanta()->prepare($sql);
		$kysely->execute(array($askareID));
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$tulokset[] = $tulos;
		}
		
		return count($tulokset) != 0;
	}
	
	function luoUusiTagi( $nimi ) {
		$sql1 = "INSERT INTO tagi(nimi) VALUES(?)";
		$sql2 = "SELECT * FROM tagi WHERE nimi=?";
		$kysely = getTietokanta()->prepare($sql2);
		$kysely->execute(array($nimi));
		$rivit = $kysely->rowCount();
		
		if( $rivit == 0 ) {
			$kysely = getTietokanta()->prepare($sql1);
			$kysely->execute(array($nimi));
			return true;
		}
		return false;
	}
	
	function poistaTagiTietokannasta( $id ) {
		$sql1 = "DELETE FROM tagilista WHERE tagi_id=?";
		$sql2 = "DELETE FROM tagi where id=?";
		
		$kysely = getTietokanta()->prepare($sql1);
		$kysely->execute(array($id));
		
		$kysely = getTietokanta()->prepare($sql2);
		$kysely->execute(array($id));
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
	
	function getPrioriteetti () {
		return $this->prioriteetti;
	}	
}
?>
