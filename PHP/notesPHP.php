<!DOCTYPE html>
<?php
session_start();
$cookie_name = 'user';
$cookie_value = 'Jphindev';
setcookie($cookie_name, $cookie_value, time() + 86400 * 30, '/'); // 86400 = 1 day
echo 'php version: ' . phpversion();
?>
<html>
	<head>
		<title>Cours PHP & MySQL</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Cours PHP</h1>
		<a href=#signet>Jump</a>
<?php
/*
PHP: PHP Hypertext Preprocessor
SQL: Structured Query Language
Le MySQL est un système de gestion de bases de données relationnelles.
*/
?>
<!-- --------- -->
<h2>VARIABLES</h2>
<!-- --------- -->
<?php
// Le nom des variables est sensible à la casse $prenom # $PRENOM

echo "Bonjour, je m'appelle Simon aka \"Sim\" <br>"; //affiche une chaîne de caractère qui peut interpréter les variables
echo 'Bonjour, je m\'appelle Simon aka "Sim" <br>'; //simple chaîne de caractères qui ne peut pas interpréter les variables
echo 'Bonjour <br>';
echo 29;
echo '<br> Il y en a ', 29, ' en tout<br>';
$prenom = 'Simon';
$age = 29;
echo "La variable \$prenom contient: ";
echo $prenom . '<br>';

//
////////// STRING AND NUMBERS

// gettype() pour connaitre le type d'une variable

//// String (chaines de caractères)

$exString1 = 'Hello There !';
echo gettype($exString1) . '<br>';
$exString2 = '36';
echo gettype($exString2);

echo strlen('Hello world!') . '<br>'; //12 - Nombre de caractères
echo str_word_count('Hello world!') . '<br>'; //2 - Nombre de mots
echo strpos('Hello world!', 'world') . '<br>'; //6 - Position du mot recherché
echo strtoupper($exString1) . '<br>'; //HELLO THERE ! - en majuscule
echo strtolower($exString1) . '<br>'; //en minuscule
echo str_replace('There', 'Dolly', $exString1) . '<br>'; //Hello Dolly ! - remplace des caractères
echo strrev($exString1) . '<br>'; //en sens inverse
echo trim($exString1) . '<br>'; //HelloThere! - enlève les espaces
$exStrToArr1 = explode(' ', $exString1); //créé un tableau en séparant par les espaces
print_r($exStrToArr1); //['Hello', 'There', '!']
echo substr($exString1, 6, 5) . '<br>'; //There - renvoie les 5 caractères depuis la position 6

//// Integer and float (entiers et décimaux)

$exInt1 = 36;
var_dump(is_int($exInt1)); //true - vérifie si c'est un entier
$exFloat = 3.6;
var_dump(is_float($exFloat)); //true - vérifie si c'est un nombre décimal

echo pi(); //renvoie la valeur de pi
echo min(0, 150, 30, 20, -8, -200); //-200 - renvoie la valeur minimum
echo max(0, 150, 30, 20, -8, -200); //150 - renvoie la valeur maximum
echo abs(-6.7); //6.7 - renvoie la valeur absolue
echo sqrt(64); //8 - renvoie la racine carrée
echo round(0.6); //1 - renvoie l'entier le plus proche
echo round(0.49); //0
echo rand(); //renvoie un entier aléatoire
echo rand(1, 100); //entier aléatoire entre 1 et 100

//
////////// CONCATÉNATION

// avec guillemets pour interpréter
echo "$prenom est mon prénom et j'ai $age ans <br>"; //Simon est mon prénom et j'ai 29 ans
echo "{$prenom} est mon prénom et j'ai {$age} ans <br>"; //préférable
echo $prenom . " est mon prénom et j'ai " . $age . ' ans <br>'; //la meilleure

// avec apostrophes et points sinon considéré comme une chaîne de caractères
echo $prenom . ' est mon prénom et j\'ai ' . $age . ' ans <br>';

// avec sprintf
$formatSp = '%s est mon prénom et j\'ai %d ans.'; //%s = string, %d = digit
echo sprintf($formatSp, $prenom, $age);
echo '<br>';

//
////////// OPÉRATEURS

/*______________________________
+	Addition
–	Soustraction
*	Multiplication
/	Division
%	Modulo (reste d’une division euclidienne)
**	Exponentielle = Puissance (le seul qui est calculé par la droite)
______________________________*/

$x = 2;
$y = $x + 1; //y vaut 3
$x += 2; //x vaut 4 - Opérateurs combinés correspond à $x = $x + 2
$bonjour = 'Bonjour ';
$bonjour .= $prenom; //Bonjour Simon
$x += $y -= 1;

//calculé par la droite: y=y-1 (2), puis x=x+y (6)

/////////////////////////////////////////////////////////////
?>
<!-- -------------- -->
<h2>LES CONDITIONS</h2>
<!-- -------------- -->
<?php
//
////////// OPÉRATEURS DE COMPARAISON

/*______________________________
==	Permet de tester l’égalité sur les valeurs
===	Permet de tester l’égalité en termes de valeurs et de types
!=	Permet de tester la différence en valeurs
<>	Permet également de tester la différence en valeurs
!==	Permet de tester la différence en valeurs ou en types
<	Permet de tester si une valeur est strictement inférieure à une autre
>	Permet de tester si une valeur est strictement supérieure à une autre
<=	Permet de tester si une valeur est inférieure ou égale à une autre
>=	Permet de tester si une valeur est supérieure ou égale à une autre
______________________________*/

$x = 4;
var_dump($x > 3); //bool(true) -> sert à afficher les informations d'une variable

//
////////// IF

if ($x > 1) {
  // if (test=true){code à exécuter}
  echo '$x contient une valeur supérieure à 1 <br>';
} else {
  echo '$x contient une valeur inférieure ou égale à 1 <br>';
}

// Priorité des opérateurs: [<, <=, >, >=] > [==, ===, !=, !==, <>] > [??]
var_dump(2 > 4 == false); //d'abord comparaison de 2>4 (false) puis false==false (true)

//
////////// OPÉRATEURS LOGIQUES

/*______________________________
AND, &&	Renvoie true si toutes les comparaisons valent true
OR, ||	Renvoie true si une des comparaisons vaut true
XOR		Renvoie true si une des comparaisons exactement vaut true (soit l'une soit l'autre mais pas les deux)
!		Renvoie true si la comparaison vaut false (et inversement). false => 0, NULL ou tableau vide
______________________________*/

if (!($x >= 0 and $y >= 0)) {
  echo 'Soit $x contient une valeur stric. négative, soit $y contient une valeur stric. négative, soit les deux variables contiennent une valeur stric. négative';
}

//
////////// TERNAIRE ? ET FUSION NULL ??

echo $x >= 0 ? '$x stocke un nb positif <br>' : '$x stocke un nb négatif <br>'; //if ? then : else
$resultatx = $x ?? 'NULL'; //test ?? code à renvoyer si le résultat du test est NULL

//
////////// SWITCH

switch ($x) {
  case 0:
    echo '$x stocke la valeur 0';
    break;
  case 1:
    echo '$x stocke la valeur 1';
    break;
  case 2:
    echo '$x stocke la valeur 2';
    break;
  default:
    echo '$x ne stocke pas de valeur entre 0 et 4';
}

//
////////// MATCH

$result_match = match ($x) {
  1, 3, 5, 7, 9 => '$x est impair',
  2, 4, 6, 8 => '$x est pair',
  default => '$x n\'est pas un chiffre',
};
echo '<br>' . $result_match . '<br>';

/////////////////////////////////////////////////////////////
?>
<!-- ----------- -->
<h2>LES BOUCLES</h2>
<!-- ----------- -->
<?php
//
// $x++ post incrémentation
// ++$x pré incrémentation

//
////////// WHILE

$x = 0;
while ($x <= 4) {
  echo '$x contient la valeur ' . $x . '<br>';
  $x++;
}

//
////////// DO ... WHILE

$x = 6;
do {
  //au moins un passage garanti
  echo '$x contient la valeur ' . $x . '<br>';
  $x++;
} while ($x <= 5);

//
////////// FOR

for ($x = 0; $x <= 5; $x++) {
  echo '$x contient la valeur ' . $x . '<br>';
}

//
////////// FOREACH

$resultat = '';
$tableau = ['Un', 'Deux', 'Trois'];
foreach ($tableau as $valeurs) {
  $resultat .= $valeurs . ', ';
}
echo $resultat;

/////////////////////////////////////////////////////////////
?>
<!-- ------------------ -->
<h2>INCLUDE ET REQUIRE</h2>
<!-- ------------------ -->
 <?php
/*______________________________
include 'menu.php'; //importe le code d'un autre fichier
include_once 'menu.php'; //possible de le faire une seule fois
require 'menu.php'; //plus stricte, stop le script en cas de problème
require_once 'menu.php';
______________________________*/

