<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./view/design/style.css">
</head>
<body>
  <h1> Regle du jeu </h1>
  <p> Mon cher <?=$nom?> vous jouez pour la première fois.
  <p>Je me permets de vous donner les règles du jeu : </p>
  <ul>
    <li>
      Vous devez décider d'un nombre entre 1 et 999
    </li>
    <li>
      Et moi, je vais essayer de le deviner.
    </li>
  </ul>
  <p>
    Etes vous pret <?= $nom ?> ?
  </p>
  <form>
    <input type="hidden" name="ctrl" value="playGame" />
    <input type="submit" value="Oui !">
    <input type="hidden" name="nom" value="<?=$nom?>"/>
  </form>
</body>
</html>
