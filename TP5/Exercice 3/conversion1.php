<?php
$calcul = 0;
$celsius = '';
$fahrenheit = '';

if (isset($_GET['action']) && $_GET['action'] === 'convertir' && isset($_GET['temp_in'])) {
    $celsius = floatval($_GET['temp_in']);
    $fahrenheit = ($celsius * 9/5) + 32;
    $calcul = 1;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Conversion Celsius/Fahrenheit</title>
    <link rel="stylesheet" href="design/style.css">
  </head>
  <body>
    <h1>Conversion de températures</h1>
    <form action="conversion1.php" method="get">
      <input id="in" type="number" step="any" name="temp_in" value="<?php echo htmlspecialchars($celsius); ?>">
      <label for="in">Celsius</label>
      égal
      <output id="out" for="in" name="temp_out"><?php echo $calcul ? number_format($fahrenheit, 2) : ''; ?></output>
      <label for="out">Fahrenheit</label>
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
</html>