<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
//require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Nota.php");
//require_once(__DIR__."/../model/Comment.php");

class NotaMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
  	}

    /*Cogemos todos los datos de una Nota buscandolo por su ID y devolvemos un objeto nota*/
    public static function findByIdNota($idNota){

    	$stmt = $this->db->prepare("SELECT * FROM nota WHERE IdNota=?");
      $stmt->execute(array($idNota));
	  	$nota = $stmt->fetch(PDO::FETCH_ASSOC);

      if($nota != null) {

          return  new Nota($row['IdNota'],$row['nombre'],$row['contenido']);

      } else {

          return NULL;
      }
    }


      public function save(Nota $nota) {
  			$stmt = $this->db->prepare("INSERT INTO nota(nombre,contenido,Usuario_idUsuario) values (?,?,?)");
  			$stmt->execute(array($nota->getNombre(), $nota->getContenido(), $nota->getUsuario_idUsuario()));
  			return $this->db->lastInsertId();
  		}

      public function update(Nota $nota) {
			$stmt = $this->db->prepare("UPDATE nota set nombre=?, contenido=? where IdNota=?");
			$stmt->execute(array($nota->getNombre(), $nota->getContenido(), $nota->getIdNota()));
		}

    public function delete(Nota $nota) {
			$stmt = $this->db->prepare("DELETE from nota WHERE IdNota=?");
			$stmt->execute(array($nota->getIdNota()));
		}
