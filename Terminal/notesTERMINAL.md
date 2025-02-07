# LE TERMINAL

## RACCOURCIS

- le **c:** se trouve dans /cygdrive/c/
- flèches **haut** et **bas** pour naviguer dans l’historique
- **tab** pour l’autocomplétion
- **ctrl+r** pour rechercher dans l’historique
- **ctrl+a** pour aller au début de la ligne de commande
- **ctrl+e** pour aller à la fin de la ligne de commande
- entre **''** ou **\\** quand il y a un espace dans le nom d’un dossier

## WILDCARDS OU JOKER

pour remplacer des caractères  
`_.txt` tous les fichiers .txt du répertoire courant  
`fic_` tous les fichiers qui commencent par fic

## COMMANDES DE BASES

`pwd` //(print working directory) affiche l’endroit où on est  
`pwd --help` //on met le paramètre help à la commande pwd

`ls` //(list) liste les dossiers et fichiers du répertoire  
`ls .` //par défaut, dossier courant  
`ls ..` //dossier parent  
`ls -a` //(all) affiche aussi les répertoires cachés  
`ls -l` //affichage détaillé, d pour dossier, - pour fichiers  
`ls -la` //on peut combiner plusieurs paramètres  
`ls docs` //affiche le contenu du dossier docs  
`ls -la docs` //on combine tout

`cd` //(change directory) pour changer de dossier

`mkdir` //(make directory) créer un répertoire  
`mkdir test1 test2` //crée les dossier test1 et test2

`touch fichier.txt` //crée un fichier

`mv` //(move) pour déplacer  
`mv fichier.txt test2/` //déplace le fichier dans le répertoire test2  
`mv test2/fichier.txt .` //déplace le fichier dans le répertoire actuel  
`mv fichier.txt file.txt` //change le nom de fichier en file

`cp` //(copy) pour copier  
`cp \*.txt test2/` //copie tous les fichiers en .txt dans test2  
`cp file.txt file2.txt` //fait une copie de file nommée file2  
`cp -r test1/ test2` //copie de façon récursive (en totalité) test1 dans test2

`rm` //(remove) pour supprimer  
`rm fichier2.txt` //supprime fichier2  
`rm -r test2/` //supprime en totalité le dossier test2

## COMMANDES UTILES

`man cmd` //(manuel) pour obtenir le manuel d’une commande

`cat file.txt` //affiche le contenu d’un fichier  
`less file.txt` //affiche le fichier page par page  
`more file.txt` //comme less avec des options en moins

`grep` //rechercher du texte dans un fichier  
`grep Cours file.txt` //affiche les lignes qui contiennent le mot "Cours"  
`grep texte \*` //recherche "texte" dans tous les fichiers du répetoire courant

## REDIRECTION

`ls -l > liste.txt` //affiche le résultat de la commande dans un fichier

`echo 'ajout de texte' >> file.txt` //ajoute du text dans le fichier
