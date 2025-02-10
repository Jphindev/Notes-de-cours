<?php
class SubInt implements UserInt
{
  protected $user_name;
  protected $user_age;
  protected $prix_abo;
  protected $user_pass;

  public function __construct($n, $p, $a)
  {
    $this->user_name = $n;
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

  public function setPrixAbo()
  {
    if ($this->user_age === 'mineur') {
      return $this->prix_abo = UserInt::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = UserInt::ABONNEMENT;
    }
  }
}

//

class SubAbs extends UserAbs
{
  public function __construct($n, $p, $a)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_age = $a;
  }

  public function setPrixAbo()
  {
    if ($this->user_age === 'mineur') {
      return $this->prix_abo = parent::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = parent::ABONNEMENT;
    }
  }
}
