<?php
//file: view/posts/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$post = $view->getVariable("nota");
$errors = $view->getVariable("errors");
$view->setVariable("nombre", "contenido","Usuario_idUsuario");
?>

<body style="overflow-y:scroll">
	<div id="main-content" >
		<h1><p align= center><?= i18n("Crear nota")?></h1>

		<div class="container">

			<form action="../controller/defaultController.php?controlador=nota&accion=crearNota"   method="post" class ="formularioCrear" role = "form">

					<div class ="form-group ">
						<label for = "nomNota" id="labelNombre"><?= i18n("Nombre")?>:</label>
						<input type="text"  class ="form-control" name="nomNota"  id="textBoxNombre" maxlength="50" value="<?= $nota->getNombre()?>" >
					</div>

					<div class ="form-group">
						<label for = "contenidoNota" id="contenidoNota"><?= i18n("Contenido")?>:</label>
						<input type="text" name="contenidoNota" class ="form-control" id="textBoxContenido"  maxlength="300" value="<?= $nota->getContenido()?>" >
					</div>

						 <input type="hidden" name="idUsu" value="<?= $nota->getUsuario_idUsuario()?>">

					<button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-paperclip" id="btnGuardar"></span><?= i18n("Guardar")?></button>
					<a href="verNotas.php"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>
		</form>
		</div>
	</div>
</body>
