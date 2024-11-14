<?php

$abbrevations = array('HTML' => 'HyperText Markup Langage', 'CSS' => 'Cascading SteelSheet', 'PHP' => 'HyperText PreProcessor');

function abbr(string $abbr): string{
    global $abbrevations;
    if(array_key_exists($abbr, $abbrevations)){
        return "<abbr title=\"{$abbrevations[$abbr]}\">$abbr</abbr>";
    }
    return $abbr;
}

function abbrAll(): string{
    global $abbrevations;
    $output = "<table>\n";
    foreach($abbrevations as $abbr => $full){
        $output .= "  <tr><th>$abbr</th><td>$full</td></tr>\n";
    }
    $output .= "</table>";
    return $output;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Abréviations</title>
</head>
<body>
    <p>
        Le langage <?= abbr('PHP') ?>
        produit généralement du <?= abbr('HTML') ?>.
    </p>
    <p>Voici toutes les abréviations connues : </p>
    <?= abbrAll() ?>

</body>
</html>
