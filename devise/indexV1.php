<?php
require_once(dirname(__FILE__).'/model/change.php');

// Créer une instance de la classe Change
$change = new Change(dirname(__FILE__).'/data/exchangeRate.csv');

// Récupérer la liste des devises
$devises = $change->getDevises();

// Traiter la conversion si le formulaire est soumis
$result = '';
if (isset($_GET['montant']) && isset($_GET['source']) && isset($_GET['cible'])) {
    $montant = floatval($_GET['montant']);
    $source = $_GET['source'];
    $cible = $_GET['cible'];
    
    try {
        $resultat = $change->change($source, $cible, $montant);
        $result = number_format($resultat, 2) . " " . $cible;
    } catch (Exception $e) {
        $result = "Erreur : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="design/w3.css">
  <link rel="stylesheet" href="design/style.css">
  <title>Convertisseur de devises</title>
</head>
<body>

  <header class="w3-container w3-teal">
    <h1>Outil de conversion de devises</h1>
  </header>

  <main class="w3-container">
    <p>
      
      Boursomachin met à votre disposition ce convertisseur de devises, qui vous permet de convertir des monnaies instantanément et gratuitement.
      Vous pouvez convertir entre elles les devises les plus populaires comme,  Euro EUR, Dollar US USD, Yen japonais JPY, Livre Sterling GBP.
    </p>
    <p>
      Usage : vous entrez dans le convertisseur le montant que vous souhaitez convertir,  indiquez la devise d'origine et la devise qui vous intéresse. Et vous obtenez instantanément le montant dans la devise souhaitée, avec le taux de change entre les 2 monnaies.
    </p>

    <h2>Convertisseur</h2>
    <div>
    <form id="convertisseur" action="indexV1.php" method="get" class="w3-panel w3-card-2">
      <input id="montant" type="number" name="montant" placeholder="Montant" value="<?php echo isset($_GET['montant']) ? htmlspecialchars($_GET['montant']) : ''; ?>" required>
      <select id="source" name="source">
        <?php foreach ($devises as $devise): ?>
          <option value="<?php echo $devise; ?>" <?php echo (isset($_GET['source']) && $_GET['source'] == $devise) ? 'selected' : ''; ?>><?php echo htmlspecialchars($devise); ?></option>
        <?php endforeach; ?>
      </select>
      <img src="design/arrow-icon.png" alt="">
      <select id="cible" name="cible">
        <?php foreach ($devises as $devise): ?>
          <option value="<?php echo htmlspecialchars($devise); ?>" <?php echo (isset($_GET['cible']) && $_GET['cible'] == $devise) ? 'selected' : ''; ?>><?php echo htmlspecialchars($devise); ?></option>
        <?php endforeach; ?>
      </select>
      <button name="button" type="submit" class="w3-button w3-teal">Convertir</button>
    </form>

    <output for="montant source cible" form="convertisseur" name="target_amount" class="w3-container w3-teal w3-xlarge">
      <?php echo $result; ?>
    </output>
    </div>
  </main>

</body>
</html>