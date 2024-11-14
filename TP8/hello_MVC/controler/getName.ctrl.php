<?php
require_once('framework/view.fw.php');
require_once('model/greeting.class.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

// Récupération des informations de la query string
$name = $_GET['name'] ?? '';

//////////////////////////////////////////////////////////////////////////////
// PARTIE SELECTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Création de la vue
$view = new View();

// Si le nom est vide on retourne à la page de lecture du nom
if ($name == '') {
  $view->display('getName');
} else {
  $view->assign('name', $name);
  // Recupère la liste des langues à partir du modèle
  $view->assign('languages',Greeting::getAllLanguages());
  // Vue pour faire choisir la langue
  $view->display('getLanguage');
}
