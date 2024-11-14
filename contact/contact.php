<?php
// Récupère les informations de la query string
$city = $_GET['city'] ?? 'Dallas';

// Chemin vers le fichier de la base de données SQLite
$dataSourceName = 'sqlite:' . __DIR__ . '/data/contact.db';

try {
    // Création de l'instance PDO
    $db = new PDO($dataSourceName);
    
    // Configuration pour lever des exceptions en cas d'erreur
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête
    $query = 'SELECT name, phone FROM contact WHERE city = :city';
    $statement = $db->prepare($query);

    // Exécution de la requête avec le paramètre
    $statement->execute([':city' => $city]);

    // Récupération des résultats
    $contacts = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>My contacts from <?= htmlspecialchars($city) ?></h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Phone</th>
      </tr>
      <?php foreach ($contacts as $contact): ?>
        <tr>
          <td><?= htmlspecialchars($contact['name']) ?></td>
          <td><?= htmlspecialchars($contact['phone']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>