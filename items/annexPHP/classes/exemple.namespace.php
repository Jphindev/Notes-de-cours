<?php
namespace Exemple {
  include 'sousexemple.namespace.php';
  class UserNS
  {
    /*code de la classe*/
  }
  const VILLE = 'Paris';
  const PAYS = 'France';
  function bonjour()
  {
    echo 'Bonjour<br>';
  }

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
  use const Exemple\Sous\SOUSPAYS; //Importation d'une constante

  //Import et alias de plusieurs fonctions avec une instruction use
  use function Exemple\Sous\{bonsoir as ssbsr, bonjour as ssbjr};

  var_dump($ssobj = new Sousutil()); //object(Exemple\Sous\UserNS)#26 (0) { }
  echo '<br>';
  ssbjr(); //Sous Bonjour
  echo SOUSPAYS; //Sous France
  echo '<br>';
  ssbsr(); //Sous Bonsoir
}
//Pour créer du code global en dehors d'un espace de nom défini
namespace {
  function bonsoir()
  {
    echo 'Bonsoir global<br>';
  }
  function bonjour()
  {
    echo 'Bonjour global<br>';
  }
  echo 'Namespace: ' . __NAMESPACE__ . '<br>'; //Namespace:  | n'affiche rien
}
