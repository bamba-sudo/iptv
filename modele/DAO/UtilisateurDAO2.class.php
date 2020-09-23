<?php
	/* ==================================================================================
   	 * Description : DAO pour la classe Utilisateur
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
	include_once(DOSSIER_BASE_INCLUDE."modele/utilisateur.class.php");

	// ============================== CLASSE ============================================
	class UtilisateurDAO implements DAO {	

		/* ************************************************************************************* */
		/* Retourne une Équipe en fonction de la clé primaire (nom). Retourne null si non trouvé */
		/* ************************************************************************************* */
		public static function chercher($cles) { 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$unUtilisateur=null; 

			$requete= $connexion->prepare("SELECT * FROM utilisateur WHERE id_client=?");
		  

			$requete->execute(array($cles));			
			
			if ($requete->rowCount() > 0) {
				$enregistrement=$requete->fetch();
				$unUtilisateur=new Utilisateur($enregistrement['id_client'],$enregistrement['user'], $enregistrement['password']);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
		  
			return $unUtilisateur;	 
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
				
			$requete= $connexion->prepare("SELECT * FROM utilisateur ".$filtre);

			$requete-> execute();			

			foreach ($requete as $enregistrement) {
				$unUtilisateur=new Utilisateur($enregistrement['id_client'], $enregistrement['user'], $enregistrement['password']);
				array_push($liste, $unUtilisateur);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
			
			return $liste;	 
		} 

		/* ************************************************************************************* */
		/* Insère l'objet reçu en paramètre dans la table Panier                                 */
		/* ************************************************************************************* */
		static function inserer($unUtilisateur){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$tab=array( $unUtilisateur->getIdClient(),$unUtilisateur->getNomUtilisateur(),      $unUtilisateur->getMotPasse());
			$commandeSQL  = "INSERT INTO utilisateur (id_client,user,password)";  
			$commandeSQL .=  "VALUES (?,?,?)";

			
			$requete = $connexion->prepare($commandeSQL);
			$requete->execute($tab);
			
			ConnexionBD::close();	
		}


		/* ******************************************************************************************** */
		/* Utilise l'objet reçu en paramètre pour modifier l'enreg. corresponadant dans la table Panier */
		/* ******************************************************************************************** */
		static public function modifier($unUtilisateur) {
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "UPDATE utilisateur SET id_client=".$unUtilisateur->getIdClient().",user='".$unUtilisateur->getNomUtilisateur()."',password='".$unUtilisateur->getMotPasse()."' where id_client=".$unUtilisateur->getIdClient();

			$requete = $connexion->prepare($commandeSQL);			
			$requete->execute();
			
			ConnexionBD::close();	
		}

		/* ******************************************************************************************** */
		/* Supprime l'enregistrement dans la table Panier corresponadant à l'objet reçu en paramètres   */
		/* ******************************************************************************************** */
		static public function supprimer($unUtilisateur){
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "DELETE FROM utilisateur WHERE id_client=".$unUtilisateur->getIdClient();
			$requete = $connexion->prepare($commandeSQL);
			return	$requete->execute();
		} 
		
	}
	
?>