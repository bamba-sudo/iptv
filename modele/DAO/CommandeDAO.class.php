<?php
	/* ==================================================================================
   	 * Description : DAO pour la classe Commande
     * Auteur      : Walid Gharbi
	 * ==================================================================================
	*/
	
	// ============================ INLCUSIONS ==========================================
	// si la constante n'existe pas, on la crée
	if (defined("DOSSIER_BASE_INCLUDE") == false) {
		define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."iptv/");
	}
	// Importe l'interface DAO et la classe Commande
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/DAO.interface.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/commande.class.php");

	// ============================== CLASSE ============================================
	class CommandeDAO implements DAO {	

		/* ************************************************************************************* */
		/* Retourne une Équipe en fonction de la clé primaire (nom). Retourne null si non trouvé */
		/* ************************************************************************************* */
		public static function chercher($cles) { 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$uneCommande=null; 

			$requete= $connexion->prepare("SELECT * FROM commande WHERE id_commande=?");
		  

			$requete->execute(array($cles));			
			
			if ($requete->rowCount() > 0) {
				$enregistrement=$requete->fetch();
				$uneCommande=new Commande($enregistrement['id_commande'], $enregistrement['date_create'], $enregistrement['id_produit'],
									$enregistrement['id_client'], $enregistrement['quantite'], $enregistrement['prix_total']);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
		  
			return $uneCommande;	 
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
				
			$requete= $connexion->prepare("SELECT * FROM commande ".$filtre);

			$requete-> execute();			

			foreach ($requete as $enregistrement) {
				$uneCommande=new Commande($enregistrement['id_commande'], $enregistrement['date_create'], $enregistrement['id_produit'],
									$enregistrement['id_client'], $enregistrement['quantite'], $enregistrement['prix_total']);
				array_push($liste, $uneCommande);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
			
			return $liste;	 
		} 

		/* ************************************************************************************* */
		/* Insère l'objet reçu en paramètre dans la table Commande                                 */
		/* ************************************************************************************* */
		static function inserer($uneCommande){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$tab=array( $uneCommande->getIdCommande(),      $uneCommande->getDate(),
						$uneCommande->getIdProduit(), $uneCommande->getIdClient(), $uneCommande->getQuantite(), $uneCommande->getPrix());
			$commandeSQL  = "INSERT INTO commande (id_commande,date_create,id_produit,id_client,quantite,prix_total)";  
			$commandeSQL .=  "VALUES (?,?,?,?,?,?)";

			
			$requete = $connexion->prepare($commandeSQL);
			$requete->execute($tab);
			
			ConnexionBD::close();	
		}


		/* ******************************************************************************************** */
		/* Utilise l'objet reçu en paramètre pour modifier l'enreg. corresponadant dans la table Commande */
		/* ******************************************************************************************** */
		static public function modifier($uneCommande) {
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "UPDATE commande SET id_commande=".$uneCommande->getIdCommande().",date_create='".$uneCommande->getDate()."'";
			$commandeSQL .= ",id_produit=".$uneCommande->getIdProduit().",id_client=".$uneCommande->getIdClient();
			$commandeSQL .= ",quantite=".$uneCommande->getQuantite().",prix_total=".$uneCommande->getPrix()." where id_commande=".$uneCommande->getIdClient();

			$requete = $connexion->prepare($commandeSQL);			
			$requete->execute();
			
			ConnexionBD::close();	
		}

		/* ******************************************************************************************** */
		/* Supprime l'enregistrement dans la table Commande corresponadant à l'objet reçu en paramètres   */
		/* ******************************************************************************************** */
		static public function supprimer($uneCommande){
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "DELETE FROM commande WHERE id_commande=".$uneCommande->getIdCommande();
			$requete = $connexion->prepare($commandeSQL);
			return	$requete->execute();
		} 
		
	}
	
?>