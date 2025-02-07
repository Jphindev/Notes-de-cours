# GIT & GITHUB

## GIT

Git: gestionnaire de versions  
GitHub: héberge les dépôts en ligne

### CONFIGURER GIT

`$ mkdir Git_Objectif-Charlie` //pour créer un répertoire  
`$ cd Git_Objectif-Charlie/` //on se déplace dans le répertoire  
`$ git config --global user.name "JeanPhiH"`  
`$ git config --global user.email jp.herfeld@gmail.com`  
`$ git config --global color.diff auto`  
`$ git config --global color.status aut`  
`$ git config --global color.branch aut`
`$ git config --global core.editor vim`  
`$ git config --global merge.tool vimdiff`  
`$ git config --list` // pour voir la liste des configs

### BASES

#### WORKING DIRECTORY

--Git Add-> STAGE  
--Git Commit-> REPOSITORY  
--Git Push-> GITHUB

Un commit est un objet qui contient un pointeur vers l’instantané du contenu indexé ainsi que des pointeurs vers le ou les commits le précédant directement.

#### INIT

`$ git init` ou `$ git clone` // pour démarrer ou cloner un projet

#### ADD

`$ touch index.html` //création d’un fichier  
`$ git add index.html styles.css` //on met en index ou stage le fichier html  
`$ git add .` // indexer tous les fichiers modifiés

#### STATUS

`$ git status` //pour connaitre le status de nos fichiers

#### COMMIT

`$ git commit -m "Ajout du fichier index.html"` //on commit (valide) les fichiers qui étaient en stage  
`$ git commit` //ouverture de Vim pour écrire le message puis esc et :x  
`$ git commit -a` //correspond à git add + git commit  
`$ git commit --amend` //valide les fichiers actuels en remplaçant le précédent commit  
`$ git commit --amend --no-edit` //même chose sans avoir à modifier le message  
`$ git commit --amend -m "nouveau message"` //remplace le message du dernier commit effectué

#### RM

`$ git rm file.txt` //supprime le suivi puis le fichier en lui même  
`$ git rm --cached file.txt` //supprime le suivi mais conserve le fichier dans le projet

#### MV

`$ git mv README.txt LISEZMOI.txt` //renomme un fichier

#### LOG

`$ git log` //affiche l’historique des modifs  
`$ git log --pretty=oneline` //une ligne par commit (--since ou --author)  
`$ git reflog` //affiche l’historique de toutes les actions et donne tous les hash (SHA) correspondants  
`$ git checkout e789e7c` //en entrant les 8 premiers caractères du SHA, on peut revenir dans le temps à une action donnée

#### BLAME

`$ git blame file.txt` //affiche l’historique de modifications d’un fichier

### MANIPULATIONS

#### CHERRY-PICK

`$ git cherry-pick d356940 de966d4`  
Cette commande va permettre de sélectionner un ou plusieurs commits grâce à leur SHA et de les migrer sur la branche principale, sans pour autant fusionner toute la branche.

#### REMISE (stash)

`$ git stash` //permet de mettre de côté tout ce qui a été fait depuis le dernier commit  
`$ git stash pop` //récupère le dernier stash sauvegardé et supprime la sauvegarde  
`$ git stash list` //liste des stash sauvegardés  
`$ git stash apply` //pour récupérer les modif qui étaient sauvegardées dans le stash (dans une autre branche par exemple) sans supprimer la sauvegarde  
`$ git stash apply stash@{0}` //pour récupérer un stash spécifique

#### REVERT

`$ git revert HEAD^` //annule le dernier commit et revient à l’état précédent avec un nouveau commit  
(mieux que reset pour la synchronisation avec un dépot distant)

#### TROUVER UNE ERREUR DANS UN COMMIT

`$ git stash` //je mets de coté le travail en cours  
`$ git bisect start` //pour commencer à chercher le commit qui a créé l’erreur  
`$ git bisect bad HEAD` //pour dire que le dernier commit en cours n’est pas valide (il contient l’erreur)  
Il faut chercher ensuite le dernier commit valide  
`$ git log` //puis copie de l’id du commit que l’on sait sans l’erreur  
`$ git bisect good [id_valide]`  
Le terminal va ensuite passer les commits l’un après l’autre  
`$ ls -la src/` ou `$ cat nom_fichier` //pour voir si le commit contient l’erreur ou pas  
`$ git bisect good` //si il est bon  
`$ git bisect bad` //si l’erreur est trouvée  
Ainsi jusqu’à trouver le 1er commit qui a engendré l’erreur (first bad commit) → on copie l’id du commit  
`$ git bisect reset` //la recherche est finie  
`$ git revert [id_commit]` //pour annuler le commit avec l’erreur  
`$ git stash pop` //pour récupérer et reprendre le travail sauvegardé

