<?php $moi = $data->hello; ?>
<!DOCTYPE HTML>
<html>
<body>
<h1><?php echo $moi; ?></h1><br>
<h2>Askareesi:</h2>
<dl>
	<?php foreach($data->lista as $asia) { ?>
	<form action="muokkaus.php" method="GET">
	<dt><textarea rows="1" cols="50" name="otsikko" readonly><?php echo $asia->getOtsikko(); ?></textarea></dt>
		<dd><textarea rows="4" cols="50" name="kuvaus" readonly><?php echo $asia->getKuvaus(); ?></textarea></dd>
		<dd><input type="text" name="ajankohta" value=<?php echo $asia->getAjankohta(); ?> readonly></dd>
		<button class="btn-primary" type="submit">Muokkaa tai poista</button>
	</form>
	<?php } ?>
</dl>
<a href="lisays.php">Lisää askare</a><br>
<a href="logout.php">Kirjaudu ulos</a>
</body>
</html>
