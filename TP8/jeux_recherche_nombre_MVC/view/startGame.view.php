<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./view/design/style.css">
</head>
<body>
  <h1> Le Jeu du nombre </h1>
  <form>
    <input type="hidden" name="ctrl" value="startGame"/> 
    <p> Bonjour <?= $nom ?>,
      voulez-vous jouer au jeu du nombre ?
    </p>
    <input type="submit" name="jouer" value="Oui"/>
    <input type="submit" name="jouer" value="Non"/>
    <input type="hidden" name="nom" value="<?= $nom ?>" />
  </form>
</body>
</html>
