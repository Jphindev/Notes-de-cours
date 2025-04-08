// Notes de cours JavaScript
// Basées sur le cours de Pierre Giraud
// https://www.pierre-giraud.com/javascript-apprendre-coder-cours/

/********************************************/
/***** LES VARIABLES ET TYPES DE VALEUR *****/
/********************************************/

/* nom: commence par lettre, $ ou _, 
		pas de caractères spéciaux, 
		pas d'espace 
		pas de noms réservés
		sensible à la casse
1ere lettre en majuscule à partir du 2e mot */

//////////////////////////////////
/*** Initialiser une variable ***/

let monAge; // La variable doit être déclarée avant d'être utilisée
monAge = 29;
// ou plus rapide
let prenom = "Pierre"; // = est un opérateur d'affectation
prenom = "Mathilde"; // on modifie la valeur stockée dans la variable

const nom = "Smith"; // une constante ne pourra pas être modifiée
//////////////////////////////////

////////////////////////////////
/*** les 7 types de valeurs ***/

/* String ou « chaine de caractères » */
let presentationG = "Je m'appelle Pierre"; // avec guillemets
let presentationA = "Je m'appelle Pierre"; // avec apostrophes
// On utilise un antislash \ pour annuler (échapper) l'apostrophe

let ageString = "29";
/* dans ce cas, 29 n'est pas un nombre mais une chaine de caractère */

/* Number ou « nombre » */
let ageNb = 29;
let nbDecimal = 3.14;
// pour les nombres positifs, négatifs, entiers et décimaux

/* Boolean ou « booléen » */
let faux = false; // valeur false si le test n'est pas validé
let resultat = 8 > 4; // valeur true si le test est validé
// valeurs falsy: false, null, undefined, 0, NaN, ""
Boolean(falsy_value); //return false
Boolean(true_value); //return true

/* Null ou « nul / vide » et Undefined ou « indéfini » */
let vide = null; // absence de valeur, type object (erreur connue)
let noloso; // il y a une valeur mais elle est encore indéfinie

/* Object ou « objet » et Symbol ou « symbole » --> plus tard */

/* document.getElementById("ptype").innerHTML = "Type de prenom : " + typeof prenom + ";<br>Type de ageString : " + typeof ageString + ";<br>Type de ageNb : " + typeof ageNb + "<br>Type de resultat : " + typeof resultat + ";<br>Type de vide : " + typeof vide + ";<br>Type de noloso : " + typeof noloso; */
// "<br>" permet d'aller à la ligne (comme \n), + permet la concaténation
////////////////////////////////

//////////////////////////////////
/*** Opérations arithmétiques ***/

let x = 2;
let y = 3;
let z = 4;
// On peut le faire en une ligne: let x=2, y=3, z=4;

let a = x + 1; // addition: a stocke 3
let s = x - y; // soustraction: s stocke -1
let m = x * y; // multiplication: m stocke 6
let d = x / y; // division: d stocke 2/3
let r = 5 % 3; // modulo: reste de la division euclidienne r stocke 2
let e = x ** 3; // exposant: e stocke  8
// utilisation de ( ) pour la priorité des calculs

/* Opérateurs d'affectation */
x += 3; // correspond à x = x + 3; x stocke 5
x -= 1; // x = x - 1; x stocke 4
y *= x; // y = y * x; y stocke 12
y /= z; // y = y / z; y stocke 3
x %= y; // x = x % y; x stocke 1
//////////////////////////////////

////////////////////////
/*** Concaténations ***/

let concString = "un" + 2 + 4; // stocke un24
let concAdd = 2 + 4 + "un"; // stocke 6un
/* nombre d'abord: le + fait une addition
 * string d'abord: le + fait une concaténation */

/* Affichage avec concaténation, en utilisant les guillements " */
console.log(
	"concString contient " + concString + "\net concAdd contient " + concAdd
);

/* Affichage sans concaténation, en utilisant les backticks ` et ${} */
console.log(`concString contient ${concString} 
et concAdd contient ${concAdd}`); // retour à la ligne conservé comme <pre>
////////////////////////

/***************************************/
/***** LES STRUCTURES DE CONTROLE  *****/
/***************************************/

///////////////////////////////////
/*** Opérateurs de comparaison ***/

ageNb == ageString; // vrai car les valeurs 4 et "4" sont égales
ageNb === ageString; // faux car les valeurs sont égales mais pas les types
ageNb != ageString; // faux, seules les valeurs sont comparées
ageNb !== ageString; // vrai, valeures égales mais types différents

let comp = ageString == 29; // comp contient true
comp = ageString === 29; // comp contient false (string !== number)
let test = comp == false; // test contient true
/* C'est d'abord la comparaison qui se fait et ensuite l'affectation
 * ceci peut-être changé avec des parenthèses */

// Les valeurs false: false en booléen, 0, "" chaine de caractère vide, null, undefined, NaN (Not a Number)
///////////////////////////////////

/////////////////////////
/*** La condition if ***/

/* La condition dans le if doit être vraie pour être exécutée */
if (ageNb == 29) {
	// la condition est true, le code sera exécuté
	console.log("Vous avez 29 ans");
}
if (ageNb) {
	// ageNb est différent de 0, la condition est true
	console.log("Bravo vous êtes vivant");
}
if (ageString === 29) {
	// la condition est false, rien n'est exécuté
	console.log("Vous avez vingt-neuf ans");
}
if ((ageString === 29) == false) {
	// false == false est true
	console.log("Bravo");
}

/* if...else */
if (ageString === ageNb) {
	console.log("Les variables ont la même valeur et le même type");
} else {
	console.log("Les variables n'ont pas la même valeur et le même type");
}

/* if...else if...else */
if (ageString === ageNb) {
	console.log("Les variables ont la même valeur et le même type");
} else if (ageString == ageNb) {
	console.log("Les variables ont la même valeur mais pas le même type");
} else {
	console.log("Les variable sont différentes en valeur et en type");
}
// dès qu'un test est true, les tests suivants seront ignorés
/////////////////////////

/////////////////////////////
/*** Opérateurs logiques ***/

/* AND: && Toutes les comparaisons doivent être vraies
 * OR: || Au moins l'une des comparaisons doit être vraie
 * NO: ! Inverse la valeur du booléen */
ageNb > 18 && ageNb < 64; // est true
!(ageNb < 18) || ageNb > 64; // est true
!(ageNb < 18) && !(ageNb > 64); // est true

/* Précédence, ordre de priorité */
/*
(_) >> _++ _-- >> !_ ++_ --_ >> _**_ _*_ _/_ _%_ >> _+_ _-_ >>
_<_ _<=_ _>_ _>=_ >> _==_ _!=_ _===_ _!==_ >> && >> || >>
_?_:_ >> _=_ _+=_ _-=_ etc
*/
/////////////////////////////

////////////////////////////
/*** Opérateur ternaire ***/

/* test ? code à exécuter si true : code à exécuter si false */
/* if ? then : else; */
ageNb == 29 ? console.log("29 ans") : console.log("pas 29 ans");
// ou encore plus rapide:
console.log(ageNb == 29 ? "Vous avez 29 ans" : "Vous n'avez pas 29 ans");
////////////////////////////

////////////////
/*** Switch ***/

switch (ageNb) {
	case 27:
		console.log("27 ans");
		break;
	case 28:
		console.log("28 ans");
		break;
	case 29:
		console.log("29 ans");
		break;
	case 30:
		console.log("30 ans");
		break;
	default:
		console.log("Il n'a pas entre 27 et 30 ans");
}
////////////////

/////////////////////////////////
/*** Boucle while (tant que) ***/

let w = 0;
while (w < 3) {
	// condition de sortie de la boucle
	console.log("xw vaut " + w + " au passage n° " + (w + 1));
	w++; // on incrément à la fin
}

/* do...while (fait... tant que) */
let dw = 0;
do {
	console.log("dw vaut " + dw + " au passage n° " + (dw + 1));
	dw++;
} while (dw < 3);
// si la condition n'est pas réalisée au départ, le code s'exécutera au moins une fois
/////////////////////////////////

////////////////////
/*** Boucle for ***/

for (let f = 0; f < 3; f++) {
	// initialisation, test, incrémentation
	console.log("f vaut " + f + " au passage n° " + (f + 1));
}

/* Instruction continue pour sauter des itérations */
for (let c = 0; c < 4; c++) {
	if (c % 2 != 0) {
		continue;
	} // si c est impair, on saute la valeur
	console.log("c vaut " + c + " au passage n° " + (c + 1));
}

