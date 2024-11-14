<?php
// Activation de l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers nécessaires
include_once('framework/view.fw.php');
include_once('model/article.class.php');
include_once('model/categorie.class.php');

// Paramètres de pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$pageSize = 10;

// Récupération de l'ID de catégorie
$idCategorie = isset($_GET['idCategorie']) ? (int)$_GET['idCategorie'] : 0;

try {
    // Récupération des articles selon la catégorie
    if ($idCategorie > 0) {
        $categorie = Categorie::read($idCategorie);
        $articles = Article::readPageCategorie($page, $pageSize, $categorie);
        $nomCategorie = $categorie->getNom();
        $totalArticles = Article::count($idCategorie); // Compte les articles de la catégorie
    } else {
        $articles = Article::readPage($page, $pageSize);
        $nomCategorie = "Tous les produits";
        $totalArticles = Article::count(); // Compte tous les articles
    }

    // Vérification que $articles est bien un tableau
    if (!is_array($articles)) {
        throw new Exception("La méthode de récupération des articles n'a pas retourné un tableau.");
    }

    // Calcul des informations de pagination
    $totalPages = ceil($totalArticles / $pageSize);
    $hasNextPage = $page < $totalPages;

    // Préparation des données pour la vue
    $view = new View();
    $view->assign('nomCategorie', $nomCategorie);
    $view->assign('articles', $articles);
    $view->assign('idCategorie', $idCategorie);
    $view->assign('page', $page);
    $view->assign('pagePrec', max(1, $page - 1));
    $view->assign('pageSuiv', min($totalPages, $page + 1));
    $view->assign('hasNextPage', $hasNextPage);
    $view->assign('totalPages', $totalPages);
    $view->assign('totalArticles', $totalArticles);

    // Affichage de la vue
    $view->display("articles");

} catch (Exception $e) {
    // Gestion des erreurs
    error_log("Erreur dans afficherArticles.ctrl.php : " . $e->getMessage());
    $view = new View();
    $view->assign('error', "Une erreur est survenue lors de la récupération des articles.");
    $view->display("error");
}
?>