/////////////////////////////////////////////////////////////
?>
<!-- ------------- -->
<h2>LES FONCTIONS</h2>
<!-- ------------- -->
 <?php
 //Le nom des fonctions n'est pas sensible à la casse addition() = ADDITION()

 //// Création d'une fonction
 function nom_de_la_fonction($parametre1, $parametre2)
 {
   echo '<br>Paramètre 1 = ' . $parametre1 . '<br>';
   echo 'Paramètre 2 = ' . $parametre2 . '<br>';
 }

 /*______________________________
Deux façons de créer une fonction
Normal: function varfct($param) {} puis varfct($arg);
En nommant une fonction anonyme: $varfct = function($param){} puis $varfct($arg);
______________________________*/

 //// Appel d'une fonction
 $argument1 = 'oui';
 $argument2 = 'non';
 $variable = 47.5;
 nom_de_la_fonction($argument1, $argument2);
 gettype($variable); // fonction interne déjà définie par PHP

 //// Exemple
 function addition($p1, $p2)
 {
   echo $p1 . ' + ' . $p2 . ' = ' . ($p1 + $p2) . '<br>';
 }
 addition(1, 1);
 addition($x, $y);

 //
 ////////// ARGUMENT PAR RÉFÉRENCE &

 // Pour autoriser la fonction à modifier la valeur de l'argument de départ

 $x = 0;
 function plus2($p)
 {
   $p = $p + 2;
   echo 'Valeur dans la fonction : ' . $p; //2
 }
 plus2($x);
 echo '<br>Valeur en dehors de la fonction : ' . $x; //0

 function plus3(&$p)
 {
   //on ajoute & devant le paramètre
   $p = $p + 3;
   echo '<br>Valeur dans la fonction : ' . $p; //3
 }
 plus3($x);
 echo '<br>Valeur en dehors de la fonction : ' . $x; //3, on a autorisé la modification de $x par la fonction

 //
 ////////// VALEURS PAR DÉFAUT $p=

 function bonjourdefaut($prenom, $role = 'abonné(e)')
 {
   echo '<br>Bonjour ' . $prenom . ' vous êtes un(e) ' . $role . '.<br>';
 }
 bonjourdefaut('Mathilde'); //Bonjour Mathilde vous êtes un(e) abonné(e).
 bonjourdefaut('Pierre', 'administrateur'); //Bonjour Pierre vous êtes un(e) administrateur.

 //
 ////////// NOMBRE VARIABLE D'ARGUMENTS ...

 function bonjournbvar(...$prenoms)
 {
   //va créer un tableau avec les différents arguments
   foreach ($prenoms as $p) {
     echo 'Bonjour ' . $p . '<br>';
   }
 }
 bonjournbvar('Mathilde', 'Pierre', 'Victor');

 //
 ////////// LE TYPAGE DES ARGUMENTS

 function sans_typage($a, $b)
 {
   echo $a . ' + ' . $b . ' = ' . ($a + $b) . '<br>';
 }
 function avec_typage(float $a, float $b)
 {
   echo $a . ' + ' . $b . ' = ' . ($a + $b) . '<br>';
 }
 sans_typage(3, 4); //3 + 4 = 7
 sans_typage(3, '4Pierre'); //3 + 4Pierre = 7 - '4Pierre' est converti en 4 par PHP
 // sans_typage(3, 'Pierre'); 	//3 + Pierre = 3 - 'Pierre' est converti en 0 par PHP
 avec_typage(3, 4); //3 + 4 = 7
 avec_typage(3, 4.5); //3 + 4.5 = 7.5
 avec_typage(3.5, 4.2); //3.5 + 4.2 = 7.7
 // avec_typage(3, '4Pierre');	//3 + 4 = 7 - '4Pierre' est converti en 4 par PHP
 // avec_typage(3, 'Pierre');	//Renvoie une erreur qui termine l'exécution

 //
 ////////// LE TYPAGE STRICT

 // Il faut ajouter: declare(strict_types= 1); en début de fichier
 // n'est possible que pour les types string, int, float et bool

 //
 ////////// RETURN

 function multreturn(float $a, float $b)
 {
   return $a * $b;
 }
 $res = multreturn(4, 5);
 echo $res += 2; //22

 function multreturn_avec_typage($a, $b): int
 {
   return $a * $b;
 }
 echo multreturn_avec_typage(2, 4.1); //8 – transformation de PHP pour correspondre au type attendu

 function multreturn_typage_strict($a, $b): int
 {
   return $a * $b;
 }
 echo multreturn_typage_strict(2, 4.1); //erreur
 echo '<br><br>';

 //
 ////////// PORTÉE DES VARIABLES

 // Une variable globale n'est pas accessible en local
 // Une variable locale n'est pas accessible en global

 //// Utilisation d'une variable globale en local
 $x = 10;
 function portee()
 {
   global $x; //on ajoute l'instruction >global pour pouvoir utiliser la variable globale
   echo 'La valeur de $x globale est : ' . $x . '<br>'; //10
   $x = $x + 5; //On ajoute 5 à la valeur de $x
 }
 portee();
 echo '$x contient maintenant : ' . $x . '<br>'; //15 – on a changé la valeur globale de la variable

 //// Utilisation d'une variable locale en global -> en utilisant >return

 //// Conserver la valeur d'une variable locale -> >static
 function compteur()
 {
   static $x = 0;
   echo '$x contient la valeur : ' . $x . '<br>';
   $x++;
 }
 compteur(); //0
 compteur(); //1

 //
 ////////// LES CONSTANTES

 // On écrit les constantes en MAJUSCULES sans $
 define('DIX', 10); //on met la valeur 10 dans la constante DIX
 const MIN_VALUE = 1; //écriture valable pour string, int, float, bool, array

 //// Constantes prédéfinies et magiques
 echo 'FILE: ' . __FILE__ . '<br>'; //Contient le chemin complet et le nom du fichier
 echo 'DIR: ' . __DIR__ . '<br>'; //Contient le nom du dossier dans lequel est le fichier
 echo 'LINE: ' . __LINE__ . '<br>'; //Contient le numéro de la ligne courante dans le fichier
 echo 'FUNCTION: ' . __FUNCTION__ . '<br>'; //Contient le nom de la fonction actuellement définie ou {closure} pour les fonctions anonymes

 //
 ////////// LES FONCTIONS ANONYMES (closures) ET AUTO-INVOQUÉES

 (function () {
   echo 'Fonction anonyme auto-invoquée';
 })(); //pour effectuer une tâche une seule fois

 //
 ////////// FONCTION DE RAPPEL (callback)
 $squ = function (float $x) {
   return $x ** 2;
 };
 $tab15 = [1, 2, 3, 4, 5];
 $tb_squ = array_map($squ, $tab15); //exécute la closure sur chaque élément du tableau
 echo '<br>';
 print_r($tb_squ);
 echo '<br>';

 function my_callback($item)
 {
   return strlen($item);
 }
 $stringsFruits = ['apple', 'orange', 'banana', 'coconut'];
 $lengths = array_map('my_callback', $stringsFruits);
 print_r($lengths);
 //On peut aussi mettre une fonction anonyme en callback
 //$lengths = array_map( function($item) { return strlen($item); } , $stringsFruits);
 echo '<br>';

/////////////////////////////////////////////////////////////
?>
<!--------------- -->
<h2>LES TABLEAUX</h2>
<!-- ------------ -->
<?php
//
////////// TABLEAUX NUMÉROTÉS OU INDEXÉS

// clef => valeur, les clefs sont attribuées automatiquement à partir de 0 quand elles ne sont pas spécifiées

$prenoms = ['Mathilde', 'Pierre', 'Amandine', 'Florian']; //avec array
$ages = [27, 29, 21, 29]; //avec []
$prenoms[] = 'John'; //ajout d'une nouvelle valeur dans le tableau
array_push($prenoms, 'John'); //ajout d'une nouvelle valeur dans le tableau
$prenoms[4] = 'John'; //ajout d'une valeur en précisant la clef
echo $prenoms[2] . '<br>'; //Amandine
$taille = count($prenoms);
echo $taille . '<br>'; //5 donne la taille du tableau
array_splice($prenoms, 4, 1, 'Marc'); //supprime 1 valeur à partir de l'index 4 par une nouvelle valeur "Marc", renvoie le ou les élements supprimés
array_splice($prenoms, 4, 0, 'Delphine'); //insert une valeur avant l'index 4
unset($prenoms[5]); //supprime une valeur sans supprimer l'index

//// Affichage d'un tableau complet
$p = '';
for ($i = 0; $i < $taille; $i++) {
  $p .= $prenoms[$i] . ', ';
}
echo $p . '<br>';

$res = '';
foreach ($prenoms as $valeurs) {
  $res .= $valeurs . ', ';
}
echo $res . '<br>';

//
////////// TABLEAUX ASSOCIATIFS = CLEFS TEXTUELLES

$ages = ['Mathilde' => 27, 'Pierre' => 29];
$ages['Amandine'] = 21; //ajoute une entrée au tableau
echo 'Pierre a ' . $ages['Pierre'] . ' ans.<br>'; //Pierre a 29 ans.

$cars = ['brand' => 'Ford', 'model' => 'Mustang', 'year' => 1964];
$newarray = array_diff($cars, ['Mustang', 1964]); //suppr des valeurs dans un tableau
array_pop($ages); //suppr la dernière valeur d'un tableau
array_shift($ages); //suppr la première valeur d'un tableau

foreach ($ages as $clef_prenom => $valeur_age) {
  echo $clef_prenom . ' a ' . $valeur_age . ' ans.<br>';
}

//
////////// TABLEAUX MULTIDIMENSIONNELS = TABLEAU DANS UN TABLEAU

//// Un tableau numéroté stockant des tableaux numérotés
$suite = [[1, 2, 4, 8, 16], [1, 3, 9, 27, 81]];
echo $suite[0][2] . '<br>'; //4

//// Un tableau numéroté stockant des tableaux associatifs
$utilisateurs = [
  ['nom' => 'Mathilde', 'mail' => 'math@gmail.com'],
  ['nom' => 'Pierre', 'mail' => 'pierre.giraud@edhec.com'],
  ['nom' => 'Amandine', 'mail' => 'amandine@lp.fr'],
  'Florian',
];
$sous_util = $utilisateurs[2]; //['nom' => 'Amandine', 'mail' => 'amandine@lp.fr']
echo $sous_util['nom'] . '<br>'; //Amandine
echo $utilisateurs[2]['nom'] . '<br>'; //Amandine
echo $utilisateurs[3] . '<br>'; //Florian

//// Un tableau associatif stockant des tableaux associatifs
$produits = [
  'Livre' => ['poids' => 200, 'quantite' => 10, 'prix' => 15],
  'Stickers' => ['poids' => 10, 'quantite' => 100, 'prix' => 1.5],
];
echo $produits['Livre']['prix'] . '<br>'; //15

foreach ($produits as $clef => $produit) {
  echo 'Caractéristiques de ' . $clef . ' :<br>';
  foreach ($produit as $caracteristique => $valeur) {
    echo $caracteristique . ' : ' . $valeur . '<br>';
  }
  echo '<br>';
}
/*______________________________
Caractéristiques de Livre :
poids : 200
quantité : 10
prix: 15

Caractéristiques de Stickers :
...
______________________________*/

//
////////// AFFICHAGE RAPIDE ET RECHERCHE DANS UN TABLEAU

echo '<pre>'; //pour conserver la mise en forme du code
print_r($produits); //pour un affichage simple
var_dump($produits); //donne plus d'informations
echo '</pre>';

array_key_exists('model', $cars); //true - vérifie l'éxistence d'une clé dans un tableau
in_array('Ford', $cars); //true - vérifie léxistence d'une valeur dans un tableau
array_search('Mustang', $cars); //model - donne la clé d'une valeur si elle existe (sinon false)
echo '<br>';

//
////////// SORT

/*______________________________
sort() - ascending order
rsort() - descending order
asort() - associative in ascending order, according to the value
ksort() - associative in ascending order, according to the key
arsort() - associative in descending order, according to the value
krsort() - associative in descending order, according to the key
______________________________*/

/////////////////////////////////////////////////////////////
?>
<!-- ------------------- -->
<h2>MANIPULER DES DATES</h2>
<!-- ------------------- -->
<?php
//
////////// TIMESTAMP UNIX

//// time() -> Nombre de secondes écoulés depuis le 1er janvier 1970
echo 'Timestamp actuel : ' . time() . '<br>'; //1548406800

//// mktime() -> Timestamp du GMT d'une date donnée en prenant compte les fuseaux horaires
echo 'Timestamp 25 janvier 2019 08h30 (GMT+1) : ' .
  mktime(8, 30, 0, 1, 25, 2019) .
  '<br>'; //donne le timestamp de 7h30

//// gmmktime() -> Timestamp exact d'une date donnée en donnant le GMT
echo 'Timestamp 25 janvier 2019 08h30 (GMT) : ' .
  gmmktime(8, 30, 0, 1, 25, 2019) .
  '<br>'; //donne le timestamp de 8h30

//// strtotime(time, start date) -> Timestamp du GMT à partir d'une chaîne de caractère
$stt1 = strtotime('2019/01/25 08:30:00'); //plusieurs formats possible
$stt2 = strtotime('2019/01/25'); //à minuit quand ce n'est pas précisé
$stt3 = strtotime('next friday');
$stt4 = strtotime('2 days ago'); //il y a 48h
$stt5 = strtotime('+1 day', $stt3); // 24h après vendredi prochain
echo date('Y/m/d H:i:s', $stt3) . '<br>';

//// getdate() -> Obtenir une date à partir d'un Timestamp
echo '<pre>';
print_r(getdate()); //donne le tableau du timestamp actuel
echo '</pre><br>';

echo '<pre>';
print_r(getdate($stt2)); //donne le tableau du timestamp donné
echo '</pre>';

//
////////// OBTENIR ET FORMATER UNE DATE

/*______________________________
l - day of the week
d - day of the month (01 to 31)
m - month (01 to 12)
Y - year (in four digits)
H - 24-hour format of an hour (00 to 23)
h - 12-hour format of an hour (01 to 12)
i - Minutes (00 to 59)
s - Seconds (00 to 59)
a - Lowercase Ante meridiem and Post meridiem (am or pm)
______________________________*/

//// date(format, timestamp) locale
echo date('d/m/Y') . '<br>'; //26/01/2019
echo date('l d m Y h:i:s') . '<br>'; //Saturday 26 01 2019 10:14:43
echo date('c') . '<br>'; //2019-01-26T10:14:43+01:00
echo date('r') . '<br>'; //Sat. 26 Jan 2019 10:14:43 +0100

//// gmdate() date GMT et changement de fuseau horaire
echo date('d m Y h:i:s') . '<br>'; //26 01 2019 10:19:41
echo gmdate('d-m-Y h:i:s') . '<br>'; //26-01-2019 09:19:41
date_default_timezone_set('Europe/Moscow'); //On choisit le fuseau horaire de Moscou = GMT+3
echo date('d m Y h:i:s') . '<br>'; //26 01 2019 12:19:41
echo gmdate('d-m-Y h:i:s') . '<br>'; //26-01-2019 09:19:41

