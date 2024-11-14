<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./view/design/style.css">
</head>

<body>
  <h1> Le Jeux du nombre </h1>
  <p class="found"> Cher <?= $nom ?>, vous pensiez donc au nombre <?= $solution ?>.
    J'ai trouvé la réponse en <?= $nombreDeCoup ?> coups.
  </p>
  <form>
    <input type="hidden" name="ctrl" value="playAgain" />
    <input type="submit" value="Rejouer" />
    <input type="hidden" name="nom" value="<?= $nom ?>" />
    <input type="hidden" name="jouer" value="Oui" />
  </form>
</body>

</html>