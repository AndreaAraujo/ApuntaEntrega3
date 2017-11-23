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


		public function findAll() {
				$stmt = $this->db->query("SELECT * FROM nota, usuario WHERE usuario.IdUsuario = nota.Usuario_idUsuario");
				$notas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$notas = array();
				foreach ($notas_db as $nota) {
					$Usuario_idUsuario = new User($nota["IdUsuario"]);
					array_push($notas, new Post($nota["IdNota"], $nota["nombre"], $nota["contenido"], $Usuario_idUsuario));
				}
				return $notas;
			}

			public function findById($idNota){
			$stmt = $this->db->prepare("SELECT * FROM nota WHERE IdNota=?");
			$stmt->execute(array($idNota));
			$nota = $stmt->fetch(PDO::FETCH_ASSOC);
			if($nota != null) {
				return new Nota(
				$nota["IdNota"],
				$nota["nombre"],
				$nota["contenido"],
				new Usuario($nota["Usuario_idUsuario"]));
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
			$stmt->execute(array($nota->getIdNota(),$nota->getNombre(), $nota->getContenido() ));
		}

    public function delete(Nota $nota) {
			$stmt = $this->db->prepare("DELETE from nota WHERE IdNota=?");
			$stmt->execute(array($nota->getIdNota()));
		}
}