/*__DEPRECATED__________________
//// Transformer une date en français: setlocale() et strftime() /!\ deprecated
echo strftime('%A %d %B %Y %I:%M:%S') . '<br>'; //Saturday 26 January 2019 10:22:04
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']); //on active la localisation française
date_default_timezone_set('Europe/Paris'); //on défini le fuseau horaire
echo strftime('%A %d %B %Y %I:%M:%S') . '<br>'; //Samedi 26 Janvier 2019 10:22:04
echo strftime('%c') . '<br>'; //Sam 26 jan 10:22:04 2019
________________________________*/

//// Date locale avec datefmt_format

$fmt = datefmt_create(
  'fr_FR',
  IntlDateFormatter::FULL,
  IntlDateFormatter::FULL,
  'Europe/Paris',
  IntlDateFormatter::GREGORIAN,
  'EEEE d MMMM yyyy HH:mm:ss'
  /* voir https://unicode-org.github.io/icu/userguide/format_parse/datetime/#date-field-symbol-table */
);
echo 'Avec datefmt_format: ' . datefmt_format($fmt, time()) . '<br>';

//// Date locale avec IntlDateFormatter
$fmtOO = new IntlDateFormatter(
  'fr_FR',
  IntlDateFormatter::FULL,
  IntlDateFormatter::FULL,
  'Europe/Paris',
  IntlDateFormatter::GREGORIAN,
  'EEEE d MMMM yyyy'
);
echo 'Avec IntlDateFormatter: ' . $fmt->format(time()) . '<br>';

//
////////// COMPARER DES DATES

// Il faut comparer les Timestamp et pas les dates
$d1 = '25-01-2019 14:30:25'; //on défini la date
$d2 = '30-June 2018 14:30:25'; //un autre format
$tmstp1 = strtotime($d1); //on récupère le timestamp
$tmstp2 = strtotime($d2);
$dfr1 = datefmt_format($fmt, $tmstp1); //on localise en français
$dfr2 = datefmt_format($fmt, $tmstp2);

if ($tmstp1 < $tmstp2) {
  echo 'Le ' . $dfr1 . ' est avant le ' . $dfr2;
} elseif ($tmstp1 == $tmstp2) {
  echo 'Les deux dates sont les mêmes';
} else {
  echo 'Le ' . $dfr2 . ' est avant le ' . $dfr1;
} //Le Samedi 30 juin 2018 est avant le Vendredi 25 janvier 2019

// Opérations sur les dates
$d3 = strtotime('July 04');
$d4 = ceil(($d3 - time()) / 60 / 60 / 24); //différence entre 2 date arrondie au supérieur, en jours
echo '<br>There are ' . $d4 . ' days until 4th of July.';

//// checkdate() pour tester la validité d'une date
checkdate(1, 25, 2019); //true – le 25 jan 2019 est une date valide
checkdate(2, 29, 2015); //false – 2015 n'est pas une année bissextile
echo '<br>';

/*__DEPRECATED__________________
//// strptime() pour tester une date locale /!\ deprecated
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);

$format1 = '%A %d %B %Y %H:%M:%S';
$format2 = '%H:%M:%S';

$date1 = strftime($format1); //Vendredi 08 novembre 2024 15:58:03
$date2 = strftime($format1); //Vendredi 08 novembre 2024 15:58:03
$date3 = strftime($format2); //15:58:03

echo $date1 . '<br>' . $date2 . '<br>' . $date3 . '<br>';

if (strptime($date1, $format1)) {
  echo '<pre>';
  print_r(strptime($date1, $format1)); //affichage d'un tableau car les formats sont les mêmes
  echo '</pre><br>';
}
if (strptime($date2, '%A %d %B %Y')) {
  echo '<pre>';
  print_r(strptime($date2, '%A %d %B %Y')); //tableau incomplet, les données non reconnues vont dans [unparsed]
  echo '</pre><br>';
}
if (strptime($date3, '%A %d %B %Y')) {
  echo '<pre>';
  print_r(strptime($date3, '%A %d %B %Y')); //false, les formats sont différents
  echo '</pre>';
}
________________________________*/

/////////////////////////////////////////////////////////////
?>
<!-- ----------------------- -->
<h2>VARIABLES SUPERGLOBALES</h2>
<!-- ----------------------- -->
<?php
//
////////// $GLOBALS

//C'est un tableau nom => valeur de toutes les variables globales définies
$prenom = 'Pierre';
$nom = 'Giraud';
$age = 28;
function prez2()
{
  $mail = 'pierre.giraud@edhec.com';
  echo 'Je suis ' .
    $GLOBALS['prenom'] .
    ' ' .
    $GLOBALS['nom'] .
    ', j\'ai ' .
    $GLOBALS['age'] .
    ' ans.<br>Mon adresse mail est : ' .
    $mail;
}

//// Rappel avec le mot clef global
//global $prenom, $nom, $age;
//echo 'Je suis ' .$prenom. ' ' .$nom. ', j\'ai ' .$age. ' ans.<br>Mon adresse mail est : ' .$mail;

//
////////// $_SERVER

//Tableau contenant les variables définis par le serveur

//Renvoie le nom du fichier contenant le script
echo $_SERVER['PHP_SELF'] . '<br>';
//Renvoie le nom du serveur qui héberge le fichier
echo $_SERVER['SERVER_NAME'] . '<br>';
//Renvoie l'adresse IP du serveur qui héberge le fichier
echo $_SERVER['SERVER_ADDR'] . '<br>';
//Retourne l'IP du visiteur demandant la page
echo $_SERVER['REMOTE_ADDR'] . '<br>';
//Renvoie une valeur non vide si le script a été appelé via le protocole HTTPS
echo $_SERVER['HTTPS'] . '<br>';
//Retourne le temps Unix du début de la requête
echo $_SERVER['REQUEST_TIME'] . '<br>';

//
////////// $_REQUEST

//tableau associatif qui va contenir les variables de $_GET, $_POST et $_COOKIE

//
////////// $_ENV

//Tableau contenant les variables d'environnement
echo $_ENV['USER']; //nom de l'utilisateur qui exécute le script
echo '<br>';

//
////////// $_FILES

//contient les informations d'un fichier lors de son upload, son type, sa taile, son nom, etc.
/*______________________________
$_FILES['input_name']['name']; // nom du fichier
$_FILES['input_name']['type']; // type du fichier
$_FILES['input_name']['size']; // taille en octets
$_FILES['input_name']['tmp_name']; // emplacement du fichier temporaire sur le serveur
$_FILES['input_name']['error']; // code erreur du téléchargement
______________________________*/

//
////////// $_GET et $_POST

//Pour manipuler les informations envoyées via un formulaire HTML

//
////////// $_COOKIE

/*______________________________
//Un cookie est un fichier texte qui peut contenir une quantité limitée de données. Il est enregistré du coté utilisateur.
//setcookie(NAME, value, expire, path, domain, secure, httponly) pour créer un cookie
// /!\ à écrire en début de fichier avant la balise html
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day - expire dans 30 jours
setcookie('user_id', '1234');
setcookie('user_pref', 'dark_theme', time()+3600*24, '/', '', true, true);
setcookie('user_id', '5678'); //modification d'un cookie
setcookie('user_pref', '', time()-3600, '/', '', false, false); //suppression d'un cookie
______________________________*/

//on vérifie si le cookie existe
if (!isset($_COOKIE[$cookie_name])) {
  echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
  echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo 'Value is: ' . $_COOKIE[$cookie_name] . '<br>';
}
print_r($_COOKIE);
echo '<br>';

//
////////// $_SESSION

//Une session démarre dès que la fonction session_start() est appelée et se termine en général dès que la fenêtre courante du navigateur est fermée. Elle permet d'utiliser des variables sur plusieurs pages.
//session_start(); /!\ à écrire en début de fichier avant setcookie
$_SESSION['prenom'] = 'Pierre'; //on définit des variables de session
echo 'Prénom de la session: ' . $_SESSION['prenom'] . '.<br>'; //peut être appelé sur d'autres pages qui ont session_start()
$_SESSION['age'] = 29;
$id_session = session_id(); //on récupère d'id de session s'il existe
$id_sess_cookie = $_COOKIE['PHPSESSID']; //on peut aussi récupérer l'id de session avec $_COOKIE
print_r($_SESSION);

//Il est possible d'accéder aux variables de session dans une autre page php si celle-ci débute par session_start();

unset($_SESSION['age']); //pour détruire une variable de session particulière
session_unset(); //pour détruire toutes les variables de la session courante
session_destroy(); //pour supprimer le fichier de session mais pas $_SESSION
echo '<br>';

/////////////////////////////////////////////////////////////
?>
<!-- ------------------------- -->
<h2>MANIPULATION DES FICHIERS</h2>
<!-- ------------------------- -->
<?php
//
////////// LECTURE DE FICHIER TXT

echo 'Avec file_get_contents: <br>' .
  file_get_contents('test.txt') .
  '<br><br>'; //affiche le contenu du fichier
echo 'Avec nl2br: <br>' . nl2br(file_get_contents('test.txt')) . '<br><br>'; //pour conserver les retours à la ligne

echo 'Avec print_r: <pre>';
print_r(file('test.txt')); //sous forme de tableau
echo '</pre>';

echo 'Avec readfile: <br>';
readfile('test.txt'); //pas besoin de echo
echo '<br><br>';

//
////////// OUVRIR, LIRE ET FERMER UN FICHIER

/*__ modes d'ouvertures ________
r	read only						r+	read + write				pointeur au début
a	write after					a+ write after + read			pointeur à la fin
w	write & replace			w+ write + read & replace			pointeur au début
x	create new & write	x+ create new & write + read		pointeur au début
c	write or create & keep	c+ write + read or create & keep	pointeur au début
b binary pour une meilleure compatibilité
______________________________*/

//// fopen() pour ouvrir un fichier
($ressource = fopen('test.txt', 'rb')) or die('Impossible à ouvrir'); //r=read only – b=meilleure compatibilité

//// fread() pour lire un fichier ouvert depuis la position courante du curseur
echo 'Avec fopen puis fread: ' .
  fread($ressource, filesize('test.txt')) .
  '<br><br>'; //on lit le fichier en entier et place le curseur à la fin

//// fseek() pour déplacer le curseur
fseek($ressource, 20); //pour placer le pointeur derrière le 20e caractère
fseek($ressource, 40, SEEK_CUR); //avancer de 40 à partir de la position courante
fseek($ressource, 0);

//// fgets() pour lire ligne par ligne
echo 'Ligne 1 : ' . fgets($ressource) . '<br>'; //pour lire un fichier ligne par ligne
echo 'Ligne 2 : ' . fgets($ressource) . '<br>'; //ligne vide
echo 'Ligne 3(30) : ' . fgets($ressource, 30) . '<br>'; //pour lire 30 octets de la 3e ligne
echo 'Ligne 3 suite: ' . fgets($ressource, 15) . '<br>'; //pour lire la suite la 3e ligne

//// fgetc() pour lire caractère par caractère
echo 'Caractère 1 : ' . fgetc($ressource) . '<br>'; //affiche le 1er caractère du fichier
echo 'Caractère 2 : ' . fgetc($ressource) . '<br><br>'; //affiche le 2e caractère du fichier

//// feof() pour savoir si on est à la fin d'un fichier end of file)
//// ftell() pour connaitre la place du pointeur
while (!feof($ressource)) {
  //tant que end of file n'est pas atteint (false)
  echo 'Le pointeur est au niveau du caractère ' . ftell($ressource) . '<br>';
  $ligne = fgets($ressource); //on enregistre une ligne
  echo 'La ligne "' .
    $ligne .
    '" contient ' .
    strlen($ligne) .
    ' caractères <br><br>';
} //et on affiche le nombre de caractères de cette ligne grâce à strlen (string length)

