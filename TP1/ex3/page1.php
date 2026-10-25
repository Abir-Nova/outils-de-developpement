<?php
// Page 1 : tableau Name / Age
require_once 'config.php';   // charge generateTable()

// Données de l'énoncé : nom => âge
$table1 = ['Amine' => '30', 'Ali' => '60'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page 1</title>
    <?= styleTable() ?>
</head>

<body>
    <h2>Table1 (page1.php)</h2>
    <?= generateTable($table1, ['Name', 'Age']) ?>
</body>

</html>