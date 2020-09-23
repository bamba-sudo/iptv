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
				<h1 class="text-white"> TestClientDAO </h1>
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

							include_once(DOSSIER_BASE_INCLUDE."modele/DAO/ClientDAO.class.php");

							$unClient = new Client(1, "Walid", "Gharbi", "walid.gharbi@bnc.ca");

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php 
  						// chercherDAO

  						echo "<h2>chercher()</h2>";

  						$unClient = ClientDAO::chercher(9003);

  						echo "<br />";

  						echo $unClient ? $unClient : "aucun client";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercheTous()</h2>";

  						$unClient2 = ClientDAO::chercherTous();

  						echo "<br />";

  						if (count($unClient2)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($unClient2 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercherAvecFiltre()</h2>";

  						$unClient3 = ClientDAO::chercherAvecFiltre("WHERE prenom='Walid'");

  						echo "<br />";

  						if (count($unClient3)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($unClient3 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>inserer()</h2>";

  						$unClient4 = new Client(90050, "Melanie", "Descartes", "melanie.denali@gmail.com");

  						ClientDAO::inserer($unClient4);

  						$unClient4 = ClientDAO::chercher(90050);

  						echo $unClient4 ? $unClient4 : "aucun client";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>modifier()</h2>";

  						$unClient5 = ClientDAO::chercher(9002);

              echo $unClient5 ? "<ul><li>".$unClient5."</li></ul>" : "aucun client";

  						$unClient5 = new Client(9002, "Robert", "JeanBaptiste", "w.gharbi.tangerine@gmail.com");

  						ClientDAO::modifier($unClient5);

  						echo $unClient5 ? $unClient5 : "aucun client";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>supprimer()</h2>";

  						$unClient6 = ClientDAO::chercher(9004);

  						ClientDAO::supprimer($unClient6);

  						echo $unClient6 ? "existe encore" : "n'existe plus";
  						?>
  					</li>
				</ul>				
			</div>
		</div>
	</div>
</body>
</html>