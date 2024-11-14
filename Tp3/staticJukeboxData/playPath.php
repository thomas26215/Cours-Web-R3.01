<?php
if (isset($_GET['music'])) {
    $music = $_GET['music'];
    $elements = explode("/", $music);
    
    if (count($elements) == 2) {
        $group = htmlspecialchars($elements[0]);
        $song = htmlspecialchars($elements[1]);
        echo "<h2>Lecture en cours</h2>";

        echo "<figure style=\"display: flex; flex-direction: column; justify-content: center; align-items: center\">
        <div style=\"display: flex; flex-direction: column; align-items: center\">
          <img src=\"data/$group/$song.jpeg\" alt=\"$song par $group\" style=\"height: auto; margin-bottom: 10px;\">
          <audio src=\"data/$group/$song.mp3\" controls autoplay style=\"margin-bottom: 10px; width: 100%;\"></audio>
        </div>
      </figure>";

        // Ajout du bouton de retour
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        echo "<div style=\"text-align: center; margin-top: 20px;\">
                <a href=\"$referer\" style=\"padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;\">Retour</a>
              </div>";

    } else {
        echo "<p>Format de musique invalide</p>";
    }
    exit;
}
?>
