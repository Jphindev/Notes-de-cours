# WINDEV

## Raccourcis clavier

| Raccourci    | Effet                             | Niveau  |
| ------------ | --------------------------------- | ------- |
| F1           | Aide sur l'élément sélectionné    |         |
| F2           | Événements de l'objet             |         |
| F4           | Reproduire la mise en forme       | fenêtre |
| F4           | Nouvelle procédure locale         | code    |
| F5           | Ordre de navigation               | fenêtre |
| F9           | Tester la fenêtre                 |         |
| Ctrl F2      | Traitement ou événement initial   |         |
| Ctrl F3      | Rechercher/remplacer dans le code |         |
| Ctrl F4      | Fermer la fenêtre                 |         |
| Ctrl F9      | Tester le projet                  |         |
| Ctrl <       | Accueil                           |         |
| Ctrl E       | chercher une fenêtre              |         |
| Ctrl W       | cacher les volets                 |         |
| Ctrl B       | Placer un point d'arrêt débogueur | code    |
| Ctrl L       | supprime la ligne                 | code    |
| Ctrl D       | duplique la ligne                 | code    |
| Ctrl /       | met en commentaires               |         |
| Ctrl Shift / | enlève les commentaires           |         |
| Ctrl R       | Indenter automatiquement le code  |         |
| Ctrl N       | Nouveau                           |         |
| Shift F4     | Nouvelle procédure globale        | code    |
| Shift Tab    | Désindente                        | code    |
| Tab          | Indente                           | code    |
| Alt Entrée   | Ouvrir la description             |         |
| R            | Formatage du champ                | état    |
|              |                                   |         |
|              |                                   |         |
|              |                                   |         |
|              |                                   |         |

## I. Les bases

### 1. Initialisation d'un projet

Les variables globales peuvent être déclarées en codant l'élément P.

### 2. Analyse

rubrique = entrée  
fichier de données = table  
L'analyse permet de décrire tous les fichiers de données manipulés par l'application.  
analyse -> répertoire .ana

Cardinalités: Client 0,n --- 1,1 Commande  
Un client peut avoir entre 0 et plusieurs commandes.  
Une commande peut avoir un seul client et pas plus.

### 3. Clés de fichiers de données

- Clé unique: identifie la rubrique avec une valeur unique, possibilité d'utiliser un identifiant automatique
- Clé avec doublons: plusieurs valeurs identiques sont possibles
- Clé primaire: unique et non nulle, une seule par fichier de données
- Clé spatiale: contient des données géographiques ou géométriques

Ces clés permettent d'accélérer les accès aux données et les tris.

Elles peuvent être:

- Clé simple: sur une seule rubrique
- Clé composée: définir une clé sur plusieurs rubriques

### 4. Charte

BTN\*Bouton  
FEN_Fenêtre  
SAI_Champ_De_Saisie
SEL_Champ_De_Sélection_radio
LIB_Libellé
IMG_Image
TABLE_Table
COL_Colonne
ONG_Onglet
COMBO_Sélection_dans_une_liste
ETAT_Représentation_graphique
OPT_Option_de_menu_déroulant

gGlobal
sString_Chaine  
mMéthode
paramParamètre_de_la_requète

### 5. Débogueur

- Placer un point d'arrêt puis lancer le projet
- Suivre l'évolution pas à pas ou plus détaillé
- Possibilité de déplacé la position de l'exécution en cours
- clic droit puis "Ajouter l'expression dans le débogueur" pour suivre la valeur d'une variable
- clic sur colonne stop pour l'autostop: lancera le débogueur dès que la valeur de la variable suivie change
- colonne expression pour mettre une valeur cible (ex: =10)
- Visualiser le suivi d'une variable: clic droit puis éditer

## II. Wlangage

-> programmation événementielle

```wl
// Syntaxe classique
TableAjouteLigne(TABLE_TableProduit, "Dubois", "Pierre")

// Syntaxe préfixée
TABLE_TableProduit.AjouteLigne("Dubois", "Pierre")

// INFO: Afficher dans une boite de dialogue
Info("Bonjour" + SAI_Prénom, "Bienvenue ! (sur une autre ligne)")

// TRACE: Pour tester une manipulation (comme console.log)
SI EnModeTest() = Vrai ALORS //
  Trace("Variable NumMenu : " + NumMenu)
FIN
```

### 1. VARIABLES

https://doc.pcsoft.fr/?1514013&name=les_differents_types_variables

```wl
// Déclaration
Prix est un monétaire //deviendra moPrix avec la charte
Nom, Prénom sont des chaînes // gsNom, gsPrénom pour global string avec la charte

// Initialisation
Prix = 500.32

// Raccourci
Prix est un monétaire = 500.32

// Portée globale
// - niveau Projet et Collection de procédures,
// - niveau Fenêtre, Fenêtre Mobile, Page, Etat,
// - niveau Champ.
```

#### a. NOMBRES

```wl
Compteur est un entier
V1 est un entier
Res est un numérique

Compteur = 10
V1 = 3

Compteur = Compteur + 3  // Compteur vaut 13
Compteur ++ // Compteur vaut 14
Compteur -= 8 // Compteur vaut 6
Compteur = Compteur * V1 // Compteur vaut 18
Res = Compteur / 5 // Res vaut 3.6

// Comparaisons: < > <= >= <> =
```

#### b. CHAÎNE

```wl
Nom est une chaîne
Nom = "Dupont"
Nom = SAI_Nom //affectation d'une variable avec un champ

ChaîneMultiligne est une chaîne
Chaîne multiligne = "
  Ceci est une chaîne
  sur plusieurs lignes.
  "
```

##### Concaténation

