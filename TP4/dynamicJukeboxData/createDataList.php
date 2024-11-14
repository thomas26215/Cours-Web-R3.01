<?php
$liste = __DIR__ . '/../../'; // Utilisez __DIR__ pour obtenir le chemin absolu

function create($liste) {
    if ($handle = opendir($liste)) {
        while (false !== ($entry = readdir($handle))) { // Utilisez readdir pour lire les entrées
            if ($entry != '.' && $entry != '..') { // Ignorez les entrées courantes et parent
                $path = $liste . '/' . $entry; // Créez le chemin complet
                if (is_file($path)) { // Vérifiez si c'est un fichier
                    echo $entry . "\n"; // Affichez le nom du fichier
                }else{
                    create($path);
                }
            }
        }
        closedir($handle); // Fermez le répertoire
    } else {
        echo "Erreur : Impossible d'ouvrir le répertoire $liste\n";
    }
}

// Appel de la fonction avec le chemin
create($liste);
?>
