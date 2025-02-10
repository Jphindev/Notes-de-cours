<?php
trait Malus
{
  protected $malus = 0;

  public function plusCinq()
  {
    $this->malus += 5;
    echo 'Trait malus: ' . $this->malus . '<br>';
    return $this;
  }
}