#### RESET

##### SOFT

`$ git reset --soft`  
Permet de se placer sur un commit spécifique afin de voir le code à un instant donné, ou de créer une branche partant d’un ancien commit.  
Elle annule les commits, mais conserve les modifications dans le répertoire de travail et la zone de stage.  
Elle ne supprime aucun fichier, aucun commit, et ne crée pas de HEAD détaché.

##### MIXED (par défaut)

Annule les commits et déplace les modifications dans le répertoire de travail.  
`$ git reset` //correspond à:  
`$ git reset --mixed HEAD~`  
`$ git reset --mixed HEAD fiche.txt` //retire le fichier de la zone stage  
`$ git reset HEAD fiche.txt` //--mixed n’est pas obligatoire

##### HARD

Annule les commits et supprime toutes les modifications dans le répertoire de travail, réinitialisant complètement le dépôt à l’état du commit spécifié.  
`$ git log` //pour récupérer le hash (identifiant) du dernier commit  
`$ git reset --hard HEAD^` //supprime le dernier commit (là où était le HEAD)  
`$ git checkout autreBranche` //on va sur une autre branche  
`$ git reset --hard ca83a6df` //on applique le commit supprimé sur la nouvelle branche

### BRANCHES

Une branche est un pointeur vers un commit en particulier.

`$ git branch` //liste des branches  
`$ git branch -r` //réveille des branches inactives  
`$ git branch -f [cible] [destination]` //force une branche cible à se déplacer

#### CRÉATION

pour renommer la branche master en main  
`$ git branch -M main`

`$ git branch test` //ajout d’une nouvelle branche test, en parallèle de main (ou master)  
`$ git checkout test` //on bascule sur la branche test en déplaçant le head (la surveillance pour le commit)  
`$ git switch test` //nouvelle écriture pour la bascule  
`$ git checkout -b test` //écriture raccourcie des 2 précédentes

#### MODIFICATION

`$ git branch -d test` //on supprime la branche test  
`$ git branch -D test` //pour supprimer aussi toutes les modifs dans la branche

#### RÉFÉRENCES RELATIVES

Pour cibler un commit particulier (pour détacher le HEAD par exemple):  
`$ git checkout feature^` //place le HEAD sur le parent du dernier commit de la branche feature  
`$ git checkout feature~3` //cible le 3e parent en remontant dans l’historique des commits  
`$ git branch -f main HEAD~3` //bouge (de force) la branche main à trois parents derrière HEAD  
`$ git reset HEAD~1` //remonte une branche en arrière en annulant le dernier commit  
Quand plusieurs parents sont possibles: HEAD^2 //on choisit le parent n°2  
`$ git checkout HEAD~^2~2` //on peut combiner plusieurs références relatives (recule de 1, recule vers le 2e parent, recule de 2)

#### FUSIONNER

Quand le projet est linéaire:  
`$ git checkout main` //on se remet sur main  
`$ git merge test` //on fusionne main avec test  
`$ git branch -d test` //on supprime la branche devenue inutile  
On a fait avancer le main jusqu’au test (fast-forward)

Quand le projet diverge (commits différents dans chaque branche)  
fusion de 3 sources: le dernier commit commun aux deux branches et le dernier commit de chaque branche.  
En cas de conflits: trait de séparation dans le fichier, on va supprimer la partie en trop  
puis git add et git commit.

#### REBASER

on va déplacer les commits de test pour déplacer la branche à la pointe de la branche main  
`$ git checkout test`  
`$ git rebase main`  
`$ git rebase -i [destination] [cible]` //rebase la branche ciblée sur une autre branche en réordonnant les commits

Attention ne jamais rebaser des commits qui ont déjà été poussés sur un dépôt public.

## GITHUB

### CLÉ SSH ET CONNEXION AU DÉPOT DISTANT GITHUB

création d’une paire clé publique / clé privée:  
`$ ssh-keygen -t ed25519 -C "jp.herfeld@gmail.com"`  
clé publique: .ssh/id_ed25519.pub  
clé privée: .ssh/id_ed25519

