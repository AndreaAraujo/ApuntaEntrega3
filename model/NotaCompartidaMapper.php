<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../model/NotaCompartida.php");

class NotaMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
  	}

    public function findByIdNotaC($idNotaC){
    $stmt = $this->db->prepare("SELECT U.IdUsuario, U.login, U.password,U.email FROM notas_compartidas C, usuario U WHERE C.idUsu = U.idUsuario and  C.idNota=?");
    $stmt->execute(array($idNotaC));
    $usuC = $stmt->fetch(PDO::FETCH_ASSOC);
    if($usuC != null) {
        return new Usuario(
      $usuC["IdUsuario"],
      $usuC["login"],
      $usuC["password"],
      $usuC["email"]
      );
    } else {
      return NULL;
    }
  }

  public function devolverNotaC($idNotaC){
    $stmt = $this->db->prepare("SELECT * FROM notas_compartidas WHERE idNota=?");
    $stmt->execute(array($idNotaC));
    $notaC = $stmt->fetch(PDO::FETCH_ASSOC);
    if($notaC != null) {
  
        return new NotaCompartida(
      $notaC["idUsu"],
      $notaC["idNotaC"]
      );
    } else {
      return NULL;
    }
  }
  }
