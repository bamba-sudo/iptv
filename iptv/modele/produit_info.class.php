<?php

// Classe représentant un produit pour vente dans un commerce
class ProduitInfo {
	// Attributs
	private $idProduit; // int
	private $type; // String
	private $addmag; // String

	// Constructeur
	public function __construct($idProduit,$type,$addmag){
		$this->idProduit=$idProduit;
		$this->type=$type;
		$this->addmag=$addmag;
	}
	
	// Accesseurs et mutateurs
	public function getIdProduit() {return $this->idProduit;}
	public function getType() {return $this->type;}
	public function getAddMag() {return $this->addmag;}

	// Autres méthodes
	//public function verifierMotPasse($motAVerifier) { return $this->motPasse == $motAVerifier; }
	
	// Affichage
	public function __toString(){
		$message=$this->idProduit."<br />".$this->type."<br />".$this->addmag;
		return $message;
	}
}
?>





