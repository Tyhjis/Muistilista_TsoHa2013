<!DOCTYPE HTML>
<html>
<body>
			<div class = "login-form">
				<h2>Rekisteröi</h2>
				<form action = "rekisteroi.php" method = "POST">
					<fieldset>						
						<div class="clearfix">
							<input type = "text" placeholder="Etunimi" name = "etunimi"><br>
							<input type = "text" placeholder="Sukunimi" name = "sukunimi"><br>
							<input type = "text" placeholder="Sähköposti" name = "sahkoposti"><br>
							<input type = "text" placeholder="Käyttäjätunnus" name = "kayttajatunnus">
						</div>
						<div class = "clearfix">
							<input type = "password" placeholder = "Salasana" name = "salasana1"><br>
							<input type = "password" placeholder = "Salasana uudestaan" name = "salasana2">
						</div>
						<button class = "btn-primary" type="submit">Rekisteröidy</button><br>
					</fieldset>
				</form>
			</div>
			<?php echo $data->virhe; ?><br>
			<a href="kirjautuminen.php">Takaisin kirjautumiseen</a><br>
	</body>
</html>
 
