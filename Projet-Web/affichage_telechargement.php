<?php

$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'group7', 'kerry');


$recuperation = $bdd->prepare("CALL Recupereinscrits");
$recuperation->execute();
$donnees = $recuperation->fetchAll(PDO::FETCH_ASSOC);


$csv_content = "Nom de l'événement,Email,Nom de la manifestation\n";
foreach ($donnees as $row) {
    $csv_content .= '"' . $row['nom_inscrit'] . '","' . $row['mail'] . '","' . $row['nom_manifestation'] . '"' . "\n";
}

$filename_csv = "liste_des_inscrits.csv";

if (isset($_GET['telecharger'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename_csv . '"');
    echo $csv_content;
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des inscrits</title>
</head>
<body>
    <h1>Liste des inscrits</h1>
    <table border="1">
        <tr>
            <th>Nom de l'événement</th>
            <th>Email</th>
            <th>Nom de la manifestation</th>
        </tr>
        <?php foreach ($donnees as $row): ?>
        <tr>
            <td><?php echo $row['nom_inscrit']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><?php echo $row['nom_manifestation']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form action="affichage_telechargement.php" method="get">
        <input type="hidden" name="telecharger" value="1">
        <button type="submit">Télécharger CSV</button>
    </form>
</body>
</html>