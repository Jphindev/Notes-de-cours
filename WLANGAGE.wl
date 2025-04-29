//////////////
// WLANGAGE //
//////////////

// -> programmation événementielle

// Syntaxe classique
TableAjouteLigne(TABLE_TableProduit, "Dubois", "Pierre")

// Syntaxe préfixée
TABLE_TableProduit.AjouteLigne("Dubois", "Pierre")

////////// VARIABLES

// https://doc.pcsoft.fr/?1514013&name=les_differents_types_variables

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

////// OPÉRATIONS MATHS

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

////// CHAÎNE

Nom est une chaîne
Nom = "Dupont"
Nom = SAI_Nom //affectation d'une variable avec un champ

ChaîneMultiligne est une chaîne
Chaîne multiligne = "
  Ceci est une chaîne
  sur plusieurs lignes.
  "

//// CONCATENATION

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

//// OPERATIONS DE CHAINES

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
Trace(Texte[5]) //F
Trace(Texte[5 À 10]) //Franci
Trace(Texte[5 À]) //Francisco
Trace(Texte[À 10]) //San Franci
Trace(Texte[10 SUR 3]) //isc

// Formatage
TexteInitial est une chaîne = "C'est Éric"

TexteInitial = TexteInitial.Formate(ccSansAccent + ccMinuscule) //cc = chaine de caractère
Trace(TexteInitial) //c'est eric
TexteInitial = TexteInitial.Formate(ccMajuscule + ccSansEspaceIntérieur)
Trace(TexteInitial) //C'ESTÉRIC

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

////// TEMPS

// Type Date

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

// Type heure

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

// Type Durée

MaDurée est une Durée
MaDurée = 2 min 8 s
MaDurée = 128 s
MaDurée.EnSecondes = 128
Trace(MaDurée.VersChaîne("MM:SS")) //02:08

////// TABLEAU

// les indices commencent à 1, pas à 0

MonTableau est un tableau de chaînes

MonTableau.Ajoute("WINDEV")
MonTableau.Ajoute("WEBDEV")
MonTableau.Ajoute("WINDEV Mobile")

Trace("Valeur de l'élément 3 : [%MonTableau[3]%]") //WINDEV Mobile

TableauJour est un tableau de chaînes = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"]

// POUR ... À

POUR Indice = 1 À MonTableau.Occurrence
  Trace("[%Indice%] : [%MonTableau[Indice]%]")
FIN //1 : WINDEV | 2 : WEBDEV ...

// POUR TOUT ...

POUR TOUT ÉLÉMENT UneChaîne, Indice DE MonTableau
  Trace("[%Indice%] : [%UneChaîne%]")
FIN

// Tableau associatif

MonTableau est un tableau associatif de Dates

MonTableau["Marc"] = "19820201"
MonTableau["Anne"] = "19840604"

Trace("Valeur de l'élément ayant pour clé ""Marc"" : " + MonTableau["Marc"])

POUR TOUT ÉLÉMENT Valeur, Clé, Indice DE MonTableau
Trace("Valeur de l'élément [%Indice%] qui a pour clé [%Clé%] : [%Valeur%]")
FIN

////// STRUCTURE

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






////// FONCTIONS

// Afficher dans une boite de dialogue
Info("Bonjour" + SAI_Prénom, "Bienvenue ! (sur une autre ligne)")

// Pour tester une manipulation (comme console.log)
SI EnModeTest() = Vrai ALORS //
  Trace("Variable NumMenu : " + NumMenu)
FIN