```wl
MaChaîneConstruite	est une chaîne
NomProduit			    est une chaîne	= "WINDEV"

// Concaténation (+)
MaChaîneConstruite = "Mon outil de développement, c'est " + NomProduit + " !"
Trace("Concaténation : " + MaChaîneConstruite)

// ChaîneConstruit (%1)
MaChaîneConstruite = ChaîneConstruit("Mon outil de développement, c'est %1 !", NomProduit)
Trace("ChaîneConstruit : " + MaChaîneConstruite)

// Saisie directe de la variable (syntaxe [% %]) -> recommandé
MaChaîneConstruite = "Mon outil de développement, c'est [%NomProduit%] !"
Trace("Saisie directe : " + MaChaîneConstruite)
```

##### Opérations de chaînes

```wl
ListeProduits est une chaîne = "
WINDEV
WEBDEV
WINDEV Mobile
"
// Parcourir tous les éléments de la chaine
POUR TOUTE CHAÎNE UnProduit DE ListeProduits SÉPARÉE PAR RC //Retour Chariot
	Trace(UnProduit)
FIN

// Extraire un élément particulier
Produit est une chaîne = ListeProduits.ExtraitChaîne(2, RC)
Trace(Produit) //WEBDEV

// Extraire des caractères
Texte est une chaîne = "San Francisco"
Texte[5] //F
Texte[5 À 10] //Franci
Texte[5 À] //Francisco
Texte[À 10] //San Franci
Texte[10 SUR 3] //isc
Texte.Gauche(3) //San
Texte.Droite(3) //sco
Texte.Milieu(5, 3) //Fra

// Formatage
TexteInitial est une chaîne = "C'est Éric"

TexteInitial = TexteInitial.Formate(ccSansAccent + ccMinuscule) //cc = chaine de caractère
Trace(TexteInitial) //c'est eric
TexteInitial = TexteInitial.Formate(ccMajuscule + ccSansEspaceIntérieur)
Trace(TexteInitial) //C'ESTÉRIC
SansEspace("Abra ca da bra", sscIntérieur) // Renvoie "Abracadabra"

// Recherche
ChaîneARechercher	est une chaîne	= "WINDEV"

TexteOriginal		est une chaîne	= "
Outils de développement :
- WINDEV
- WEBDEV
- WINDEV Mobile
"

Pos est un entier
Pos = TexteOriginal.Position(ChaîneARechercher)
SI Pos = 0 ALORS
	Trace("La chaîne - [%ChaîneARechercher%] - n'a pas été trouvée dans le texte")
SINON
	Trace("La chaîne - [%ChaîneARechercher%] - a été trouvée à la position [%Pos%]")
FIN
//La chaîne - WINDEV - a été trouvée à la position 30 (en comptant les retours chariots)

// Comparaison de chaînes
// Chaînes à comparer
Chaîne1 est une chaîne = "DEVELOPPEMENT"
Chaîne2 est une chaîne = "DEV"
Chaîne3 est une chaîne = "Développement"

// Les 2 chaînes sont comparées avec l'opérateur ~= (égalité souple: sans casse, espaces ou accents)
SI Chaîne1 ~= Chaîne2 ALORS
  Trace("Les 2 chaînes sont équivalentes")
SINON
  Trace("Les 2 chaînes sont différentes")
FIN //différentes

SI Chaîne1 ~= Chaîne3 ALORS ... //équivalentes
```

#### c. TEMPS

##### Type Date

```wl
MaDate est une Date
MaDate	= Hier()
MaDate	= "20210929"
MaDate.Année	= 1985
MaDate.Mois		= 10
MaDate.Jour		= 26
Trace(MaDate.VersChaîne()) //26/10/1985
Trace(MaDate.VersChaîne("Jjjj JJ Mmmm AAAA")) //Samedi 26 Octobre 1985
Trace(MaDate.VersJourEnLettre()) //samedi

SI MaDate < DateDuJour() ALORS
	Trace("La date mémorisée est antérieure à la date du jour")
FIN
```

##### Type heure

```wl
// Déclaration d'une heure
MonHeure est une Heure // Par défaut, l'heure est initialisée avec l'heure actuelle
MonHeure = Maintenant()
MonHeure = "1525"

MonHeure.Heure = 12
MonHeure.Minute = 0
MonHeure.Seconde = 0

Trace(MonHeure.VersChaîne()) //12:00:00:00
Trace(MonHeure.VersChaîne("HH:mm:SS")) //12:00:00

SI MonHeure < Maintenant() ALORS
  Trace("L'heure mémorisée est antérieure à l'heure actuelle")
SINON
  Trace("L'heure mémorisée est postérieure à l'heure actuelle")
FIN //antérieure
```

##### Type Durée

```wl
MaDurée est une Durée
MaDurée = 2 min 8 s
MaDurée = 128 s
MaDurée.EnSecondes = 128
Trace(MaDurée.VersChaîne("MM:SS")) //02:08
```

#### d. TABLEAU

```wl
// les indices commencent à 1, pas à 0

MonTableau est un tableau de chaînes

MonTableau.Ajoute("WINDEV")
MonTableau.Ajoute("WEBDEV")
MonTableau.Ajoute("WINDEV Mobile")

Trace("Valeur de l'élément 3 : [%MonTableau[3]%]") //WINDEV Mobile

TableauJour est un tableau de chaînes = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"]
```

##### POUR ... À

```wl
POUR Indice = 1 À MonTableau.Occurrence
  Trace("[%Indice%] : [%MonTableau[Indice]%]")
FIN //1 : WINDEV | 2 : WEBDEV ...
```

##### POUR TOUT ...

```wl
POUR TOUT ÉLÉMENT UneChaîne, Indice DE MonTableau
  Trace("[%Indice%] : [%UneChaîne%]")
FIN
```

##### Tableau associatif

```wl
MonTableau est un tableau associatif de Dates

MonTableau["Marc"] = "19820201"
MonTableau["Anne"] = "19840604"

Trace("Valeur de l'élément ayant pour clé ""Marc"" : " + MonTableau["Marc"])

POUR TOUT ÉLÉMENT Valeur, Clé, Indice DE MonTableau
  Trace("Valeur de l'élément [%Indice%] qui a pour clé [%Clé%] : [%Valeur%]")
FIN
```

