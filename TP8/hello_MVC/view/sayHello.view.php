<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Salutation en <?= $language ?></h1>
  <p> <?= $salutation ?> </p>
  <form>
    <input type="hidden" name="ctrl" value="getLanguage"/>
    <input type="hidden" name="name" value="<?=$name?>"/>

    <p>Recommencer dans une autre langue ?
      <select name="language">
        <?php foreach($languages as $language) : ?>
          <option value="<?= $language ?>"><?= $language ?></option>
          <?php endforeach; ?>
      </select>
    </p>
    <button type="submit">Saluer</button>
  </form>
  <a href="index.php"><button type="button">Retour au début</button></a>
</body>
</html>
