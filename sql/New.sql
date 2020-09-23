##########################
# Auteur : Walid Gharbi  #
# For : M. Zellagui		 #
#						 #
# Name of the project :	 #
#						 #
# 	 Iptv Website		 #
##########################

# Création de la base de donnée.
CREATE DATABASE site_iptv DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

# Utilisation de cette base de donnée à fin de la modifier.
USE site_iptv;

# Création de la table client. Deux clée primaire, dont user et code_client.
CREATE TABLE client (
  id_client          INT AUTO_INCREMENT,
  prenom        	 VARCHAR(155),
  nom                VARCHAR(155),
  email	             VARCHAR(155),
  CONSTRAINT id_client_pk PRIMARY KEY (id_client)
);

# Création de la table produit. Une clée primaire, dont code_produit.
CREATE TABLE produit (
  id_produit           INT AUTO_INCREMENT,
  type_produit   	   VARCHAR(255),
  description          VARCHAR(255),
  image				   VARCHAR(255),
  prix                 DECIMAL(11, 2),
  quantite_stock	   INT,
  quantite_commander   INT NULL,
  rating 			   DECIMAL(11, 1),
  CONSTRAINT id_produit PRIMARY KEY (id_produit)
);

# Création de la table commande. Admin recoit la commande. Une deux clées étrangères et une clée primaire.  
CREATE TABLE commande (
  id_commande             INT AUTO_INCREMENT,
  date_create			  date,
  id_produit   	          INT,
  id_client               INT,
  quantite       		  INT null,
  prix_total              DECIMAL(11, 2) null,
  CONSTRAINT id_produit_fk FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
  CONSTRAINT id_client_fk FOREIGN KEY (id_client) REFERENCES client(id_client),
  CONSTRAINT id_commande PRIMARY KEY (id_commande) 
);

# Création de la table panier. Panier pour le client.
CREATE TABLE panier (
	id_panier		INT AUTO_INCREMENT,
	id_produit  	INT,
	id_client 		INT,
	quantite        INT null,
	CONSTRAINT id_produit_fkk FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
  	CONSTRAINT id_client_fkk FOREIGN KEY (id_client) REFERENCES client(id_client),
  	CONSTRAINT id_panier PRIMARY KEY (id_panier)
);

# Création de la table produit_info. Information supplémentaire pour iptv.
CREATE TABLE produit_info (
	id_produit 		INT,
	type_produit	VARCHAR(255) null,
	add_mag			VARCHAR(255) null,
	CONSTRAINT id_produit_fkkk FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
);

# Création de la table utilisateur. Connexion a son compte ou inscription au compte remplir table client avant
CREATE TABLE utilisateur (
	id_client 		INT,
	user 			VARCHAR(255),
	password		VARCHAR(255),
	CONSTRAINT id_client_fkkk FOREIGN KEY (id_client) REFERENCES client(id_client)
);

# [...]
################################################################################################
################################################################################################
################################################################################################
################################################################################################
################################################################################################
################################################################################################
# [...]

# Création des valeurs de chaque table. A des fin d'exemple. A enlever par la suite...

# Création de répetition pour chaque id.
ALTER TABLE produit AUTO_INCREMENT=200;
ALTER TABLE client AUTO_INCREMENT=9002;
ALTER TABLE commande AUTO_INCREMENT=39473;
ALTER table panier AUTO_INCREMENT=1;

# Création valeur de la table client
INSERT INTO client VALUES (null, "Walid", "Gharbi", "w.gharbi.tangerine@gmail.com");
INSERT INTO client VALUES (null, "Adam", "Bouchaf", "adam@gmail.com");
INSERT INTO client VALUES (null, "Ahmed", "Belgacem", "ahmed@gmail.com");
INSERT INTO client VALUES (null, "Djamel", "Vito", "vito@gmail.com");

# Création valeur de la table produit
INSERT INTO produit VALUES (null, "mag", "djfnjenejkjerhkrejhfklreh", "image1", 20.99, 5, null, 3);
INSERT INTO produit VALUES (null, "mag320", "djfnjenejkjerhkrejhfklreh", "image2", 19.99, 2, null, 4);
INSERT INTO produit VALUES (null, "mag530", "djfnjenejkjerhkrejhfklreh", "image3", 31.99, 10, null, 5);
INSERT INTO produit VALUES (null, "codeiptv", "djfnjenejkjerhkrejhfklreh", "image4", 23.99, 30, null, 2);

# Création valeur de la table utilisateur
INSERT INTO utilisateur VALUES (9002, "root", "root");
INSERT INTO utilisateur VALUES (9003, "wawa", "root");
INSERT INTO utilisateur VALUES (9005, "baba", "mama");

# INSERT INTO panier VALUES (null, 203, 9002, 5);
# INSERT INTO panier VALUES (null, 201, 9004, 10);
# INSERT INTO panier VALUES (null, 200, 9005, 3);

# INSERT into produit_info VALUES (201, "mag345", "234234");

# INSERT INTO commande VALUES (null, "2020-08-09", 201, 9004, 5, 100);
# INSERT INTO commande VALUES (null, "2020-07-10", 203, 9002, 10, 200);
# INSERT INTO commande VALUES (null, "2021-10-23", 200, 9005, 3, 35);


# Pas terminer manque le forum et plusieur autres tables pour terminer le site juste demo..... a enlever aussi	
