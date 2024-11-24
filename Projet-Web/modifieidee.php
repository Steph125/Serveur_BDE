<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Modifier une idée</title>
</head>
<body>
    <section class="contact-form">
        <form action="modifieidee.php" method="POST">
            <div>
                <label for="nom_i">Nom :</label>
                <input type="text" id="nom_i" name="nom_i" required>
            </div>
            <div>
                <label for="new_description">Description :</label>
                <input type="text" id="new_description" name="new_description" required>
            </div>
            <div>
                <label for="new_image">URL de l'image :</label>
                <input type="text" id="new_image" name="new_image" required>
            </div>
            <button type="submit" name="action" value="inscrire">Modifier</button>      
        </form>
    </section>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom_i = $_POST['nom_i'];
        $new_description = $_POST['new_description'];
        $new_image = $_POST['new_image'];

       
        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');


        $verifie = $bdd->prepare("SELECT * FROM idees WHERE nom_i = :nom_i");
        $verifie->bindValue(':nom_i', $nom_i, PDO::PARAM_STR);
        $verifie->execute();
        $verification = $verifie->fetch(PDO:: FETCH_ASSOC);

        if ($verification) {
            
            $modification = $bdd->prepare("CALL ModificationIdee(:nom_i, :new_description, :new_image)");
            $modification->bindParam(':nom_i', $nom_i);
            $modification->bindParam(':new_description', $new_description);
            $modification->bindParam(':new_image', $new_image);
            $modification->execute();
            echo "<p>La modification a été effectuée avec succès.</p>";
            
            
            $email = $bdd->prepare("SELECT mail_i FROM idees WHERE nom_i = :nom_i"); 
            $email->bindParam(':nom_i', $nom_i, PDO::PARAM_STR); 
            $email->execute();
            $user = $email->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {

                $to = $user['mail_i'];
                echo "<a href='mailto:$to'>Notifier $to</a>";
            }
        } else {
            echo "<p>Le nom n'a pas été trouvé, impossible de modifier l'idée.</p>";
        }
    }
    ?>
</body>
</html>