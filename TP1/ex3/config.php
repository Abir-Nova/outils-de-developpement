<?php
/*
 * Exercice 3 - Fonction réutilisable generateTable()
 * Fichier : config.php (inclus par page1.php et page2.php)
 */

/**
 * Génère le code HTML d'un tableau à deux colonnes à partir d'un tableau associatif
 * @param array $donnees  tableau associatif (clé => valeur)
 * @param array $entetes  les deux titres de colonnes, ex. ['Name', 'Age']
 * @return string         le code HTML du tableau
 */
function generateTable(array $donnees, array $entetes): string
{
    // En-tête du tableau : une cellule <th> par titre
    $html  = "<table>\n<thead>\n<tr>";
    foreach ($entetes as $titre) {
        $html .= "<th>" . htmlspecialchars($titre) . "</th>";
    }
    $html .= "</tr>\n</thead>\n<tbody>\n";

    // Corps du tableau : une ligne par couple clé => valeur
    foreach ($donnees as $cle => $valeur) {
        $html .= "<tr><td>" . htmlspecialchars($cle) . "</td>"
            . "<td>" . htmlspecialchars($valeur) . "</td></tr>\n";
    }
    $html .= "</tbody>\n</table>\n";

    return $html;   // on retourne le HTML : à la page de décider de l'afficher
}

/** Style CSS commun aux deux pages */
function styleTable(): string
{
    return "<style>
        body  { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; min-width: 350px; }
        th, td { padding: 10px 20px; text-align: left; border-bottom: 1px solid #ddd; }
        th    { background: #6d8ab4; color: #fff; }
    </style>";
}
