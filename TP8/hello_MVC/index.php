<?php
// Calcul du routage : récupération de la route, le controleur à activer 
// Par défaut on lance le contrôleur 'main'
$ctrl = $_GET['ctrl'] ?? 'main';

// Sécurité : liste des contrôleurs possibles
// Cette liste permet d'être sûr de ne pas charger un fichier inconnu
const CTRLS = array('main','getName','getLanguage');

// Sécurité : vérification que la route est correcte
if (! in_array($ctrl,CTRLS)) {
  // Ouvre une page d'erreur
  $error = 'Mauvais controleur : "'.$ctrl.'" query string "'.$_SERVER['QUERY_STRING'].'"';
  require_once('view/error.view.php');
  exit(0);
}
// Calcule le chemin vers le fichier du contrôleur
$path = 'controler/'.$ctrl.'.ctrl.php';
// Charge le contrôleur
require_once($path);
?>