<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Choix de la langue</h1>
  <p> Bonjour <?= $name ?>, vous devez choisir la langue :
  </p>
  <form>
    <input type="hidden" name="ctrl" value="getLanguage"/>
    <input type="hidden" name="name" value="<?=$name?>"/>

    <p>Dans quelle langue voulez vous être salué ?
      <select name="language">
        <?php foreach($languages as $language) : ?>
          <option value="<?= $language ?>"><?= $language ?></option>
          <?php endforeach; ?>
      </select>
    </p>
    <button type="submit">Me saluer</button>
  </form>
</body>
</html>
