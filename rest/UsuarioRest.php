<?php
require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/UsuarioMapper.php");
require_once(__DIR__."/BaseRest.php");
/**
* Class UserRest
*
* It contains operations for adding and check users credentials.
* Methods gives responses following Restful standards. Methods of this class
* are intended to be mapped as callbacks using the URIDispatcher class.
*
*/
class UsuarioRest extends BaseRest {
	private $usuarioMapper;
	public function __construct() {
		parent::__construct();
		$this->usuarioMapper = new UsuarioMapper();
	}
	public function notaUsuario($data) {
		$usuario = new Usuario($data->login, $data->password);
		try {
			$usuario->checkIsValidForRegister();
			$this->usuarioMapper->save($usuario);
			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');
			header("Location: ".$_SERVER['REQUEST_URI']."/".$data->login);
		}catch(ValidationException $e) {
			http_response_code(400);
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}
	public function login($login) {
		$currentLogged = parent::authenticateUser();
		if ($currentLogged->getLogin() != $login) {
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
			echo("You are not authorized to login as anyone but you");
		} else {
			header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
			echo("Hello ".$login);
		}
	}
}

// URI-MAPPING for this Rest endpoint
$usuarioRest = new UsuarioRest();
URIDispatcher::getInstance()
->map("GET",	"/usuario/$1", array($login,"login"))
->map("POST", "/usuario", array($usuarioRest,"notaUsuario"));