#### e. STRUCTURE

```wl
//regroupe des variables de type différents
NomComplet est une Structure
  Nom est une chaîne //membre
  Prénom est une chaîne
FIN

// Déclaration d'une structure et de ses membres
Contact est un NomComplet
Contact.Nom = "POLO"
Contact.Prénom = "MARCO"

// Accéder à un membre
LeNom est une chaîne
LeNom = Contact.Nom
Trace(LeNom) //POLO
Trace(Contact.Nom) //POLO

// Tableau de structures
MesContacts est un tableau de NomComplet
MesContacts.Ajoute(Contact) //ou Ajoute(MesContacts, Contact)
Trace(MesContacts[1].Nom, MesContacts[1].Prénom) //POLO | MARCO
```

### 2. CONDITIONS

#### a. SI... ALORS... SINON... FIN

```wl
NombreAléatoire est un entier
// Initialise le générateur de nombre aléatoire
InitHasard()
// Prend un nombre au hasard entre 100 et 4000
NombreAléatoire = Hasard(100, 4000)
Trace("Valeur du nombre aléatoire " + NombreAléatoire)
// Vérifie si ce nombre est supérieur strictement à 2000
SI NombreAléatoire > 2000 ALORS
  Trace("Nombre supérieur à 2000")
SINON
  Trace("Nombre inférieur ou égal à 2000")
FIN

// Fonction en condition: fait l'action et vérifie ensuite la condition
SI fCopieFichier("test.txt","test2.txt") = Faux ALORS
	Erreur("Problème lors de la copie de test.txt vers test2.txt")
	RETOUR
FIN

// Instruction conditionnelle monoligne
Trace(NombreAléatoire > 2000 ? "Nombre supérieur à 2000" SINON "Nombre inférieur ou égal à 2000")
```

##### ET

```wl
Condition1 est un booléen = Faux
Condition2 est un booléen = Vrai

SI Condition1 ET Condition2 ALORS //les deux doivent être vrai
  Trace("Condition1 ET Condition2 : <vrai>")
SINON
  Trace("Condition1 ET Condition2 : <faux>")
FIN
```

##### OU

```wl
Condition1 est un booléen = Faux
Condition2 est un booléen = Vrai

SI Condition1 OU Condition2 ALORS //une seule doit être vrai
  Trace("Condition1 OU Condition2 : <vrai>")
SINON
  Trace("Condition1 OU Condition2 : <faux>")
FIN

// avec _ET_ _OU_ la seconde condition n'est pas évaluée si la première est fausse
```

#### b. SELON

```wl
LaDateDuJour est une Date

SELON LaDateDuJour.Jour
  CAS 1 : Trace("Nous sommes le premier jour du mois.")
  CAS 15 : Trace("Nous sommes le 15 du mois.")
  AUTRES CAS : Trace("Nous sommes le : " + LaDateDuJour.VersChaîne())
FIN

SELON LaDateDuJour.Mois
  CAS 1, 2, 3 : Trace("Nous sommes au premier trimestre de l'année.")
  CAS 4 <= * <= 6 : Trace("Nous sommes au deuxième trimestre de l'année.")
  CAS > 6 : Trace("Nous sommes au second semestre de l'année.")
FIN
```

### 3. LES BOUCLES

#### a. POUR

```wl
// Remplissage d'un tableau d'entiers pairs de 1 à 10
TableauNombres est un tableau d'entiers
POUR Indice = 1 À 10
  SI Indice = 5 ALORS
    Trace("Condition de sortie atteinte")
    SORTIR
  FIN
  SI EstImpair(Indice) = Vrai ALORS
    Trace("[%Indice%] est impair : passe à l'itération suivante")
    CONTINUER
  FIN
  TableauNombres.Ajoute(Indice)
  Trace("Ajout du nombre [%Indice%] dans le tableau")
FIN
POUR Indice = 1 _À_ TableauNombres.Occurrence //length
  // _À_ pour ne pas recalculer le nombre d'occurrences à chaque tour
  Trace("Indice [[%Indice%]] a pour valeur " + TableauNombres[Indice])
FIN
// Indice [1] a pour valeur 2 | Indice [2] a pour valeur 4
```

##### PAS

```wl
POUR Indice = 100 À 1 PAS -10
  Trace(Indice) // 100, 90, 80...
FIN
```

#### b. BOUCLE (nb d'occurences inconnus)

```wl
Compteur est un entier = 10

// Fin de boucle avec SI
BOUCLE
  Trace("Tour de boucle | Valeur : [%Compteur%]")
  Compteur--
  SI Compteur = 0 ALORS SORTIR
FIN

// Fin de boucle avec TANTQUE
BOUCLE
  Trace("Tour de boucle | Valeur : [%Compteur%]")
  Compteur = Compteur - 1
À FAIRE TANTQUE Compteur > 0

// Fin de boucle avec nb d'itérations
BOUCLE(10) //boucle répétée 10 fois
  Trace("Tour de boucle | Valeur : [%Compteur%]")
  Compteur --
FIN
```

#### c. TANTQUE (condition de sortie au début)

```wl
Compteur est un entier = 1
TANTQUE Compteur <= 10
  Trace("Tour de boucle | Valeur : [%Compteur%]")
  Compteur ++
FIN
```

### 4. LES PROCÉDURES

