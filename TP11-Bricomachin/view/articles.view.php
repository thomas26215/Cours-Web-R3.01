<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nomCategorie) ?></title>
    <link rel="stylesheet" type="text/css" href="view/design/style.css">
</head>
<body>
    <header>
        <h1>Bricomachin, le bricolage malin</h1>
        <nav>
            <a href="?ctrl=afficherArticles">Accueil</a>
            <form method="get" action="index.php">
                <input type="hidden" name="ctrl" value="choisirCategorie">
                <button type="submit">Choisir une catégorie</button>
            </form>
            <?php if ($page > 1): ?>
                <a href="?ctrl=afficherArticles&page=<?=$pagePrec?>&idCategorie=<?=$idCategorie?>">&lt; Précédent</a>
            <?php endif; ?>
            Page <?= $page ?> sur <?= $totalPages ?> (<?= $totalArticles ?> articles)
            <?php if ($hasNextPage): ?>
                <a href="?ctrl=afficherArticles&page=<?=$pageSuiv?>&idCategorie=<?=$idCategorie?>">Suivant &gt;</a>
            <?php endif; ?>
        </nav>
    </header>

    <h2><?= htmlspecialchars($nomCategorie) ?></h2>

    <?php if (count($articles) > 0): ?>
        <?php foreach ($articles as $article): ?>
            <article>
                <h2><?= htmlspecialchars($article->getLibelle()) ?></h2>
                <img src="<?= htmlspecialchars($article->getImageURL()) ?>" alt="<?= htmlspecialchars($article->getLibelle()) ?>" />
                <p><?= number_format($article->getPrix(), 2, ',', ' ') ?>€</p>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>

    <footer>
        <p>Site fictif, issu de données réelles du Web</p>
    </footer>
</body>
</html>