//// fclose() pour fermer un fichier
fclose($ressource); //bonne pratique pour ne pas utiliser inutilement des ressources

//
////////// CRÉER ET ÉCRIRE DANS UN FICHIER

//// fopen('chemin/file.txt', 'w')

//// file_put_contents('chemin', 'contenu') pour créer ou écraser un fichier
file_put_contents('exemple.txt', 'Ecriture dans un fichier');
$texte = file_get_contents('exemple.txt'); //on sauvegarde le contenu
$texte .= "\n**NOUVEAU TEXTE**"; //on ajoute du contenu
file_put_contents('exemple.txt', $texte); //on écrase avec le contenu complet
file_put_contents('exemple.txt', "\n**AJOUT DE TEXTE**", FILE_APPEND); //meilleure méthode pour ajouter du texte

//// fwrite() pour écrire au niveau du pointeur
$fichier = fopen('exemple2.txt', 'c+b'); //on crée ou ouvre un fichier /!\ c+ pointeur au début - a+ pour mettre le pointeur à la fin
fseek($fichier, filesize('exemple2.txt')); //on place le curseur en fin de fichier sinon le début sera effacé
fwrite($fichier, 'Un premier texte dans mon fichier. '); //on insère du contenu
fwrite($fichier, 'Un autre texte. '); //un autre contenu à la suite

//
////////// TESTER L'EXISTENCE D'UN FICHIER

$f = 'exemple.txt';
if (file_exists($f)) {
  //true si le fichier ou répertoire existe
  if (is_file($f)) {
    //true si c'est un véritable fichier
    echo 'Le fichier ' . $f . ' existe et est bien un fichier.<br>';
  } else {
    echo $f . ' existe mais n\'est pas un fichier régulier';
  }
} else {
  echo $f . ' n\'existe pas';
}

//
////////// RENOMMER OU EFFACER UN FICHIER

$newf = 'fichier.txt';
$exemple2 = 'exemple2.txt';
rename($f, $newf); //exemple.txt a été renommé en fichier.txt
unlink($exemple2); //on supprime exemple2.txt

//
////////// PERMISSIONS DES FICHIERS ET CHMOD

/*______________________________
aucun droit					---	0
exécution seulement	--x	1
écriture seulement	-w-	2
écriture et exécution	-wx	3
lecture seulement	r--	4
lecture et exécution	r-x	5
lecture et écriture	rw-	6
tous les droits 	rwx	7

exemple 754 = author rwx / group r-x / user r--
______________________________*/

//// fileperms() donne les permissions
//// decoct() traduit en valeur octale (0 à 7)
echo decoct(fileperms('fichier.txt')) . '<br>'; //100644 -> permissions 644
echo var_dump(is_readable('fichier.txt')) . '<br>'; //true si permission r
echo var_dump(is_writable('fichier.txt')) . '<br>'; //true si permission w

//// chmod() pour modifier les permissions
if (chmod('fichier.txt', 0755)) {
  //chmod s'exécute et la condition est ensuite vérifiée
  echo 'Permissions du fichier bien modifiées.<br><br>';
}

//
////////// UPLOAD D'UN FICHIER
echo '<br><br>';
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<?php
//

/*__upload.php__________________
$target_dir = 'uploads/';
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']); //basename permet d'extraire le nom du fichier
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST['submit'])) {
  $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
  if ($check !== false) {
    echo 'File is an image - ' . $check['mime'] . '. <br>';
    $uploadOk = 1;
  } else {
    echo 'File is not an image. <br>';
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo 'Sorry, file already exists. <br>';
  $uploadOk = 0;
}

// Check file size
if ($_FILES['fileToUpload']['size'] > 500000) {
  echo 'Sorry, your file is too large. <br>';
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != 'jpg' &&
  $imageFileType != 'png' &&
  $imageFileType != 'jpeg' &&
  $imageFileType != 'gif'
) {
  echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo 'Sorry, your file was not uploaded. <br>';
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
    echo 'The file ' .
      htmlspecialchars(basename($_FILES['fileToUpload']['name'])) .
      ' has been uploaded. <br>';
  } else {
    echo 'Sorry, there was an error uploading your file. <br>';
  }
}
______________________________*/

/////////////////////////////////////////////////////////////
?>
<!-- -------------------------------------- -->
<h2>EXPRESSIONS REGULIERES OU RATIONNELLES</h2>
<!-- -------------------------------------- -->
<?php
//
////////// FONCTIONS PCRE PHP

/*______________________________
preg_filter()		 				Recherche et remplace
preg_grep()							Recherche et retourne un tableau avec les résultats
preg_last_error()				Retourne le code d’erreur de la dernière regex exécutée
preg_match() 						Compare une regex à une chaine de caractères (0 ou 1)
preg_match_all()				Pareil mais renvoie tous les résultats (tableau)
preg_quote()						Echappe les caractères spéciaux dans une chaine
preg_replace()					Recherche et remplace
preg_replace_callback()	Recherche et remplace en utilisant une fonction de rappel
preg_replace_callback_array()	Recherche et remplace en utilisant une fonction de rappel
preg_split()						Découpe une chaine
______________________________*/

//// preg_match et preg_match_all pour rechercher

$masque_r = '/r/';
$chaine1 = 'Je suis Pierre Giraud';

if (preg_match($masque_r, $chaine1)) {
  echo 'Le caractère "r" a été trouvé ' .
    preg_match_all($masque_r, $chaine1) .
    ' fois dans "' .
    $chaine1 .
    '"<br>';
} else {
  'Aucun "r" dans "' . $chaine1 . '"<br>';
}

$match = []; //On initialise $match et $match_all
$match_all = [];

preg_match($masque_r, $chaine1, $match); //r est enregistré dans $match
preg_match_all($masque_r, $chaine1, $match_all); //un tableau de 3 r est enregistré

echo '<pre>';
print_r($match);
echo '<br><br>';
print_r($match_all);
echo '</pre>';

$m2 = []; //On initialise $m2
$res_match = preg_match_all($masque_r, $chaine1, $m2, PREG_PATTERN_ORDER, 15);
echo 'On recherche "' .
  $match_all[0][0] .
  '" en partant 15 octets après le début de la chaine de caractères. ' .
  $res_match .
  ' résultat(s) trouvé(s).<br>';

//// preg_filter pour remplacer (renvoie null si non trouvé)

$masque_jour = '/jour/';
$masque_nuit = '/nuit/';
$chaine2 = 'Bonjour, je suis Pierre';
$res_filter = preg_filter($masque_jour, 'soir', $chaine2); //on remplace jour par soir
echo 'Initial: ' . $chaine2 . '<br>Filter: ' . $res_filter . '<br>'; //Bonsoir...

//// preg_replace pour remplacer (renvoie chaine de départ si non trouvé)

$res_replace = preg_replace($masque_jour, 'ne nuit', $chaine2);
echo 'Replace: ' . $res_replace . '<br>'; //Bonne nuit...
$res_replace2 = preg_replace($masque_nuit, 'ne nuit', $chaine2);
echo 'Non trouvé: ' . $res_replace2 . '<br>'; //Bonjour...

//// preg_grep pour rechercher dans un tableau

$masque_Pierre = '/Pierre/';
$tableau1 = ['Pierre Gr', 'Mathilde Ml', 'Pierre Dp', 'Florian Dc'];
$res_grep = preg_grep($masque_Pierre, $tableau1);
echo '<pre>';
print_r($res_grep); //[Pierre Gr, Pierre Dp]
echo '</pre>';

//// preg_split pour découper une chaine et mettre dans un tableau

$masque_j = '/j/';
$res_split = preg_split($masque_j, $chaine2);
echo '<pre>';
print_r($res_split); //[0] => Bon | [1] => our, | [2] => e suis Pierre
echo '</pre>';

//
////////// LES CLASSES DE CARACTÈRES [...]

// /.../ -> et, [...] -> ou
$masque_voyelle = '/[aeiouy]/'; //a ou e ou i ou u ou y
$masque_jvo = '/j[aeiouy]/'; //j suivi d'une voyelle
$masque_vovo = '/[aeiouy][aeiouy]/'; //une voyelle suivi d'une voyelle

preg_match_all($masque_jvo, $chaine2, $tab_jvo);
print_r($tab_jvo); //[0] => Array([0] => jo | [1] => je))
echo '<br><br>';

//
////////// MÉTACARACTÈRES DE CLASSES (DANS LES CROCHETS)

/*______________________________
	[]classe de caractères
	^ pour nier une classe si placé au début d'une classe [^...]
	- pour un intervalle [a-z][A-Z][0-9]
	\ pour protéger (échapper) -> /[...\]\-...]/ pour rechercher ] ou -
______________________________*/

$chaine_meta = '[Pierre-Alexandre] \0/ ^_^';
$masque_minmaj = '/[a-z][a\-z][A-Z]/'; //minuscule + [a ou - ou z] + majuscule
$masque_paslet = '/[^a-zA-Z]/'; //pas le lettres minuscules ou majuscules
$masque_chapeau = '/[\^]_[0-9^]/'; //chapeau + underscore + chiffre ou chapeau
// pour chercher un antislash, il faut en mettre 4: \\\\

preg_match_all($masque_minmaj, $chaine_meta, $res_minmaj);
echo 'minmaj: ' . implode(', ', $res_minmaj[0]); //e-A
//implode converti le tableau en string en séparant par des virgules

preg_match_all($masque_paslet, $chaine_meta, $res_paslet);
echo '<br>paslet: ' . implode('', $res_paslet[0]) . '<br>'; //[-] \0/ ^^

preg_match_all($masque_chapeau, $chaine_meta, $res_chapeau);
print_r($res_chapeau);
echo '<br><br>';

//
////////// CLASSES ABRÉGÉES OU PRÉDÉFINIES

/*______________________________
\w	word: un mot. Équivalent à [a-zA-Z0-9_]
\W	no Word: pas un mot. Equivalent à [^a-zA- Z0-9_]
\d	digit: un chiffre. Équivalent à [0-9]
\D	no Digit: pas un chiffre. Équivalent à [^0-9]
\s	space: un blanc (espace, retour chariot ou retour à la ligne)
\S	no Space: pas un blanc
\h	horizontal space: espace horizontal
\H	no Hz space: pas un espace horizontal
\v	vertical space: un espace vertical
\V	no Vt space: pas un espace vertical
______________________________*/

$masque_now = '/[\W]/';
$masque_d = '/[\d]/';
$masque_h = '/[\h]/';
$chaine3 = 'Salut Amandinedu93 ;-)';

preg_match_all($masque_now, $chaine3, $res_now);
preg_match_all($masque_d, $chaine3, $res_d);
$nb_espaces = preg_match_all($masque_h, $chaine3); //2

echo '<pre>';
print_r($res_now); // | |;|-|)
echo '<br>';
print_r($res_d); //9, 3
echo '</pre><br>';
echo '"' .
  $chaine3 .
  '" contient ' .
  $nb_espaces .
  ' espaces horizontaux<br><br><br>';

//
////////// MÉTACARACTÈRES REGEX PHP (EN DEHORS DES CROCHETS)

//// Le point pour chercher tout sauf un retour à la ligne (\n)
$masque_pasligne = '/./'; //tout sauf retour ligne
$masque_point = '/[.]/'; //cherche un point

//// L'alternative | (ou)
$masque_altou = '/er|re/'; //cherche "er" ou "re"

//// Les ancres début (^) et fin ($) de chaine
$masque_startp = '/^p|^P/'; //Cherche "p" ou "P" en début de chaine
$masque_startmaj = '/^[A-Z]/'; //Cherche une majuscule en début de chaine
$masque_endq = '/\?$/'; //Cherche "?" en fin de chaine
$masque_startp_endq = '/^p\?$|^P\?$/'; //On cherche exactement "p?" ou "P?"

