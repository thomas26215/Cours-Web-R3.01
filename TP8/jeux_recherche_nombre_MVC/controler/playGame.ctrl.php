<?php
require_once('framework/view.fw.php');
require_once('model/game.class.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

// Récupération des informations de la query string
$nom = $_GET['nom'] ?? '';
$reponse = $_GET['reponse'] ?? '';

// Vérification de la query string
if ($nom == '') {
  $view = new View();
  $error = '$nom vide';
  $view->display('error');
}

// Ouvre la session
session_start();

// Récupère l'objet du Jeu dans la session
// Si c'est le début du jeu, on n'a pas encore d'objet dans la session, on crée l'objet
$game = $_SESSION['game'] ?? new Game();

//////////////////////////////////////////////////////////////////////////////
// PARTIE USAGE DU MODELE
//////////////////////////////////////////////////////////////////////////////

// Booléen pour indiquer la fin du jeu
$finDuJeu = false;

// Booléen pour indiquer que le joueur a triché
$triche = false;

// Examen de la réponse de l'utilisateur
if ($reponse == 'Trouvé') {
  // L'utilisateur nous dit que la valeur est trouvée
  // Rappel la valeur devinée
  $guess = $game->getGuess();
  // C'est la fin du jeu
  $finDuJeu = true;
} else {
  // S'il n'y a plus d'autre choix c'est que l'utilisateur a triché
  if ($game->noChoice()) {
    // C'est une triche
    $triche = true;
  } else {
    // Autres cas ou l'on poursuit le jeu
    if ($reponse == 'Trop grand') {
      // L'utilisateur nous dit que la valeur est trop grande
      // Informe le modèle du choix de l'utilisateur
      $game->guessTooHigh();
      // Demande au modèle de refaire une estimation
      $guess = $game->guess();
    } elseif ($reponse == 'Trop petit') {
      // L'utilisateur nous dit que la valeur est trop petite
      // Informe le modèle du choix de l'utilisateur
      $game->guessTooLow();
      // Demande au modèle de refaire une estimation
      $guess = $game->guess();
    } else {
      // C'est le premier pas du jeu, la première estimation
      $guess = $game->guess();
    }
  }
}

// Sauvegarde l'objet dans la session
$_SESSION['game'] = $game;
// Ferme la session
session_write_close();

//////////////////////////////////////////////////////////////////////////////
// PARTIE GESTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////
// Création de la vue
$view = new View();

if ($finDuJeu) {
  // Fin du jeu
  $view->assign('solution', $guess);
  $view->assign('nom', $nom);
  $view->assign('nombreDeCoup', $game->getNbGuess());
  $view->display('endGame');
}

if ($triche) {
  // Un cas de triche
  $view->assign('nom', $nom);
  $view->display('cheatGame');
}

// Sinon, le jeu continue
$view->assign('nom', $nom);
$view->assign('guess', $guess);
$view->display('playGame');
