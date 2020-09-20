<?php

// Classe représentant un produit pour vente dans un commerce
class Produit {
	// Attributs
	private $idProduit; // int
	private $type; // String
	private $description; // String
	private $image; // String
	private $prix; // double
	private $quantite_stock; // int
	private $quantite_commander; // int
	private $rating; // double
	// Constructeur
	public function __construct($idProduit,$type,$description,$image,$prix,$quantite_stock,$quantite_commander=0,$rating){
		$this->idProduit=$idProduit;
		$this->type=$type;
		$this->description=$description;
		$this->image=$image;
		$this->prix=$prix;
		$this->quantite_stock=$quantite_stock;
		$this->rating=$rating;
	}
	
	// Accesseurs et mutateurs
	public function getIdProduit() {return $this->idProduit;}
	public function getType() {return $this->type;}
	public function getDescription() {return $this->description;}
	public function getImage() {return $this->image;}
	public function getPrix() {return $this->prix;}
	public function getQuantiteStock() {return $this->quantite_stock;}
	public function getQuantiteCommander() {return $this->quantite_commander;}
	public function getRating() {return $this->rating;}

	// Autres méthodes
	//public function verifierMotPasse($motAVerifier) { return $this->motPasse == $motAVerifier; }
	
	// Affichage
	//public function __toString(){
	//	$message= ;
	//	return $message;
	//}
}
?>





