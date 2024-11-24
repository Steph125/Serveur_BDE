<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Formulaire d'ajout de manifestation</title>
</head>
<body>
    <section class="contact-form">
        <h2>Formulaire d'ajout de manifestation</h2>
        <form action="evenement_mois.php" method="POST">
            <div>
                <label for="nom_e">Nom :</label>
                <input type="text" id="nom_e" name="nom_e" required>
            </div>
            <div>
                <label for="prix_e">Prix :</label>
                <input type="text" id="prix_e" name="prix_e" required>
            </div>
            <div>
                <label for="description_e">Description :</label>
                <input type="text" id="description_e" name="description_e" required>
            </div>
            <div>
                <label for="date_e">Date :</label>
                <input type="date" id="date_e" name="date_e" required>
            </div>
            <div>
                <label for="image_e">URL de l'image :</label>
                <input type="text" id="image_e" name="image_e" required>
            </div>
            <button type="submit" name="action" value="regle">Envoyer</button>
        </form>
    </section>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['action']) && $_POST['action'] === 'regle') {
    
            $nom_e = $_POST['nom_e'];
            $description_e = $_POST['description_e'];
            $image_e = $_POST['image_e'];
            $date_e = $_POST['date_e'];
            $prix_e = $_POST['prix_e'];

           
            $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

            $ajout = $bdd->prepare("CALL PostEvenement(:nom_e, :description_e, :image_e ,:date_e, :prix_e)");
            $ajout->bindParam(':nom_e', $nom_e);
            $ajout->bindParam(':prix_e', $prix_e);
            $ajout->bindParam(':description_e', $description_e);
            $ajout->bindParam(':date_e', $date_e);
            $ajout->bindParam(':image_e', $image_e);

            $ajout->execute();

          
            echo "<h3>L'événement a été ajouté avec succès.</h3>";
        }
    }
    ?>
</body>
</html>