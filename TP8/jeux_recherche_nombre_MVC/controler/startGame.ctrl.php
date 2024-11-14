<?php
require_once('framework/view.fw.php');
require_once('model/game.class.php');


//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES ET GESTION DES ERREURS
//////////////////////////////////////////////////////////////////////////////
$nom = $_GET['nom'] ?? '';
$jouer = $_GET['jouer'] ?? '';

// Vérification de la query string
if ($nom == '') {
  $view = new View();
  $error = '$nom vide';
  $view->display('error');
}

// Vérification de la query string
if ($jouer == '') {
  $view = new View();
  $error = '$jouer vide';
  $view->display('error');
}

//////////////////////////////////////////////////////////////////////////////
// CAS DE FIN DU JEU
//////////////////////////////////////////////////////////////////////////////

if ($jouer == 'Non') {
  // Le joueur ne veut plus jouer
  // On détruit la session (NB: elle doit être ouverte avant de la détruire)
  session_start();
  session_destroy();
  // La vue pour confimer qu'on ne joue plus
  $view->assign('nom', $nom);
  // On afficher la fin du jeu
  $view->display('stopGame');
}


//////////////////////////////////////////////////////////////////////////////
// PARTIE USAGE DU MODELE
//////////////////////////////////////////////////////////////////////////////

// Le joueur veux bien jouer

// Ouvre la session
session_start();

// Récupère l'objet du Jeu dans la session
if (isset($_SESSION['game'])) {
  $game = $_SESSION['game'];
  // C'était le jeu précédent, on le réinitialise, la personne veut encore jouer
  $game->restart();
} else {
  // C'est le début du jeu, on n'a pas encore d'objet dans la session
  // on crée l'objet
  $game = new Game();
}

// Sauvegarde l'objet dans la session
$_SESSION['game'] = $game;

//////////////////////////////////////////////////////////////////////////////
// PARTIE SELECTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////
$view = new View();
  // Passage des paramètres à la vue
  $view->assign('nom', $nom);
  // Est-ce la première fois ?
  if ($game->getNbGame() <= 1) {
    // On affiche la vue de l'affichage de la règle du jeu
    $view->display('gameRules');
  } else {
    // On affiche le message de continuation avec le nombre de fois
    $view->assign('nbGame', $game->getNbGame());
    $view->display('playAgain');
  }