/* break pour sortir de la boucle */
for (let b = 0; b < 10; b++) {
	if (b == 3) {
		break;
	} // si b vaut 3 la boucle s'arrête
	console.log("b vaut " + b + " au passage n° " + (b + 1));
}
////////////////////

/*************************/
/***** LES FONCTIONS *****/
/*************************/

//////////////////////////////////////////
/*** Fonctions prédéfinies = méthodes ***/
console.log(Math.random()); // affiche un nb décimal aléatoire entre 0 et 1

let message = "Bonjour, ça va ?";
console.log(message);
message = message.replace("jour", "soir"); // remplace un string
console.log(message);

//////////////////////////////////////////

//////////////////////////////////
/*** fonctions personnalisées ***/

// multiplication
function multiplication(nb1, nb2) {
	// avec des paramètres
	return nb1 + " x " + nb2 + " = " + nb1 * nb2; // valeur de retour
} // l'instruction return marque la fin de la fonction
console.log(multiplication(5, 10));

/* les variables définies à l'intérieur d'une foncton sont locales et inaccessibles à l'extérieur de la fonction (en global)
 * let ne pourra être utilisé qu'à l'intérieur d'un bloc dans une fonction
 * var pourra être utilisé dans tous les blocs d'une même fonction */
//////////////////////////////////

///////////////////////////
/*** Fonction anonymes ***/

/* Appel avec une variable */
let fctAn = function () {
	// pas de nom de fonction
	console.log("Ceci est une fonction anonyme dans une variable");
};
fctAn();

/* Auto-invocation */
(function () {
	console.log("Ceci est une fonction anonyme auto-invoquée");
})();
// une fonction nommée peut aussi s'auto-invoquer

/* par le gestionnaire d'évènement */
document.getElementById("foncAno").addEventListener("click", function () {
	alert("Une fonction anonyme est cachée ici");
});
// Quand on clique sur l'élément html foncAno, cela exécute la f° anonyme.
///////////////////////////

//////////////////////////////
/*** Fonctions récursives ***/

function decompte(t) {
	if (t > 0) {
		console.log(t);
		return decompte(t - 1); // on appelle la f° à l'intérieur de la f°
	} else {
		console.log(t);
		return t;
	}
}
decompte(3);
//////////////////////////////

/*************************/
/***** ORIENTE OBJET *****/
/*************************/

/*
let variable-objet = {
	propriété_1 : [valeur tableau],
	propriété_2: valeur-nombre,
	propriété_3: "valeur-string",
}
Quand l'objet correspond à une fonction, on appelle ça une méthode.
Reconnaitre un objet: Objet(), 1ere lettre en majuscule
Utiliser une propriété: objet.propriété
Utiliser une méthode: objet.méthode(paramètre)
Le paramètre peut être lui-même une fonction correspondant à un objet */

////////////////////////
/*** Objet littéral ***/

let utilisateur = {
	nom: ["Pierre", "Giraud"],
	//La valeur de la propriété "nom" est un tableau
	age: 29, // un couple nom: valeur est appelé membre
	mail: "pierre.giraud@edhec.com",
	bonjour: function () {
		//Bonjour est une méthode de l'objet utilisateur
		console.log(
			"Bonjour, je suis " + this.nom[0] + ", j'ai " + this.age + " ans"
		);
	},
};
// l'objet créé est composé de 4 membres: 3 propriétés et 1 méthode
console.log(typeof utilisateur); // affiche "object"

/* accès avec un . */
utilisateur.bonjour(); //Bonjour, je suis Pierre, j'ai 29 ans
utilisateur.age = 30; // modification de la valeur d'une propriété
utilisateur.taille = 170; // ajout d'une nouvelle propriété taille

/* accès avec [] */
console.log(utilisateur["mail"]); // ou .mail
console.log(utilisateur["nom"][0]); // ou .nom[0] 1ere valeur du tableau
utilisateur.nom[0] = "Sophie";
console.log(utilisateur["nom"]); // ou .nom

/* Opérateur nullish quand une propriété n'existe pas */
// expression à tester ?? valeur de substitution
utilisateur.adresse ?? "n'existe pas";
////////////////////////

///////////////////////////////
/*** Constructeur d'objet  ***/

function User(n, a, m) {
	this.nom = n;
	this.age = a;
	this.mail = m;
	this.bonjour = function () {
		console.log(
			"Bonjour, je suis " + this.nom[0] + ", j'ai " + this.age + " ans"
		);
	};
}
// this correspond au nom de l'objet que l'on va créer avec ce constructeur

let pierre = new User(["Pierre", "Giraud"], 29, "pierre.giraud@edhec.com");
pierre.bonjour();
document.getElementById("pUser").innerHTML = "Nom complet : " + pierre.nom;

pierre.taille = 170; // ajout d'une nouvelle propriété avec sa valeur (membre)
///////////////////////////////

///////////////////
/*** Prototype ***/

/*
Lorsqu’on créé une fonction, le JavaScript va automatiquement lui ajouter une propriété prototype qui ne va être utile que lorsque la fonction est utilisée comme constructeur, c’est-à-dire lorsqu’on l’utilise avec la syntaxe new. 
Si on peut construire un nouvelle objet à partir d'une fonction, c'est grâce à l'objet constructor de la fonction.


function Constructeur(x, y){
	this.propriété_1 = x;
	this.propriété_2 = y;
	this.prototype{
		constructor{};
		__proto__{}; }
}
Constructeur.prototype.propriété_3 = valeur_z
On va pouvoir ajouter des propriétés à la propriété prototype qui seront partagés par tous les objets créés à partir du constructeur.

Cela permet l’héritage en orienté objet JavaScript.
On dit qu’un objet « hérite » des membres d’un autre objet lorsqu’il peut accéder à ces membres définis dans l’autre objet.

ObjetCréé {
	propriété_1: valeur_x
	propriété_2: valeur_y
	__proto__: 
}
Les valeurs de la propriété prototype sont aussi des objets
La propriété __proto__ de l’objet créé va être égale à la propriété __proto__ du constructeur qui a servi à créer l’objet.

ObjetCréé va pouvoir accéder et se partager les membres définis dans le prototype du constructeur.

Exemple: */
function Utilisateur(n, a, m) {
	this.nom = n;
	this.age = a;
	this.mail = m;
}
// on ajoute une méthode bonjour à la propriété prototype du constructeur Utilisateur
Utilisateur.prototype.bonjour = function () {
	console.log(
		"Bonjour, je suis " + this.nom[0] + ", j'ai " + this.age + " ans"
	);
};
// on créé un objet sophie en utilisant le constructeur
let sophie = new Utilisateur(
	["Sophie", "Truchet"],
	32,
	"sophie.truchet@gmail.com"
);
// l'objet sophie a alors accès à la méthode bonjour
sophie.bonjour(); // pas besoin d'utiliser sophie.prototype.bonjour()
console.log(sophie);
console.log(Utilisateur);

/* Il faut généralement définir les propriétés des objets au sein du constructeur et les méthodes dans le prototype du constructeur. */

/*  lorsqu’on essaie d’accéder à un membre d’un objet, le membre en question sera d’abord cherché dans l’objet puis dans sa propriété __proto__, puis dans la propriété __proto__ de son constructeur, etc. jusqu’à remonter au constructeur Object(). */

function Ligne(longueur) {
	this.longueur = longueur;
}
Ligne.prototype.taille = function () {
	//on créé une méthode dans le prototype
	console.log("Longueur : " + this.longueur);
};

function Rectangle(longueur, largeur) {
	Ligne.call(this, longueur); // on importe la longueur de Ligne
	this.largeur = largeur;
}
Rectangle.prototype = Object.create(Ligne.prototype);
// on importe le prototype de Ligne (dans lequel est la méthode taille) dans Rectangle, ce qui aura pour effet d'importer aussi le constructor de Ligne dans Rectangle, il faut donc le recréer:
Rectangle.prototype.constructor = Rectangle;
Rectangle.prototype.aire = function () {
	console.log("Aire : " + this.longueur * this.largeur);
};

function Parallelepipede(longueur, largeur, hauteur) {
	Rectangle.call(this, longueur, largeur);
	this.hauteur = hauteur;
}
Parallelepipede.prototype = Object.create(Rectangle.prototype);
Parallelepipede.prototype.constructor = Parallelepipede;
Parallelepipede.prototype.volume = function () {
	console.log("Volume : " + this.longueur * this.largeur * this.hauteur);
};