```wl
//Création d'une procédure globale
PROCÉDURE Bienvenue()
  Info("Bienvenue dans mon programme écrit en WLangage")

PROCÉDURE SupprimerEspace(LOCAL ChaîneATraiter est une chaîne)
  //LOCAL permet de ne pas modifier la variable originale
  ChaîneATraiter = ChaîneATraiter.Remplace(" ", "")
  Trace("La chaîne sans espace est : [%ChaîneATraiter%]")

PROCÉDURE CalculTTC(LOCAL MontantHT est un monétaire, LOCAL TauxTVA est un réel = 20) : monétaire
  //TauxTVA est optionnel et fixé à 20 par défaut
  TTC est un monétaire
  TTC = MontantHT * (1 + TauxTVA/100)
RENVOYER TTC

// Appel de la procédure depuis le code
Bienvenue()

MaChaîne est une chaîne
MaChaîne = "a b c"
SupprimerEspace(MaChaîne) //abc

MontantTTC est un monétaire
MontantTTC = CalculTTC(500, 10)
//MontantTTC = CalculTTC(500) si on utilise tauxTVA de 20 par défaut
Trace("Montant TTC : " + MontantTTC) //550
```

### 5. PROGRAMMATION ORIENTÉE OBJET

Nouveau -> Code -> Classe

Une classe comporte des membres (données, paramètres) et des méthodes (procédures, fonctions).  
Chaque objet crée sera une instance de la classe.  
L'héritage permet d'inclure les caractéristiques d'une classe de base dans une nouvelle classe dérivée (sous classe).  
Une classe dérivée permet à ses objets d'accéder à toutes les méthodes, à tous les membres et à toutes les propriétés de ses classes ancêtres.

#### a. Création d'une classe

```wl
CProduit est une Classe

PUBLIC
  mg_SeuilAlerteStock est un entier //membre public

PRIVÉ
  m_Référence est une chaîne //membre privé
  m_Libellé est une chaîne
  m_Stock est un entier
FIN

// État du stock
EtatStock est une Enumération
  STOCK_VIDE
  STOCK_ALERTE
  STOCK_OK
FIN
```

#### b. Le constructeur

On modifie le constructeur pour initialiser le membre mg_SeuilAlerteStock lors de la création de l'objet

```wl
PROCÉDURE Constructeur(SeuilAlerteStock est un entier)
mg_SeuilAlerteStock = SeuilAlerteStock
```

#### c. Getter et Setter

On génère la propriété (clic droit) pour chaque membre afin d'avoir un getter et setter

```wl
//getter: lit la valeur du membre
PROCÉDURE PUBLIQUE Référence() : chaîne
RENVOYER m_Référence

//setter: modifie la valeur du membre
PROCÉDURE PUBLIQUE Référence(Valeur est une chaîne)
m_Référence=Valeur
```

#### d. Méthodes

On crée des méthodes pour mettre le stock à jour et vérifier l'état du stock

```wl
PROCÉDURE AjouteStock(LOCAL StockSupplémentaire est un entier) : booléen

// Le stock fourni en paramètre doit être valide
SI StockSupplémentaire < 0 ALORS
// Impossible d'ajouter un stock négatif
RENVOYER Faux
FIN

// Incrémente le stock actuel avec le stock supplémentaire
m_Stock += StockSupplémentaire

// L'ajout est effectif
RENVOYER Vrai
```

```wl
PROCÉDURE EtatDuStock() : EtatStock

// Si le stock est vide
SI m_Stock = 0 ALORS
RENVOYER STOCK_VIDE
FIN

// Si le stock est sous le seuil d'alerte
SI m_Stock <= mg_SeuilAlerteStock ALORS
RENVOYER STOCK_ALERTE
FIN

// Le stock est OK
RENVOYER STOCK_OK
```

#### e. Instanciation

On crée un objet pour instancier la classe

```wl
UnProduit est un CProduit(20) //renseignement de la quantité limite grâce au contructeur

UnProduit.Référence	= "REF-123"
UnProduit.Libellé	= "Mon produit"
UnProduit.AjouteStock(10)
Trace(UnProduit.Référence + " " + UnProduit.Libellé + " " + UnProduit.Stock)

SI UnProduit.EtatDuStock() = CProduit.STOCK_OK ALORS
	Trace("Le stock est correct")
SINON
	Trace("Le stock est insuffisant")
FIN
//REF-123 Mon produit 10 | Le stock est insuffisant
```

## III. ÉTATS

Un état est une représentation graphique de données.
Un rapport à envoyer, un bon de commande à imprimer, un PDF à générer, ...

### Visualiser un état

```wl
// Configuration du visualisateur
iParamètreVisualisateur(iBoutonAucun+iBoutonImprimante+iBoutonPdf)
iParamètreVisualisateur(iBoutonTous-iBoutonImprimante)
// Ouverture grâce au visualisateur
iDestination(iVisualisateur)
//sélection de l'état à afficher
iImprimeEtat(ETAT_Bon_de_commande)
```

### Enchainement d'états

```wl
iDestination(iVisualisateur)
// Affiche plusieurs états à la suite
iEnchaînementAjoute(ETAT_Partie1)
iEnchaînementAjoute(ETAT_Partie2)
iEnchaînementImprime()
```

### Etat à partir d'une requête

```wl
//-> BTN_RapportPrescription (clic)
IDDoc est une chaîne
// Saisie du paramètre
Saisie("Pour quel médecin ?", IDDoc)
iDestination(iVisualisateur)
// Lancer la requête avec le paramètre
iInitRequêteEtat(ETAT_PrescriptionsDocteur, IDDoc)
// Afficher l'état
iImprimeEtat(ETAT_PrescriptionsDocteur)

//Autre solution: lancer la requête dans le code de l'état
//-> Ouverture de ETAT_PrescriptionsDocteur
PROCÉDURE MonEtat(IDSaisie est une chaîne)
  iInitRequêteEtat(ETAT_PrescriptionsDocteur, IDSaisie)
//-> BTN_RapportPrescription (clic)
iImprimeEtat(ETAT_PrescriptionsDocteur, IDDoc)
```

Si plusieurs paramètres sont à fournir avec l'état, il faut les écrire dans le même ordre que celui de la requête SQL.
Pour un état sans tableau, il suffit de modéliser les champs sur la première ligne de résultat. Le reste du résultat sera généré automatiquement par répétition des champs.

