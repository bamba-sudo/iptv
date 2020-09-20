<?php
	/* ==================================================================================
   	 * Description : DAO pour la classe Panier
     * Auteur      : Walid Gharbi
	 * ==================================================================================
	*/
	
	// ============================ INLCUSIONS ==========================================
	// si la constante n'existe pas, on la crée
	if (defined("DOSSIER_BASE_INCLUDE") == false) {
		define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."iptv/");
	}
	// Importe l'interface DAO et la classe Panier
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/DAO.interface.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/panier.class.php");

	// ============================== CLASSE ============================================
	class PanierDAO implements DAO {	

		/* ************************************************************************************* */
		/* Retourne une Équipe en fonction de la clé primaire (nom). Retourne null si non trouvé */
		/* ************************************************************************************* */
		public static function chercher($cles) { 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$unPanier=null; 

			$requete= $connexion->prepare("SELECT * FROM Panier WHERE id_Panier=?");
		  

			$requete->execute(array($cles));			
			
			if ($requete->rowCount() > 0) {
				$enregistrement=$requete->fetch();
				$unPanier=new Panier($enregistrement['id_panier'], $enregistrement['id_produit'], $enregistrement['id_client'],
									$enregistrement['quantite']);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
		  
			return $unPanier;	 
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
				
			$requete= $connexion->prepare("SELECT * FROM panier ".$filtre);

			$requete-> execute();			

			foreach ($requete as $enregistrement) {
				$unPanier=new Panier($enregistrement['id_panier'], $enregistrement['id_produit'], $enregistrement['id_client'],
									$enregistrement['quantite']);
				array_push($liste, $unPanier);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
			
			return $liste;	 
		} 

		/* ************************************************************************************* */
		/* Insère l'objet reçu en paramètre dans la table Panier                                 */
		/* ************************************************************************************* */
		static function inserer($unPanier){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$tab=array( $unPanier->getIdPanier(),      $unPanier->getIdProduit(),
						$unPanier->getIdClient(), $unPanier->getQuantite());
			$commandeSQL  = "INSERT INTO Panier (id_panier,id_produit,id_client,quantite)";  
			$commandeSQL .=  "VALUES (?,?,?,?)";

			
			$requete = $connexion->prepare($commandeSQL);
			$requete->execute($tab);
			
			ConnexionBD::close();	
		}


		/* ******************************************************************************************** */
		/* Utilise l'objet reçu en paramètre pour modifier l'enreg. corresponadant dans la table Panier */
		/* ******************************************************************************************** */
		static public function modifier($unPanier) {
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "UPDATE panier SET id_panier=".$unPanier->getIdPanier().",id_produit=".$unPanier->getIdProduit();
			$commandeSQL .= ",id_client=".$unPanier->getIdClient().",quantite=".$unPanier->getQuantite()." where id_panier=".$unPanier->getIdPanier();

			$requete = $connexion->prepare($commandeSQL);			
			$requete->execute();
			
			ConnexionBD::close();	
		}

		/* ******************************************************************************************** */
		/* Supprime l'enregistrement dans la table Panier corresponadant à l'objet reçu en paramètres   */
		/* ******************************************************************************************** */
		static public function supprimer($unPanier){
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "DELETE FROM panier WHERE id_panier=".$unPanier->getIdPanier();
			$requete = $connexion->prepare($commandeSQL);
			return	$requete->execute();
		} 
		
	}
	
?>