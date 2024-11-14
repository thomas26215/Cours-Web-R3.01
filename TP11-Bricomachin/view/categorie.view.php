<?php

// Au début de vos scripts PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="design/style.css">
  <title><?= htmlspecialchars($nomCategorie) ?></title>
  <style>
    .category-button {
      display: inline-block;
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      margin: 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    .category-button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1><?= htmlspecialchars($nomCategorie) ?></h1>
  <form action="index.php" method="get">
    <input type="hidden" name="ctrl" value="choisirCategorie">
    <?php foreach ($sousCategories as $sousCategorie): ?>
      <button type="submit" name="id" value="<?= $sousCategorie->getId() ?>" class="category-button">
        <?= htmlspecialchars($sousCategorie->getNom()) ?>
      </button>
    <?php endforeach; ?>
  </form>
  <?php if ($idCategoriePere > 0): ?>
    <a href="index.php?ctrl=choisirCategorie&id=<?= Categorie::read($idCategoriePere)->getPere() ?>">Retour</a>
  <?php endif; ?>
</body>
</html>