// Le constructeur Parallelepipede possède ainsi 3 propriétés (longueur, largeur, hauteur) dans son objet et 3 méthodes (taille, aire, volume) dans son prototype
let geo = new Parallelepipede(5, 4, 3);
geo.volume();
geo.aire();
geo.taille();
///////////////////

/////////////////////
/*** Les classes ***/

class LigneC {
	constructor(nom, longueur) {
		this.nom = nom;
		this.longueur = longueur;
	}
	taille() {
		console.log("Longueur de  " + this.nom + " : " + this.longueur);
	}
}

let geo1 = new Ligne("geo1", 10);
geo1.taille();

class RectangleC extends LigneC {
	// on étend le constructeur Ligne
	constructor(nom, longueur, largeur) {
		super(nom, longueur); //Appelle le constructeur parent
		this.largeur = largeur;
	}
	aire() {
		console.log("Aire de " + this.nom + ": " + this.longueur * this.largeur);
	}
}

let geo3 = new RectangleC("geo3", 7, 5);
geo3.aire();
geo3.taille();
/////////////////////

/*****************************/
/***** OBJETS PRÉDÉFINIS *****/
/*****************************/

// Valeur primitive: n'est pas un objet et ne peut pas être modifiée
let messP = "Bonjour"; // contient une valeur primitive
let messO = new String("Bonjour"); // contient un objet
messO.length; // on peut utiliser les propriétés du constructeur String
messP.length; // possible car JavaScript s'adapte pour en faire un objet relatif

////////////////
/*** STRING ***/

let str = "Chaîne de caractère"; // C correspond à la pos°0
str.length; // les espaces comptes /!\certains caractères spéciaux
str.includes("Chaîne"); //true, "Chaîne" est-il inclus dans str ?
str.includes("chaine"); //false, la casse compte
str.startsWith("Cha"); //true, str commence-t-il avec Cha ?
str.endsWith("tère"); //true, str finit-il avec tère ?
str.substring(7, 9); //de, affiche de la pos°7 jusqu'à pos°9 non inclus
str.indexOf("a"); //3, retourne la pos° du 1er a
str.charAt(2); //a, retourne le caractère présent à la position indiquée
str.lastIndexOf("a"); //14, retourne la pos° du dernier a
str.slice(7, 9); //de, créé un nouveau string à partir de l'ancien de pos° 7 jusqu'à 9
str.replace("ca", "Ca"); // remplace une chaine par une autre
str.toLowerCase(); // retourne le texte en minuscule
str.toUpperCase(); // en majuscule
str.trim(); // supprime les espaces en début et fin de chaine
////////////////

////////////////
/*** NUMBER ***/

Number.MIN_VALUE; // plus petite valeur numérique positive possible
Number.MAX_VALUE; // plus grande valeur numérique positive possible
Number.MIN_SAFE_INTEGER; // plus petit entier sûr en JS
Number.MAX_SAFE_INTEGER; // plus grand entier sûr en JS
Number.NEGATIVE_INFINITY; // -Infinity
Number.POSITIVE_INFINITY; // Infinity
Number.NaN; // valeur qui n'est pas un nombre

Number.isFinite(10); //false, le nb est-il fini ?
Number.isFinite(Number.POSITIVE_INFINITY); //false
Number.isInteger(10.5); //false, est-ce un entier ?
Number.isNaN(10); //false, est-ce la valeur NaN ?
Number.isSafeInteger(10000000000000000); //false, un entier sûr ?
Number.parseFloat("29.5 C 30"); //29.5, extrait les nbs existant avant un texte
Number.parseInt("FF", 16); //255, convertit un nb (ici en base 16) en base 10

let nbr = 3141.59;
nbr.toFixed(1); //3141.6 indique le nb de décimales conservées et arrondi
nbr.toPrecision(2); //3.1e+3 (3,1x10^3) affiche la valeur avec le nb de chiffres spécifié
let nbff = 255;
nbff.toString(16); //ff, converti un number en string avec la base spécifiée
////////////////

//////////////
/*** MATH ***/

Math.E; // nb d'Euler (2.718)
Math.LN2; // logarithme népérien de 2 (rappel ln(e)=1)
Math.LN10; // logarithme népérien de 10
Math.LOG2E; // logarithme décimal de e en base 2
Math.LOG10E; // logarithme décimal de e en base 10 (rappel: log10(10)=1)
Math.PI; // valeur de pi
Math.SQRT1_2; // racine carrée de 1/2
Math.SQRT2; // racine carrée de 2

Math.floor(2.13); //2, arrondi à l'entier inférieur
Math.ceil(2.13); //3, arrondi à l'entier supérieur
Math.round(2.13); //2, arrondi à l'entier le plus proche
Math.trunc(2.13); //2, garde seulement la partie entière
Math.random(); // génère un nombre décimal aléatoire entre [0;1[

/* Pour avoir un nb aléatoire entre 0 et 100 */
Math.round(Math.random() * 100);

Math.min(14, 7.2, 25); // 7.2, renvoie le plus petit nb
Math.max(14, 7.2, 25); // 25, renvoie le plus grand nb
Math.abs(-4); // 4, renvoie la valeur absolue
Math.abs("Bonjour"); // NaN
Math.cos(Math.PI); // -1, renvoie le cosinus de pi
Math.sin(Math.PI / 2); // tan(), acos(), asin(), atan()
Math.exp(1); // 2.718..., renvoie e^1
Math.log(1); // 0, renvoie ln(1) ou log base e
//////////////

////////////////////////
/*** Tableaux ARRAY ***/

// Rq: si une pos° du tableau est négative, on commence à compter par la fin

let produits = ["livre", 20, ["magnets", 100]];
produits[0]; //livre
produits[2][1]; //100

// Pour copier un tableau
const copyProduits = Array.from(produits);

/* for...of pour parcourir les valeurs d'un tableau */
for (let valeur of produits) {
	console.log(valeur);
}

/* for...in pour parcourir les valeurs des propriétés d'un objet (équivalent d'un tableau associatif) */
let objpierre = {
	prenom: "Pierre",
	age: 29,
	cours: ["HTML", " CSS", " JavaScript"],
};
for (let propriete in objpierre) {
	console.log(objpierre[propriete]);
}

/* Propriétés et méthodes */

produits.length; //5, renvoie la longueur d'un tableau
produits.push("sac"); //4, ajoute en fin de tableau et retourne la taille
produits.pop(); //3, suppr la dernière valeur du tableau et retourne la taille
produits.shift(); //livre, suppr la 1ere valeur et retourne l'élément supprimé
produits.unshift("livre"); //3, ajoute un élément en début de tableau et retourne la taille
produits.splice(2, 0, "sac"); //[], à la pos°2, suppr 0 élément, ajoute "sac" et retourne le tableau des éléments supprimés
produits.join("/"); //livre/20/sac/magnets,100 virgule par défaut
produits.slice(1, 3); //["20","sac"], créé un tableau de [pos°1 à pos°3[
produits.concat(["ordinateur", 5], ["gourde"]); // fusionne des tableaux au 1er
produits.includes(20); //true, vérifie si le tableau contient une valeur

// SORT pour ordonner un tableau
tableau.sort(function (a, b) {
	return a.propriete - b.propriete;
	// si >0 b passe devant, si <0 a passe devant
});

// FILTRE pour filtrer les éléments d'un tableau
const tableauFiltre = tableau.filter(function (a) {
	return a.propriete <= 35;
});
// si <35 va dans le tableau filtré

// MAP pour récupérer les valeurs d'un tableau
map(function (a) {
	return a.propriete;
});
// crée la liste des valeurs d'une propriété
//fontion raccourcie lambda
tableau.map((a) => a.propriete);

////////////////////////

//////////////
/*** DATE ***/

Date(); //Fri Dec 22 2023 13:08:23 GMT+0100 (heure normale d’Europe centrale)
Date.now(); //1703246949000, nb de ms écoulées depuis le 1er janvier 1970

let datemtn = new Date(); // date actuelle complète
/* on créé la même date de 3 façons différentes */
let dateWTClit = new Date("September 11, 2001 11:20:01");
let dateWTCnb = new Date(1000200001000); // timestamp unix x 1000
let dateWTC = new Date(2001, 8, 11, 11, 20, 1); // année,mois-1,jour,h,m,s,ms

