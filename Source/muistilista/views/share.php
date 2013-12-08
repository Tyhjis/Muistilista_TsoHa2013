<?php 
$askare = $data->askare;
?>
<body>
	<h1>Kenelle haluat jakaa askareen: "<?php echo $askare->getOtsikko();?>"</h1>
	<table id="mytable" class="table table-striped table-bordered tablesorter">
		<thead>
			<tr>
				<th>Tunnus</th>
				<th>Nimi</th>
				<th>Jaa</th>
			</tr>
		</thead>
<tbody>
<?php foreach ($data->kayttajat as $asia) { ?>
<tr>
	<td><?php echo $asia->getTunnus();?></td>
	<form method="get" action="jaa.php">
	<td><?php echo $asia->getKokonimi();?></td>
	<td>
		<input type="hidden" name="askareID" value=<?php echo $askare->getID(); ?>>
		<button type="submit" class="btn btn-default" name="kayttajaID" value=<?php echo $asia->getID();?>>Jakoon</button>
	</td>
	</form>
</tr>
<?php } ?>
</table>
<p>Tämän askareen näkevät nämä käyttäjät: <?php foreach( $data->askareenKayttajat as $kayttaja ) { echo $kayttaja->getTunnus()." "; } ?></p>

</body>
<a href="etusivu.php">Takaisin etusivulle</a><br>
