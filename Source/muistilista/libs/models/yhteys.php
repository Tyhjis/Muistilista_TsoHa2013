<?php
function getTietokanta() {
	$yhteys = new PDO("pgsql:");
	$yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	return $yhteys;
}
?>