/* GETTERS pour obtenir qqchose d'une date */
dateWTC.getDay(); // n° du jour de la semaine (0:dim, 1:lun, 6:sam)
dateWTC.getDate(); // n° du jour du mois
dateWTC.getMonth(); //n° du mois (0:jan, 1:fev, 11:dec)
dateWTC.getFullYear(); // année
dateWTC.getHours();
dateWTC.getMinutes();
dateWTC.getSeconds();
dateWTC.getMilliseconds(); // h, m, s, ms

dateWTC.getUTCDay(); // pareil, mais selon l'heure UTC. même chose pour les autres

/* SETTERS pour définir des composants de dates */
dateWTC.setDate(11);
dateWTC.setMonth(8);
dateWTC.setFullYear(2001);
dateWTC.setHours(11);
dateWTC.setMinutes(20);
dateWTC.setSeconds(1); //dateWTC.setMilliseconds();
/* dateWTC.setUTCDate(11);//...*/

/* Format local */
dateWTClit.toLocaleDateString("fr-FR", {}); // renvoie jour-mois-année
dateWTClit.toLocaleTimeString("fr-FR", {}); // renvoie heures-minutes-secondes

/* Méthode complète */
let dateWTCLocale = dateWTClit.toLocaleString("fr-FR", {
	weekday: "long", //Mardi, short:Mar., narrow:M
	year: "numeric", //2001, 2-digit:01
	month: "long", //septembre, numeric:09
	day: "numeric",
	hour: "numeric",
	minute: "numeric",
	second: "numeric",
});
//////////////

/*************************************/
/***** BOM: Browser Object Model *****/
/*************************************/

/* API: Application Programming Interface
C'est une interface qui va fonctionner en définissant des objets qui vont nous fournir des propriétés et des méthodes ce qui permettra d'utiliser les commandes complexes d'un logiciel. 
Le BOM est composé de plusieurs API intégrées aux navigateurs web */

//////////////////////
/*** Objet WINDOW ***/

window.outerWidth, window.outerHeight;
// retourne la largeur et la hauteur de la fenêtre du navigateur, options comprises
window.innerWidth, window.innerHeight;
// retourne la largeur et la hauteur de la partie visible de la fenêtre de navigation

/* window.open */
let bopen = document.getElementById("bopen");

bopen.addEventListener("click", function () {
	fenetre = window.open(
		"https://www.codepen.io",
		"CodePen",
		"width=500, height=500"
	);
});
// quand on clique sur l'élément avec l'id "bopen", la fonction qui permet d'ouvrir une fenêtre (que l'on stocke dans la variable fenetre) nommée "CodePen" s'exécutera

/* resizeBy() */
bopen.addEventListener("click", function () {
	fenetre.resizeBy(200, 100);
});
// on augmente la largeur de 200 et la hauteur de 100

/* resizeTo() */
bopen.addEventListener("click", function () {
	fenetre.resizeTo(800, 600);
});
// on définit une nouvelle taille de fenêtre

/* moveBy() */
bopen.addEventListener("click", function () {
	fenetre.moveBy(100, 100);
});
// déplace la fenêtre de 100px par rapport au bord gauche et 100px par rapport à sa position de départ

/* moveTo() */
bopen.addEventListener("click", function () {
	fenetre.moveTo(0, 0);
});
// déplace la fenêtre de manière absolue par rapport au bord gauche et supérieur de l'espace de travail

/* scrollBy() */
bopen.addEventListener("click", function () {
	fenetre.scrollBy(0, 200);
});
// fait défiler la fenêtre de 200px par rapport au bord sup

/* scrollTo() */
bopen.addEventListener("click", function () {
	fenetre.scrollTo(0, 0);
});
// remonte en haut de la page

/* close() */
bopen.addEventListener("click", function () {
	fenetre.close();
});
// ferme la fenêtre

/* confirm(), alert() et prompt() */

document.getElementById("confirm").addEventListener("click", boitedialogue);
// il ne faut pas mettre de parenthèse après boitedialogue, sinon la fonction est exécutée à l'ouverture de la page

function boitedialogue() {
	if (confirm("Allez sur internet ?")) {
		// boite de message avec bouton "OK" (true) et "Annuler" (false)
		window.alert("Vous avez cliqué sur OK");
		// window. n'est pas obligatoire
	} else {
		prompt("Pourquoi ?");
	} // l'utilisateur peut envoyer du texte
}
//////////////////////

//////////////////////////////////////
/*** NAVIGATOR et géolocalisation ***/

navigator.language; //fr-FR, langue du navigateur
navigator.cookieEnabled; //true, les cookies sont-ils autorisés
navigator.platform; //Win32, OS utilisé

document.getElementById("crd").addEventListener("click", geoloc);
function geoloc() {
	navigator.geolocation.getCurrentPosition(coordonnees);
}
function coordonnees(pos) {
	// f° qui correspond à l'objet Position()
	let latitude = pos.coords.latitude; // on peut utiliser les propriétés
	let longitude = pos.coords.longitude; //de l'objet Position()
	// la propriété coords renvoie à l'objet Coordinates() qui a les propriétés latitude et longitude
	console.log("Latitude : " + latitude.toFixed(2));
	console.log("Longitude : " + longitude.toFixed(2));
}
/* On utilise la méthode getCurrentPOsition() de l'objet Geolocation qui est lui-même une propriété de l'objet Navigator()
Les paramètres -coordonnees- font appel à une fonction correspondant à l' objet Position() retourné par la méthode getCurrentPosition.
Quand il s'agit de propriétés ou de méthodes qui ne renvoient pas à une fonction, on peut enchainer les . :
pos.coord.latitude
document.getElementById("confirm").addEventListener("click", boitedialogue)
Quand il s'agit d'une méthode qui renvoie à une fonction, on ne le peut pas et il faudra se référé à une fonction:
getCurrentPosition(fct).coords impossible
*/
//////////////////////////////////////

/////////////////
/*** HISTORY ***/

history.length; // retourne le nb d'éléments dans l'historique
history.go(-2); // on charge la page à la pos° -2 de l'historique
history.back(); // correspond à go(-1)
history.forward(); // correspond à go(1)
/////////////////

//////////////////////////////////////////
/*** LOCATION localisation d'une page ***/

location.href; // retourne l'url complète
location.origin; //retourne le nom de l'hôte (hostname), le port (port) et le protocole de l'url (protocole)

/*location.assign(); // va charger une url
location.reload(); // recharge le document actuel
location.replace(); // remplace la page actuelle par une autre*/
//////////////////////////////////////////

////////////////
/*** SCREEN ***/

screen.width; // retourne la largeur totale de l'écran
screen.availWidth; // largeur sans la barre des tâches
screen.height; // hauteur totale de l'écran
screen.availHeight; // hauteur sans la barre des tâches
screen.colorDepth; // profondeur de la palette de couleurs en bits
screen.pixelDepth; // résolution en bits par pixel
////////////////

/********************/
/***** DOM HTML *****/
/********************/

////////////////////////////
/*** Accès aux éléments ***/

/* par le sélecteur CSS */

// /!\ querySelector ne cible que le 1er élément concerné
document.querySelector("p").textContent = "1er p du doc";
//sélectionne le 1er sélecteur CSS "p" du document et remplace le texte
document.querySelector("div").querySelector("p").textContent +=
	" (1er p du 1er div)"; // on ajoute du texte (+=) au 1er p du 1er div
document.querySelector("button#confirm").style.color = "blue";
// on cible le button avec un id "confirm"
document.querySelector("p.dom").style.color = "red";
// on cible le p avec une class "dom"

/* forEach */

document.querySelectorAll("span").forEach(function (elt, index) {
	elt.textContent += " (span n°: " + index + ")";
});
// la méthode forEach va passer en revue tous les éléments "span" un par un. Son argument est une fonction de rappel qui peut prendre 3 arguments optionnels:
// - L’élément en cours de traitement dans la NodeList
// - L’index de l’élément en cours de traitement dans la NodeList
// - L’objet NodeList auquel forEach() est appliqué.

/* par l'id de l'élément */

document.getElementById("confirm").style.textDecoration = "underline";
//document.querySelector("#confirm").style.textDecoration = "underline"; renvoie la même chose

/* par la class de l'élément */

