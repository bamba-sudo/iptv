<?php
	/* ==================================================================================
   	 * Description : DAO pour la classe ProduitInfo
     * Auteur      : Walid Gharbi
	 * ==================================================================================
	*/
	
	// ============================ INLCUSIONS ==========================================
	// si la constante n'existe pas, on la crée
	if (defined("DOSSIER_BASE_INCLUDE") == false) {
		define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."iptv/");
	}
	// Importe l'interface DAO et la classe ProduitInfo
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/DAO.interface.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/produit_info.class.php");

	// ============================== CLASSE ============================================
	class ProduitInfoDAO implements DAO {	

		/* ************************************************************************************* */
		/* Retourne une Équipe en fonction de la clé primaire (nom). Retourne null si non trouvé */
		/* ************************************************************************************* */
		public static function chercher($cles) { 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$unProduitInfo=null; 

			$requete= $connexion->prepare("SELECT * FROM produit_info WHERE id_produit=?");
		  

			$requete->execute(array($cles));			
			
			if ($requete->rowCount() > 0) {
				$enregistrement=$requete->fetch();
				$unProduitInfo=new ProduitInfo($enregistrement['id_produit'], $enregistrement['type_produit'], $enregistrement['add_mag']);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
		  
			return $unProduitInfo;	 
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
				
			$requete= $connexion->prepare("SELECT * FROM produit_info ".$filtre);

			$requete-> execute();			

			foreach ($requete as $enregistrement) {
				$unProduitInfo=new ProduitInfo($enregistrement['id_produit'], $enregistrement['type_produit'], $enregistrement['add_mag']);
				array_push($liste, $unProduitInfo);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
			
			return $liste;	 
		} 

		/* ************************************************************************************* */
		/* Insère l'objet reçu en paramètre dans la table ProduitInfo                                 */
		/* ************************************************************************************* */
		static function inserer($unProduitInfo){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$tab=array( $unProduitInfo->getIdProduit(),      $unProduitInfo->getType(),
						$unProduitInfo->getAddMag());
			$commandeSQL  = "INSERT INTO produit_info (id_produit,type_produit,add_mag)";  
			$commandeSQL .=  "VALUES (?,?,?)";

			
			$requete = $connexion->prepare($commandeSQL);
			$requete->execute($tab);
			
			ConnexionBD::close();	
		}


		/* ******************************************************************************************** */
		/* Utilise l'objet reçu en paramètre pour modifier l'enreg. corresponadant dans la table ProduitInfo */
		/* ******************************************************************************************** */
		static public function modifier($unProduitInfo) {
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "UPDATE produit_info SET id_produit=".$unProduitInfo->getIdProduit().",type_produit='".$unProduitInfo->getType();
			$commandeSQL .= "',add_mag='".$unProduitInfo->getAddMag()."' WHERE id_produit=".$unProduitInfo->getIdProduit();

			$requete = $connexion->prepare($commandeSQL);			
			$requete->execute();
			
			ConnexionBD::close();	
		}

		/* ******************************************************************************************** */
		/* Supprime l'enregistrement dans la table ProduitInfo corresponadant à l'objet reçu en paramètres   */
		/* ******************************************************************************************** */
		static public function supprimer($unProduitInfo){
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "DELETE FROM produit_info WHERE id_produit=".$unProduitInfo->getIdProduit();
			$requete = $connexion->prepare($commandeSQL);
			return	$requete->execute();
		} 
		
	}
	
?>