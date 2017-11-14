<?php
// file: model/Post.php
require_once(__DIR__."/../core/ValidationException.php");


class Nota {
  private $idNota;
  private $nombre;
  private $contenido;
  private $Usuario_idUsuario;

    /*
      Constructor de la NOTA
    */
    public function __construct($idNota=NULL,$nombre=NULL, $contenido=NULL,Usuario $Usuario_idUsuario=NULL) {
      $this->idNota = $idNota;
      $this->nombre = $nombre;
      $this->contenido = $contenido;
      $this->Usuario_idUsuario = $Usuario_idUsuario;

    }

    public function getIdNota() {
      return $this->idNota;
    }
    public function setIdNota($idNota) {
      $this->idNota = $idNota;
    }

    public function getNombre() {
      return $this->nombre;
    }
    public function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    public function getContenido() {
      return $this->contenido;
    }
    public function setContenido($contenido) {
      $this->contenido = $contenido;
    }
    public function getUsuario_idUsuario() {
      return $this->Usuario_idUsuario;
    }
    public function setUsuario_idUsuario($Usuario_idUsuario) {
      $this->Usuario_idUsuario = $Usuario_idUsuario;
    }

    /*Comprobamos si se puede registrar la Nota. Si se puede retornamos un TRUE*/
      public static function registroValido($nombre,$contenido){
      $errores = array();
      $error;

      if (strlen($nombre) < 1 || strlen($nombre) > 50) {
       $errores["nombre"] = "El nombre de la Nota debe tener entre 3 y 50 caracteres";
       $error = i18n("El nombre de la Nota debe tener entre 3 y 50 caracteres");
       header("Location: ../views/error.php?error=$error");
      }
      if (strlen($contenido) < 1 || strlen($contenido) > 300) {
       $errores["contenido"] = "El contenido de la Nota debe tener entre 5 y 300 caracteres";
       $error = i18n("El contenido de la Nota debe tener entre 5 y 300 caracteres");
       header("Location: ../views/error.php?error=$error");
      }



      if (sizeof($error)==0){
       return true;
      }
      }



      public function checkIsValidForUpdate() {
    		$errors = array();
    		if (!isset($this->id)) {
    			$errors["id"] = "id is mandatory";
    		}
    		try{
    			$this->registroValido();
    		}catch(ValidationException $ex) {
    			foreach ($ex->getErrors() as $key=>$error) {
    				$errors[$key] = $error;
    			}
		      }
    		if (sizeof($errors) > 0) {
    			throw new ValidationException($errors, "post is not valid");
    		}
	      }
    }