for (valeur of document.getElementsByClassName("dom")) {
	valeur.style.textDecoration = "underline wavy";
}
// passe en revue tous les éléments de class "dom" et leur applique un style
/*for(valeur of document.querySelectorAll(".dom")){
	valeur.style.textDecoration = "underline wavy";}
renvoie la même chose
*/

/* par son tag name */

document.getElementsByTagName("p");

/* par son attribut name (formulaires) */

document.getElementsByName("email");

/* par des propriétés */

//body, head, links, title, url, scripts, cookie
document.body.style.backgroundColor = "lightcyan";
document.title = "Tout JavaScript"; // change le titre de l'onglet

/* avec l'interface Element */

document.querySelector("p.dom").innerHTML += "<button>innerHTML</button>";
// ajout (+=) du contenu interne dans l'elt html p.dom
document.querySelector("#fin").outerHTML = "<h3>outerHTML</h3>";
// remplacement (=) complet (balises incluses) de l'elt html p id "fin" avec tout son contenu
document.getElementById("dom1").textContent += " + textContent";
// ajout de texte dans le contenu de l'élément id "dom1"
document.getElementById("dom1").textContent; // texte complet (visible ou non)
document.getElementById("dom1").innerText; // texte visible seulement

/* Cas des formulaires */

// pour une checkbox:
document.getElementById("idCheckbox").checked; //renvoie true ou false si la case est cochée ou pas
// pour un bouton radio:
let inputRadioList = document.querySelectorAll("input[name='nameRadio']");
let valeurRadio = "";
for (let i = 0; i < inputRadioList.length; i++) {
	if (inputRadioList[i].checked) {
		// on cherche le radio qui est sélectionné
		valeurRadio = inputRadioList[i].value;
		break;
	}
}
// console.log(valeurRadio); affiche la valeur du radio coché
////////////////////////////

////////////////////
/*** Les noeuds ***/

/*
elt.parentNode cible le parent du noeud spécifié quel que soit son type
elt.parentElement ne cible que un parent elt html (null s'il n'existe pas)
elt.childNodes répertorie tous les enfants quels que soient leurs types
elt.children ne répertorie que les enfants qui sont des éléments html*/
// Quand on utilise une propriété ou méthode de l'interface Node, il faut obligatoirement se placer sur un noeud au préalable.

let pspan = document.getElementById("pspan");
let divnoeud = document.getElementById("noeud");
pspan.parentNode.style.backgroundColor = "rgba(240,160,000,0.5)";
// le noeud parent de p id "pspan" (qui est le div ".noeud") change de backgroundColor
/*pspan.childNodes[0].style.color = "orange"; ne marche pas car en pos° 0 du childNode il y a un texte qui n'est pas un élément stylisable*/
divnoeud.childNodes[1].style.color = "red";
// le childNodes[1] de divnoeud correspond au h2 enfant du div
divnoeud.children[0].style.textDecoration = "underline";
// children ne passe en revue que les enfants qui sont des éléments. La pos° 0 correspond donc au même h2 qu'au-dessus

document.body.firstChild; // cible le 1er noeud enfant direct de body
document.body.lastChild; // cible le dernier noeud enfant direct
document.body.firstElementChild; // cible le 1er noeud enfant élément
document.body.lastElementChild; // cible le dernier noeud enfant élément

pspan.previousSibling; // cible le précédent noeud de même niveau du DOM
pspan.nextSibling; // le noeud prochain de même niveau dans le DOM
pspan.previousElementSibling; // le précédent noeud élément
pspan.nextElementSibling; // le prochain noeud élément

pspan.nodeName; //P, cible le nom du noeud : nom de la balise ou #text
pspan.nodeValue; // cible la valeur du noeud (le texte qu'il contient)
pspan.nodeType; //1, renvoie un entier représentant le type de noeud
////////////////////

/////////////////////////////////////////////////////////
/*** CREER MODIFIER OU SUPPRIMER DES ELEMENTS DU DOM ***/

/* Création */

let newP = document.createElement("p"); // création d'un noeud élément
newP.textContent = "p créé avec createElement";

let newTexte = document.createTextNode("noeud de texte créé");
// création d'un noeud texte

document.body.prepend(newP); // on insert avant le 1er enfant de body
document.body.prepend(newP, "p créé avec prepend"); //écriture raccourcie, pareil avec append
document.body.append(newTexte); // on insert après le dernier enfant un ou plusieurs noeuds ou textes
document.body.appendChild(newTexte); // ne peut ajouter qu'un noeud à la fois et retourne l'objet ajouté, ne peut pas ajouter directement du texte
document.body.insertBefore(newP, document.getElementById("dom1"));
//insert le noeud newP avant l'enfant de body spécifié

/* Insertion */

pspan.insertAdjacentElement("afterend", newP); // insert newP après pspan
pspan.insertAdjacentHTML(
	"beforeend",
	"<strong> insertAdjacentElement</strong>"
); // insert du code html avant la balise fermante de pspan
pspan.insertAdjacentText("afterbegin", "Yo "); // insert Yo après la balise ouvrante de pspan
pspan.insertAdjacentText("beforebegin", "BB "); // insert BB avant la balise ouvrante de pspan

/* Interpolation */

let contenuTitre = "Azertype";
let contenuParagraphe = "L'application pour apprendre à taper plus vite !";

let div = ` 
    <div>
        <h1>${contenuTitre}</h1>
        <p>${contenuParagraphe}</p>
    </div>
    `; // on écrit l'arborescence entre backticks
document.getElementById("interpolation").innerHTML = div;
// on insert div dans le .interpolation

/* Déplacement */

document.body.insertBefore(pspan, document.body.lastElementChild);
// déplace pspan avant le dernier élément enfant de body
// on peut aussi le faire avec appendChild()

let clonespan = pspan.cloneNode(true); //true pour cloner les enfants avec
document.getElementById("divdp").insertAdjacentElement("afterend", clonespan); //insert le clone après la balise fermante de divdp

divnoeud.replaceChild(newP, document.getElementById("pfin"));
// dans le noeud divnoeud, on met l'enfant newP à la place de l'enfant pfin

/* Suppression */

let eltDel = divnoeud.removeChild(divnoeud.lastElementChild);
// on se place sur le noeud divnoeud et on supprime le dernier enfant du div
let txtDel = document.body.removeChild(document.body.lastChild);
// on supprime le dernier enfant du noeud body (c'est un texte)

document.body.firstChild.remove(); //on supprime le 1er enfant du noeud body (c'est un texte)
divnoeud.childNodes[3].remove(); // on supprime le 4e enfant de divnoeud (c'est un texte)
/////////////////////////////////////////////////////////

/////////////////////////////////
/*** Manipuler les ATTRIBUTS ***/

pspan.hasAttributes(); //true, pspan possède des attributs (id)
pspan.hasAttribute("id"); //true, on précise quel attribut on recherche

for (let i = 0; i < pspan.attributes.length; i++) {
	console.log(pspan.attributes[i].name + " = " + pspan.attributes[i].value);
} //on passe en revue les différents attributs de pspan, value correspond à la valeur de l'attribut

pspan.getAttributeNames();
//[id], rnevoie le nom des attributs de pspan sous forme de tableau
pspan.getAttribute("id");
//pspan, renvoie la valeur associé au nom de l'attribut

document.querySelector("h2").setAttribute("class", "h2dom"); //ou "id"
document.querySelector("h2").id = "h2dom"; //plus rapide avec id, alt, src
// on ajoute à la 1ere balise h2 un nouvel attribut "class" = "h2dom"

document.querySelector(".h2dom").removeAttribute("class");
// on supprime la class "h2dom" de h2

document.querySelector("h2").classList.add("h2dom");
document.querySelector("h2").classList.remove("h2dom");
// on ajoute ou enleve la class "h2dom" de h2 avec classList

/* Changer le style */
document.querySelector("#dom1").style.color = "crimson";
document.querySelector("#dom1").style.backgroundColor = "cyan";
document.querySelector("#dom1").style.fontSize = "20px";
/////////////////////////////////

////////////////////
/*** ÉVÈNEMENTS ***/

/* façon obsolète */
document.querySelector("#evnmt").onclick = function () {
	alert("c'est OKKKKK");
};
document.querySelector("#evnmt").onmouseover = function () {
	this.style.backgroundColor = "orange";
};
document.querySelector("#evnmt").onmouseout = function () {
	this.style.backgroundColor = "white";
};

/* avec addEventListener */

document.querySelector("#ael").addEventListener("click", function () {
	alert("ça clique bâtard");
});
// sur un clique de l'elt p#ael un message apparait

