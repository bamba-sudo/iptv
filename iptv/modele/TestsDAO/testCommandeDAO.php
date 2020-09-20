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
				<h1 class="text-white"> TestCommandeDAO </h1>
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

							include_once(DOSSIER_BASE_INCLUDE."modele/DAO/CommandeDAO.class.php");

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php 
  						// chercherDAO

  						echo "<h2>chercher()</h2>";

  						$uneCommande = CommandeDAO::chercher(1);

  						echo "<br />";

  						echo $uneCommande ? $uneCommande : "aucune commande";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercheTous()</h2>";

  						$uneCommande2 = CommandeDAO::chercherTous();

  						echo "<br />";

  						if (count($uneCommande2)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($uneCommande2 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercherAvecFiltre()</h2>";

  						$uneCommande3 = CommandeDAO::chercherAvecFiltre("WHERE id_commande=2");

  						echo "<br />";

  						if (count($uneCommande3)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($uneCommande3 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>inserer()</h2>";

  						$uneCommande4 = new Commande(4, "2020-06-09", 200, 9005, 4, 45);

  						CommandeDAO::inserer($uneCommande4);

  						$uneCommande4 = CommandeDAO::chercher(4);

  						echo $uneCommande4 ? $uneCommande4 : "aucune commande";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>modifier()</h2>";

  						$uneCommande5 = CommandeDAO::chercher(2);

              echo $uneCommande5 ? "<ul><li>".$uneCommande5."</li></ul>" : "aucune commande";

  						$uneCommande5 = new Commande(2, "2020-07-10", 200, 9002, 5, 100);

  						CommandeDAO::modifier($uneCommande5);

  						echo $uneCommande5 ? $uneCommande5 : "aucune commande";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>supprimer()</h2>";

  						$uneCommande6 = CommandeDAO::chercher(1);


  						if ($uneCommande6 == null) {
                echo "n'existe plus";
              } else {
                CommandeDAO::supprimer($uneCommande6);
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