<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>evenement passee</title>
</head>
<body>

<h2>Formulaire de modification d'événement passé</h2>
<form action="evenement_passee.php" method="post">
  <label for="nom">Nom :</label><br>
  <input type="text" id="nom" name="nom"><br>
  <label for="new_image">UrlImage :</label><br>
  <input type="text" id="new_image" name="new_image"><br><br>
  <button type="submit" name="action" value="modifie">Modifier</button>
</form>

<h2>Formulaire de suppression d'événement passé</h2>
<form action="evenement_passee.php" method="post">
<label for="new_nom">Nom :</label><br>
  <input type="text" id="new_nom" name="new_nom"><br>
  <label for="new_commentaire">Commentaire :</label><br>
  <input type="text" id="new_commentaire" name="new_commentaire"><br>
  <button type="submit" name="action" value="supprime">Supprimer</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');
    $action = $_POST['action'];
    $nom = $_POST['nom'] ?? '';
    $new_nom = $_POST['new_nom'] ?? '';
    $new_commentaire = $_POST['new_commentaire'] ?? '';

    switch ($action) {
        case 'modifie':
            $new_image = $_POST['new_image'] ?? '';

            $recup_date = $bdd->prepare("CALL recupredate(:nom, @eventDate)");
            $recup_date->bindParam(':nom', $nom, PDO::PARAM_STR);
            $recup_date->execute();
            $date_e = $bdd->query("SELECT @eventDate")->fetchColumn();

            if ($date_e && (new DateTime($date_e)) < (new DateTime())) {
                $modif = $bdd->prepare("CALL modificationevenementpasse(:nom, :new_image)");
                $modif->bindParam(':nom', $nom, PDO::PARAM_STR);
                $modif->bindParam(':new_image', $new_image, PDO::PARAM_STR);
                $modif->execute();
                echo "L'image a bien été modifiée";
            } else {
                echo "Impossible de modifier un événement du mois en cours ou du futur.";
            }
            break;

        case 'supprime':
            $recup_date = $bdd->prepare("CALL recupredate(:new_nom, @eventDate)");
            $recup_date->bindParam(':new_nom', $new_nom, PDO::PARAM_STR);
            $recup_date->execute();
            $date_e = $bdd->query("SELECT @eventDate")->fetchColumn();

            if ($date_e && (new DateTime($date_e)) < (new DateTime())) {
                $suppression = $bdd->prepare("CALL suppresionevenementpasse(:new_nom, :new_commentaire)");
                $suppression->bindParam(':new_nom', $new_nom, PDO::PARAM_STR);
                $suppression->bindParam(':new_commentaire', $new_commentaire, PDO::PARAM_STR);
                $suppression->execute();
                echo "Le commentaire a bien été supprimé";
            } else {
                echo "Impossible de supprimer un événement du mois en cours ou du futur.";
            }
            break;

        default:
            echo "Action non reconnue.";
            break;
    }
}
?>
</body>
</html>