document.querySelector("#ael").addEventListener("mouseover", function () {
	this.style.backgroundColor = "yellow";
});
// mouseover: quand le pointeur est sur l'elt

let bgc = function () {
	this.style.backgroundColor = "#ededed";
};
document.querySelector("#ael").addEventListener("mouseout", bgc);
// mouseout: quand le pointeur quitte l'elt

document.querySelector("#ael").removeEventListener("mouseout", bgc);
// on supprime un evnmt

document.addEventListener("keypress", (event) => {
	console.log(event.key);
}); // affiche toutes les touches pressées
// event.target: renvoie l’élément HTML qui a déclenché l’événement
// event.clientX et event.clientY : les coordonnées de la souris quand l’événement écouté est lié à la souris.

/* Cas des formulaires */

const inputText = document.getElementById("idText");
inputText.addEventListener("change", () => {
	//quand un changement est observé dans l'input (quand une case est cochée ou quand l'utilisateur sélectionne un autre élément de la page)
});
inputText.addEventListener("input", () => {
	//quand un changement de la valeur de l'input est observée (appuie sur une touche du clavier pour ajouter du texte par exemple)
});

// /!\ Soumission d'un formulaire
form.addEventListener("submit", (event) => {
	event.preventDefault();
}); // pour annuler le rechargement de la page et la perte des données

/* Propagation */

/* Phase de capture: l'evnmt descend l'arbre du DOM de html jusqu'à l'elt concerné
Phase de bouillonnement: l'evnmt fait le chemin inverse, de en remontant de l'elt concerné jusqu'au html.
L'ordre des évènments se fait par défaut pendant la phase de bouillonnement.
Si on désir changer cela: 
.addEventListener("evnmt", f(){}}, true);
true signifie que l'on prend en compte la phase de capture, cela changera ainsi l'ordre des évènements
*/

// on peut stopper une propagation pour qu'il n'y ait plus qu'un seul élément qui soit actif et ignorer les évènements des éléments parents. Dans notre div "evnmt" un évènement "click" sur button existe dans le fichier html (bouton cliqué) et un évènement "click" sur le div existe aussi (c'est OKKK). On va activer le premier (button) et stoppper le second (div)

bton = document.querySelector("#bton");
bton.addEventListener("click", clickAndStop);
function clickAndStop(e) {
	alert("c'est cliqué: arrêt");
	e.stopPropagation();
} // l'evnmt du div ne se déclenche plus

// on peut également empêcher qu'un evnmt soit pris en compte par le navigateur:
function testDonnees(e) {
	/*Si (if...) les données ne remplissent pas certaines conditions, renvoie un message et empêche l'action par défaut du clic = l'envoie du formulaire*/
	alert("Envoi du formulaire bloqué");
	e.preventDefault();
} //pour un formulaire mal rempli par exemple
////////////////////

/**********************************************************/
/*****  REGEXP Expressions Régulières ou Rationnelles *****/
/**********************************************************/

///////////////////////////
/*** JH cherche string ***/

// avec RegExp
let masque1bis = new RegExp("Pierre");
// avec des slashs
let chPierre = /Pierre/; //cherche le 1er "Pierre"
let chAZ = /[A-Z]/; //cherche la 1ere majuscule
let chAZg = /[A-Z]/g; //cherche toutes les majuscules (global)
let che = /e/;
let choug = /ou/g;
let chj = /j/;

let phrase = "Bonjour, je m'appelle Pierre et vous ?";

/* match() */
phrase.match(chPierre); //Pierre, cherche chPierre dans phrase et renvoie la 1ere correspondance
phrase.match(chAZ); //B, la 1ere maj. dans phrase
phrase.match(chAZg); //[B, P] toutes les maj. de phrase dans un tableau
phrase.match(chAZg)[1]; //P

/* search() */
phrase.search(chPierre); //22, position de la 1ere occurence de recherche
phrase.search(chAZ); //0, pos° de la 1ere maj. (-1 si rien n'est trouvé)

/* replace() */
phrase.replace(chPierre, "Mathilde"); // remplace le 1er "Pierre" par "Mathilde"
phrase.replace(che, "E"); //...jE..., remplace le 1er "e" par "E"
phrase.replace(choug, "OU"); //BonjOUr,...vOUs ?, remplace tous les "ou" par "OU"

/* split() */
phrase.split(chj); //["Bon", "our", "e m'appelle Pierre et vous"]
//la phrase est divisée à chaque j rencontré, renvoie un tableau

/* exec() */
chPierre.exec(phrase); //["Pierre"], cherche chPierre dans phrase et renvoie un tableau

/* test() */
chPierre.test(phrase); //true, indique s'il a trouvé chPierre dans phrase
///////////////////////////

///////////////////////////////
/*** Classes de caractères ***/

// [aJ_] : cherche a ou J ou _
let chvoyg = /[aeiouy]/g; // cherche une voyelle
let chjvoyg = /j[aeiouy]/g; // cherche un j suivi d'une voyelle
let chvoyvoyg = /[aeiouy][aeiouy]/g; // cherche 2 voyelles qui se suivent
phrase.match(chvoyg); //['o', 'o', 'u', 'e', 'a', 'e', 'e', 'i', 'e', 'e', 'e', 'o', 'u']
phrase.match(chjvoyg); //['jo', 'je']
phrase.match(chvoyvoyg); //["ou","ie","ou"]

/* metacaractères */

/* Les métacaractères ont un sens spécial à l'intérieur des classes de caractères []
^ au début: nie la séquence
- entre 2 caractères: intervalle
\/, \^, \-, \[, \] permet de chercher "/", "^", "-", "[", "]"
*/
let phrase2 = "Bonjour, je suis ^Pierre^. Mon /numéro/ est le [06-36-65-65-65]";
let masque1 = /[^aeiouy]/g; //Cherche autre chose qu'une voyelle dans la chaine
let masque2 = /[\^aeiouy]/g; //Cherche ^ ou une une voyelle dans la chaine
let masque3 = /[aei^ouy]/g; //Cherche ^ ou une une voyelle dans la chaine
let masque4 = /[a-z]o/g; //Cherche une lettre minuscule suivie d'un o
let masque5 = /[a-zA-Z]o/g; //Cherche une lettre (min ou maj) suivie d'un o
let masque6 = /[a\-z]/g; //Cherche "a", "-" ou "z"
let masque7 = /[0-9az-]/g; //Cherche un chiffre, "a", "z" ou "-"
let masque8 = /[0-9\[\]]/g; //Cherche un chiffre ou "[" ou "]"

/* Classes de caractères ABRÉGÉES ou PRÉDÉFINIES */

/*
\w pour word: [a-zA-Z0-9_]
\W anti word: [^a-zA-Z0-9_]
\d pour digit: [0-9]
\D anti digit: [^0-9]
\s pour space: [ ] (espace, retour chariot ou retour à la ligne)
\S anti space: [^ ] (tout caractère qui n'est pas un caractère blanc)
\t pour tabulation
\v pour vertical space
\n pour saut de ligne */

let masque9 = /[\da-z]/g; // cherche un chiffre ou une lettre minuscule

/* métacaractères spéciaux: n'ont un sens qu'en dehors des []

. : n'importe quel caractère sauf \n (\. ou dans [] pour chercher le .)
| : alternatives /Pierre|Mathilde/ cherche "Pierre" ou "Mathilde"
^ : cherche en début de chaine /^[A-Z]/ cherche un maj. au début
		attention: /^[^A-Z]/ cherche en début de chaine un caractère qui n'est pas une majuscule
$ : cherche en fin de chaine /\.$/ cherche un point en fin de chaine */

/* Quantificateurs {} */

/[A-Z]{3}/g; // cherche une séquence de 3 majuscules
/\d{2,4}/g; // cherche une séquence de 2 à 4 chiffres
/^[aeiouy]{3,}/; // cherche une séquence en début de chaine d'au moins 3 voyelles
/Ab?/g; //ou /Ab{0,1}/g; cherche un A suivi de 0 à 1 b
/Ab+/g; //ou /Ab{1,}/g; cherche un A suivi d'au moins 1 b
/Ab*/; //ou /Ab{0,}/; cherche un A suivi d'au moins 0 b */

/* sous-masques () */

