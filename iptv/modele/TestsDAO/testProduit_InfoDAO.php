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
				<h1 class="text-white"> TestProduitInfo </h1>
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

							include_once(DOSSIER_BASE_INCLUDE."modele/DAO/Produit_InfoDAO.class.php");

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php 
  						// chercherDAO

  						echo "<h2>chercher()</h2>";

  						$unProduit = ProduitInfoDAO::chercher(200);

  						echo "<br />";

  						echo $unProduit ? $unProduit : "aucun produit";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercheTous()</h2>";

  						$unProduit1 = ProduitInfoDAO::chercherTous();

  						echo "<br />";

  						if (count($unProduit1)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($unProduit1 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercherAvecFiltre()</h2>";

  						$unProduit2 = ProduitInfoDAO::chercherAvecFiltre("WHERE add_mag='123456'");

  						echo "<br />";

  						if (count($unProduit2)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($unProduit2 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>inserer()</h2>";

  						$unProduit3 = new ProduitInfo(201, "pro656", "637472");

  						ProduitInfoDAO::inserer($unProduit3);

              $unProduit8 = ProduitInfoDAO::chercher(200);
              echo "1 ".$unProduit8;

  						$unProduit3 = ProduitInfoDAO::chercher(201);

  						echo $unProduit3 ? $unProduit3 : "aucun produit";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>modifier()</h2>";

  						$unProduit10 = ProduitInfoDAO::chercher(201);
              $unProduit6 = ProduitInfoDAO::chercher(200);
              echo $unProduit6;

              echo $unProduit10 ? "<ul><li>".$unProduit10."</li></ul>" : "aucun produit";

  						$unProduit4 = new ProduitInfo(201, "lol234", "243342");

  						ProduitInfoDAO::modifier($unProduit4);

              $unProduit7 = ProduitInfoDAO::chercher(200);
              echo $unProduit7;

  						echo $unProduit4 ? $unProduit4 : "aucun produit";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>supprimer()</h2>";

  						$unProduit5 = ProduitInfoDAO::chercher(200);
              echo $unProduit5;

              if ($unProduit5 == null) {
                echo "n'existe plus";
              } else {
                ProduitInfoDAO::supprimer($unProduit5);
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