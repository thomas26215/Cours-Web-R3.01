<?php
// Inclusion du modèle
require_once('model/music.class.php');
require_once('model/dao.class.php');
$class = 'Music';
$music = new $class(1,'Passenger','Community Centre','1.jpg','1.mp3','Acoustic');
$methodes = get_class_methods($class);
$musicParPage = $_GET['musicParPage'] ?? 8;;


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox avec BD</title>
  <link rel="stylesheet" type="text/css" href="design/style.css">
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <!-- Navigation -->
  <nav>
    <p>
      <a href="jukebox.php?page=1&pageSize=8">
        <span class="arrow left"></span><span class="arrow left"></span>
      </a>
      <a href="jukebox.php?page=1&pageSize=8">
        <span class="arrow left"></span>
      </a>
      <a class="selected" href="jukebox.php?page=1&pageSize=8">1</a>
      <?php 
          for ($i = 2; $i<=8; $i++) :
            $page="jukebox.php?page={$i}&pageSize=8";
      ?>
      <a href="<?= $page ?>"><?= $i ?>         </a>
      <?php endfor;?>      

      <a href="jukebox.php?page=9&pageSize=8">
        <span class="arrow right"></span>
      </a>
      <a href="jukebox.php?page=70&pageSize=8">
        <span class="arrow right"></span><span class="arrow right"></span>
      </a>
    </p>
    <form action="" method="get">
      <p>Musiques/page</p>
      <input type="number" name="musicParPage" value="<?= $musicParPage ?>" maxlength="4" size="2">
    </form>
  </nav>

  <!-- Contenu principal -->
  <main>
    <section>
        <?php 
          for ($j = 1; $j<=$musicParPage; $j++) :
            $lien="playId.php?id={$j}&page=1&pageSize=8";
            $image="http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/img/{$j}.jpg";
            $uneMusique=$music->read($j);
            $titre = $uneMusique->getTitle();
            $author = $uneMusique->getAuthor();
            $category = $uneMusique->getCategory();
        ?>
      <figure>
        <a href="<?= $lien ?>">
          <img src="<?= $image ?>" />
        </a>
        <figcaption>
          <music-song><?= $titre?></music-song>
          <music-group><?= $author?></music-group>
          <music-category><?= $category?></music-category>
        </figcaption>
      </figure>
      <?php endfor;?>
    </section>
  </main>
  <footer>
    Jukebox IUT
  </footer>
</body>
</html>