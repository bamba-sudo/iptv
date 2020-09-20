<!DOCTYPE html>
<html>
<head>
	<title> test </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container jumbotron bg-dark text-center">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="text-white"> TestPanierDAO </h1>
			</div>
		</div>	
	</div>
	<div class="container p-3 my-3 bg-dark text-white">
		<div class="row">
			<div class="col-sm-12">
				<ul class="list-group list-group-flush">
  					<li class="list-group-item bg-dark">
  						<?php 
  							// define("DOSSIER_BASE_LIENS", "/Projet");  
							// define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."Projet/");

							include_once(DOSSIER_BASE_INCLUDE."modele/DAO/PanierDAO.class.php");

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php 
  						// chercherDAO

  						echo "<h2>chercher()</h2>";

  						$unPanier = PanierDAO::chercher(1);

  						echo "<br />";

  						echo $unPanier ? $unPanier : "aucun panier";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercheTous()</h2>";

  						$unPanier2 = PanierDAO::chercherTous();

  						echo "<br />";

  						if (count($unPanier2)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($unPanier2 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercherAvecFiltre()</h2>";

  						$unPanier3 = PanierDAO::chercherAvecFiltre("WHERE id_panier=6");

  						echo "<br />";

  						if (count($unPanier3)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($unPanier3 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>inserer()</h2>";

  						$unPanier4 = new Panier(8, 203, 90050, 16);

  						PanierDAO::inserer($unPanier4);

  						$unPanier4 = PanierDAO::chercher(8);

  						echo $unPanier4 ? $unPanier4 : "aucun panier";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>modifier()</h2>";

  						$unPanier5 = PanierDAO::chercher(7);

              echo $unPanier5 ? "<ul><li>".$unPanier5."</li></ul>" : "aucun panier";

  						$unPanier5 = new Panier(7, 200, 9005, 20);

  						PanierDAO::modifier($unPanier5);

  						echo $unPanier5 ? $unPanier5 : "aucun panier";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>supprimer()</h2>";

  						$unPanier6 = PanierDAO::chercher(1);


  						if ($unPanier6 == null) {
                echo "n'existe plus";
              } else {
                PanierDAO::supprimer($unPanier6);
                echo "supprimer avec success";
              }
  						?>
  					</li>
				</ul>				
			</div>
		</div>
	</div>
</body>
</html>