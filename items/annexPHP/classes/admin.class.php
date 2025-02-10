<?php

class AdminAbs extends UserAbs
{
  protected static $ban;
  public $pubvar1 = 'public variable 1';
  public $pubvar2 = 'public variable 2';

  public function __construct($n, $p, $a)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
    $this->user_age = $a;
  }

  public function setBan(...$b)
  {
    foreach ($b as $banned) {
      self::$ban[] .= $banned;
    }
  }
  public function getBan()
  {
    echo 'Utilisateurs bannis : ';
    foreach (self::$ban as $valeur) {
      echo $valeur . ', ';
    }
  }

  public function setPrixAbo()
  {
    if ($this->user_age === 'mineur') {
      return $this->prix_abo = parent::ABONNEMENT / 6;
    } else {
      return $this->prix_abo = parent::ABONNEMENT / 3;
    }
  }

  public static function statut()
  {
    echo 'Admin';
  }
}

//

class AdminInt implements UserInt
{
  protected $user_name;
  protected $user_age;
  protected $prix_abo;
  protected $user_pass;
  protected static $ban;

  public function __construct($n, $p, $a)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
    $this->user_age = $a;
  }

  public function getNom()
  {
    echo $this->user_name;
  }
  public function getPrixAbo()
  {
    echo $this->prix_abo;
  }

  public function setBan(...$b)
  {
    foreach ($b as $banned) {
      self::$ban[] .= $banned;
    }
  }
  public function getBan()
  {
    echo 'Utilisateurs bannis : ';
    foreach (self::$ban as $valeur) {
      echo $valeur . ', ';
    }
  }

  public function setPrixAbo()
  {
    if ($this->user_age === 'mineur') {
      return $this->prix_abo = UserInt::ABONNEMENT / 6;
    } else {
      return $this->prix_abo = UserInt::ABONNEMENT / 3;
    }
  }
}

//

class AdminAbo extends UserAbo
{
  protected static $ban;
  public const ABONNEMENT = 5;
  public $test123 = 'test réussi';

  public function __construct($n, $p, $c)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
    $this->user_cat = $c;
  }

  public function getNom()
  {
    parent::getNom();
    echo ' (admin)';
  }

  public function setBan(...$b)
  {
    foreach ($b as $banned) {
      self::$ban[] .= $banned;
    }
  }

  public function getBan()
  {
    echo 'Utilisateurs bannis: ';
    foreach (self::$ban as $valeur) {
      echo $valeur . ', ';
    }
  }

  public function setPrixAbo()
  {
    if ($this->user_cat === 'mineur') {
      return $this->prix_abo = self::ABONNEMENT;
    } else {
      return $this->prix_abo = parent::ABONNEMENT / 2;
    }
  }
}

//

class Admin extends User
{
  protected $ban;

  public function __construct($n, $p)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
  }

  public function getNom()
  {
    parent::getNom();
    echo ' (depuis la classe étendue)<br>';
  }

  public function setBan($b)
  {
    $this->ban[] .= $b;
  }

  public function getBan()
  {
    echo 'Utilisateurs bannis par ' . $this->user_name . ' : ';
    foreach ($this->ban as $valeur) {
      echo $valeur . ', ';
    }
  }
}
