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
    <section>
        <?php foreach($songs as $song): ?>
          <figure>
          <a href="playPath.php?music=<?=$song[0]?>/<?=$song[1]?>">
    <img src="data/<?=$song[0]?>/<?=$song[1]?>.jpeg" alt="Song Image" />
</a>

          </figure>
        <?php endforeach; ?>
        </section>
  </header>
  <main>
    <section>
     
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
