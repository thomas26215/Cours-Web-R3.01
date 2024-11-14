<?php
// Récupération de le controleur à activer 
// Par défaut on lance l'action main
$ctrl = $_GET['ctrl'] ?? 'main';
// Liste des controleurs possibles
// Cette liste permet d'être sûr de ne pas charger de fichier inconnu
const CTRLS = array('main','getName','startGame','playGame','playAgain');

// Vérification que l'action est correcte
if (! in_array($ctrl,CTRLS)) {
  // Ouvre une page d'erreur
  $error = 'Mauvais controleur :"'.$ctrl.'" query string "'.$_SERVER['QUERY_STRING'].'"';
  //TODO : ajouter la page d'ou l'on vient
  require_once('view/error.view.php');
  exit(0);
}
// Calcule le chemin vers le fichier du controleur
$path = 'controler/'.$ctrl.'.ctrl.php';
// Charge le controleur
require_once($path);
?>