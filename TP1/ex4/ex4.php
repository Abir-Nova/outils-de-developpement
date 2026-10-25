<?php
/*
 * Exercice 4 - Chaînes de caractères et expressions régulières
 * Chaque question est une fonction qui retourne true / false
 * preg_match() retourne 1 si le motif correspond, 0 sinon
 */

/** Q1 : la chaîne ne contient que des lettres (accents compris) ? */
function contientQueDesLettres(string $s): bool
{
    // ^ début, \p{L}+ une ou plusieurs lettres Unicode, $ fin, /u = UTF-8
    return preg_match('/^\p{L}+$/u', $s) === 1;
    // Variante simple (lettres ASCII uniquement) : ctype_alpha($s)
}

/** Q2 : la chaîne contient-elle le caractère '@' ? */
function contientArobase(string $s): bool
{
    // strpos retourne la position ou false : on compare avec !== (strict)
    // car la position 0 est aussi "faux" avec un test simple.
    return strpos($s, '@') !== false;
}

/** Q3.a : numéro de téléphone de la forme 00-00-00-00-00 */
function estTelephone(string $s): bool
{
    // \d{2} : 2 chiffres ; (-\d{2}){4} : 4 groupes "tiret + 2 chiffres"
    // Le modificateur D empêche d'accepter un saut de ligne final
    return preg_match('/^\d{2}(-\d{2}){4}$/D', $s) === 1;
}

/** Q3.b : matricule = 3 lettres au début, 2 chiffres à la fin (ex. abc12) */
function estMatricule(string $s): bool
{
    // [a-zA-Z]{3} : 3 lettres ; .* : caractères éventuels ; \d{2} : 2 chiffres
    // (si le matricule doit faire exactement 5 caractères : /^[a-zA-Z]{3}\d{2}$/D)
    return preg_match('/^[a-zA-Z]{3}.*\d{2}$/D', $s) === 1;
}

/** Q3.c : code postal = exactement 5 chiffres */
function estCodePostal(string $s): bool
{
    return preg_match('/^\d{5}$/D', $s) === 1;
}

// Jeux d'essai : [fonction, libellé, valeurs à tester]
$tests = [
    ['contientQueDesLettres', 'Que des lettres',  ['Bonjour', 'abc123', 'été', '']],
    ['contientArobase',       "Contient '@'",      ['sam@gmail.com', 'samgmail.com', '@']],
    ['estTelephone',          'Téléphone',         ['06-12-34-56-78', '0612345678', '06-12-34-56']],
    ['estMatricule',          'Matricule',         ['abc12', 'ab123', 'abcd12', 'abc1']],
    ['estCodePostal',         'Code postal',       ['75001', '7500', '750011', '75a01']],
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>TP PHP - Exercice 4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #222;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 14px;
        }

        th {
            background: #6d8ab4;
            color: #fff;
        }

        .ok {
            color: #1a7f37;
            font-weight: bold;
        }

        .ko {
            color: #c62828;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Exercice 4 : expressions régulières</h1>
    <?php foreach ($tests as [$fonction, $libelle, $valeurs]): ?>
        <h3><?= htmlspecialchars($libelle) ?></h3>
        <table>
            <tr>
                <th>Chaîne testée</th>
                <th>Résultat</th>
            </tr>
            <?php foreach ($valeurs as $v): ?>
                <?php $ok = $fonction($v); // appel dynamique de la fonction 
                ?>
                <tr>
                    <td><?= $v === '' ? '(vide)' : htmlspecialchars($v) ?></td>
                    <td class="<?= $ok ? 'ok' : 'ko' ?>"><?= $ok ? 'Valide' : 'Invalide' ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
</body>

</html>