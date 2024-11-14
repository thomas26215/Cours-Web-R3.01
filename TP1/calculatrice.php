<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculatrice PHP</title>
</head>
<body>
    <?php
    if (isset($_GET['a']) && isset($_GET['b']) && isset($_GET['op'])) {
        $a = $_GET['a'];
        $b = $_GET['b'];
        $op = $_GET['op'];

        // Vérifier si a et b sont des nombres
        if (is_numeric($a) && is_numeric($b)) {
            switch ($op) {
                case '+':
                    $resultat = $a + $b;
                    break;
                case '*':
                    $resultat = $a * $b;
                    break;
                case '-':
                    $resultat = $a - $b;
                    break;
                case '/':
                    if ($b != 0) {
                        $resultat = $a / $b;
                    } else {
                        echo "<p>Erreur : Division par zéro impossible.</p>";
                        exit;
                    }
                    break;
                default:
                    echo "<p>Erreur : Opérateur non reconnu.</p>";
                    exit;
            }

            echo "<p>$a $op $b = $resultat</p>";
        } else {
            echo "<p>Erreur : 'a' et 'b' doivent être des nombres.</p>";
        }
    } else {
        echo "<p>Erreur : Tous les paramètres (a, b et op) doivent être fournis.</p>";
    }
    ?>
</body>
</html>