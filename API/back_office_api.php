<?php

	$curl = curl_init('http://pacoret.chalon.codeur.online/API/api.php?projet');
        
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_HEADER,0);
    curl_setopt($curl,CURLOPT_TIMEOUT,3);
    $data = curl_exec($curl);
    curl_close($curl);
        
        
    $data = json_decode($data);

    // echo "<pre>"; print_r($data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mon Back Office</title>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

	
		<div class="container-fluid">
			<div class="col-lg-6 col-sm-12">
				<h2 class="col-lg-offset-2">Créer un nouveau projet</h2>
				<form action="http://pacoret.chalon.codeur.online/API/api.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3" for="nomProjet">Nom du projet :</label>
					<div class="col-sm-9">
						<input type="text" name="nomProjet" id="nomProjet">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="urlProjet">Url du site :</label>
					<div class="col-sm-9">
						<input type="text" name="urlProjet" id="urlProjet">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="langagesProjet">Langage(s) :</label>
					<div class="col-sm-9">
						<input type="text" name="langagesProjet" id="langagesProjet">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="descriptionProjet">Description :</label>
					<div class="col-sm-9">
						<textarea name="descriptionProjet" id="descriptionProjet"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="nomImage">Image :</label>
					<div class="col-sm-9">
						<input type="file" name="nomImage" id="nomImage">
					</div>
				</div>
				<input type="submit" name="ajoute" value="créer" id="creer" class="btn btn-success">
				</form>
			</div>
			<div class="col-lg-6 col-sm-12">
				<h2 class="col-lg-offset-2">Modifier un projet</h2>
				<form action="http://pacoret.chalon.codeur.online/API/api.php" method="post" enctype="multipart/form-data">
				<div class="col-sm-offset-3 col-sm-9">
					<select id="select" name="select">
						<option>Choisi un projet à modifier</option>
							<?php foreach ($data as $projet): ?>
								<option value="<?= $projet->id ?>"><?= $projet->Nom?></option>
							<?php endforeach ?>
					</select>
				</div>
					<div class="form-group">
						<label class="col-sm-3" for="ModifUrlProjet">Url du site :</label>
						<div class="col-sm-9">
							<input type="text" name="ModifUrlProjet" id="ModifUrlProjet">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3" for="ModifLangagesProjet">Langage(s) :</label>
						<div class="col-sm-9">
							<input type="text" name="ModifLangagesProjet" id="ModifLangagesProjet">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3" for="ModifDescriptionProjet">Description :</label>
						<div class="col-sm-9">
							<textarea name="ModifDescriptionProjet" id="ModifDescriptionProjet"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3" for="ModifNomImage">Image :</label>
						<div class="col-sm-9">
							<input type="file" name="ModifNomImage" id="ModifNomImage">
						</div>
					</div>
					<input type="submit" name="modif" value="modifier" id="modifier" class="btn btn-warning">
				</form>
			</div>
		</div>
		
		<h2>Supprimer un dossier</h2>
		<form action="http://pacoret.chalon.codeur.online/API/api.php">
			<select id="suppr">
				<option>Choisi un projet à supprimer</option>
				<?php foreach ($data as $projet): ?>
					<option value="<?= $projet->id ?>"><?= $projet->Nom ?></option>
				<?php endforeach ?>
			</select><br>
			<input type="submit" name="supprime" value="supprimer" id="supprimer" class="btn btn-danger">
		</form>
		<p id="confirm"></p>
		<br><br><br>
		<article class="projets">
			<h2>Tous les projets</h2>
			<?php foreach ($data as $projet): ?>
				<div class="projet col-lg-3" style="text-align: center;">
				<h3><?= $projet->Nom ?></h3>
				<img src="<?= $projet->Image ?>">
				<p><?= $projet->url_site ?></p>
				<p><?= $projet->description ?></p>
				<p><?= $projet->Langages ?></p>
				</div>
			<?php endforeach ?>
		</article>
		<script type="text/javascript">
			$(document).ready( function(){


				$('#supprimer').on('click', function(e){

					e.preventDefault();

					var supprime = $('#suppr').val();
					console.log(supprime);
					var suppr = {

						suppr: {
							supprime: supprime
						}
					};

					$.ajax({
						type: "DELETE",
						url: "http://pacoret.chalon.codeur.online/API/api.php",
						contentType: "application/json",
						data: JSON.stringify(suppr),
						succes: function(suppr){
							document.getElementById('confirm').innerHTML = "Projet bien suprimmer";
						}
					});
				});

			});
		</script>
</body>
</html>