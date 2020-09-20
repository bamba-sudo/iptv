<?php
	/* Description : interface à implémenter pour tous les DAO
     * Auteur      : Walid Gharbi
	*/

	// ****** INLCUSIONS *******
	// si la constante n'existe pas, on la crée
	if (defined("DOSSIER_BASE_INCLUDE") == false) {
		define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."iptv/");
	}
	// Importe l'interface DAO et la classe Produit
	// Donne accès à la classe de connexion à la BD
	// Pas besoin de la réimporter dans les classes implémente l'interface
	include_once(DOSSIER_BASE_INCLUDE.'modele/DAO/connexionBD.class.php');

	// ****** INTERFACE *******
	interface DAO {	
		// Cette méthode doit retourner l'objet dont la clé primaire a été reçu en paramètre
		// Notes : 1) On retourne null si non-trouvé, 
		//         2) Si la clé primaire est composée, alors le paramètre est un tableau assiociatif
		static public function chercher($cles); 
		// Cette méthode doit retourner une liste de tous les objets reliés à la table de la BD
		static public function chercherTous(); 
		// Comme la méthode chercherTous, mais en applicant le filtre (clause WHERE ...) reçue en param.
		static public function chercherAvecFiltre($filtre); 
		// Cette méthode insère l'objet reçu en paramètre dans la table
		// Retourne true/false selon que l'opération a été un succès ou pas.
		static public function inserer($unObjet); 
		// Cette méthode modifie tous les champs de l'objet reçu en paramètre dans la table
		static public function modifier($unObjet); 
		// Cette méthode supprime l'objet reçu en paramètre de la table
		static public function supprimer($unObjet); 
	}
?>