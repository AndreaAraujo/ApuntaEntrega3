<?php
//file: view/posts/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$post = $view->getVariable("post");
$errors = $view->getVariable("errors");
$view->setVariable("title", "Edit Post");
?>


<form action="index.php?controller=posts&amp;action=add" method="POST">
	<?= i18n("Title") ?>: <input type="text" name="title"
	value="<?= $post->getTitle() ?>">
	<?= isset($errors["title"])?i18n($errors["title"]):"" ?><br>

	<?= i18n("Contents") ?>: <br>
	<textarea name="content" rows="4" cols="50"><?=
	htmlentities($post->getContent()) ?></textarea>
	<?= isset($errors["content"])?i18n($errors["content"]):"" ?><br>

	<input type="submit" name="submit" value="submit">
</form>






<!-- SIN ACABAAAAAAAAAR -->
















<div id="main-content" >
  <h1><p align= center><?= i18n("Crear nota")?></h1>

  <div class="container">

    <form action="index.php?controlador=nota&accion=crearNota"   method="POST" class ="formularioCrear" role = "form">

        <div class ="form-group ">
          <label for = "nomNota" id="labelNombre"><?= i18n("Nombre")?>:</label>
          <input type="text"  class ="form-control" name="nomNota"  id="textBoxNombre" maxlength="50"value="<?= nota->getNombre() ?>">
        	<?= isset($errors["title"])?i18n($errors["title"]):"" ?><br>
        </div>

        <div class ="form-group">
          <label for = "contenidoNota" id="contenidoNota"><?= i18n("Contenido")?>:</label>
          <input type="text" name="contenidoNota" class ="form-control" id="textBoxContenido"  maxlength="300" >
        </div>

           <input type="hidden" name="idUsu" value="<?php echo  $idUsuario;?>">

        <button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-paperclip" id="btnGuardar"></span><?= i18n("Guardar")?></button>
        <a href="verNotas.php"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>
  </form>
  </div>
</div>
