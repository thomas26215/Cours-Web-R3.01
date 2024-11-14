<?php
$temp_in = isset($_GET['temp_in']) ? floatval($_GET['temp_in']) : 10;
$temp_out = 10;
$entree = isset($_GET['entree']) ? $_GET['entree'] : "Celsius";
$sortie = $entree === "Celsius" ? "Fahrenheit" : "Celsius";

if(isset($_GET['action'])){
    if ($_GET['action'] === 'convertir') {
        if($entree == "Celsius"){
            $temp_out = ($temp_in * 9/5) + 32;
        } else {
            $temp_out = ($temp_in - 32) * 5/9;
        }
    } elseif($_GET['action'] === 'inverser'){
        $entree = $entree === "Celsius" ? "Fahrenheit" : "Celsius";
        $sortie = $sortie === "Fahrenheit" ? "Celsius" : "Fahrenheit";
        // Échange des valeurs lors de l'inversion
        $temp = $temp_in;
        $temp_in = $temp_out;
        $temp_out = $temp;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Conversion Celsius/Fahrenheit</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>
    <h1>Conversion de températures</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="action" value="inverser">Inverser</button>
        <input id="in" type="number" step="any" name="temp_in" value="<?php echo htmlspecialchars($temp_in); ?>">
        <label for="in"><?php echo htmlspecialchars($entree); ?></label>
        égal
        <output id="out" for="in" name="temp_out"><?php echo number_format($temp_out, 2); ?></output>
        <label for="out"><?php echo htmlspecialchars($sortie); ?></label>
        <button type="submit" name="action" value="convertir">Convertir</button>
        <input type="hidden" name="entree" value="<?php echo htmlspecialchars($entree); ?>">
    </form>
</body>
</html>
