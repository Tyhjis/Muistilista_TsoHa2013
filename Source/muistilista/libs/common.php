<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
	$data = (object)$data;
	require 'views/template.php';
	require 'views/'.$sivu;
	require 'views/lowertemplate.php';
	die();
}

function alustaIstunto($kayttajatunnus, $id, $yllapitaja) {
	$_SESSION['kayttaja'] = $kayttajatunnus;
	$_SESSION['id'] = $id;
	$_SESSION['yllapitaja'] = $yllapitaja;
}

function lopetaIstunto() {
	unset($_SESSION['kayttaja']);
	unset($_SESSION['id']);
}

function tarkistaKirjautuminen() {
	return isset($_SESSION['kayttaja']) && isset($_SESSION['id']);
}

function tarkistaKuukausi( $kuukausi ) {
        return ($kuukausi >= 1) && ($kuukausi <= 12);
}

function tarkistaPaiva( $vuosi, $kuukausi, $paiva ) {
        if( !(tarkistaKuukausi( $kuukausi ) && tarkistaVuosi( $vuosi )) ) {
			return false;
		}
        if($kuukausi == 2) {
                if( onkoKarkausvuosi($vuosi) ) {
                        return ($paiva >= 1) && ($paiva <= 29);
                } else {
                        return ($paiva >= 1) && ($paiva <= 28);
                }
        }
        if($kuukausi == 1 || $kuukausi == 3 || $kuukausi == 5 || $kuukausi == 7 || $kuukausi == 8 || $kuukausi == 10 || $kuukausi == 12) {
                return ($paiva >= 1) && ($paiva <= 31);
        } else {
                return ($paiva >= 1) && ($paiva <= 30);
        }
}

function tarkistaTunnit( $tunti ) {
        return ($tunti >= 0) && ($tunti <= 24);
}

function tarkistaMinuutit( $minuutti ) {
        return ($minuutti >= 0) && ($minuutti <= 59);
}

function tarkistaVuosi( $vuosi ) {
        return ($vuosi >= 1) && ($vuosi <= 2059);
}

function onkoKarkausvuosi( $vuosi ) {
        return ($vuosi % 4 == 0 && $vuosi % 100 != 0) || $vuosi %400 == 0;
}
?>
