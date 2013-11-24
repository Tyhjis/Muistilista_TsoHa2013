<?php
require_once 'libs/common.php';
if( tarkistaKirjautuminen() ) {
	lopetaIstunto();
}
header('Location: http://krha.users.cs.helsinki.fi/muistilista/kirjautuminen.php');
?>
