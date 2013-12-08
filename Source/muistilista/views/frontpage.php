<?php $moi = $data->hello;
$tagit;?>
<body>
<h1><?php echo $moi; ?></h1><br>
<h2>Askareesi:</h2>
<table id="myTable" class="table table-striped table-bordered tablesorter">
<thead>
<tr>
	<th>Prior.</th>
	<th>Otsikko</th>
	<th>Kuvaus</th>
	<th>Ajankohta</th>
	<th>Tagit</th>
	<th>Muokkaa</th>
	<th>Poista</th>
	<th>Jaa</th>
</tr>
</thead>
<tbody>
<?php foreach($data->lista as $asia) { ?>
	<tr>
		<?php $id = $asia->getID(); ?>
		<td><?php echo $asia->getPrioriteetti(); ?></td>
		<td><?php echo $asia->getOtsikko(); ?></td>
		<td><?php echo $asia->getKuvaus(); ?></td>
		<td><?php echo $asia->getAjankohta(); ?></td>
		<td><?php $tagit = $asia->haeAskareenTagit($id);
		foreach( $tagit as $tagi ) {
			echo $tagi->nimi . ",\n";
		}?></td>
		<form method="get">	
		<td><button type="submit" class="btn btn-primary" name="id" formaction="muokkaus.php" value=<?php echo $id; ?>>Muokkaa</button></td>
		<td><button type="submit" class="btn btn-danger" name="id" formaction="poista.php" value=<?php echo $id; ?>>Poista</button></td>
		<td><button type="submit" class="btn btn-default" name="id" formaction="jaa.php" value=<?php echo $id;?>>Jaa</button></td>
		</form>
	</tr>
<?php } ?>
</tbody>
</table>
<b>Listaa tagin mukaan:</b>
<form action="etusivu.php" id="tagiform" method="get"></form>
	<select name="tagi" form="tagiform">
		<option value="kaikki">Kaikki</option>
		<?php foreach($data->tagit as $tagi) { ?>
		<option value=<?php echo $tagi->id;?>><?php echo $tagi->nimi;?></option>
		<?php } ?>
	</select>
	<button type="submit" class="btn btn-default" form="tagiform">Näytä</button>
<form action="etusivu.php" method="get">
	<input type="text" name="uusitagi" placeholder="Luo uusi tagi">
	<button class = "btn-default" type="submit">Luo</button>
	<?php if( isset($data->virhe)) { echo $data->virhe; } ?>
</form>
<br><br>
<?php if( $_SESSION['yllapitaja'] == true ) { ?>
		<a href="yllapitaja.php">Ylläpidon sivu</a><br>
	<?php }?>
<a href="lisays.php">Lisää askare</a><br>
</body>
