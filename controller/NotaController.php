<?php

//require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../model/PostMapper.php");
//require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class NotaController extends BaseController {


    private $notaMapper;

  	public function __construct() {
  		parent::__construct();
    		$this->notaMapper = new NotaMapper();
  	}

    public function index() {
		// obtain the data from the database
		$nota = $this->notaMapper->findAll();
		// put the array containing Post object to the view
		$this->view->setVariable("nota", $nota);
		// render the view (/view/posts/index.php)
		$this->view->render("notas", "index");
	}
/*
  public function view(){
  if (!isset($_GET["id"])) {
    throw new Exception("id is mandatory");
  }
  $idNota = $_GET["id"];
  // find the Post object in the database
  $nota = $this->NotaMapper->findByIdWithComments($idNota);
  if ($nota == NULL) {
    throw new Exception("no such post with id: ".$idNota);
  }
  // put the Post object to the view
  $this->view->setVariable("nota", $nota);
  // check if comment is already on the view (for example as flash variable)
  // if not, put an empty Comment for the view
  $comment = $this->view->getVariable("comment");
  $this->view->setVariable("comment", ($comment==NULL)?new Comment():$comment);
  // render the view (/view/posts/view.php)
  $this->view->render("notas", "view");
}*/


/*AÑADIR NOTA*/

public function add() {
  if (!isset($this->currentUser)) {
    throw new Exception("Not in session. Adding posts requires login");
  }
  $nota = new Nota();
  if (isset($_POST["submit"])) { // reaching via HTTP Post...
    // populate the Post object with data form the form
    $nota->setNombre($_POST["nombre"]);
    $nota->setContenido($_POST["contenido"]);
    // The user of the Post is the currentUser (user in session)
    $nota->setUsuario_idUsuario($this->currentUser);
    try {
      // validate Post object
      $post->checkIsValidForCreate(); // if it fails, ValidationException
      // save the Post object into the database
      $this->notaMapper->save($nota);
      // POST-REDIRECT-GET
      // Everything OK, we will redirect the user to the list of posts
      // We want to see a message after redirection, so we establish
      // a "flash" message (which is simply a Session variable) to be
      // get in the view after redirection.
      $this->view->setFlash(sprintf(i18n("Nota \"%s\" successfully added."),$nota ->getNombre()));
      // perform the redirection. More or less:
      // header("Location: index.php?controller=posts&action=index")
      // die();
      $this->view->redirect("notas", "index");
    }catch(ValidationException $ex) {
      // Get the errors array inside the exepction...
      $errors = $ex->getErrors();
      // And put it to the view as "errors" variable
      $this->view->setVariable("errors", $errors);
    }
  }
  // Put the Post object visible to the view
  $this->view->setVariable("post", $post);
  // render the view (/view/posts/add.php)
  $this->view->render("posts", "add");
}

/*  MODIFICAR NOTA   */

public function edit() {
  if (!isset($_REQUEST["id"])) {
    throw new Exception("A nota id is mandatory");
  }
  if (!isset($this->currentUser)) {
    throw new Exception("Not in session. Editing posts requires login");
  }
  // Get the Post object from the database
  $postid = $_REQUEST["id"];
  $post = $this->notaMapper->findByIdNota($idNota);
  // Does the post exist?
  if ($nota == NULL) {
    throw new Exception("no such post with id: ".$idNota);
  }
  // Check if the Post author is the currentUser (in Session)
  if ($nota->getUsuario_idUsuario() != $this->currentUser) {
    throw new Exception("logged user is not the author of the post id ".$idNota);
  }
  if (isset($_POST["submit"])) { // reaching via HTTP Post...
    // populate the Post object with data form the form
    $post->setTitle($_POST["nombre"]);
    $post->setContent($_POST["contenido"]);
    try {
      // validate Post object
      $nota->checkIsValidForUpdate(); // if it fails, ValidationException
      // update the Post object in the database
      $this->notaMapper->update($nota);
      // POST-REDIRECT-GET
      // Everything OK, we will redirect the user to the list of posts
      // We want to see a message after redirection, so we establish
      // a "flash" message (which is simply a Session variable) to be
      // get in the view after redirection.
      $this->view->setFlash(sprintf(i18n("Nota \"%s\" successfully updated."),$nota ->getNombre()));
      // perform the redirection. More or less:
      // header("Location: index.php?controller=posts&action=index")
      // die();
      $this->view->redirect("notas", "index");
    }catch(ValidationException $ex) {
      // Get the errors array inside the exepction...
      $errors = $ex->getErrors();
      // And put it to the view as "errors" variable
      $this->view->setVariable("errors", $errors);
    }
  }
  // Put the Post object visible to the view
  $this->view->setVariable("nota", $nota);
  // render the view (/view/posts/add.php)
  $this->view->render("notas", "editarNota");
}


public function delete() {
		if (!isset($_POST["id"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}

		// Get the Post object from the database
		$postid = $_REQUEST["id"];
		$post = $this->postMapper->findById($idNota);
		// Does the post exist?
		if ($post == NULL) {
			throw new Exception("no such post with id: ".$idNota);
		}
		// Check if the Post author is the currentUser (in Session)
		if ($post->getUsuario_idUsuario() != $this->currentUser) {
			throw new Exception("Post author is not the logged user");
		}
		// Delete the Post object from the database
		$this->notaMapper->delete($nota);
		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("Nota \"%s\" successfully deleted."),$post ->getTitle()));
		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		$this->view->redirect("notas", "index");
	}



}
