##########################
# Auteur : Walid Gharbi  #
# For : M. Zellagui		 #
#						 #
# Name of the project :	 #
#						 #
# 	 Iptv Website		 #
##########################

USE site_iptv;

DELETE FROM utilisateur;
DROP TABLE utilisateur;

DELETE FROM produit_info;
DROP TABLE produit_info;

DELETE FROM panier;
DROP TABLE panier;

DELETE FROM commande;
DROP TABLE commande;

DELETE FROM produit;
DROP TABLE produit;

DELETE FROM client;
DROP TABLE client;

DROP DATABASE site_iptv;
