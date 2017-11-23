<?php

require_once(__DIR__."/../core/PDOConnection.php");

class UsuarioMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($usuario) {
		$stmt = $this->db->prepare("INSERT INTO usuario (login, password, email) values (?,?,?)");
		$stmt->execute(array($usuario->getLogin(), $usuario->getPassword(), $usuario->getEmail()));
	}


	public function usernameExists($login) {
		$stmt = $this->db->prepare("SELECT count(login) FROM usuario where login=?");
		$stmt->execute(array($login));
		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function isValidUser($login, $password) {
		$stmt = $this->db->prepare("SELECT count(login) FROM usuario where login=? and password=?");
		$stmt->execute(array($login, $password));
		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}
