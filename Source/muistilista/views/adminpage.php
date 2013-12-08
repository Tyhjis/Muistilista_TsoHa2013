<?php
$kayttajat = $data->kayttajat;
?>
<body>
	<table id="mytable" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Tunnus</th>
				<th>Nimi</th>
				<th>Admin</th>
				<th>Erota</th>
				<th>Korota adminiksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($kayttajat as $kayttaja) { ?>
			<tr>
				<td><?php echo $kayttaja->getTunnus(); ?></td>
				<td><?php echo $kayttaja->getKokonimi(); ?></td>
				<td><?php if($kayttaja->isYllapitaja() == true) {
								echo "On";
						  } else {
							    echo "Ei";
							}?></td>
				<form action="yllapitaja.php" method="get">
				<td><button class="btn btn-danger" value=<?php echo $kayttaja->getID(); ?> name="erotus">Erota</button></td>
				<td><button class="btn btn-default" value=<?php echo $kayttaja->getID(); ?> name="korotus">Korota</button></td>
				</form>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<h4>Poista tagi tietokannasta:</h4>
	<form action="yllapitaja.php" id="taginpoistokannasta" method="get"></form>
	<select name="poistatagi" form="taginpoistokannasta">
		<?php foreach($data->tagit as $tagi) { ?>
					<option value=<?php echo $tagi->id; ?>><?php echo $tagi->nimi ?></option>
		<?php } ?>
	</select>
	<button class="btn btn-default" type="submit" form="taginpoistokannasta">Poista</button><br>
	<a href="etusivu.php">Takaisin etusivulle</a><br>
</body>
