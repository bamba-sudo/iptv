<?php
	/* ==================================================================================
   	 * Description : DAO pour la classe Client
     * Auteur      : Walid Gharbi
	 * ==================================================================================
	*/
	
	// ============================ INLCUSIONS ==========================================
	// si la constante n'existe pas, on la crée
	if (defined("DOSSIER_BASE_INCLUDE") == false) {
		define("DOSSIER_BASE_INCLUDE", $_SERVER['DOCUMENT_ROOT']."iptv/");
	}
	// Importe l'interface DAO et la classe Client
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/DAO.interface.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/client.class.php");
	include_once(DOSSIER_BASE_INCLUDE."modele/DAO/UtilisateurDAO2.class.php");


	// ============================== CLASSE ============================================
	class ClientDAO implements DAO {	

		/* ************************************************************************************* */
		/* Retourne une Équipe en fonction de la clé primaire (nom). Retourne null si non trouvé */
		/* ************************************************************************************* */
		public static function chercher($cles) { 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$unClient=null; 

			$requete= $connexion->prepare("SELECT * FROM client WHERE id_client=?");
		  

			$requete->execute(array($cles));			
			
			if ($requete->rowCount() > 0) {
				$enregistrement=$requete->fetch();
				$unClient=new Client($enregistrement['id_client'], $enregistrement['prenom'], $enregistrement['nom'],
									$enregistrement['email']);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
		  
			return $unClient;	 
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
				
			$requete= $connexion->prepare("SELECT * FROM Client ".$filtre);

			$requete-> execute();			

			foreach ($requete as $enregistrement) {
				$unClient=new Client($enregistrement['id_client'], $enregistrement['prenom'], $enregistrement['nom'],
									$enregistrement['email']);
				array_push($liste, $unClient);
			}

			$requete-> closeCursor();
			ConnexionBD::close();	
			
			return $liste;	 
		} 

		/* ************************************************************************************* */
		/* Insère l'objet reçu en paramètre dans la table Client                                 */
		/* ************************************************************************************* */
		static function inserer($unClient){ 
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$tab=array( $unClient->getIdClient(),      $unClient->getPrenom(),
						$unClient->getNom(), $unClient->getEmail());
			$commandeSQL  = "INSERT INTO client (id_client,prenom,nom,email)";  
			$commandeSQL .=  "VALUES (?,?,?,?)";

			
			$requete = $connexion->prepare($commandeSQL);
			$requete->execute($tab);
			
			ConnexionBD::close();	
		}


		/* ******************************************************************************************** */
		/* Utilise l'objet reçu en paramètre pour modifier l'enreg. corresponadant dans la table Client */
		/* ******************************************************************************************** */
		static public function modifier($unClient) {
			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}

			$commandeSQL = "UPDATE client SET id_client=".$unClient->getIdClient().",prenom='".$unClient->getPrenom()."'";
			$commandeSQL .= ",nom='".$unClient->getNom()."',email='".$unClient->getEmail()."' WHERE id_client=".$unClient->getIdClient();

			$requete = $connexion->prepare($commandeSQL);			
			$requete->execute();
			
			ConnexionBD::close();	
		}

		/* ******************************************************************************************** */
		/* Supprime l'enregistrement dans la table Client corresponadant à l'objet reçu en paramètres   */
		/* ******************************************************************************************** */
		
		static public function supprimer($unClient){

			try {
				$connexion=ConnexionBD::getInstance();
			} catch (Exception $e) {
				throw new Exception("Impossible d’obtenir la connexion à la BD."); 
			}
			$idclient = $unClient->getIdClient();
			$unClient = UtilisateurDAO::chercher($idclient);
			UtilisateurDAO::supprimer($unClient);
			$commandeSQL = "DELETE FROM client WHERE id_client=".$unClient->getIdClient();
			$requete = $connexion->prepare($commandeSQL);
			return	$requete->execute();
		} 
			
	}
	
?>