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
							<table>
							<thead>
							        <tr>
							                <th>Päivä</th>
							                <th>Kuukausi</th>
							                <th>Vuosi</th>
							                <th>Kellonaika</th>
							        </tr>
							</thead>
							<tbody>
							        <tr>
							                <td><input type="text" name="paiva" placeholder="pp"></td>
							                <td><input type="text" name="kuukausi" placeholder="kk"></td>
							                <td><input type="text" name="vuosi" placeholder="VVVV"></td>
							                <td><input type="text" name="tunti" placeholder="hh"></td>
							                <td><input type="text" name="minuutti" placeholder="mm"></td>
							</table>
						</div><br>
						<b>Prioriteetti:</b>
						<select name="prioriteetti">
							<option value="5">5</option>
							<option value="4">4</option>
							<option value="3">3</option>
							<option value="2">2</option>
							<option value="1">1</option>
						</select>
						<button class = "btn-primary" type="submit" name="nappi" value="painettu">Lisää askare</button><br>
					</fieldset>
				</form>
				<?php if( isset($data) ) { echo $data->virhe; }?><br>
				<a href="etusivu.php">Takaisin etusivulle</a>
			</div>
	</body>
