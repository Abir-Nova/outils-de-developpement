<?php
// Page 2 : tableau Email / Phone (même fonction, autres paramètres)
require_once 'config.php';

// NB : l'énoncé nomme ce tableau $table1 par erreur ; on l'appelle $table2
$table2 = [
    'sam@gmail.com'  => '+2124444444',
    'cris@gmail.com' => '+2128888888',
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page 2</title>
    <?= styleTable() ?>
</head>

<body>
    <h2>Table2 (page2.php)</h2>
    <?= generateTable($table2, ['Email', 'Phone']) ?>
</body>

</html>