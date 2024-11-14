<?php
// Récupération du contrôleur à activer
$ctrl = $_GET['ctrl'] ?? 'afficherArticles'; // Par défaut, on lance l'action afficherArticles

// Liste des contrôleurs possibles
const CTRLS = ['afficherArticles', 'choisirCategorie'];

// Vérification que l'action est correcte
if (!in_array($ctrl, CTRLS)) {
    // Ouvre une page d'erreur
    $error = 'Mauvais contrôleur : "' . $ctrl . '"';
    require_once('view/error.view.php');
    exit(0);
}

// Calcule le chemin vers le fichier du contrôleur
$path = 'controler/' . $ctrl . '.ctrl.php';
// Charge le contrôleur
require_once($path);
?>