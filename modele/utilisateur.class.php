<?php

// Classe représentant un produit pour vente dans un commerce
class Utilisateur {
	// Attributs
	private $nomUtilisateur;
	private $motPasse;
	private $idClient;

	// Constructeur
	public function __construct($idClient,$nomUtilisateur,$motPasse){
		$this->idClient=$idClient;
		$this->nomUtilisateur=$nomUtilisateur;
		$this->motPasse=$motPasse;
	}
	
	// Accesseurs et mutateurs
	public function getNomUtilisateur() {return $this->nomUtilisateur;}
	public function getMotPasse() {return $this->motPasse;}
	public function getIdClient() {return $this->idClient;}

	// Autres méthodes
	public function verifierMotPasse($motAVerifier) { return $this->motPasse == $motAVerifier; }
	
	// Affichage
	public function __toString(){
		$message=$this->idClient.$this->nomUtilisateur.$this->motPasse;
		return $message;
	}
}
?>