## IV. FONCTIONS NATIVES

### BASE DE DONNEES / SERVEUR

```wl
// CONNEXION BDD DISTANTE // fichiers locaux vers BDD externe
MaConnexionManuelle est une Connexion
HDécritConnexion(MaConnexionManuelle)
  //Paramètres de la connexion à l'aide de l'assistant
  MaConnexionManuelle.Provider = hAccèsHFCLientServeur
  MaConnexionManuelle.Utilisateur = "WINDEVNURSE"
  MaConnexionManuelle.MotDePasse = "1234"
  MaConnexionManuelle.Serveur = "webdev26.dinao.com:4900"
  MaConnexionManuelle.BaseDeDonnées = "WINDEVNURSE"
  MaConnexionManuelle.Cryptage = hCryptageNon
SI HOuvreConnexion(MaConnexionManuelle) ALORS   //on ouvre la connexion
  HChangeConnexion("*", MaConnexionManuelle)    //on l'applique à tous nos fichiers de données
  HCréationSiInexistant("*")                    //création des fichiers dans la BDD externe
  HFermeConnexion(MaConnexionManuelle)          //on ferme la connexion
SINON
  ToastAffiche("Connexion impossible", toastLong, cvMilieu, chCentre, VertClair)
  RETOUR
FIN

// HExécuteRequête // Exécuter une requête
HExécuteRequête(REQ_Requête, hRequêteDéfaut, gsVariableChampRécupéré)
TABLE_REQ_Requête.Affiche()

// HNbEnr // renvoie le nombre de résultats d'une requête ou d'un fichier de données
HNbEnr(REQ_NomRequete)

// HSupprimeTout // supprime tous les enregistrements d'un fichier de données
HSupprimeTout(Client)

// Ping // vérifie la disponibilité d'un serveur
Ping("webdev26.dinao.com") //vrai si le serveur est disponible
```

### CHAINE

```wl
// ExtraitChaine // extraction en fonction des séparateurs
sChaîne est une chaîne = "Fraise, Framboise<BR>Citron<BR>Chocolat et Banane"
sRésultat est une chaîne = sChaîne.ExtraitChaîne(rangPremier, [", " , " et ", "<BR>"])
TANTQUE sRésultat <> EOT //End Of Text
  Trace(sRésultat)
  sRésultat = sChaîne.ExtraitChaîne(rangSuivant, [", " , " et ", "<BR>"])
FIN

// ChaîneOccurrence // renvoie le nombre d'occurrence d'une chaîne dans une autre
ChaîneOccurrence("anastasia", ["a","s"]) // Renvoie 6

// SansEspace // supprime les espaces d'une chaîne
SansEspace(" a  b c ") //abc
```

### CHAMPS

```wl
// RepriseSaisie // met le focus sur le champ de saisie spécifié
RepriseSaisie(SAI_Nom)

// SaisieInvalideDétecte // en cas de champ bligatoire non rempli ou caractères non autorisés
SI SaisieInvalideDétecte() ALORS
  ToastAffiche("Erreur de saisie !", ToastCourt, cvMilieu, chMilieu, RougeClair)
FIN
```

### DATE ET HEURE

```wl
// DateDifférence // renvoie le nombre de jours entre deux dates
nNbJours est un entier = DateDifférence(PremierJourDuMois(), SAI_DateFin)
```

### FENETRE

```wl
// ChangeFenêtreSource // charge une fenêtre interne dans un champ fenêtre interne
ChangeFenêtreSource(CFI_ChampFenêtreInterne, FI_FenêtreInterne1)    //charge FI_FenêtreInterne1 dans CFI_ChampFenêtreInterne

// FinProgramme // ferme l'application
FinProgramme()

// Info // Afficher dans une boite de dialogue
Info("Bonjour" + Nom_utilisateur, "Bienvenue !")
  //virgule pour le saut de ligne

// InfoConstruit // Boîte de dialogue avec des paramètres (%1)
InfoConstruit("Bonjour %1" + RC + "Bienvenue !", Nom_Utilisateur)

// OuiNon // fenêtre de dialogues avec 2 boutons: oui et non
OuiNon(Non, "Quitter l'application ?")
  // Non sera sélectionné par défaut

// Ouvre // ouvre une fenêtre modale avec possibilité d'envoyer des paramètres
FEN_TraitementPatient.Ouvre(TABLE_Patients.COL_IDPatients)
  //on ouvre la fenêtre TraitementPatient et on lui transmet l'identifiant du patient
  //dans l'événement de Déclarations globales de la nouvelle fenêtre:
PROCÉDURE FEN_TraitementPatient(VariableTransmise)

// OuvreFille // ouvre une fenêtre non modale pour manipuler plusieurs fenêtre à la fois
FEN_Envoi_d_un_mail.OuvreFille()

// OuvreSoeur // fenêtre non modale qui ne se fermera pas à la fermeture de la fenêtre parente
FEN_Envoi_d_un_mail.OuvreSoeur()

// Saisie // fenêtre de dialogue avec un champ de saisie
Saisie("Quel est votre nom ?", sNom)
```

### FICHIER

