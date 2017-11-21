<?php
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../model/NotaMapper.php");
/*require_once(__DIR__."/../model/Comment.php");*/
require_once(__DIR__."/../model/CommentMapper.php");
require_once(__DIR__."/BaseRest.php");
/**
* Class PostRest
*
* It contains operations for creating, retrieving, updating, deleting and
* listing posts, as well as to create comments to posts.
*
* Methods gives responses following Restful standards. Methods of this class
* are intended to be mapped as callbacks using the URIDispatcher class.
*
*/
class NotaRest extends BaseRest {
	private $notaMapper;
	//private $commentMapper;
	public function __construct() {
		parent::__construct();
		$this->notaMapper = new NotaMapper();
		//$this->commentMapper = new CommentMapper();
	}
	/*public function getNotas() {
		$posts = $this->notaMapper->findAll();
		// json_encode Post objects.
		// since Post objects have private fields, the PHP json_encode will not
		// encode them, so we will create an intermediate array using getters and
		// encode it finally
		$posts_array = array();
		foreach($posts as $post) {
			array_push($posts_array, array(
				"id" => $post->getId(),
				"title" => $post->getTitle(),
				"content" => $post->getContent(),
				"author_id" => $post->getAuthor()->getusername()
			));
		}
		header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		header('Content-Type: application/json');
		echo(json_encode($posts_array));
	}*/
	public function createNota($data) {
		$currentUser = parent::authenticateUser();
		$nota = new Nota();
		if (isset($data->nombre) && isset($data->contenido)) {
			$nota->setNombre($data->nombre);
			$nota->setContenido($data->contenido);
			$nota->setUsuario_idUsuario($currentUser);
		}
		try {
			// validate Post object
			$nota->checkIsValidForCreate(); // if it fails, ValidationException
			// save the Post object into the database
			$idNota = $this->notaMapper->save($nota);
			// response OK. Also send post in content
			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');
			header('Location: '.$_SERVER['REQUEST_URI']."/".$idNota);
			header('Content-Type: application/json');
			echo(json_encode(array(
				"IdNota"=>$idNota,
				"nombre"=>$nota->getNombre(),
				"contenido" => $nota->getContenido()
			)));
		} catch (ValidationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}/*
	public function readNota($idNota) {
		// find the Post object in the database
		$nota = $this->notaMapper->findByIdWithComments($idNota);
		if ($post == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Post with id ".$postId." not found");
		}
		$post_array = array(
			"id" => $post->getId(),
			"title" => $post->getTitle(),
			"content" => $post->getContent(),
			"author_id" => $post->getAuthor()->getusername()
		);
		//add comments
		$post_array["comments"] = array();
		foreach ($post->getComments() as $comment) {
			array_push($post_array["comments"], array(
				"id" => $comment->getId(),
				"content" => $comment->getContent(),
				"author" => $comment->getAuthor()->getusername()
			));
		}
		header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		header('Content-Type: application/json');
		echo(json_encode($post_array));
	}*/

	public function updateNota($idNota, $data) {
		$currentUser = parent::authenticateUser();
		$nota = $this->notaMapper->findById($notaId);
		if ($nota == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Note with id ".$idNota." not found");
		}

								/*SI PUEDE MODIFICAR, AUNQUE NO LO CREARA*/

		// Check if the Post author is the currentUser (in Session)
		/*if ($nota->getUsuario_idUsuario() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
			echo("you are not the author of this post");
		}*/
		$nota->setNombre($data->nombre);
		$nota->setContenido($data->contenido);
		try {
			// validate Post object
			$nota->checkIsValidForUpdate(); // if it fails, ValidationException
			$this->notaMapper->update($nota);
			header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
		}catch (ValidationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}
	public function deleteNota($idNota) {
		$currentUser = parent::authenticateUser();
		$nota = $this->notaMapper->findById($idNota);
		if ($nota == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Note with id ".$idNota." not found");
			return;
		}
		// Check if the Post author is the currentUser (in Session)
		/*
		if ($nota->getAuthor() != $currentUser) {
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
			echo("you are not the author of this post");
			return;
		}*/
		$this->notaMapper->delete($nota);
		header($_SERVER['SERVER_PROTOCOL'].' 204 No Content');
	}
	/*public function createComment($postId, $data) {
		$currentUser = parent::authenticateUser();
		$post = $this->postMapper->findById($postId);
		if ($post == NULL) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			echo("Post with id ".$postId." not found");
		}
		$comment = new Comment();
		$comment->setContent($data->content);
		$comment->setAuthor($currentUser);
		$comment->setPost($post);
		try {
			$comment->checkIsValidForCreate(); // if it fails, ValidationException
			$this->commentMapper->save($comment);
			header($_SERVER['SERVER_PROTOCOL'].' 201 Created');
		}catch(ValidationException $e) {
			header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
			header('Content-Type: application/json');
			echo(json_encode($e->getErrors()));
		}
	}*/
}
// URI-MAPPING for this Rest endpoint
$notaRest = new NotaRest();
URIDispatcher::getInstance()
//->map("GET",	"/notas", array($notaRest,"getNotas"))
//->map("GET",	"/notas/$1", array($notaRest,"readNota"))
->map("POST", "/notas", array($notaRest,"createNota"))
/*->map("POST", "/nota/$1/comment", array($postRest,"createComment"))*/
->map("PUT",	"/notas/$1", array($notaRest,"updateNota"))
->map("DELETE", "/notas/$1", array($notaRest,"deleteNota"));
