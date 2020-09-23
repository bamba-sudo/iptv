<?php

// Classe représentant un produit pour vente dans un commerce
class Panier {
	// Attributs
	private $idPanier; // Panier
	private $idProduit; // Produit
	private $idClient; // Client
	private $quantite; // double

	// Constructeur
	public function __construct($idPanier,$idProduit,$idClient,$quantite){
		$this->idPanier=$idPanier;
		$this->idProduit=$idProduit;
		$this->idClient=$idClient;
		$this->quantite=$quantite;
	}
	
	// Accesseurs et mutateurs
	public function getIdPanier() {return $this->idPanier;}
	public function getIdProduit() {return $this->idProduit;}
	public function getIdClient() {return $this->idClient;}
	public function getQuantite() {return $this->quantite;}

	// Autres méthodes
	//public function verifierMotPasse($motAVerifier) { return $this->motPasse == $motAVerifier; }
	
	// Affichage
	public function __toString(){
		$message=$this->idPanier."<br />".$this->idProduit."<br />".$this->idClient."<br />".$this->quantite;
		return $message;
	}
}
?>