```wl
// fRepExe // chaine correspondant au répertoire EXE du projet
sChemin est une chaîne = fRepExe() + "\Fichier.txt"

// fCrée // crée un fichier
oFichier est un FichierDisque = fCrée(sChemin)

// Ouvre // ouvre un fichier
oFichier.Ouvre(sChemin, foLectureEcriture)

// EcritLigne // écrit une ligne dans le fichier
oFichier.EcritLigne("Première ligne")

// Ferme // ferme le fichier
oFichier.Ferme()

// fSauveTexte // Écriture directe dans le fichier .txt
fSauveTexte(sChemin, "Contenu de la ligne 1"+RC+"Contenu de la ligne 2"+RC+"Contenu de la ligne 3")

// HExtraitMémo // extrait le contenu d'un fichier image, son ou binaire
HextraitMémo(Fichier de données, Rubrique, "C:\Projet\test.jpg")

// LanceAppliAssociée // ouvre un fichier externe avec l'application dédiée
LanceAppliAssociée("C:\WDNEWS\Version\Fonctions.pdf")

// lit // lit le contenu d'un fichier par bloc
oFichier.lit(500)
  // Lecture de 500 octets du fichier

// LitLigne // lit une ligne du fichier
sLigneFichier = oFichier.LitLigne()
  // Lecture de la première ligne du fichier puis le fichier est parcouru jusqu'à la fin
TANTQUE PAS sLigneFichier~=EOT
	sContenuFichier += [RC] + sLigneFichier
	  // On mémorise la ligne lue et lecture de la ligne suivante
	sLigneFichier = oFichier.LitLigne()
FIN
Info("Le contenu du fichier est : ",sContenuFichier)

// fChargeTexte // Lecture complète d'un fichier .txt
sContenuFichier = fChargeTexte(ComplèteRep(fRepExe())+"fichier.txt")
Info("Le contenu du fichier est : ",sContenuFichier)

// fCopieFichier // copie un fichier
fCopieFichier("test.txt","test2.txt")

// fSupprime // supprime un fichier
SI fSupprime("test2.txt") ALORS //fait l'action et vérifie si c'est vrai
	Info("Suppression de test2.txt effectuée")
SINON
	Erreur("Suppression impossible : test2.txt inexistant")
FIN

// fSélecteur // choisit un fichier via l'explorateur Windows
sFichier est une chaîne = ""
sFichier = fSélecteur("",...	// Répertoire de base
	"",...                      // Fichier sélectionné
	"",...                      // Titre de la fenêtre
	"Fichier texte (*.txt)"+TAB+"*.TXT"+RC+...		// Choix des extensions
	"Tous (*.*)"+TAB+"*.*",...	// Filtre de sélection
	"TXT")                      // Extension sélectionnée à l'entrée
SI sFichier <> "" ALORS
	InfoConstruit("Le fichier sélectionné est '%1'",sFichier)
SINON
	Info("Aucun fichier sélectionné")
FIN

// REPERTOIRES //
fRepEnCours()             // Repertoire courant
fRepExe()                 // Repertoire de l'application
fRepDonnéesUtilisateur()  // Repertoire des données de l'utilisateur
fRépertoireExiste()       // Retourne vrai si le repertoire existe
fRepCrée()                // Crée un repertoire
fListeRépertoire(gsRep1,frRécursif) // Liste des repertoires
fRepSupprime(gsRep1,frRécursif)     // Supprime un repertoire
fRepSélecteur(ComplèteRep(SAI_REPENCOURS), "Sélectionnez un répertoire...", "")

// EXCEL //
FicXls est un xlsDocument = xlsOuvre("C:\chemin\Fichier.xls") // Ouvre un fichier Excel
xlsNbLigne(FicXls)                    // Nombre de lignes du fichier Excel
xlsDonnée(FicXls, n°ligne, n°colonne) // accède à une cellule
xlsFerme()                            // Ferme un fichier Excel
HImporteXLS(fichier de données, chemin du xls, n°feuille, "rubrique1pourinjectioncolonne1,rubrique2pourinjectioncolonne2", hImpTestDoublon + hImpIgnorePremièreLigne)
```

### TABLEAU

```wl
// Affiche // met à jour l'affichage du tableau
TABLE_Produit.Affiche(<position>)
  taCourantEnreg: affiche et sélectionne la produit recherché ou enregistré
  taCourantBandeau: affiche les produits regroupés par catégories
  taCourantPremier: positionne l'affichage sur le premier produit de la liste
  taInit: réinitialise l'affichage

// TableSelect // position dans un tableau
TableSelect(TABLE_Produit) // indique l'indice la la ligne sélectionnée
TableSelectPlus(TABLE_Produit,3) // sélection de la 3e ligne du tableau
TableSelectMoins(TABLE_Produit,3) // désélection de la 3e ligne du tableau
```

### GRAPHES

```wl
// grTitre // titre du graphe
grTitre(GRF_Programmation, "Part des hommes et des femmes",grEnHaut)

// grLégende // Ajouter une légende
grLégende (GRF_Programmation,grADroite)

// grEtiquetteSérie // Etiquette de séries pour les HISTOGRAMMES
grEtiquetteSérie(GRF_HistoProgrammation,1,"2020")
grEtiquetteSérie(GRF_HistoProgrammation,2,"2021")

// grEtiquetteCatégorie // Ajouter les étiquettes de catégorie (abscisses)
grEtiquetteCatégorie(GRF_Programmation, 1, "Hommes")
grEtiquetteCatégorie(GRF_Programmation, 2, "Femmes")

// grAjouteDonnée pour les graphes SECTEURS // Ajouter des données
grAjouteDonnée (GRF_Programmation, 1, 60)
grAjouteDonnée (GRF_Programmation, 1, 40)

// grAjouteDonnée pour les graphes SECTEURS // Remplir les données pour 2020 (série 1) et 2021 (série 2)
grAjouteDonnée(GRF_HistoProgrammation,1,1,100) //nom,série,catégorie,valeur
grAjouteDonnée(GRF_HistoProgrammation,1,2,110)
grAjouteDonnée(GRF_HistoProgrammation,1,3,120)
grAjouteDonnée(GRF_HistoProgrammation,2,1,150)
grAjouteDonnée(GRF_HistoProgrammation,2,2,170)
grAjouteDonnée(GRF_HistoProgrammation,2,3,180)

// grDessine // Dessiner le graphe complètement
grDessine(GRF_Programmation)
```

### ZONES RÉPÉTÉES

Comme un tableau avec un affichage différent en zones répétées

