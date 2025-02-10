<?php
abstract class UserAbs
{
  use Malus;
  protected $user_name;
  protected $user_age;
  protected $prix_abo;
  protected $user_pass;
  protected $x = 0;
  public const ABONNEMENT = 15;

  abstract public function setPrixAbo();

  public function getNom()
  {
    echo $this->user_name;
  }
  public function getPrixAbo()
  {
    echo $this->prix_abo;
  }

  //Méthodes magiques

  public function __call($methode, $arg)
  {
    echo 'Méthode ' .
      $methode .
      ' inaccessible depuis un contexte objet.
		<br>Arguments passés : ' .
      implode(', ', $arg) .
      '<br>';
  }
  public static function __callStatic($methode, $arg)
  {
    echo 'Méthode ' .
      $methode .
      ' inaccessible depuis un contexte statique.
		<br>Arguments passés : ' .
      implode(', ', $arg) .
      '<br>';
  }

  public function __get($prop)
  {
    echo 'Propriété ' . $prop . ' inaccessible.<br>';
  }
  public function __set($prop, $valeur)
  {
    echo 'Impossible de mettre à jour la valeur de ' .
      $prop .
      ' avec "' .
      $valeur .
      '" (propriété inaccessible)';
  }

  public function __toString()
  {
    return 'Nom d\'utilisateur : ' .
      $this->user_name .
      '<br>
		Prix de l\'abonnement : ' .
      $this->prix_abo .
      '<br><br>';
  }

  public function __invoke($arg)
  {
    echo 'Un objet a été utilisé comme une fonction.
		<br>Argument passé : ' .
      $arg .
      '<br><br>';
  }

  //Chainage de méthodes

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

  //Late static binding

  public static function getStatut()
  {
    static::statut();
  }
  public static function statut()
  {
    echo 'Utilisateur';
  }
}

//

class UserAbo
{
  protected $user_name;
  protected $user_pass;
  protected $prix_abo;
  protected $user_cat;
  public const ABONNEMENT = 15;

  public function __construct($n, $p, $c)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_cat = $c;
  }

  public function getNom()
  {
    echo $this->user_name;
  }

  public function setPrixAbo()
  {
    if ($this->user_cat === 'mineur') {
      return $this->prix_abo = self::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = self::ABONNEMENT;
    }
  }

  public function getPrixAbo()
  {
    echo $this->prix_abo;
  }
}

//

class User
{
  protected $user_name;
  protected $user_pass;

  public function __construct($n, $p)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
  }

  public function getNom()
  {
    echo $this->user_name;
  }
}

//

class Utilisateur
{
  private $user_name;
  private $user_pass;

  public function getNom()
  {
    return $this->user_name;
  }

  public function setNom($new_user_name)
  {
    $this->user_name = $new_user_name;
  }

  public function setPasse($new_user_pass)
  {
    $this->user_pass = $new_user_pass;
  }
}

//

class Utilisateur_test
{
  public $user_name;
  public $user_pass;
}
