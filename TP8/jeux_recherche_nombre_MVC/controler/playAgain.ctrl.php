<?php
// Inclut le mini framework
require_once('framework/view.fw.php');
// Ce controleur a besoin du modèle
require_once('model/game.class.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES ET GESTION DES ERREURS
//////////////////////////////////////////////////////////////////////////////
$nom = $_GET['nom'] ?? '';
$jouer = $_GET['jouer'] ?? '';

// Vérification de la query string
if ($nom == '') {
  $error = '$nom vide';
  $view = new View();
  $view->display('error');
}

// Vérification de la query string
if ($jouer == '') {
  $error = '$jouer vide';
  $view = new View();
  $view->display('error');
}

//////////////////////////////////////////////////////////////////////////////
// CAS DE FIN DU JEU
//////////////////////////////////////////////////////////////////////////////

if ($jouer == 'Non') {
  // Le joueur ne veut plus jouer
  // On détruit la session
  session_start();
  session_destroy();
  // La vue pour confimer qu'on ne joue plus
  $view = new View();
  $view->assign('nom', $nom);
  // On afficher la fin du jeu
  $view->display('stopGame');
}

//////////////////////////////////////////////////////////////////////////////
// PARTIE SELECTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Le joueur veux bien jouer à nouveau
$view = new View();
$view->assign('nom', $nom);
$view->display('playGame');
