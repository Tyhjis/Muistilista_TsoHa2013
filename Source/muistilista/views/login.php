<!DOCTYPE html>
<html>
	<body>
		<h1>Muistilista</h1>
		<p>Tervetuloa muistilistaan! Aloita joko kirjautumalla sisään tai luomalla itsellesi käyttäjätunnus.</p>
			<div class = "login-form">
				<h2>Kirjaudu</h2>
				<form action = "kirjautuminen.php" method = "POST">
					<fieldset>
						<div class="clearfix">
							<input type = "text" placeholder="Käyttäjätunnus" name = "username">
						</div>
						<div class = "clearfix">
							<input type = "password" placeholder = "Salasana" name = "password">
						</div>
						<button class = "btn-primary" type="submit">Kirjaudu</button><br>
						<button class = "btn-secondary" type="submit" formaction = "rekisteroi.php">Rekisteröidy</button><br>
					</fieldset>
				</form>
<?php echo $data->virhe; ?>
			</div>
	</body>
	
	
</html>
