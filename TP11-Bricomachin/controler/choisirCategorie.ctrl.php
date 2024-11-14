<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../model/categorie.class.php');
require_once(__DIR__ . '/../framework/view.fw.php');

// Récupérer l'ID de la catégorie depuis l'URL, 0 si non spécifié
$idCategorie = isset($_GET['id']) ? (int)$_GET['id'] : 1;

echo $idCategorie;

try {
    if ($idCategorie > 0) {
        // Catégorie spécifique sélectionnée
        $categorie = Categorie::read($idCategorie);
        $sousCategories = $categorie->readSubCategorie();
        $nomCategorie = $categorie->getNom();
        $idCategoriePere = $categorie->getPere();
    } else {
        // Aucune catégorie sélectionnée, afficher les catégories racines
        $categorieRacine = new Categorie(0, "Catégories principales", -1);
        $sousCategories = $categorieRacine->readSubCategorie();
        $nomCategorie = "Choisir une catégorie";
        $idCategoriePere = -1;
    }

    if (empty($sousCategories)) {
        // Catégorie terminale, rediriger vers l'affichage des articles
        header("Location: index.php?ctrl=afficherArticles&idCategorie=$idCategorie");
        exit;
    }

    // Préparer la vue
    $view = new View();
    $view->assign('nomCategorie', $nomCategorie);
    $view->assign('sousCategories', $sousCategories);
    $view->assign('idCategoriePere', $idCategoriePere);
    $view->display("categorie");

} catch (Exception $e) {
    // Gestion des erreurs
    $view = new View();
    $view->assign('error', $e->getMessage());
    $view->display("error");
}
?>