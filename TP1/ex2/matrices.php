<?php
/*
 * Exercice 2 - Opérations sur les matrices
 *  1) Somme de deux matrices carrées
 *  2) Produit de deux matrices
 * Une matrice est représentée par un tableau de tableaux : $M[ligne][colonne]
 */

/**
 * Somme de deux matrices : C[i][j] = A[i][j] + B[i][j]
 * Les deux matrices doivent avoir exactement les mêmes dimensions
 */
function sommeMatrices(array $A, array $B): array
{
    if (count($A) !== count($B) || count($A[0]) !== count($B[0])) {
        throw new InvalidArgumentException("Les matrices doivent avoir les mêmes dimensions");
    }
    $C = [];
    for ($i = 0; $i < count($A); $i++) {            // parcours des lignes
        for ($j = 0; $j < count($A[0]); $j++) {     // parcours des colonnes
            $C[$i][$j] = $A[$i][$j] + $B[$i][$j];
        }
    }
    return $C;
}

/*
 * Produit de deux matrices : C[i][j] = somme sur k de A[i][k] * B[k][j]
 * Condition : nombre de colonnes de A = nombre de lignes de B
 */
function produitMatrices(array $A, array $B): array
{
    $lignesA   = count($A);
    $colonnesA = count($A[0]);
    $colonnesB = count($B[0]);
    if ($colonnesA !== count($B)) {
        throw new InvalidArgumentException("Produit impossible : colonnes(A) doit être égal à lignes(B)");
    }
    $C = [];
    for ($i = 0; $i < $lignesA; $i++) {
        for ($j = 0; $j < $colonnesB; $j++) {
            $C[$i][$j] = 0;                          // initialisation de la case
            for ($k = 0; $k < $colonnesA; $k++) {    // somme des produits
                $C[$i][$j] += $A[$i][$k] * $B[$k][$j];
            }
        }
    }
    return $C;
}

// Affiche une matrice sous forme de table HTML
function afficherMatrice(array $M, string $titre): void
{
    echo "<h3>" . htmlspecialchars($titre) . "</h3><table>";
    foreach ($M as $ligne) {
        echo "<tr>";
        foreach ($ligne as $val) {
            echo "<td>$val</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Données de test (matrices carrées 3x3)
$A = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
$B = [[9, 8, 7], [6, 5, 4], [3, 2, 1]];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>TP PHP - Exercice 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #222;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            border: 1px solid #999;
            padding: 8px 16px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Exercice 2 : matrices</h1>
    <?php
    afficherMatrice($A, "Matrice A");
    afficherMatrice($B, "Matrice B");
    afficherMatrice(sommeMatrices($A, $B),  "1) A + B");
    afficherMatrice(produitMatrices($A, $B), "2) A x B");
    ?>
</body>

</html>