<?php
//Lista asioista array-tietotyyppiin laitettuna:
require_once "kayttaja.php";
require_once "utils/yhteys.php";
$lista = Kayttaja::getKayttajat();
?><!DOCTYPE HTML>
<html>
  <head><title>Muistilista: Etusivu</title></head>
  <body>
    <h1>Muistilistan käyttäjät:</h1>
    <ul>
    <?php foreach($lista as $asia) { ?>
      <li><?php echo $asia->getAllFields(); ?></li>
    <?php } ?>
    </ul>
    <a href="addaskare.html">Askareen lisäys</a><br>
    <a href="editaskare.html">Askareen muokkaus</a>
  </body>
</html>
