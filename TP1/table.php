<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Table de multiplication</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }
        td {
            border: 1px solid #ddd;
            text-align: center;
            width: 30px;
            height: 30px;
        }
        .number {
            display: inline-block;
            border: 2px solid #007bff;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <table>
        <?php
        $rows = 5;
        $cols = 5;

        for ($i = 1; $i <= $rows; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $cols; $j++) {
                if ($i == 1 || $j == 1) {
                    $number = max($i, $j)-1;
                } else {
                    $number = ($i-1) * ($j-1);
                }
                
                if ($number == 0) {
                    echo "<td><span class='number'></span></td>";
                } else {
                    echo "<td><span class='number'>$number</span></td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>