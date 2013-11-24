<!DOCTYPE HTML>
<html>
	<body>
		<h1>Askareen lisäys</h1>
			<div class="form-group">
				<h2>Lisää askare</h2>
				<form action = "lisays.php" method = "POST">
					<fieldset>
						<div class="clearfix">
							<input type = "text" placeholder="Lisää askareen otsikko (pakollinen)." name ="otsikko">
						</div>
						<div class = "clearfix">
							<textarea rows="4" cols="50" name="kuvaus"></textarea>
						</div>
						<div class = "clearfix">
							Päivämäärä ja aika:<br>
							<input type = "datetime-local" name="ajankohta">
						</div>
						<button class = "btn-primary" type="submit">Lisää askare</button><br>
					</fieldset>
				</form>
				<a href="etusivu.php">Takaisin etusivulle</a>
			</div>
	</body>
</html>
