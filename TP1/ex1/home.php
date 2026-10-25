<?php
/*
 * Exercice 1 - Tableaux associatifs (notes des étudiants)
 * Rôle    : inclure test.php, appliquer les 8 questions et afficher
 *           chaque résultat dans un tableau HTML
 */

// On récupère le tableau $notes défini dans test.php
require_once 'test.php';

/*
 * Affiche un tableau associatif (prenom => note) sous forme de table HTML
 * @param array  $tab   le tableau à afficher
 * @param string $titre le titre affiché au-dessus du tableau
 */
function afficherTable(array $tab, string $titre): void
{
    echo "<h3>" . htmlspecialchars($titre) . "</h3>";
    echo "<table><thead><tr><th>prenom</th><th>note</th></tr></thead><tbody>";
    foreach ($tab as $prenom => $note) {
        echo "<tr><td>" . htmlspecialchars($prenom) . "</td><td>" . $note . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>
<!DOCTYPE html>
<html lang="fr">    

<head>
    <meta charset="UTF-8">
    <title>TP PHP - Exercice 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #222;
        }

        table {
            border-collapse: collapse;
            min-width: 220px;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 14px;
            text-align: left;
        }

        th {
            background: #6d8ab4;
            color: #fff;
        }

        .res {
            background: #eef3fa;
            padding: 8px 12px;
            border-left: 4px solid #9d4191;
        }
    </style>
</head>

<body>
    <h1>Exercice 1 : tableau associatif des notes</h1>

    <?php
    //  Question 1 : affichage du tableau initial 
    afficherTable($notes, "Q1 - Tableau initial");

    //  Question 2 : ajouter la note 10 de l'étudiant « Ali » 
    // Affecter une valeur à une nouvelle clé l'ajoute à la fin du tableau
    $notes["Ali"] = 10;
    afficherTable($notes, "Q2 - Après ajout de Ali (10)");

    //  Question 3 : supprimer la note de « najat » 
    // unset() supprime l'élément correspondant à la clé donnée
    unset($notes["najat"]);
    afficherTable($notes, "Q3 - Après suppression de najat");

    //  Question 4 : note maximale et note minimale 
    $noteMax = max($notes);   
    $noteMin = min($notes);   
    // array_keys($tab, $valeur) renvoie TOUTES les clés ayant cette valeur 
    $nomsMax = implode(", ", array_keys($notes, $noteMax));
    $nomsMin = implode(", ", array_keys($notes, $noteMin));
    echo "<h3>Q4 - Note maximale et minimale</h3>";
    echo "<p class='res'>Note maximale : <b>$noteMax</b> ($nomsMax)<br>";
    echo "Note minimale : <b>$noteMin</b> ($nomsMin)</p>";

    //  Question 5 : tri par ordre alphabétique (sur les noms) 
    $triAlpha = $notes;   // copie : on garde $notes intact pour la suite
    // ksort trie selon les CLÉS ; SORT_FLAG_CASE ignore la casse (Ali = ali)
    ksort($triAlpha, SORT_STRING | SORT_FLAG_CASE);
    afficherTable($triAlpha, "Q5 - Tri alphabétique (ksort)");

    //  Question 6 : la note 20 est-elle présente ? 
    // in_array(valeur, tableau, true) : le 3e paramètre true force la comparaison stricte (type + valeur)
    $presente = in_array(20, $notes, true);
    echo "<h3>Q6 - La note 20 existe-t-elle ?</h3>";
    echo "<p class='res'>La note 20 est " . ($presente ? "<b>présente</b>" : "<b>absente</b>") . " dans le tableau.</p>";

    //  Question 7 : classement par ordre de mérite 
    $merite = $notes;
    // arsort trie selon les VALEURS, ordre décroissant, en conservant les clés
    arsort($merite);
    afficherTable($merite, "Q7 - Classement par mérite (arsort)");

    //  Question 8 : moyenne de la classe 
    // array_sum = somme des notes ; count = nombre d'étudiants
    $moyenne = array_sum($notes) / count($notes);
    echo "<h3>Q8 - Moyenne de la classe</h3>";
    echo "<p class='res'>Moyenne = <b>" . round($moyenne, 2) . "</b> / 20</p>";
    ?>
</body>

</html>