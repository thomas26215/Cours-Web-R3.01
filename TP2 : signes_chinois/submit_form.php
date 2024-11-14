<?php
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs
    $nom = $_POST['nom'] ?? "inconnu";
    $age = $_POST['annee'] ?? 2000;

    // Liste des signes
    $signe = array('Coq', 'Chien', 'Cochon', 'Rat', 'Buffle', 'Tigre', 'Lapin', 'Dragon', 'Serpent', 'Cheval', 'Chèvre', 'Singe');
    
    // Calcul du signe
    $index = (date("Y")-$age - 1921) % 12;
    $signeCalcule = $signe[$index];

    // Détermination du genre
    $genre = $_POST['genre'] ?? '';
    $presentation = ($genre == 'femme') ? 'Madame' : 'Monsieur';
} else {
    // Redirection si le formulaire n'est pas soumis correctement
    header("Location: formulaire.html");
    exit();
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signe Chinois</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Signes Astrologiques Chinois</h1>
    </header>
    <main>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <section>
            <p>
                Bonjour <?= $presentation ?> <?= $nom ?>, vous êtes né(e) en <?= htmlspecialchars($age) ?>.
                Votre signe astrologique chinois est :
            </p>
            <p><strong><?= htmlspecialchars($signeCalcule) ?></strong></p>



        </section>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Votre Site Astrologique</p>
    </footer>
</body>

</html>
