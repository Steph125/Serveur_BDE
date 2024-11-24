<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="contact.css">
</head>
<body>


    <section class="contact-form">
        <form action="ajoutdateidee.php" method="POST">
            <div>
                <label for="nom_i">nom:</label>
                <input type="text" id="nom_i" name="nom_i" required>
            </div>
            <div>
                <label for="new_date">date:</label>
                <input type="DATE" id="new_date" name="new_date" required>
            </div>
            <button type="submit" name="action" value="inscrit">ajouter</button>      
        </form>
    </section>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_i = $_POST['nom_i'];
    $new_date = $_POST['new_date'];
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

    
    $verifie = $bdd->prepare("SELECT * FROM idees WHERE nom_i = :nom_i");
    $verifie->bindValue(':nom_i', $nom_i, PDO::PARAM_STR);
    $verifie->execute();
    $verification = $verifie->fetch(PDO:: FETCH_ASSOC);

    if ($verification) {
        
        $requetedate = $bdd->prepare("CALL AjoutDate(:nom_i, :new_date)");
        $requetedate->bindParam(':nom_i', $nom_i);
        $requetedate->bindParam(':new_date', $new_date);
        $requetedate->execute();
        echo "La date a été ajoutée avec succès.";
        $email = $bdd->prepare("SELECT mail_i FROM idees WHERE nom_i = :nom_i"); 
        $email->bindParam(':nom_i', $nom_i, PDO::PARAM_STR); 
        $email->execute();
        $user = $email->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {

            $to = $user['mail_i'];
            echo "<a href='mailto:$to'>Notifier $to</a>";
        }

    } else {
        echo "Le nom n'a pas été trouvé, impossible d'ajouter la date.";
    }
}
?>

   
</body>
</html>