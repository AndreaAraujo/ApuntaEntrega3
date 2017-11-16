<?php
//file: view/layouts/default.php
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
?><!DOCTYPE html>
<html>
<head>

  	<meta charset="utf-8"><!--

	<link rel="stylesheet" href="css/style.css" type="text/css">

   enable ji18n() javascript function to translate inside your scripts
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
-->

	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>
	<!-- header -->
	<header id="main-header">

			<li><a href="index.php?controller=notas&amp;action=index">Notas</a></li>

			<?php if (isset($currentuser)): ?>


          <id="logoCabecera"><img class="logo" src = "../img/icono.png"/>
          <a href="../controller/defaultController.php?controlador=language&accion=change&lang=es" id = "salir"><?= i18n("Español") ?></a>
          <a href="../controller/defaultController.php?controlador=language&accion=change&lang=en" id = "salir"><?= i18n("Inglés") ?></a>
          <div class="bloque">
            <br><br><br>
            <a id = "notas" href= "verNotas.php"><?= i18n("Ver mis notas")?></a>
            <a id = "salir" href="../controller/defaultController.php?controlador=usuario&accion=logout"><?= i18n("Salir")?></a>
          </div>


			<?php endif ?>


	</header>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	<footer>
		<?php
		include(__DIR__."/language_select_element.php");
		?>
	</footer>

</body>
</html>