```wl
// ZoneRépétéeAjoute // ajoute des données dans une zone répétée
POUR TOUT Patient
  ZoneRépétéeAjoute(ZR_Patients, Patient.Nom + TAB + Patient.Prenom) // TAB pour aller au champ suivant
FIN
```

### FONCTIONNALITES DIVERSES

```wl
// DateDifférence // renvoie le nombre de jours entre deux dates
nNbJours est un entier = DateDifférence(SAI_DateDebut, SAI_DateFin)

// ErreurDétectée / ErreurInfo // détecte si la dernière fonction utilisée a renvoyé une erreur et affiche l'erreur
SI ErreurDétectée ALORS
  Trace(ErreurInfo())
  Erreur("Une erreur a été détectée pendant l'écriture dans le fichier",ErreurInfo())
	RETOUR
FIN

// ExécuteTraitement // Exécute le code d'un événement d'un autre élément.
//-> IMG_Visuel (clic)
BTN_Modifier.ExécuteTraitement(trtClic)

// Nation // Change la langue de l'application
Nation(nationAnglais)

// Sablier // le pointeur se transforme en sablier pendant le déroulement d'un code
Sablier(vrai)
  //code
Sablier(faux)

// TimerSys // Exécuter une procédure au bout d'un certain temps
TimerSys(Nom_Procédure, 200, 1) // Procédure éxécutée après 2s
FinTimerSys(1) // Annule le timer 1

// ToastAffiche // pop up d'information
ToastAffiche("Ceci est un message Toast.", toastLong, cvMilieu, chCentre, VertClair)

```

## V. EXEMPLES DE CODE

### Afficher et mettre à jour la fiche d'un produit à partir d'une liste de produits

```wl
//-> BTN_Modifier dans FEN_Menu (clic)
FEN_Fiche_du_produit.Ouvre()
// Met à jour la ligne sélectionnée après modification
TABLE_Produit.Affiche(taCourantBandeau) //met à jour le bandeau de sélection courant

//-> code dans FEN_Fiche_du_produit (Fin d'initialisation)
Produit.VersFenêtre() //Produit est un fichier de données (table)

//-> BTN_Valider dans FEN_Fiche_du_produit (clic)
EcranVersFichier()
//les valeurs des champs de la fenêtre vont être sauvegardées dans les rubriques correspondantes dans le fichier de données

// EcranVersFichier() est équivalent aux lignes suivantes:
// Produit.Référence = SAI_Référence
// Produit.Libellé = SAI_Libellé
// Produit.Description = SAI_Description
// ...

Produit.Modifie()   //c'est le fichier de données Produit que l'on veut modifier
Ferme()             //on ferme la fenêtre
```

### Modification d'une image

```wl
//-> BTN_Modifier dans FEN_Fiche_du_produit (clic)
Fichier est une chaîne
 
// Ouvre le sélecteur d'images
Fichier = fSélecteurImage("", "", "Sélectionnez une image...") //avec l'assistant

SI Fichier <> "" ALORS // Si un fichier a été sélectionné
  IMG_Visuel = Fichier
FIN
```

### Ajouter un nouveau produit

```wl
//-> BTN_Nouveau dans FEN_Menu (clic)

//on initialise les variables des rubriques du fichier de données "Produit"
Produit.RAZ()
//on ouvre la fiche du produit
FEN_Fiche_du_produit.Ouvre()
//on réaffiche le champ Table à partir de l'enregistrement courant
TABLE_Produit.Affiche(taCourantEnreg)

//-> BTN_Valider dans FEN_Fiche_du_produit (clic)
EcranVersFichier()
SI Produit..NouvelEnregistrement ALORS //vrai car RAZ fait précédemment
  Produit.Ajoute()
SINON
  Produit.Modifie()
FIN
//si.. sinon peut aussi être remplacé par: Produit.Enregistre()
Ferme()
```

### Rechercher un produit

- Recherche à l'identique

```wl
//-> BTN_RechercheIdentique pour champ COMBO_Client (clic)

// On recherche l'id du client qui correspond au nom complet recherché dans la combo
// La rubrique mémorisée dans la description du champ COMBO doit correspondre au premier paramètre de LitRecherche
Client.LitRecherchePremier(IDClient, COMBO_Client)
SI Client.Trouve() ALORS
  // Affiche les données du client dans le fenêtre
  Client.VersFenêtre()
FIN
```

- Recherche générique

```wl
//-> BTN_RechercheGénérique pour champ SAI_Nom_Recherché (clic)

// On recherche un nom complet qui correspond au texte saisi dans le champ
// Seul le premier nom trouvé sera affiché
Client.LitRecherche(NomComplet, SAI_Nom_Recherché)
SI Client.Trouve() ALORS
  // Affiche les données du client
  Client.VersFenêtre()
SINON
  Erreur("Aucun client ne correspond")
FIN
```

- Recherche dynamique dans une table

```wl
//-> SAI_Nom_Recherché (modification)
SI SAI_Nom_Recherché <> "" ALORS
  TableActiveFiltre(TABLE_Produits.COL_Nom, filtreContient, SAI_Nom_Recherché)
SINON
  TableDésactiveFiltre(TABLE_Produits)
FIN
```

### Parcourir des produits

```wl
//-> BTN_Premier dans ONG_Visualisation (clic)

// Lit le premier client
Client.LitPremier()
SI Client.EnDehors() ALORS
  // si le fichier de données est vide
  Info("Aucune fiche à visualiser.")
SINON
  // Affiche les données du client
  Client.VersFenêtre()
FIN

//-> BTN_Précédent avec message d'erreur quand début du fichier atteint

// Si aucune recherche en cours
SI Client.EnDehors() ALORS
  // Lit le dernier client
  Client.LitDernier()
FIN
 
// Lit le client précédent
Client.LitPrécédent()
// Si le début du fichier de données est dépassé
SI Client.EnDehors() ALORS
  Info("Début du fichier de données atteint.")
SINON
  // Affiche les données du client
  Client.VersFenêtre()
FIN

//-> BTN_Suivant avec retour au 1er si fin du fichier atteint

SI Client.EnDehors() ALORS
	Client.LitPremier()
SINON
	Client.LitSuivant()
	SI Client.EnDehors() ALORS
		Client.LitPremier()
	FIN
FIN
Client.VersFenêtre()

//-> BTN_Dernier

// Lit le dernier client
Client.LitDernier()
SI Client.EnDehors() ALORS
  // Pas de client
  Info("Aucune fiche à visualiser.")
SINON
  // Affiche les données du client
  Client.VersFenêtre()
FIN
```

