<?php
$vanhaotsikko = $data->vanhaotsikko;
$vanhakuvaus = $data->vanhakuvaus;
?>
<!DOCTYPE HTML>
<html>
<body>
		<h1>Askareen muokkaus</h1>
			<div class="form-group">
				<h2>Muokkaa askaretta</h2>
				<form action = "muokkaus.php" method = "GET">
					<fieldset>
						<div class="clearfix">
							<textarea rows="1" cols="50" name="uusiotsikko"><?php echo $vanhaotsikko; ?></textarea>
						</div>
						<div class = "clearfix">
							<textarea rows="4" cols="50" name="uusikuvaus"><?php echo $vanhakuvaus; ?></textarea>
						</div>
						<div class = "clearfix">
							Päivämäärä ja aika:<br>
							<input type = "datetime-local">
						</div>
						<button class = "btn-primary" type="submit">Muokkaa</button><br>
						<button class = "btn-secondary" type="submit" formaction="poista.php">Poista</button><br>
					</fieldset>
				</form>
				<a href="etusivu.php">Takaisin etusivulle</a>
			</div>
	</body>
</html>