let phrase3 = "Bonjour, je suis Pierre et mon no. est le [06-36-65-65-65]";
//avec phrase3.match(masque):
/er|t/g; //["er, "t", "t"], "er" ou "t" global
/e(r|t)/; //["er","r"], "er" ou "et" (comme les factorisations) + capture r ou t (renvoie la 1ere occurence entre parenthèse trouvée)
/Bon(jour)/; //["Bonjour","jour"], "Bonjour" + capture "jour"
/Bon(jour)/g; //["Bonjour"], "Bonjour" + capture "jour" (non car global)

/* assertions */

//avec phrase3.match(masque):
/e(?=r)/g; //["e"], cherche "e" suivi de "r"
/e(?!r)/g; //["e","e","e","e","e"], cherche "e" non suivi de "r"
/(?<=i)s/g; //["s"], cherche "s" précédé de "i"
/(?<!i)s/g; //["s","s"], cherche "s" non précédé de "i"

/* Options ou drapeaux ou marqueurs

g   Permet d’effectuer une recherche globale
i   Rend la recherche insensible à la casse
m   Permet la recherche sur chaque ligne (en cas de \n)
s   Permet au point de remplacer n'importe quel caractère même \n */

/* exemples */

// vérifier une adresse mail
function verifierMail(email) {
	emailRegexp = new RegExp("[w._-]+@[w._-]+\\.[w._-]+");
	if (emailRegexp.test(email)) {
		return true;
	}
	return false;
} // /!\ on échappe deux fois le . une fois pour la regexp et une autre fois pour le javascript
///////////////////////////////

/****************************/
/***** NOTIONS AVANCÉES *****/
/****************************/

///////////////////////////////////////////////////////////
/*** Les paramètres du reste (nb variable d'arguments) ***/

let nb1 = 1,
	nb2 = 2,
	nb3 = 3,
	nb4 = 4;
function somme(...nombres) {
	//stocke une liste d'arguments dans un tableau
	let s = 0;
	for (let nombre of nombres) {
		s += nombre;
	}
	return s;
}
somme(nb1, nb2); //3
somme(nb1, nb2, nb3, nb4); //10
///////////////////////////////////////////////////////////

////////////////////////////////////
/*** Opérateur de décomposition ***/

let tb1 = [3, 5, 1, 32];
let tb2 = [64, -5, 17];
Math.max(...tb1); //32, transforme un tableau en liste de nombres
Math.max(...tb1, ...tb2); //64, compare les 2 tableaux
////////////////////////////////////

////////////////////////////
/*** Fonctions fléchées ***/

// déclaration simple d'une fonction
function disBonjour() {
	// lu en 1er dans le javascript
	alert("Bonjour");
} // disBonjour() pour l'appeler

// avec une expression de fonction
let disBonsoir = function () {
	// lu par javascript dans l'ordre d'écriture
	alert("Bonsoir");
}; // disBonjour() pour l'appeler

// avec une expression de fonction nommée (Named Function Expression)
let disBonmatin = function bonmatin(nom) {
	if (nom) {
		alert("Bonmatin " + nom);
	} else {
		bonmatin("inconnu"); // fait référence à elle même en interne
	}
}; // disBonjour("Pierre") pour l'appeler

// Fonctions fléchées

/*Expression de fonction classique :
let addi = function(a, b) {
	return a + b;}
let double = function(n){
	return n * 2}; */

let addi = (a, b) => {
	a + b;
}; // dans ce cas les arguments ne sont pas un tableau
let double = (n) => n * 2; // double(3) renvoie 6
let disAuRevoir = () => alert("Au revoir");
////////////////////////////

///////////////////////////////////////////////////
/*** Closures (f° interne dans une f° externe) ***/

// une variable globale peut être utilisée dans une fonction mais une variable utilisée dans une fonction ne pourra pas être lue dans le contexte globale.
// De même, les fonctions internes ont accès aux variables définies dans la fonction externe mais la fonction externe n’a aucun moyen d’accéder aux variables définies dans une de ses fonctions internes

function compteur() {
	let count = 0;

	return function () {
		return count++;
	};
}
// en l'état compteur() retourne: function(){return count++;} ce qui est inutilisable. Mais on pourra l'utiliser si on la stocke dans une variable:
let plusUn = compteur();
plusUn(), plusUn(), plusUn(); //0 1 2
// la variable de la fonction parente va continuer d'exister au travers de la fonction interne
///////////////////////////////////////////////////

////////////////////////////
/*** Délai d'exécution  ***/

/* setTimeout */
function message2s() {
	delai = setTimeout(alert, 2000, "Message d'alerte après 2 secondes");
} // une boite d'alert apparait au bout de 2s
// on met "delai="" pour le clearTimeout qui vient

/* clearTimeout */
function stopDelai() {
	clearTimeout(delai);
} // annule le delai de setTimeout (dans un bouton par exemple)

/* setInterval */
function afficheHeure() {
	setInterval(function () {
		// la f° sera exécutée en boucle
		let d = new Date();
		document.getElementById("clock").innerHTML = d.toLocaleTimeString();
	}, 1000); // la f° sera exécutée toutes les secondes
}
afficheHeure();

/* clearInterval */
let dec = 0;
let sec = 0;
let min = 0;
let heu = 0;
let chrono;
function timer() {
	chrono = setInterval(function () {
		document.getElementById("chronop").textContent =
			heu + " : " + min + " : " + sec + " . " + dec;
		dec += 1;
		if (dec >= 10) {
			dec = 0;
			sec += 1;
		}
		if (sec >= 60) {
			sec = 0;
			min += 1;
		}
		if (min >= 60) {
			min = 0;
			heu += 1;
		}
	}, 100);
}
timer();
function stopTimer() {
	clearInterval(chrono);
} // arrête le chrono (dans un bouton par exemple)
////////////////////////////

///////////////////////////
/*** GESTION D'ERREURS ***/

/* try...catch */
try {
	//on met ici le code à tester
	gougnafier;
	alert("Bonjour");
} catch (err) {
	// les erreurs apparaissent ici
	console.log(err.name); // nom de l'erreur
	console.log(err.message); // description de l'erreur
	console.log(err.stack); // résumé et emplacement de l'erreur
}

/* throw (exceptions) */

function div0() {
	let x = prompt("Entrez un premier nombre (numérateur)");
	let y = prompt("Entrez un deuxième nombre (dénominateur)");

	if (isNaN(x) || isNaN(y) || x == "" || y == "") {
		throw new Error("Merci de rentrer deux nombres");
	} else if (y == 0) {
		throw new Error("Division par 0 impossible");
	} else {
		alert(x / y);
	}
}

try {
	div0();
} catch (err) {
	console.log(err.message); //on affiche le message d'erreur qui correspond
} finally {
	console.log("Ce message s'affichera quoiqu'il arrive");
}
///////////////////////////

//////////////////
/*** SYMBOLES ***/

const symbLoc = Symbol(); // identifiant unique disponible localement
const symbGlob = Symbol.for("symbGlob"); // dispo dans tous les fichiers
const clefSymbGlob = Symbol.keyFor(symbGlob);
// on récupère la clef d'un symbole

const firstName = Symbol("clef1");
const ageold = Symbol("clef2");
//On définit un nouvel objet utilisateur avec deux propriétés
let utili = {
	[firstName]: "Pierre",
	[ageold]: 29,
};
// les symboles sont utilisés comme clefs de l'objets utilisateur pour protéger les propriétés de l'écrasement
//////////////////

//////////////////////////
/*** OBJETS ITÉRABLES ***/

//String et Array sont des objets itérables, on peut parcourir leurs valeurs une à une. On pourra le faire avec des objets grâce à des protocoles itérateurs comme [Symbol.iterator].

let ficheUser = {
	prenom: "Sophie",
	nom: "Truchet",
	age: 32,
	[Symbol.iterator]() {
		//Méth. itérateur avec Symbol.iterateur comme clef
		//Renvoie un tableau contenant les valeurs des propriétés de l'objet
		let tableau = Object.values(this);
		let posprop = 0;
		return {
			next() {
				//permet de reprendre où on s'était arrêté
				if (posprop < tableau.length) {
					return {
						value: tableau[posprop++],
						done: false,
					};
				} else {
					return {
						value: undefined,
						done: true,
					};
				}
			},
		};
	},
};
for (let p of ficheUser) {
	console.log(p);
}
//////////////////////////

/////////////////////
/*** GÉNÉRATEURS ***/

function* genSeq1() {
	yield 1;
	yield 2;
	yield 3;
}
function* genSeq2() {
	yield 4;
	yield* genSeq1(); //itère tout genSeq1 avant de reprendre la suite
	yield 5;
}

