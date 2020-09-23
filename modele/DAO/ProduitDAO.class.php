<?php
	/* ==================================================================================
   	 * Description : DAO pour la classe Produit
     * Auteur      : Walid Gharbi
	 * ==================================================================================
	*/
	
	// ============================ INLCUSIONS ==========================================
	// si la constante n'existe pas, on la crée
	if (defined("DOSSIER_BASE_INCLUDE") == false) {
		define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."iptv/");
	}
	// Importe l'interface DAO et la classe Produit
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/DAO.interface.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/produit.class.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/Produit_InfoDAO.class.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/PanierDAO.class.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/CommandeDAO.class.php");
	

	// ============================== CLASSE ============================================
	class ProduitDAO implements DAO {	

		/* ************************************************************************************* */
		/* Retourne une Équipe en fonction de la clé primaire (nom). Retourne null si non trouvé */
		/* ************************************************************************************* */
		public static function chercher($cles) { 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$unProduit=null; 

			$requete= $connexion->prepare("SELECT * FROM produit WHERE id_produit=?");
		  

			$requete->execute(array($cles));			
			
			if ($requete->rowCount() > 0) {
				$enregistrement=$requete->fetch();
				$unProduit=new Produit($enregistrement['id_produit'], $enregistrement['type_produit'], $enregistrement['description'],
									$enregistrement['image'], $enregistrement['prix'], $enregistrement['quantite_stock'], $enregistrement['quantite_commander'], $enregistrement['rating']);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
		  
			return $unProduit;	 
		} 
		
		/* ************************************************************************************* */
		/* Retourne un tableau avec toutes les équipes                                           */
		/* ************************************************************************************* */
		static public function chercherTous() { 
			return self::chercherAvecFiltre("");
		} 
		
		/* ************************************************************************************* */
		/* Retourne un tableau avec toutes les équipes qui respectent les consitions du filtre   */
		/* ************************************************************************************* */
		static public function chercherAvecFiltre($filtre){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$liste = array(); 
				
			$requete= $connexion->prepare("SELECT * FROM produit ".$filtre);

			$requete-> execute();			

			foreach ($requete as $enregistrement) {
				$unProduit=new Produit($enregistrement['id_produit'], $enregistrement['type_produit'], $enregistrement['description'],
									$enregistrement['image'], $enregistrement['prix'], $enregistrement['quantite_stock'], $enregistrement['quantite_commander'], $enregistrement['rating']);
				array_push($liste, $unProduit);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
			
			return $liste;	 
		} 

		/* ************************************************************************************* */
		/* Insère l'objet reçu en paramètre dans la table Produit                                 */
		/* ************************************************************************************* */
		static function inserer($unProduit){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$tab=array( $unProduit->getIdProduit(),      $unProduit->getType(),
						$unProduit->getDescription(), $unProduit->getImage(), $unProduit->getPrix(), $unProduit->getQuantiteStock(), $unProduit->getQuantiteCommander(), $unProduit->getRating());
			$commandeSQL  = "INSERT INTO Produit (id_produit,type_produit,description,image,prix,quantite_stock,quantite_commander,rating)";  
			$commandeSQL .=  "VALUES (?,?,?,?,?,?,?,?)";

			
			$requete = $connexion->prepare($commandeSQL);
			$requete->execute($tab);
			
			ConnexionBD::close();	
		}


		/* ******************************************************************************************** */
		/* Utilise l'objet reçu en paramètre pour modifier l'enreg. corresponadant dans la table Produit */
		/* ******************************************************************************************** */
		static public function modifier($unProduit) {
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "UPDATE produit SET id_produit=".$unProduit->getIdProduit().", type_produit='".$unProduit->getType()."'";
			$commandeSQL .= ", description='".$unProduit->getDescription()."', image='".$unProduit->getImage()."', prix=".$unProduit->getPrix().", quantite_stock=".$unProduit->getQuantiteStock().", quantite_commander=".$unProduit->getQuantiteCommander().", rating=".$unProduit->getRating()." where id_produit=".$unProduit->getIdProduit();

			$requete = $connexion->prepare($commandeSQL);			
			$requete->execute();
			
			ConnexionBD::close();	
		}

		/* ******************************************************************************************** */
		/* Supprime l'enregistrement dans la table Produit corresponadant à l'objet reçu en paramètres   */
		/* ******************************************************************************************** */
		static public function supprimer($unProduit){
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}
			# echo "<br />".$unProduit."<br />";
			$idProduit = $unProduit->getIdProduit();
			$unProduitInfo = ProduitInfoDAO::chercher($idProduit);
			# echo "<br />".$unProduitInfo."<br />";
			ProduitInfoDAO::supprimer($unProduitInfo);
			$unPanier = PanierDAO::chercherAvecFiltre("where id_produit=".$idProduit);
			# echo "<br />".$unPanier[0]."<br />";
			PanierDAO::supprimer($unPanier[0]);
			$uneCommande = CommandeDAO::chercherAvecFiltre("where id_produit=".$idProduit);
			# echo "<br />".$uneCommande[0]."<br />";
			CommandeDAO::supprimer($uneCommande[0]);
			$commandeSQL = "DELETE FROM produit WHERE id_produit=".$unProduit->getIdProduit();
			$requete = $connexion->prepare($commandeSQL);
			return	$requete->execute();
		}

	}
	
?>