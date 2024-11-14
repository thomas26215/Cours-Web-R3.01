<?php
// Chemin vers le fichier de la base de données SQLite
$dataSourceName = 'sqlite:' . __DIR__ . '/data/contact.db';

try {
    // Création de l'instance PDO
    $db = new PDO($dataSourceName);
    
    // Configuration pour lever des exceptions en cas d'erreur
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête pour obtenir les villes uniques
    $query = 'SELECT DISTINCT city FROM contact ORDER BY city';
    $statement = $db->prepare($query);

    // Exécution de la requête
    $statement->execute();

    // Récupération des résultats
    $cities = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur PDO : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="design/style.css">
    <title>My contacts</title>
  </head>
  <body>
    <h1>My contacts : select a City</h1>

    <form method="get" action="contact.php">
        <?php foreach ($cities as $index => $city): ?>
            <div>
                <input type="radio" id="city<?=$city['city']?>" name="city" value="<?=$city['city']?>">
                <label for="city<?=$city['city']?>"><?=$city['city']?></label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Sélectionner</button>
    </form>

  </body>
</html>