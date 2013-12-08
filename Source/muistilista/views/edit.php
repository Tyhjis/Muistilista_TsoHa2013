<?php
$id = $data->id;
$vanhaotsikko = $data->vanhaotsikko;
$vanhakuvaus = $data->vanhakuvaus;
$vuosi = $data->vuosi;
$paiva = $data->paiva;
$kuukausi = $data->kuukausi;
$tunti = $data->tunti;
$minuutti = $data->minuutti;
?>
<body>
		<h1>Askareen muokkaus</h1>
			<div class="form-group">
				<h2>Muokkaa askaretta</h2>
				<form action = "muokkaus.php" id="paivitysform" method = "GET">
					<fieldset>
						<div class="clearfix">
							<textarea rows="1" cols="50" name="uusiotsikko" form="paivitysform"><?php echo $vanhaotsikko; ?></textarea>
						</div>
						<div class = "clearfix">
							<textarea rows="4" cols="50" name="uusikuvaus" form="paivitysform"><?php echo $vanhakuvaus; ?></textarea>
						</div>
						<div class = "clearfix">
							Päivämäärä ja aika: (vvvv-kk-pp tt:mm:ss)<br>
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
							                <td><input type="text" name="paiva" form="paivitysform" value=<?php echo $paiva;?>></td>
							                <td><input type="text" name="kuukausi" form="paivitysform" value=<?php echo $kuukausi;?>></td>
							                <td><input type="text" name="vuosi" form="paivitysform" value=<?php echo $vuosi;?>></td>
							                <td><input type="text" name="tunti" form="paivitysform" value=<?php echo $tunti;?>></td>
							                <td><input type="text" name="minuutti" form="paivitysform" value=<?php echo $minuutti;?>></td>
							</table>
						</div><br>
							<p>Tagit: <?php foreach( $data->askareentagit as $tagi ) {
											echo $tagi->nimi.", ";
									 } ?></p>
						<br>
						<b>Prioriteetti:</b>
						<select name="prioriteetti">
							<option value="5">5</option>
							<option value="4">4</option>
							<option value="3">3</option>
							<option value="2">2</option>
							<option value="1">1</option>
						</select>
						<button class = "btn-primary" type="submit" name="uid" value=<?php echo $id; ?> form="paivitysform">Muokkaa</button><br>
					</fieldset>
				</form>
				<form id="tagiform" method="get">
							<select name="tagilisays" form="tagiform">
								<?php foreach($data->tagit as $tagi) { ?>
								<option value=<?php echo $tagi->id;?>><?php echo $tagi->nimi;?></option>
								<?php } ?>
							</select>
						</form>
						<button class = "btn btn-default" type="submit" name="tagiAsk" value=<?php echo $id; ?> form="tagiform">Lisää tagi askareeseen</button><br>
						
				<form id="tagidelform" method="get">
					<select name="tagipoisto" form="tagidelform">
						<?php foreach($data->askareentagit as $tagi) { ?>
						<option value=<?php echo $tagi->id;?> ><?php echo $tagi->nimi; ?></option>
						<?php } ?>					
					</select>
				</form>
				<button class="btn btn-default" type="submit" name="tagiDel" value=<?php echo $id; ?> form="tagidelform">Poista tagi askareesta</button><br>
				<a href="etusivu.php">Takaisin etusivulle</a><br>
				<?php if( isset($data->virhe) ) {
					echo $data->virhe;
				} ?>
			</div>
</body>