//// Les quantificateurs
/*
a{X}		On veut une séquence de X « a »
a{X,Y}	On veut une séquence de X à Y fois « a »
a{X,}		On veut une séquence d’au moins X fois « a » sans limite supérieure
a?			On veut 0 ou 1 « a ». Équivalent à a{0,1}
a+			On veut au moins un « a ». Équivalent à a{1,}
a*			On veut 0, 1 ou plusieurs « a ». Équivalent à a{0,}
*/

$masque_er01 = '/er?/'; //1 "e" suivi de 0 ou 1 "r"
$masque_er1 = '/er+/'; //1 "e" suivi d'au moins 1 "r"
$masque_majet10 = '/^[A-Z].{10,}\?$/'; //Une majuscule suivi d'au moins 10 caractères qui ne sont pas des \n (retour ligne)
$masque_10nb = '/^\d{10,10}$/'; //exactement et uniquement 10 chiffres

//// Les sous masques ( et ) sont capturants et prioritise la recherche
$masque_erout = '/er|t/'; //Chercher "er" ou "t"
$masque_eret = '/e(r|t)/'; //Cherche "er", "et", "r" et "t"
$masque_err = '/er{2}/'; //Cherche "e" suivi de "r" suivi de "r"
$masque_erer = '/(er){2}/'; //Cherche "er" suivi de "er"

//// Les assertions (avant, arrière, positive, négative) ne sont pas capturantes

/*______________________________
a(?=b)	Cherche « a » suivi de « b » (assertion avant positive)
a(?!b)	Cherche « a » non suivi de « b » (assertion avant négative)
(?<=b)a	Cherche « a » précédé par « b » (assertion arrière positive)
(?<!b)a	Cherche « a » non précédé par « b » (assertion arrière négative)
______________________________*/

$masque_er = '/e(?=r)/'; //Chercher "e" suivi de "r"
$masque_enonr = '/e(?!r)/'; //Chercher "e" non suivi de "r"
$masque_is = '/(?<=i)s/'; //Cherche "s" précédé de "i"
$masque_nonis = '/(?<!i)s/'; //Cherche "s" non précédé de "i"

//// Résumé des métacaractères en dehors des classes

/*______________________________
\		Caractère dit d’échappement ou de protection qui va servir notamment 
		à neutraliser le sens d’un métacaractère ou à créer une classe abrégée
[		Définit le début d’une classe de caractères
]		Définit la fin d’une classe de caractères
.		Permet de chercher n’importe quel caractère à l’exception du caractère de nouvelle ligne
|		Caractère d’alternative qui permet de trouver un caractère ou un autre
^		Permet de chercher la présence d’un caractère en début de chaine
$		Permet de chercher la présence d’un caractère en fin de chaine
?		Quantificateur de 0 ou 1. Peut également être utilisé avec « ( » pour en modifier le sens
+		Quantificateur de 1 ou plus
*		Quantificateur de 0 ou plus
{		Définit le début d’un quantificateur
}		Définit la fin d’un quantificateur
(		Début de sous masque ou d’assertion
)		Fin de sous masque ou d’assertion
______________________________*/

//
////////// LES OPTIONS OU MODIFICATEURS /.../option

/*______________________________
i		Rend la recherche insensible à la casse
m		La recherche s'effectue sur une seule ligne (jusqu'à un retour ligne \n ou retour chariot \r)
s		Cette option permet au métacaractère . de remplacer n’importe quel caractère 
		y compris un caractère de nouvelle ligne
x		Permet d’utiliser des caractères d’espacement dans nos masques qui seront ignorés sauf pour les séquences spéciales
u		Cette option permet de désactiver les fonctionnalités additionnelles de PCRE qui ne sont pas compatibles avec le langage Perl. Cela peut être très utile dans le cas où on souhaite exporter nos regex
______________________________*/

$masque_piecasse = '/pie/'; //cherche "pie" en minuscule
$masque_piepascasse = '/pie/i'; //cherche pie en min ou maj
$masque_ende = '/e$/'; //cherche "e" à la fin d'une chaine de caractère
$masque4_endeline = '/e$/m'; //"e" à la fin d'une ligne ou chaine
echo '<br>';

//
////////// EXEMPLE CONCRET POUR UN MOT DE PASSE DE FORMULAIRE
?>

<form action='coursPHP.php' method='post'>
	<label for='pass'>Choisissez un mot de passe.</label>
	<input type='password' name='pass' id='pass'>
	<br>
	<p>Note : Le mot de passe doit possèder au moins 8 caractères dont
	au moins une majuscule, un chiffre et un caractère spécial</p>
	<br>
	<input type='submit' value='Envoyer'>
</form>

<?php
$m = '/^\S*(?=\S{8,})(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/';
//on désire un mdp sans espaces, avec 8 caractères minimum, au moins 1 majuscule, 1 chiffre et 1 caractère spécial

if (isset($_POST['pass'])) {
  if (preg_match($m, $_POST['pass'])) {
    echo 'Le mot de passe choisi convient<br>';
  } else {
    echo 'Le mot de passe choisi ne répond pas aux critères<br>';
  }
}

/////////////////////////////////////////////////////////////
?>
<!-- ---------------------------------- -->
<h2>PROGRAMMATION ORIENTÉ OBJET EN PHP</h2>
<!-- ---------------------------------- -->
<?php
//
////////// CLASSES, INSTANCES ET OBJETS

// Une classe est un bloc de code qui va contenir différentes variables, fonctions et éventuellement constantes et qui va servir de plan de création pour différents objets.
require 'classes/malus.trait.php'; //déclaré ici pour plus tard
require 'classes/utilisateur.class.php';

require 'classes/utilisateur.interface.php'; //déclaré ici pour plus tard
$pierre_test = new Utilisateur_test();
//on crée une nouvelle instance (copie) de la classe Utilisateur_test qui va crée automatiquement un nouvel objet $pierre

/*__ utilisateur.class.php _____
class Utilisateur_test{
	public $user_name; //on déclare la propriété user_name
	public $user_pass; //public pour pouvoir le modifier en dehors de la class (dangereux)
}
______________________________*/

//
////////// PROPRIÉTÉS ET MÉTHODES

$mathilde_test = new Utilisateur_test();
$pierre_test->user_name = 'Pierre'; //l'opérateur objet permet d'accéder aux propriétés
$pierre_test->user_pass = 'abcdef';
$mathilde_test->user_name = 'Math';
$mathilde_test->user_pass = 123456;

/*__ utilisateur.class.php _____
class Utilisateur{
	private $user_name; //plus sécurisé, accessible seulement à l'intérieur de la classe
	private $user_pass;
	public function getNom(){ //on déclare une méthode accessible en dehors de la classe
		return $this->user_name; //pseudo variable qui correspond à l'objet utilisé
	}
	public function setNom($new_user_name){
		$this->user_name = $new_user_name;
	}
	public function setPasse($new_user_pass){
		$this->user_pass = $new_user_pass;
	}
}
______________________________*/

$pierre = new Utilisateur();
$mathilde = new Utilisateur();
$pierre->setNom('Pierre');
$mathilde->setNom('Math');
$pierre->setPasse('abcdef');
$mathilde->setPasse('123456');

echo $pierre->getNom() . '<br>';
echo $mathilde->getNom() . '<br>';

//
////////// LA MÉTHODE CONSTRUCTEUR

/*__ utilisateur.class.php _____
class User{
	private $user_name;
	private $user_pass;
	public function __construct($n, $p){ //méthode exécuté à la création d'un nouvel objet
		$this->user_name = $n;
		$this->user_pass = $p;
	}
	public function getNom(){
		return $this->user_name;
	}
}
______________________________*/

$pierre = new User('Pierre', 'abcdef');
$mathilde = new User('Math', 123456);
//$pierre = new User($_POST['nom'], $_POST['pass']); cas réel d'un formulaire
echo '<br>';

// la fonction __destruct() sert à exécuter du code avant la destruction d'un objet

//
////////// ENCAPSULATION (groupement des données au sein d'une classe)

/*__ Niveaux de visibilité _____
public= accessible partout (par défaut pour les méthodes et constantes)
private = accessible seulement à l'intérieur de la classe
protected = à l'intérieur + héritage ou parent
______________________________*/

//
////////// CLASSES ÉTENDUES ET HÉRITAGE

/*__ admin.class.php ___________
class Admin extends User{}
______________________________*/

//Une classe ne peut étendre qu'une seule classe parent, impossible d'étendre plusieurs autres classes

require 'classes/admin.class.php'; //Admin est une classe "enfant" de User
$philadmin = new Admin('Phil', 'coucou'); //on utilise le construct du parent User car il est public
echo $philadmin->getNom() . '<br>';

/*__ admin.class.php ___________
class Admin extends User{
	public function getNom2(){ //nouvelle méthode
		return $this->user_name; //user_name est private dans User donc inaccessible
	}
	public function getNom(){ //on surcharge la méthode de User, elles sera donc utilsée par $phil
		return $this->user_name; //mais $user_name toujours inaccessible
	}
} //ces méthodes ne pourront pas marcher
______________________________*/

/*__ utilisateur.class.php _____
class User{
	protected $user_name; //protected pour que Admin puisse y accéder
	protected $user_pass;
	...
}//Les méthodes de Admin pourront ainsi marcher
______________________________*/

/*__ admin.class.php ___________
class Admin extends User{
	protected $ban;
  public function setBan($b) //création d'un tableau des bannis
  {
    $this->ban[] .= $b;
  }
  public function getBan()
  {
    echo "Utilisateurs bannis par " . $this->user_name . " : ";
    foreach ($this->ban as $valeur) {
      echo $valeur . ", ";
...
______________________________*/

$philadmin->setBan('Gontran'); //on bannit Gontran
$philadmin->setBan('Gaël');
echo $philadmin->getBan(); //Utilisateurs bannis par Phil : Gontran, Gaël,
echo '<br>';

////////// SURCHARGE ET OPÉRATEUR DE RÉSOLUTION DE PORTÉE ::

//surcharger = redéclarer une fonction parent avec le même nombre de paramètres

/*__ admin.class.php ___________
class Admin extends User{
	protected $ban;
	public function getNom(){ //on surcharge getNom()
		return strtoupper($this->user_name); //nom en majuscule
	}
	public function __construct($n, $p){ //on surcharge la méthode __construct
		$this->user_name = strtoupper($n); //nom directement en majuscule
		$this->user_pass = $p;
...
______________________________*/

echo $philadmin->getNom() . '<br>'; //PHIL en majuscule car $philadmin est un objet de classe Admin
$valadmin = new Admin('Valerie', 'valoche'); //nom directement en majuscule avec la surcharge construct
echo $valadmin->getNom() . '<br>';

//// parent::

/*__ utilisateur.class.php _____
class User{
	...
	public function getNom()
  {
    echo $this->user_name; 
  } //echo à la place du return pour permettre l'exécution du code après l'instruction
	...
}//Les méthodes de Admin pourront ainsi marcher
______________________________*/

/*__ admin.class.php ___________
class Admin extends User{
	...
	public function getNom(){
		parent::getNom(); //on appelle la méthode du parent (User)
		echo ' (depuis la classe étendue)<br>'; 
	} //on peut rajouter des instruction grâce à la suppression du return
...
______________________________*/

//
////////// LES CONSTANTES DE CLASSE

// self:: on utilise la constante de la classe en cours d'utilisation

/*__ utilisateur.class.php _____
class UserAbo
{
  protected $prix_abo;
  protected $user_cat;
  public const ABONNEMENT = 15;

  public function __construct($n, $p, $c)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_cat = $c;
  }
  public function setPrixAbo()
  {
    if ($this->user_cat === "mineur") {
      return $this->prix_abo = self::ABONNEMENT / 2; //correspond à utilisateur::ABONNEMENT
    } else {
      return $this->prix_abo = self::ABONNEMENT;
    }
  }
  public function getPrixAbo()
  {
    echo $this->prix_abo;
...
______________________________*/

// parent:: on utilise la constante de la classe parent

