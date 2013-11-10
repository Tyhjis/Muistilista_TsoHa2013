<?php
require_once("utils/yhteys.php");
class Kayttaja {
	private $id;
	private $username;
	private $email;
	
	public static function getKayttajat() {
		$sql = "SELECT ID, tunnus, s_posti FROM kayttaja";
		$kysely = getTietokanta()->prepare($sql); $kysely->execute();
		
		$tulokset = array();
		foreach($kysely->fetchAll() as $tulos) {
			$kayttaja = new Kayttaja(); 
		/* Käytetään PHP:n vapaamielistä muuttujamallia olion
			kenttien asettamiseen */
			foreach($tulos as $kentta => $arvo) {
			$kayttaja->$kentta = $arvo;
			}
		$tulokset[] = $kayttaja;
		}
		return $tulokset;
	}
	
	public function getAllFields() {
		$fields = $this->id . $this->username . $this->email;
		return $fields;
	}
}
