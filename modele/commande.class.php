<?php

// Classe représentant un produit pour vente dans un commerce
class Commande {
	// Attributs
	private $idCommande; // int
	private $date; // String
	private $idProduit; // Produit
	private $idClient; // Client
	private $quantite; // double
	private $prix; // double

	// Constructeur
	public function __construct($idCommande,$date,$idProduit,$idClient,$quantite,$prix){
		$this->idCommande=$idCommande;
		$this->date=$date;
		$this->idProduit=$idProduit;
		$this->idClient=$idClient;
		$this->quantite=$quantite;
		$this->prix=$prix;
	}
	
	// Accesseurs et mutateurs
	public function getIdCommande() {return $this->idCommande;}
	public function getDate() {return $this->date;}
	public function getIdProduit() {return $this->idProduit;}
	public function getIdClient() {return $this->idClient;}
	public function getQuantite() {return $this->quantite;}
	public function getPrix() {return $this->prix;}

	// Autres méthodes
	//public function verifierMotPasse($motAVerifier) { return $this->motPasse == $motAVerifier; }
	
	// Affichage
	public function __toString(){
		$message=$this->idCommande."<br />".$this->date."<br />".$this->idProduit."<br />".$this->idClient."<br />".$this->quantite."<br />".$this->prix;
		return $message;
	}
}
?>