/*__ admin.class.php ___________
class AdminAbo extends UserAbo
{
  public const ABONNEMENT = 5; //surcharge en donnant une nouvelle valeur
  public function __construct($n, $p, $c)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
    $this->user_cat = $c;
  }
  public function setPrixAbo()
  {
    if ($this->user_cat === "mineur") {
      return $this->prix_abo = self::ABONNEMENT; //valeur dans AdminAbo
    } else {
      return $this->prix_abo = parent::ABONNEMENT / 2; //valeur dans UserAbo
...
______________________________*/

$marcAdminAbo = new AdminAbo('Marc', 'loremipsum', 'majeur');
$julieAdminAbo = new AdminAbo('Julie', 'jujufitcats', 'mineur');
$lucAbo = new UserAbo('Luc', 'culcul', 'majeur');

$marcAdminAbo->setPrixAbo(); //dans AdminAbo pour majeur (7.5)
$julieAdminAbo->setPrixAbo(); //dans AdminAbo pour mineur (5)
$lucAbo->setPrixAbo(); //dans UserAbo pour majeur (15)

echo 'ABONNEMENT dans UserAbo : ' . UserAbo::ABONNEMENT . '<br>'; //15
echo 'ABONNEMENT dans AdminAbo : ' . AdminAbo::ABONNEMENT . '<br>'; //5
echo 'Prix pour ';
$marcAdminAbo->getNom();
echo ' : ';
$marcAdminAbo->getPrixAbo(); //Prix pour MARC (admin) : 7.5

echo '<br>Prix pour ';
$julieAdminAbo->getNom();
echo ' : ';
$julieAdminAbo->getPrixAbo(); //Prix pour JULIE (admin) : 5

echo '<br>Prix pour ';
$lucAbo->getNom();
echo ' : ';
$lucAbo->getPrixAbo(); //Prix pour Luc : 15
echo '<br>';

//
////////// LES PROPRIÉTÉS ET MÉTHODES STATIQUES

// Une propriété statique est une propriété dont la valeur va pouvoir être modifiée et qui va être partagée par tous les objets de la classe, enfants et parents.
// On ne peut pas accéder à une propriété statique depuis un objet avec -> mais avec ::

/*__ admin.class.php ___________
class AdminAbo extends UserAbo
{
  protected static $ban; //static pour que la variable soit partagée à tous les objets de la classe AdminAbo
	public function setBan(...$b) //pour accepter un nombre variable d'arguments
  {
    foreach($b as $banned){
			self::$ban[] .= $banned; //$ban appartient maintenant à une classe et plus à un objet en particulier
		}
  }
  public function getBan()
  {
    echo 'Utilisateurs bannis: ';
    foreach (self::$ban as $valeur) { //on utilise ici aussi l'opérateur de résolution de portée ::
      echo $valeur . ', ';
...
______________________________*/

//Marc et Julie sont Admin, Luc est simple utilisateur
$marcAdminAbo->setBan('Titouan', 'Engène');
$julieAdminAbo->setBan('Estelle');
$marcAdminAbo->getBan(); //Utilisateurs bannis: Titouan, Engène, Estelle,
echo '<br>';
$julieAdminAbo->getBan(); //pareil car $ban est partagé
echo '<br>';

//
////////// LES MÉTHODES ET CLASSES ABSTRAITES

//Une méthode abstraite est vide et ne contient pas de code, elle sert à faire un plan directeur pour les classes étendues dans lesquelles on pourra ensuite ajouter du code en fonction des besoins.
//Une classe abstarite est une classe qui possède une méthode abstraite.

/*__ utilisateur.class.php _____
abstract class UserAbs //on définit la classe abstraite
{
  public const ABONNEMENT = 15;

  abstract public function setPrixAbo(); //méthode abstraite vide de code
	//cette méthode abstraite sera utilisée différemment (prix diff.) dans les différentes classes étendues
	...
______________________________*/

/*__ admin.class.php ___________
class AdminAbs extends UserAbs
{
  public function __construct($n, $p, $a)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
    $this->user_age = $a;
  }

  public function setPrixAbo() //on implémente ici la méthode abstraite pour cette classe étendue
  {
    if ($this->user_age === 'mineur') {
      return $this->prix_abo = parent::ABONNEMENT / 6;
    } else {
      return $this->prix_abo = parent::ABONNEMENT / 3;
...
______________________________*/

require 'classes/abonne.class.php';

/*__ abonne.class.php __________
class SubAbs extends UserAbs
{
  public function __construct($n, $p, $a)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_age = $a;
  }

  public function setPrixAbo() //nouvelle implémentation de la méthode pour les abonnés
  {
    if ($this->user_region === 'Sud') {
      return $this->prix_abo = parent::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = parent::ABONNEMENT;
...
______________________________*/

$marcAdminAbs = new AdminAbs('Marc', 'mdp123', 'majeur');
$sophieAdminAbs = new AdminAbs('Sophie', 'sosomanes', 'mineur');
$michelSubAbs = new SubAbs('Michel', 'foufou', 'mineur');

$marcAdminAbs->setPrixAbo(); //enregistre une valeur $prix_abo pour Marc
$sophieAdminAbs->setPrixAbo();
$michelSubAbs->setPrixAbo();

echo '<br>Abo pour ';
$marcAdminAbs->getNom();
echo ' : ';
$marcAdminAbs->getPrixAbo(); //Abo pour MARC : 5
echo '<br>Abo pour ';
$sophieAdminAbs->getNom();
echo ' : ';
$sophieAdminAbs->getPrixAbo(); //Abo pour SOPHIE : 2.5
echo '<br>Abo pour ';
$michelSubAbs->getNom();
echo ' : ';
$michelSubAbs->getPrixAbo(); //Abo pour Michel : 7.5
echo '<br>';

//
////////// LES INTERFACES

//Comme les classes abstraites, c'est un plan général pour créer des classes dérivées
//Pas de propriétés (variables) mais uniquement des signatures de méthodes et des constantes
//Une classe peut implémenter plusieurs interfaces
//Toutes les méthodes de l'interface appelée sont abstraites et publiques et doivent être obligatoirement implémentées

/*__ utilisateur.interface.php __
interface UserInt
{
  public const ABONNEMENT = 15;
  public function getNom();
  public function setPrixAbo();
  public function getPrixAbo();
}
//On peut également étendre des interfaces
//exemple: interface UserEx extends UserInt
______________________________*/

/*__ abonne.class.php __________
class SubInt implements UserInt //on implémente UserInt
{... //il faut implément toutes les méthodes de l'interface
______________________________*/

/*__ admin.class.php ___________
class AdminInt implements UserInt
{...
______________________________*/

//require 'classes/utilisateur.interface.php'; ne pas oublier de le déclarer plus haut (1100)

$sophieInt = new AdminInt('Sophie', 'sosoma', 'mineur');
$sophieInt->setPrixAbo();
echo 'Abo pour ';
$sophieInt->getNom();
echo ' : ';
$sophieInt->getPrixAbo(); //Abo pour SOPHIE : 2.5
echo '<br>';

//si plusieurs classes possèdent des similarités -> classe parent abstraite
//si les méthodes doivent être implémentées de manières différentes -> interface

//
////////// LES MÉTHODES MAGIQUES (appelées automatiquement)

//// __construct() et __destruct()

//Le constructeur est utile pour initialiser les valeurs dont un objet a besoin dès sa création et avant toute utilisation de celui-ci. Il est appelé dès qu’on va instancier une classe.
//Le destructeur va nous servir à « nettoyer » le code en détruisant un objet une fois qu’on a fini de l’utiliser. Utile pour sauvegarder des dernières valeurs de l’objet dans une base de données, fermer la connexion à une base de données, etc. juste avant que celui-ci soit détruit.

//// __call() et __callStatic()