copier la clé publique dans le presse-papier:  
`$ clip < ~/.ssh/id_ed25519.pub`  
et la coller dans l’espace github de création de clé SSH

copier le lien SSH du repository git-hub  
et spécifier à git le dépôt d’origine du projet:  
`$ git remote add origin git@github.com:JeanPhiH/Objectif-Charlie.git`
Cela permet de lier un dépôt à un nom plus court (origin ici).

#### SI LA CLE N’EST PAS RECONNU

lister les clés éxistantes:  
`$ ls -al ~/.ssh`
ouvrir l’agent  
`$ eval "$(ssh-agent -s)"` //agent 4117  
ajouter la clé créée  
`$ ssh-add ~/.ssh/id_ed25519` //ou un autre nom de clé

pour vérifier les url:  
`$ git remote -v`

pour renommer la branche master en main  
`$ git branch -M main`

on peut alors envoyer des commits du repository vers le dépôt distant GitHub:  
`$ git push -u origin main` //pour le 1er envoie  
`$ git push origin main` //sans le -u par la suite

### CLONAGE

#### CLONER UN DÉPOT

On ne pourra pas récupérer les changements à partir du projet d’origine  
`$ git clone [URL du dépot]`

Pour cloner une branche:  
`$ git clone -b nom_branche [URL du dépot]`

#### FORK

Copier un dépot sans affecter le projet original tout en contribuant au projet

- création nouvelle branche
- modifications de fichiers
- commit avec message
- pull request pour demander validation
- merge request pour fusion

En pratique, on fork puis on clone notre branche pour pouvoir travailler dessus localement.

### SYNCHRONISATION DE DEPOT

#### ENVOYER UNE BRANCHE

`$ git commit -m` //depuis le dépot local  
`$ git push [nom-distant] [nom-local]`  
`$ git push origin [nom_branche]`  
`$ git push origin main`  
`$ git push origin <source>:<destination>` //pour envoyer une source locale spécifique vers une destination distante spécifique  
`$ git push origin feature^:beta` //envoie le commit parent de feature vers la branche distante beta (qui sera crée si elle n’existe pas)

#### RAPATRIER UNE BRANCHE

`$ git fetch` //télécharger sans modifier les branches locales, il faudra merge ou rebase ensuite  
`$ git fetch origin <source>:<destination>` //pour rapatrier une source distante spécifique vers une destination locale spécifique

`$ git pull [nom-distant] [nom-local]` // pour récupérer en local les dernières modif du dépôt github  
`$ git pull origin <source>:<destination>` //pareil que fetch mais avec un merge automatique sur la branche courante  
git pull = git fetch + git merge  
git pull --rebase = git fetch + git rebase

#### SUPPRIMER UNE BRANCHE DISTANTE

`$ git push origin :feature` //supprime la branche feature du dépot distant

#### RESYNCHRONISER

`$ git checkout -b notMain origin` //crée une nouvelle branche nommée notMain et la configure pour suivre o/main du dépot distant.  
`$ git branch -u origin notMain` //même chose  
pour mettre à jour l’origine:  
`$ git remote set-url origin git@github.com:JeanPhiH/Objectif-Charlie.git`

#### CODE SOURCE: UPSTREAM

Pour synchroniser avec un code source existant  
`$ git remote add upstream [URL du dépot]`  
`$ git pull upstream main` //pour copier le dépot en local  
`$ git push origin main` //pour mettre à jour le dépot sur github

### CONFLITS

#### Exemple:

`<<<<<<< HEAD`  
`Un navigateur web` //modif locale  
`=======`  
`Un serveur web comme XAMPP` //modif distante  
`A définir`  
`>>>>>>> a6c82f75db73fc5aaec7fc2ef175253133876565`

Pour conserver la modif distante: '$ git checkout --theirs [nom_fichier]'  
Pour conserver la modif locale: '$ git chackout --ours [nom_fichier]'  
On peut aussi modifier le fichier manuellement et le sauvegarder:

`Un navigateur web`  
`Un serveur web comme XAMPP`

Ensuite, dans tous les cas: git add, git commit puis git push

### GITFLOW

![gitflow](/items/img/gitflow.png)

`$ git flow init`  
`$ git flow feature start issue5`  
`$ git add \*`  
`$ git commit -m "#5 implémentation de la fonctionnalité"`  
`$ git flow feature finish issue5`  
`$ git flow release start 0.0.2`  
`$ git flow release finish ‘0.0.2’`
