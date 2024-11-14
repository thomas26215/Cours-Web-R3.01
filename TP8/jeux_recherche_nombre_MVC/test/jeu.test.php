<?php
// Utilisation de la classe View du framework
require_once('../framework/view.class.php');

// Création de l'objet vue
$view = new View();

// Donne des valeurs à la vue
$view->assign('guess','801');
$view->assign('nom','Poucet');
$view->assign('nombreDeCoup',1);

// Affiche la vue
$view->display('jeu.view.php');
?>
