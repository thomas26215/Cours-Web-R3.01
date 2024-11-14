<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./view/design/style.css">
</head>

<body>
  <h1> Le Jeux du nombre </h1>
  <p> Je propose : <?= $guess ?>
  </p>
  <form>
    <input type="hidden" name="ctrl" value="playGame" />
    <input type="submit" name="reponse" value="Trop grand" />
    <input type="submit" name="reponse" value="Trop petit" />
    <input type="submit" name="reponse" value="Trouvé" />
    <input type="hidden" name="nom" value="<?= $nom ?>" />
  </form>
</body>

</html>