//appelées si une méthode est innaccessible dans un contexte objet ou static

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  public function __call($methode, $arg){
		echo 'Méthode ' .$methode. ' inaccessible depuis un contexte objet.
		<br>Arguments passés : ' .implode(', ', $arg). '<br>';
	}
	public static function __callStatic($methode, $arg){
		echo 'Méthode ' .$methode. ' inaccessible depuis un contexte statique.
		<br>Arguments passés : ' .implode(', ', $arg). '<br>';
...
______________________________*/

echo '<br>';
$marcAdminAbs->test1('argument1');
AdminAbs::test2('arg1', 'arg2');
echo '<br>';

//// __get(), __set(), __isset() et __unset()

//__get() s'exécute si on tente d’accéder à une propriété inaccessible
//__set() s’exécute dès qu’on tente de créer une propriété inaccessible

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  public function __get($prop){
		echo 'Propriété ' .$prop. ' inaccessible.<br>';
	}
	public function __set($prop, $valeur){
		echo 'Impossible de mettre à jour la valeur de ' .$prop. ' avec "'
		.$valeur. '" (propriété inaccessible)';
...
______________________________*/

$marcAdminAbs->prixAbo; //inaccessible car protected
$marcAdminAbs->prixAbo = 20;
echo '<br><br>';

//__isset() s’exécute lorsque les fonctions isset(variable définie ou NULL?) ou empty(variable vide?) sont appelées sur des propriétés inaccessibles.
//__unset() s’exécute lorsque la fonction unset(détruit une variable) est appelée sur des propriétés inaccessibles.

//// __toString()

//appelée quand on va traiter un objet comme une chaine de caractères

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  public function __toString(){
		return 'Nom d\'utilisateur : ' .$this->user_name. '<br>
		Prix de l\'abonnement : ' .$this->prix_abo. '<br><br>';
...
______________________________*/

echo $marcAdminAbs;

//on echo un objet qui va être transformé en string

////__invoke()

//s'exécute quand on tente d’appeler un objet comme une fonction

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  public function __invoke($arg){
		echo 'Un objet a été utilisé comme une fonction.
		<br>Argument passé : ' .$arg. '<br><br>';
...
______________________________*/

$marcAdminAbs(1234);

//// __clone()

//s’exécute dès que l’on crée un clone d’un objet pour le nouvel objet créé.

/////////////////////////////////////////////////////////////
//
?>
<!-- --------------------- -->
<h2>PHP: NOTIONS AVANCÉES</h2>
<!-- --------------------- -->
<?php //


//
////////// CHAINAGE DE MÉTHODES

//$objet->methode1()->methode2()

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  protected $x = 0;
	public function plusUn()
  {
    $this->x++;
    echo '$x vaut ' . $this->x . '<br>';
    return $this;
  }
  public function moinsUn()
  {
    $this->x--;
    echo '$x vaut ' . $this->x . '<br>';
    return $this;
  }
...
______________________________*/

$marcAdminAbs->plusUn()->plusUn()->plusUn()->moinsUn();
//$x vaut 1, 2, 3, 2

//
////////// LES CLASSES ANONYMES

//// La classe Closure

//$variable = function(anonyme){} la variable devient un objet de la classe prédéfinie Closure. On peut ainsi utiliser la méthode magique __invoke() en se servant de l'objet comme d'une fonction: $variable(argument)
$squared = function (float $x) {
  return 'Le carré de ' . $x . ' est ' . $x ** 2 . '<br>';
};
echo $squared(3); //On invoque la fonction avec la variable objet

//// Les classes anonymes

//On crée une classe anonyme qu'on stocke dans une variable objet
$anonyme = new class {
  public $user_name;
  public const BONJOUR = 'Bonjour ';

  public function setNom($n)
  {
    $this->user_name = $n;
  }
  public function getNom()
  {
    return $this->user_name;
  }
};
$anonyme->setNom('Pierre');
echo $anonyme::BONJOUR;
echo $anonyme->getNom();
echo '<br><br>';

//Affiche les infos de $anonyme
var_dump($anonyme); //object(class@anonymous)#16 (1) { ["user_name"]=> string(6) "Pierre" }

//// En passant par une fonction

function creation_classe_anonyme()
{
  return new class {
    //description classe anonyme
  };
}
$anonymefct = creation_classe_anonyme();
echo '<br>';

//// En utilisant le constructeur

function anonyme_construct($n)
{
  return new class ($n) {
    public $user_name;
    public const BONJOUR = 'Bonjour ';
    public function __construct($n)
    {
      $this->user_name = $n;
    }
    public function getNom()
    {
      return $this->user_name;
    }
  };
}
//On stocke le résultat de la fonction dans une variable objet
$anonyme_cst = anonyme_construct('Pierre');
echo $anonyme_cst::BONJOUR;
echo $anonyme_cst->getNom();
echo '<br><br>';

//// Classe anonyme imbriquée -> extends

class Externe
{
  private $age = 29;
  protected $nom = 'Pierre';
  public function anonyme_inside()
  {
    return new class ($this->age) extends Externe {
      private $a;
      private $n;

      public function __construct($age)
      {
        $this->a = $age;
      }
      public function getNomAge()
      {
        return 'Nom : ' . $this->nom . ', âge : ' . $this->a;
      }
    };
  }
}
$obj = new Externe();
echo $obj->anonyme_inside()->getNomAge();
echo '<br><br>';

//
////////// L'AUTO CHARGEMENT DES CLASSES

//permet d'importer automatiquement toutes les classes voulues
spl_autoload_register(function ($classe) {
  require 'classes/' . $classe . '.class.php';
});

//On importe ici les classes du dossier classes se terminant par .class.php

//
////////// FINAL

//mot clef final devant une fonction pour empêcher sa surcharge ou devant une classe pour empêcher de l'étendre

//
////////// LATE STATIC BINDINGS

//On utilise static à la place de self

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  public static function getStatut(){
		self::statut(); //mettre static à la place de self
	}
	public static function statut(){
		echo 'Utilisateur';
	}
...
______________________________*/

/*__ admin.class.php ___________
class AdminAbs extends UserAbs
{
	public static function statut(){
		echo 'Admin';
	}
...
______________________________*/

AdminAbs::getStatut();
echo '<br><br>'; //Utilisateur car renvoie à la fonction getStatut du parent UserAbs qui appelle UserAbs::statut()
//En mettant static::statut(), getStatut appellera le statut de l'objet utilisé.
echo '<br>';

//
////////// LES TRAITS

//des bouts de code que l'on peut utiliser dans n'importe quelle classe

/*__ malus.trait.php __________
trait Malus
{
  protected $malus;
  public function plusCinq()
  {
    $this->malus + 5;
    echo $this->malus . '<br>';
    return $this;
...
______________________________*/

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  use Malus; //comme si on copiait le trait Malus ici
...
______________________________*/

$marcAdminAbs->plusCinq()->plusCinq();

//5, 10
//L'objet peut utiliser les méthodes et propriétés de Malus
//Priorités en cas de même nom: Méthode Classe > Méthode Trait > Méthode Parent
// On peut appeler un trait dans un trait

//// insteadof et as si plusieurs traits utilisants un même nom de méthode sont appelés

/*__ utilisateur.class.php _____
abstract class UserAbs 
{
  use Malus, Bonus{
	Malus::plusCinq insteadof Bonus; //La méthode de Malus sera utilisée en cas de conflit
	Bonus::plusCinq as plus5; //On peut donner un alias temporaire à une méthode
	} 
...
______________________________*/

//
////////// INTERFACE ITERATOR

//// Parcourir les propriétés publiques d'un objet avec foreach

foreach ($marcAdminAbs as $clef => $valeur) {
  echo $clef . ' => ' . $valeur . '<br>';
} //pubvar1 => public variable 1 | pubvar2 => public variable 2
echo '<br>';

//// Les méthode de l'iterator: current, next, rewind, key et valid

class TestIter implements Iterator
{
  private $tableau = [];

  public function __construct(array $tb)
  {
    $this->tableau = $tb;
  }

  public function rewind(): void
  {
    //n'est appelée qu'une seule fois
    echo 'Retour au début du tableau<br>';
    reset($this->tableau); //revient au 1er élément du tableau
  }
  public function valid(): bool
  {
    //si false, on sort de la boucle
    $clef = key($this->tableau);
    $tableau = $clef !== null && $clef !== false;
    echo 'Valide : ';
    var_dump($tableau);
    echo '<br>';
    return $tableau;
  }
  //On utilise la fonction prédefinie current pour implémenter la méthode current
  public function current(): mixed
  {
    //renvoie la valeur courante
    $tableau = current($this->tableau);
    echo 'Elément actuel : ' . $tableau . '<br>';
    return $tableau;
  }
  public function key(): mixed
  {
    //renvoie la clef courante
    $tableau = key($this->tableau);
    echo 'Clef : ' . $tableau . '<br>';
    return $tableau;
  }
  public function next(): void
  {
    //avance le pointeur et renvoie la nouvelle valeur
    $tableau = next($this->tableau);
    echo 'Elément suivant : ' . $tableau . '<br>';
    // return $tableau;
  }
}
$tbtest = ['C1' => 'V1', 'C2' => 'V2', 'C3' => 'V3'];
$objetIter = new TestIter($tbtest);
foreach ($objetIter as $c => $v) {
  echo $c . ' => ' . $v . '<br><br>';
}
echo '<br>';
//Quand on utilise foreach avec un objet qui implémente l'interface Iterator, les fonctions vont être appelées dans un ordre défini

//
////////// LE PASSAGE D'OBJETS: IDENTIFIANTS ET RÉFÉRENCES

//// Rappel: passage des variables

$x = 1;
$y = $x; //passage par valeur, une copie de $x est créée
$z = &$y; //$z et $y sont liés, si $y change, $z changera aussi
$y = 2; //$y change et $z change car fait référence à la même valeur
//$z est un alias de $y

echo 'Valeur de $x : ' . $x . '<br>'; //1
echo 'Valeur de $y : ' . $y . '<br>'; //2
echo 'Valeur de $z : ' . $z . '<br>'; //2

//Passage par valeur

$a = 1;
function parValeur($valeur)
{
  $valeur = 5;
  echo 'Valeur dans la fonction : ' . $valeur . '<br>'; //5
}
parValeur($a);
echo 'Valeur de $a : ' . $a . '<br>'; //1 car portée limitée à la fonction

//Passage par référence

$b = 2;
function parReference(&$reference)
{
  $reference = 10;
  echo 'Valeur dans la fonction : ' . $reference . '<br>'; //10
}
parReference($b);
echo 'Valeur de $b : ' . $b . '<br>'; //10 car $b est lié à $reference
echo '<br>';

//// Passage d'objets

$denis = new Utilisateur();
$denis->setNom('Denis');
$carole = $denis; // carole et denis pointent vers le même objet
$carole->setNom('Carole'); //change aussi le nom de $denis
echo $denis->getNom() . '<br>'; //Carole
echo '<br>';
// Les variables d'objet agissent comme s'ils étaient passées par référence

var_dump($carole); //... "Carole" ...
echo '<br>';
function cestZero(&$obj)
{
  $obj = 0;
}
cestZero($carole); //$carole va prendre la valeur 0 car passage par référence
var_dump($carole); //int(0)
echo '<br>';
var_dump($denis); //... "Carole" ...
echo '<br>';

//
////////// CLONAGE D'OBJETS ET MÉTHODE MAGIQUE __CLONE()

// Au lieu d'assigner une variable d'objet qui va pointer vers le même objet, on peut cloner cette variable d'objet pour avoir une copie indépendante.

$denis->setNom('Denis');
$alex = clone $denis;
echo $alex->getNom(); //Denis
echo '<br>';
$alex->setNom('Alex');
echo $alex->getNom(); //Alex
echo '<br>';
echo $denis->getNom(); //Denis
echo '<br>';

//On peut paramétrer la méthode clone dans la class

/*__ utilisateur.class.php _____
class Utilisateur 
{
  public function __clone(){
		$this->nom = $this->nom. ' (clone)'; //affichera Denis (clone)
...
______________________________*/

//
////////// LA COMPARAISON D'OBJETS

// == true si mêmes attributs et valeurs et différentes instances de la même classe
// === true si mêmes attributs et valeurs et même instance de la même classe

$denis2 = new Utilisateur();
$denis2->setNom('Denis');
var_dump($denis == $alex); //false car user_name différents
var_dump($denis == $denis2); //true car user_name identiques
var_dump($denis === $denis2); //false car instances différentes

$denis3 = $denis2;
var_dump($denis2 === $denis3); //true car instance identique

$denisclone = clone $denis;
var_dump($denis == $denisclone); //true car user_name identiques
var_dump($denis === $denisclone); //false car instances différentes
echo '<br>';

//
////////// FORMAT JSON

//// Encoder un tableau en JSON
$arrayAge = ['Peter' => 35, 'Ben' => 37, 'Joe' => 43];
echo json_encode($arrayAge); // {"Peter":35,"Ben":37,"Joe":43}
echo '<br>';

//// Décoder en objet ou tableau
$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
var_dump(json_decode($jsonobj)); //object(stdClass)#1 (3) { ["Peter"]=> int(35) ["Ben"]=> int(37) ["Joe"]=> int(43) }
var_dump(json_decode($jsonobj, true)); //array(3) { ["Peter"]=> int(35) ["Ben"]=> int(37) ["Joe"]=> int(43) }
echo '<br>';

/////////////////////////////////////////////////////////////
//
?>
<!-- ----------------------------------------------- -->
<h2>ESPACES DE NOMS, FILTRES ET GESTION DES ERREURS</h2>
<!-- ----------------------------------------------- -->
<?php //


//
////////// ESPACES DE NOMS

//Pour résoudre la confusion entre deux noms de classes, interfaces, traits, fonctions ou constantes entre notre code et une extension PHP

include 'classes/exemple.namespace.php';
//doit être déclaré au tout début du fichier
/*__ exemple.namespace.php _____
namespace Exemple {
	include 'sousexemple.namespace.php';
	class UserNS{*code de la classe*};
	const VILLE = 'Paris';
	const PAYS = 'France';
	function bonjour(){echo 'Bonjour<br>';};

	bonsoir(); //Bonsoir global | tente d'appeler bonsoir() depuis l'espace courant, puis depuis l'espace global en cas d'échec
	bonjour(); //Bonjour
	\bonjour(); //Bonjour global | accède au bonjour() de l'espace global
	sous\bonjour(); //Sous Bonjour
	\exemple\sous\bonjour(); //Sous Bonjour

	//Commande namespace et constante magique __NAMESPACE__

	namespace\bonjour(); //Bonjour | accède au namespace courant
	echo 'Namespace: ' . __NAMESPACE__ . '<br>'; //Namespace: Exemple | accède au nom du namespace courant grâce à la constante magique

	//Instruction use et alias

	use Exemple\Sous; //Revient à écrire use Exemple\Sous as Sous
	use Exemple\Sous\UserNS as Sousutil; //Alias d'une classe
	use function Exemple\Sous\bonjour as ssbjr; //Alias d'une fonction
	use const Exemple\Sous\PAYS; //Importation d'une constante
	
	//Import et alias de plusieurs fonctions avec une instruction use
	use function Exemple\Sous\{bonsoir as ssbns, bonjour as ssbjr};
	
	var_dump($ssobj = new Sousutil()); //object(Exemple\Sous\UserNS)#26
  echo '<br>';
  ssbjr(); //Sous Bonjour
  echo PAYS; //Sous France
  echo '<br>';
  ssbsr(); //Sous Bonsoir
}
//Pour créer du code global en dehors d'un espace de nom défini
namespace {
	function bonsoir(){echo 'Bonsoir global<br>';};
	function bonjour(){echo 'Bonjour global<br>';};
	echo 'Namespace: ' . __NAMESPACE__ . '<br>'; //Namespace:  | n'affiche rien
}
______________________________*/

//Définir un sous-espace de nom

/*__ sousexemple.namespace.php _
namespace Exemple\Sous{
	class UserNS{*code*};
	const VILLE = 'Sous Paris';
	const PAYS = 'Sous France';
	function bonsoir(){echo 'Sous Bonsoir<br>';};
	function bonjour(){echo 'Sous Bonjour<br>';};
}
______________________________*/

//
////////// FILTRES PHP

/*______________________________
filter_list()				Retourne une liste de tous les filtres supportés
filter_id()					Retourne l’identifiant d’un filtre nommé
filter_input()			Récupère une variable externe et la filtre
filter_var()				Filtre une variable avec un filtre spécifique
filter_var_array()	Récupère plusieurs variables et les filtre
filter_input_array()Récupère plusieurs variables externes et les filtre
filter_has_var()		Vérifie si une variable d’un type spécifique existe
______________________________*/
echo '<br>Filtres PHP: <br>';
echo '<pre>';
print_r(filter_list());
echo '</pre>';

//// id numéroté de chaque filtre

echo '
	<table>
		<tr>
			<th>Nom du filtre</th>
			<th>Id numéroté</th>
		</tr>';
$filtres_tb = filter_list();
foreach ($filtres_tb as $clef => $nom) {
  echo '
		<tr>
			<td>' .
    $nom .
    '</td>
			<td>' .
    filter_id($nom) .
    '</td>
		</tr>';
}
echo '</table>';
echo '<br>';

//// Nettoyer

/*______________________________
FILTRE					ID NOM										ID NUM
email						FILTER_SANITIZE_EMAIL					517	
encoded					FILTER_SANITIZE_ENCODED				514	
magic_quotes		FILTER_SANITIZE_MAGIC_QUOTES	521	
number_float		FILTER_SANITIZE_NUMBER_FLOAT	520	
number_int			FILTER_SANITIZE_NUMBER_INT		519	
special_chars		FILTER_SANITIZE_SPECIAL_CHARS	515	
full_special_chars	FILTER_SANITIZE_FULL_SPECIAL_CHARS	522	
string					FILTER_SANITIZE_STRING				513	
stripped				FILTER_SANITIZE_STRIPPED			513	
url							FILTER_SANITIZE_URL						518	
unsafe_raw			FILTER_UNSAFE_RAW							516

Si le filtre est validé -> renvoie la variable nettoyée
Sinon -> renvoie false
______________________________*/

$texte = '<strong>Pierre</strong>, 29 ans';

echo $texte . '<br>';
echo filter_var($texte, FILTER_SANITIZE_NUMBER_INT) . '<br>'; //29
echo filter_var($texte, FILTER_SANITIZE_SPECIAL_CHARS) . '<br>'; //<strong>Pierre</strong>, 29 ans | affiche les balises html
/*echo filter_var($texte, FILTER_SANITIZE_STRING) . '<br>'; //annule la balise <strong> /!\ deprecated: utiliser htmlspecialchars()*/
echo '<br>';

//// Valider

/*______________________________
FILTRE					ID NOM										ID NUM
boolean					FILTER_VALIDATE_BOOLEAN		258	
validate_domain	FILTER_VALIDATE_DOMAIN		277	
validate_email	FILTER_VALIDATE_EMAIL			274	
float						FILTER_VALIDATE_FLOAT			259	
int							FILTER_VALIDATE_INT				257	
validate_ip			FILTER_VALIDATE_IP				275	 
validate_mac		FILTER_VALIDATE_MAC				276	
validate_regexp	FILTER_VALIDATE_REGEXP		272	
validate_url		FILTER_VALIDATE_URL				273

Si le filtre est validé -> renvoie la variable filtrée
Sinon -> renvoie false
______________________________*/

var_dump(filter_var(10, FILTER_VALIDATE_INT)); //int(10)
echo '<br>';
var_dump(filter_var('Coucou', FILTER_VALIDATE_FLOAT)); //bool(false)
echo '<br>';
var_dump(filter_var('jean@mail.com', FILTER_VALIDATE_EMAIL)); //string(13) "jean@mail.com"
echo '<br>';
var_dump(filter_var('https://jphindev.com', FILTER_VALIDATE_URL)); //string(20) "https://jphindev.com"
echo '<br>';
var_dump(filter_var('true', 258)); //bool(true) on utilise l'id numéroté
echo '<br>';

//// Options et drapeaux

var_dump(filter_var('Pierre', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)); //NULL | affiche null au lieu de false
echo '<br>';

var_dump(filter_var('127.0.0.1', FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)); //string(9) "127.0.0.1"
echo '<br>';

$options = ['options' => ['min_range' => 0, 'max_range' => 10]];
var_dump(filter_var(5, 257, $options)); //int(5) | 5 est bien compris entre 0 et 10

$strASCII = '<h1>Hello WorldÆØÅ!</h1>';
/*var_dump(filter_var($strASCII, FILTER_SANITIZE_STRING(/!\ DEPRECATED -> htmlspecialchars), FILTER_FLAG_STRIP_HIGH)); //enlèves les valeurs ASCII > 127*/
echo '<br><br><br>';

//// Cas pratique: formulaire HTML
?>
<form method='post' action='coursPHP.php'>
	<label for='ip'>IP:</label>
	<input type='text' id='ip' name='ip'><br>
	<label for='mail'>Mail:</label>
  <input type='mail' id='mail' name='mail'><br>
	<label for='url'>URL:</label>
  <input type='url' id='url' name='url'><br>
	<input type='submit' value='Envoyer'>
<!-- mettre type='text' pour contourner les blocages du navigateur -->
</form>
<?php //les inputs sont stockées dans la superglobale $_POST


//Vérification de l'IP
if (isset($_POST['ip'])) {
  if (filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP)) {
    echo $_POST['ip'] . ' est une IP valide <br>';
  } else {
    echo $_POST['ip'] . ' n\'est pas une IP valide <br>';
  }
}

//Vérification du mail
if (isset($_POST['mail'])) {
  //On nettoie l'input mail
  $mailnet = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
  echo 'Mail retenu : ' .
    $mailnet .
    '<br> Mail original : ' .
    $_POST['mail'] .
    '<br>';
  //On le valide avec filter_var car $mailnet est définie en interne
  if (filter_var($mailnet, FILTER_VALIDATE_EMAIL)) {
    echo $mailnet . ' est une adresse mail valide <br>';
  } else {
    echo $mailnet . ' n\'est pas une adresse mail valide <br>';
  }
}

//Vérification de l'URL
if (isset($_POST['url'])) {
  //filtre de nettoyage
  $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
  echo 'URL retenue : ' .
    $url .
    '<br> URL originale : ' .
    $_POST['url'] .
    '<br>';
  //filtre de validation
  if (filter_var($url, FILTER_VALIDATE_URL)) {
    echo $url . ' est une URL valide <br>';
  } else {
    echo $url . ' n\'est pas une URL valide <br>';
  }
}
echo '<br><br>';

//
////////// GESTION DES ERREURS

echo $nbr2; //erreur car variable non définie

//On peut configurer l'affichage d'une erreur
error_reporting(E_ALL); //pour récupérer toutes les erreurs
ini_set('display_errors', 0); //0: n'affiche rien dans le browser (plus sécurisé), 1: affiche les erreurs
function customErrorHandler($errno, $errstr, $errfile, $errline)
{
  $errMsg = "Erreur : [$errno]: $errstr - $errfile : $errline<br>";
  error_log($errMsg . PHP_EOL, 3, 'error_log.txt'); //les erreurs s'afficheront dans un fichier texte
}

set_error_handler('customErrorHandler');

echo '<br>';
echo $nbr3; //erreur avec affichage personnalisé
echo '<br>';

//
////////// GESTION DES EXCEPTIONS: TRY THROW CATCH (depuis PHP 5)
?>
<form action='coursPHP.php' method='post'>
	<label for='n1'>Numérateur :</label>
	<input type='number' id='n1' name='n1'><br>
	<label for='n2'>Dénominateur :</label>
	<input type='number' id='n2' name='n2'><br>
	<input type='submit' value='Envoyer'><br>
</form>
<?php
function division($x, $y)
{
  if ($y == 0) {
    //on crée un nouvel objet de la classe exception avec un message d'erreur et un numéro de code
    throw new Exception('Division par zéro impossible', 15);
    //l'erreur fatale va arrêter l'exécution du code s'il n'y a pas de catch
  } else {
    echo '<br>Résultat de' . $x . '/' . $y . ' : ' . $x / $y;
  }
}

//catch permet de ne pas bloquer le chargement de la page en cas d'erreur fatale
if (isset($_POST['n1']) && isset($_POST['n2'])) {
  try {
    //le code à surveiller
    division($_POST['n1'], $_POST['n2']);
  } catch (Exception $e) {
    //les actions à mener si une exception a été constatée
    echo 'Message d\'erreur : ' . $e->getMessage(); //le message défini
    echo '<br>';
    echo 'Code d\'erreur : ' . $e->getCode(); //le code défini (15)
    echo '<br>';
    echo 'Ligne : ' . $e->getLine(); //la ligne ddu throw
    echo '<br>';
    echo $e->getFile(); //le fichier concerné
  }
}
echo '<br><br>';

//// CLASSE ERROR ET INTERFACE THROWABLE (depuis PHP 7)

/*try {
  bonj(); //n'existe pas
} catch (Error $e) {
  echo $e->getMessage(); //Call to undefined function bonj()
}*/

echo '<br><br>';

try {
  if (!function_exists('test')) {
    throw new Error('La fonction n\'est pas définie');
  }
} catch (Error $e) {
  echo $e->getMessage(); //La fonction n'est pas définie
}
echo '<br><br>';

//// Finally

/*//On exécute un code quelle que soit la situation
try {
  bonj(); //n'existe pas
} finally {
  echo 'Toujours affiché';
}
echo 'Non affiché ici car exception lancée et non capturée';*/

/////////////////////////////////////////////////////////////
//
?>
<!-- ----------------------------- -->
<h2>EXEMPLE DE FORMULAIRE COMPLET</h2>
<!-- ----------------------------- -->
<?php //


// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = '';
$name = $email = $gender = $comment = $website = '';

// Nettoyage des données
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Validation des données
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = test_input($_POST['name']);
    // check if name only contains letters and whitespace with regex
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $nameErr = 'Only letters and white space allowed';
    }
  }

  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = test_input($_POST['email']);
    // check if e-mail address is well-formed with filter
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'Invalid email format';
    }
  }

  if (empty($_POST['website'])) {
    $website = '';
  } else {
    $website = test_input($_POST['website']);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (
      !preg_match(
        '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
        $website
      )
    ) {
      $websiteErr = 'Invalid URL';
    }
  }

  if (empty($_POST['comment'])) {
    $comment = '';
  } else {
    $comment = test_input($_POST['comment']);
  }

  if (empty($_POST['gender'])) {
    $genderErr = 'Gender is required';
  } else {
    $gender = test_input($_POST['gender']);
  }
}
?>