### Recherche multicritère

- Création de la requête

Nouveau -> Requête -> Sélection  
Sélectionner les rubriques des différents fichiers de données.  
Choisir la rubrique qui va diriger le tri -> bouton "Trier"  
Choisir les rubriques sur lesquels va porter les critères de recherche -> bouton "Condition de sélection" est égal au paramètre puis paramNom

- Création des champs de recherche

  -> Avec un drag & drop de la rubrique depuis le volet d'exploration.  
  -> En créant le champ de recherche avec une liaison vers la rubrique concernée dans Description -> Liaison ou Description -> Contenu
  -> En utilisant l'assistant de création du champ

- Création du bouton de recherche pour mettre à jour l'affichage

```wl
//-> BTN_Rechercher (clic)

TABLE_REQ_RechercheCommandes.Affiche(taInit)
//permet de ré-exécuter l'événement "Initialisation" du champ Table
```

- Création de la table d'affichage

La table doit avoir pour source la requête précédemment créée

```wl
// -> TABLE_REQ_RechercheCommandes (initialisation)

MaSource.ParamEtat = SEL_Etat
MaSource.ParamIDModeRèglement = COMBO_ModeReglement
MaSource.ParamDebutPeriode = SAI_DateDébut
MaSource.ParamFinPeriode = SAI_DateFin
```

### Imprimer un bon de commande via un ETAT

- Créer une requête SELECT et sélectionner les éléments à afficher sur le bon de commande
- Créer une condition sur le pramètre à prendre en compte (Commande.IDCommande)
- Créer l'état basé sur la requête
- Spécifier les éléments à faire apparaitre en entête, corps ou pied de page
- Réorganiser la position des éléments dans l'état
- Créer un menu contextuel pour activer l'impression avec le code suivant

```wl
// Impression dans le visualisateur de rapports
iDestination(iVisualisateur)
// Initialise la requête de l'état avec l'id de la commande sélectionnée dans le tableau
ETAT_Bon_de_commande.InitRequête(TABLE_REQ_RechercheCommandes.COL_IDCommande)
// Lance l'impression de l'état
ETAT_Bon_de_commande.Imprime()
```

- Lier le menu contextuel au champ table dans l'onglet UI de la description de la table

### Envoie d'un mail

```wl
MaSession est un emailSessionSMTP
MaSession.Nom				= SAI_Utilisateur
MaSession.MotDePasse		= SAI_MotDePasse
MaSession.AdresseServeur	= SAI_Serveur_SMTP
MaSession.Port				= SAI_Port
// Ouvre la session SMTP
SI PAS MaSession.OuvreSession() ALORS
	Erreur("Impossible de se connecter au serveur SMTP.", ErreurInfo())
	RETOUR
FIN

MonMessage est un Email
 
MonMessage.Expediteur	= SAI_Expéditeur
MonMessage.Sujet		= SAI_Sujet
 
EDHTML_Email.VersEmail(MonMessage)
 
// Ajoute un destinataire
MonMessage.Destinataire.Ajoute(COMBO_Destinataire.ValeurAffichée)
 
 
// Ajoute la pièce jointe si besoin
SI SAI_Fichier <> "" ALORS
	MonMessage.ChargeFichierAttaché(SAI_Fichier)
FIN

// Envoie l'email
SI MaSession.EnvoieMessage(MonMessage) = Faux ALORS
	Erreur("Message non envoyé.", ErreurInfo())
SINON
	// Message envoyé
	ToastAffiche("Message envoyé", toastCourt, cvMilieu, chCentre)
FIN

// Ferme la session SMTP
MaSession.FermeSession()
```

### Remplir un histogramme par programmation

```wl
grTitre(GRF_TraitementsParDocteur, "Nb de traitements par docteur par jour",grEnHaut)
grLégende(GRF_TraitementsParDocteur,grADroite)
HExécuteRequête(REQ_TraitementsParDocteur,hRequêteDéfaut)

tabDatesIndices				est un tableau associatif d'entier
IndiceCat		est un entier	= 1

// Parcours unique avec gestion dynamique des indices
POUR TOUT REQ_TraitementsParDocteur
	datereq est une Date = REQ_TraitementsParDocteur.DateAdministration

	// Si cette date n'a pas encore d'indice, lui en attribuer un
	SI PAS tabDatesIndices[datereq] ALORS
		tabDatesIndices[datereq] = IndiceCat
		// Définir l'étiquette de la catégorie
		grEtiquetteCatégorie(GRF_TraitementsParDocteur, IndiceCat, DateVersChaîne(datereq, "DD/MM/YY"))
		IndiceCat++
	FIN

	// Récupérer l'indice de la date courante
	indiceDateCat	est un entier			= tabDatesIndices[datereq]
	numserie			est un entier			= Gauche(REQ_TraitementsParDocteur.IDDocteur, 3)
	nomserie			est une chaîne		= Milieu(REQ_TraitementsParDocteur.IDDocteur, 4, 6)

	// Définir le nom de la série
	grEtiquetteSérie(GRF_TraitementsParDocteur, numserie, nomserie)

	// Ajouter la donnée
	grAjouteDonnée(GRF_TraitementsParDocteur, numserie, indiceDateCat, REQ_TraitementsParDocteur.Comptage_1)
FIN

grDessine(GRF_TraitementsParDocteur)
```