let generateur = genSeq2();

let quatre = generateur.next(); //{value: 4, done: false}
let un = generateur.next(); //{value: 1, done: false}
let deux = generateur.next(); //{value: 2, done: false}
let trois = generateur.next(); //{value: 3, done: false}
let cinq = generateur.next(); //{value: 5, done: false}
let und = generateur.next(); //{value: undefined, done: true}
/////////////////////

/*******************************/
/***** STOCKAGE DE DONNÉES *****/
/*******************************/

/////////////////
/*** COOKIES ***/

/*
document.cookie = "
	user=Sophie; //au minimum
	path=/; //rend le cookie accessible sur l'ensemble du domaine
	domain=sophie-truchet.com; //précision du domaine
	max-age= 86400; //en seconde ou "expires=" + date.toUTCString();
	secure; //envoyé via https uniquement
	samesite=strict; //empêche que le cookie arrive de l'extérieur
		ou lax //autorise les cookies provenant de requêtes de type get
	httpOnly; //le cookie ne peut pas accéder au javascript
	"
POur supprimer un cookie:
document.cookie = 'user=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC';
*/
/////////////////

/////////////////////////
/*** API WEB STORAGE ***/

let targetElt = document.querySelector("#bgchange");
let bgInput = document.getElementById("bgtheme");
if (localStorage.getItem("bgtheme")) {
	//sauvegarde déjà présente ?
	updateBg();
} else {
	setBg();
}
function updateBg() {
	//on charge une sauvegarde existante
	let bg = localStorage.getItem("bgtheme");
	targetElt.style.backgroundColor = "#" + bg;
	bgInput.value = bg;
}
function setBg() {
	//on met la valeur dans localstorage pour un nouveau
	localStorage.setItem("bgtheme", bgInput.value);
	updateBg(); //appel de la fonction pour mettre le bg à jour
}
bgInput.addEventListener("change", setBg); //s'exécute quand on quitte l'input

/* JSON.parse et JSON.stringify */
/*
Le localstorage sauvegarde en string.

- Pour sauvegarder un objet, il faut d'abord le convertir en string:

let userObj = {
  name: "Sammy",
  email: "sammy@example.com",
  plan: "Pro"
};

let userStr = JSON.stringify(userObj);
console.log(userStr);
	//{"name":"Sammy","email":"sammy@example.com","plan":"Pro"}

let userInfo = localStorage.setItem("userInfo", userStr);

- Pour recharger une sauvegarde, il faut convertir le string du localstorage en objet

letr userInfo = localStorage.getItem("userInfo");
let userObj = JSON.parse(userInfo);
*/

/////////////////////////

////////////////////
/*** IndexedDb  ***/

////////////////////

/////////////////////////////
/***** AJAX *****/

/*** XMLHttpRequest ***/

/*Décommenter pour voir le résultat */
//On crée un objet XMLHttpRequest
let xhr = new XMLHttpRequest();

//On initialise notre requête avec open()
xhr.open("GET", "une/url");

//On veut une réponse au format JSON
xhr.responseType = "json";

//On envoie la requête
xhr.send();

//Dès que la réponse est reçue...
xhr.onload = function () {
	//Si le statut HTTP n'est pas 200...
	if (xhr.status != 200) {
		//...On affiche le statut et le message correspondant
		alert("Erreur " + xhr.status + " : " + xhr.statusText);
		//Si le statut HTTP est 200, on affiche le nombre d'octets téléchargés et la réponse
	} else {
		alert(
			xhr.response.length +
				" octets  téléchargés\n" +
				JSON.stringify(xhr.response)
		);
	}
};

//Si la requête n'a pas pu aboutir...
xhr.onerror = function () {
	alert("La requête a échoué");
};

//Pendant le téléchargement...
xhr.onprogress = function (event) {
	//lengthComputable = booléen; true si la requête a une length calculable
	if (event.lengthComputable) {
		//loaded = contient le nombre d'octets téléchargés
		//total = contient le nombre total d'octets à télécharger
		alert(event.loaded + " octets reçus sur un total de " + event.total);
	}
};

/*** FETCH  ***/

// Pour faire des requêtes plus modernes

fetch("https://www.une-url.com")
	//url comme argument obligatoire de la requête

	.then((response) => response.json())
	//cela retourne une réponse au format JSON qui retourne également une réponse en JSON

	.then((response) => console.log(JSON.stringify(response)))
	//JSON que l'on va transformer en string et qui sera affiché dans la console

	.catch((error) => console.log("Erreur : " + error));
//on traite les erreurs avec catch et on affiche l’erreur rencontrée si on en rencontre effectivement une

//Options
let promise = fetch(url, {
	method: "GET", //ou POST, PUT, DELETE, etc.
	headers: {
		"Content-Type": "text/plain;charset=UTF-8", //pour un corps de type chaine
	}, // ou "application/json", etc.
	body: undefined, //ou string, FormData, Blob, BufferSource, ou URLSearchParams
	referrer: "about:client", //ou "" (pas de réferanr) ou une url de l'origine
	referrerPolicy: "no-referrer-when-downgrade", //ou no-referrer, origin, same-origin...
	mode: "cors", //ou same-origin, no-cors
	credentials: "same-origin", //ou omit, include
	cache: "default", //ou no-store, reload, no-cache, force-cache, ou only-if-cached
	redirect: "follow", //ou manual ou error
	integrity: "", //ou un hash comme "sha256-abcdef1234567890"
	keepalive: false, //ou true pour que la requête survive à la page
	signal: undefined, //ou AbortController pour annuler la requête
});
/////////////////////////////

console.log();

/* ARBORESCENCE DES OBJETS

window: Window() {
	outerHeight
	outerWidth
	innerHeight
	innerWidth
	history: History(){
		length
		go()
		back()
		forward() }
	location: Location(){
		hash
		search
		pathname
		href
		hostname
		port
		protocole
		host
		origin
		assign()
		reload()
		replace()    }
	screen: Screen(){
		width
		availWidth
		height
		availHeight
		colorDepth
		pixelDepth    }
	alert()
	prompt()
	confirm()
	open(){
		resizeBy()
		resizeTo()
		moveBy()
		moveTo()
		scrollBy()
		scrollTo()
		close() }
	navigator: Navigator() {
		language
		cookieEnabled
		platform
		... 
		geolocation: Geolocation(){
			watchPosition()
			clearWatch()
			getCurrentPosition() : Position(){
				timestamp
				coords: Coordinates(){
					latitude
					longitude
					altitude
					heading
					speed
					... }}}}
	document: Document(){ DOM
		body
		head
		links
		title
		url
		scripts
		cookie
		getElementById("valeur_id")
		getElementsByClassName("valeur_class"): HTMLCollection()
		getElementsByTagName("nom_elt"): HTMLCollection()
		getElementsByName("name") : NodeList()
		querySelector("elt")
		querySelectorAll("elt")
			forEach(elt, index) : NodeList()
		createElement("elt")
		createTextNode("text")
		
	String()
		match(/RegExp/)
		search(/RegExp/)
		replace(/RegExp/)
		split(/RegExp/)


	RegExp()
		exec(string)
		test(string)

	setTimeOut()
	clearTimeout()
	setInterval()
	clearInterval()
	cookie
	localstorage (sessionstorage)
		setItem(key, value)
		getItem(key)
		removeItem(key)
		clear()
		key(index)
		length



		<élément>
			nodeName
			nodeValue
			nodeType
			parentNode
			parentElement
			childNodes
			children
			firstChild
			firstElementChild
			lastChild
			lastElementChild
			previousSibling
			previousElementSibling
			nextSibling
			nextElementSibling
			prepend()
			append()
			insertBefore()
			appendChild()
			insertAdjacentElement()
			insertAdjacentText()
			insertAdjacentHTML()
			before()
			after()
			cloneNode()
			replaceChild()
			removeChild()
			remove()
			hasAttributes()
			hasAttribut("attr")
			attributes : NamedNodeMap()
			getAttributeNames()
			getAttribute()
			setAttribute("atrr", "valeur")
			removeAttribute("atrr")
			toggleAttribute()
			onclick
			onmouseover
			onmouseout
			addEventListener("evnmt", f())
			removeEventListener("evnmt", nom_f°)
			stopPropagation()
			stopImmediatePropagation()
			preventDefault()
	}
}
*/