<h3>PHP Form Validation Example</h3>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars(
  $_SERVER['PHP_SELF']
); ?>">

	<!-- On sauvegarde la value de chaque input pour ne pas tout effacer en cas d'erreur -->
  Name: <input type="text" name="name" value="<?php echo $name; ?>">
  <span class="error">* <?php echo $nameErr; ?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
  <span class="error">* <?php echo $emailErr; ?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website; ?>">
  <span class="error"><?php echo $websiteErr; ?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
  <br><br>
  Gender:
	<!-- On sauvegarde le statut du bouton sélectionné avec checked -->
  <input type="radio" name="gender" <?php if (
    isset($gender) &&
    $gender == 'female'
  ) {
    echo 'checked';
  } ?> value="female">Female
  <input type="radio" name="gender" <?php if (
    isset($gender) &&
    $gender == 'male'
  ) {
    echo 'checked';
  } ?> value="male">Male
  <input type="radio" name="gender" <?php if (
    isset($gender) &&
    $gender == 'other'
  ) {
    echo 'checked';
  } ?> value="other">Other  
  <span class="error">* <?php echo $genderErr; ?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo '<h3>Your Input:</h3>';
echo $name;
echo '<br>';
echo $email;
echo '<br>';
echo $website;
echo '<br>';
echo $comment;
echo '<br>';
echo $gender;
?>

?>
		<p id="signet">_____</p>
	</body>
</html>
