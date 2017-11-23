<?php
// file: model/User.php
require_once(__DIR__."/../core/ValidationException.php");
/**
* Class User
*
* Represents a User in the blog
*
* @author lipido <lipido@gmail.com>
*/
class Usuario {

  private $IdUsuario;
	private $login;
	private $password;
  private $email;
  private $confirmar;

  /*
      Constructor del Usuario
    */
    public function __construct($IdUsuario=NULL,$login= NULL, $password=NULL, $email=NULL  ) {
      $this->IdUsuario = $IdUsuario;
      $this->login = $login;
      $this->password = $password;
      $this->email= $email;


    }
    public function getIdUsuario() {
      return $this->IdUsuario;
    }
    public function setIdUsuario($idUsuario) {
      $this->IdUsuario = $IdUsuario;
    }

    public function getLogin() {
      return $this->login;
    }
    public function setLogin($login) {
      $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
      return $this->email;
    }
    public function setEmail($email) {
      $this->email = $email;
    }



	public function checkIsValidForRegister() {
		$errores = array();

    if (strlen($this->login) < 4) {
      $errores["login"] = i18n("El nombre de usuario debe tener al menos 4 caracteres");
    /*  $error = i18n("El nombre de usuario debe tener al menos 4 caracteres");
      header("Location: ../views/error.php?error=$error");*/
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errores ["email"]= i18n("La dirección de email introducida no es válida");
    /*  $error= i18n("La contraseña debe tener al menos 5 caracteres");
      header("Location: ../views/error.php?error=$error");*/
    }

    if (strlen($this->password) < 5) {
      $errores["password"] = i18n("La contraseña debe tener al menos 5 caracteres");
      /*$error= i18n("La contraseña debe tener al menos 5 caracteres");
      header("Location: ../views/error.php?error=$error");*/
    }

    if ($password!=$confirmar) {
        $errores["confirmar"]= i18n("Las contraseñas no coinciden. Por favor, inténtelo de nuevo");
        /*  $error= i18n("Las contraseñas no coinciden. Por favor, inténtelo de nuevo");
        header("Location: ../views/error.php?error=$error");*/
    }



		if (sizeof($errores)>0){
			throw new ValidationException($errores, i18n("El usuario no es válido"));
		}
	}
}
