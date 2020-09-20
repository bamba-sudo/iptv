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
				<h1 class="text-white"> TestUtilisateurDAO </h1>
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

							include_once(DOSSIER_BASE_INCLUDE."modele/DAO/UtilisateurDAO2.class.php");

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php 
  						// chercherDAO

  						echo "<h2>chercher()</h2>";

  						$user1 = UtilisateurDAO::chercher(9002);

  						echo "<br />";

  						echo $user1 ? $user1 : "aucun client";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercheTous()</h2>";

  						$user2 = UtilisateurDAO::chercherTous();

  						echo "<br />";

  						if (count($user2)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($user2 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>chercherAvecFiltre()</h2>";

  						$user3 = UtilisateurDAO::chercherAvecFiltre("WHERE user='root'");

  						echo "<br />";

  						if (count($user3)==0) {
                echo "<li>Aucune équipe trouvée</li>";
              }
              echo "<ul>";
              foreach ($user3 as $key){
                echo "<li>".$key."</li>";
              }
              echo "</ul";

  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php

  						echo "<h2>inserer()</h2>";

  						$user4 = new Utilisateur(9006,"rara","rara");

  						UtilisateurDAO::inserer($user4);

  						$user4 = UtilisateurDAO::chercher("rara");

  						echo $user4 ? $user4 : "aucun client";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>modifier()</h2>";

  						$user5 = UtilisateurDAO::chercher(9002);

              echo $user5 ? "<ul><li>".$user5."</li></ul>" : "aucun client";

  						$user5 = new Utilisateur(9009,"root", "kali");

  						UtilisateurDAO::modifier($user5);

  						echo $user5 ? $user5 : "aucun client";

  						?>
  					</li>
  					<li>
  						<?php

  						echo "<h2>supprimer()</h2>";

  						$user6 = UtilisateurDAO::chercher(9002);

              echo "<br />".$user6;

  						UtilisateurDAO::supprimer($user6);

              echo "<br />".$user6;

  						echo $user6 ? "existe encore" : "n'existe plus";

              echo $user4;
  						?>
  					</li>
				</ul>				
			</div>
		</div>
	</div>
</body>
</html>