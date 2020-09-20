<?php

// Classe représentant un produit pour vente dans un commerce
class Client {
	// Attributs
	private $idClient; // int
	private $prenom; // String
	private $nom; // String
	private $email; // String

	// Constructeur
	public function __construct($idClient,$prenom,$nom,$email){
		$this->idClient=$idClient;
		$this->prenom=$prenom;
		$this->nom=$nom;
		$this->email=$email;
	}
	
	// Accesseurs et mutateurs
	public function getIdClient() {return $this->idClient;}
	public function getPrenom() {return $this->prenom;}
	public function getNom() {return $this->nom;}
	public function getEmail() {return $this->email;}

	// Autres méthodes
	//public function verifierMotPasse($motAVerifier) { return $this->motPasse == $motAVerifier; }
	
	// Affichage
	public function __toString(){
		$message=$this->idClient."<br />".$this->prenom."<br />".$this->nom."<br />".$this->email;
		return $message;
	}
}
?>





