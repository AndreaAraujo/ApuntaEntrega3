<?php
require_once(__DIR__."/../core/ValidationException.php");

class NotaCompartida {

  private $idUsu;
  private $idNotaC;
  /*
      Constructor de la NOTA_compatida
    */
    public function __construct($idUsu=NULL,$idNotaC=NULL) {
      $this->idUsu = $idUsu;
      $this->idNotaC = $idNotaC;

    }

    public function getIdNotaCompartida() {
      return $this->idNotaC;
    }
    public function setIdNotaCompartida($idNotaC) {
      $this->idNotaC = $idNotaC;
    }

    public function getIdUsu() {
      return $this->idUsu;
    }
    public function setIdUsu($idUsu) {
      $this->idUsu = $idUsu;
    }
?>
