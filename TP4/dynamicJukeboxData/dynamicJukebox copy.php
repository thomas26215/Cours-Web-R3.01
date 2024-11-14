<?php
include('readDelimitedData.php');
// Lecture de toutes les musiques

$songs = readDelimitedData('jukeboxData.txt', '|')


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox static</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
    <table>
      <thead>
        <tr>
          <th>Titre</th>
          <th>Année</th>
          <th>Année</th>
          <th>Genre</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($songs as $song): ?>
          <tr>
            
              <td><?= $song[0] ?? 'N/A' ?></td>
              <td><?=$song[1] ?? 'N/A' ?></td>
              <td><?=$song[2] ?? 'N/A'?></td>
              <td><?=$song[3] ?? 'N/A'?></td>
            
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </header>
  <main>
    <section>
     
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
