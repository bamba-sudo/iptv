<!DOCTYPE html>
<html>
<head>
	<title> testProduit </title>
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
				<h1 class="text-white"> TestProduit </h1>
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

							include_once(DOSSIER_BASE_INCLUDE."modele/produit.class.php");

							$unProduit = new Produit(1, "mag345", "wjnsjkwjefniwohf", "lol.png", 23.99, 4);

							echo $unProduit->getIdProduit();
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php
  							echo $unProduit->getType();
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php
  							echo $unProduit->getDescription();
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php
  							echo $unProduit->getImage();
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php
  							echo $unProduit->getPrix();
  						?>
  					</li>
  					<li class="list-group-item bg-dark">
  						<?php
  							echo $unProduit->getQuantiteStock();
  						?>
  					</li>
				</ul>				
			</div>
		</div>
	</div>
</body>
</html>