# WINDEV

## Initialisation d'un projet

Les variables globales peuvent être déclarées en codant l'élément P.

## Analyse

rubrique = entrée  
fichier de données = table  
L'analyse permet de décrire tous les fichiers de données manipulés par l'application.  
analyse -> répertoire .ana

Cardinalités: Client 0,n --- 1,1 Commande  
Un client peut avoir entre 0 et plusieurs commandes.  
Une commande peut avoir un seul client et pas plus.

## Clés de fichiers de données

- Clé unique: identifie la rubrique avec une valeur unique, possibilité d'utiliser un identifiant automatique
- Clé avec doublons: plusieurs valeurs identiques sont possibles
- Clé primaire: unique et non nulle, une seule par fichier de données
- Clé spatiale: contient des données géographiques ou géométriques

Ces clés permettent d'accélérer les accès aux données et les tris.  
Elles peuvent être:

- Clé simple: sur une seule rubrique
- Clé composée: définir une clé sur plusieurs rubriques

## Charte

BTN_Bouton
FEN_Fenêtre
SAI_ChampDeSaisie

## Raccourcis clavier

Ctrl <: Accueil
Ctrl E: chercher une fenêtre
Ctrl W: cacher les volets
