<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./view/design/style.css">
</head>

<body>
  <h1> On va rejouer ! </h1>
  <p> Mon cher <?= $nom ?> vous jouez pour la <?= $nbGame ?>ème fois.
  <p>Bravo ! Vous aimez cela ! </p>
  <p>
    C'est parti à nouveau <?= $nom ?> ?
  </p>
  <form>
    <input type="hidden" name="ctrl" value="playAgain" />
    <button type="submit" name="jouer" value="Oui">Oui !</button>
    <button type="submit" name="jouer" value="Nom">Non ...</button>
    <input type="hidden" name="nom" value="<?= $nom ?>" />
  </form>
</body>

</html>