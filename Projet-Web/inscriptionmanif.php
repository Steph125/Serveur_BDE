<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
</head>
<body>

    <section class="contact-form">
        <h2>Formulaire d'inscription au manifestation</h2>
        <form action="inscriptionmanif.php" method="POST">
           <div>
               <label for="mail">mail:</label>
               <input type="text" id="mail" name="mail" required>
           </div>
            <div>
                <label for="nom_inscrit">nom:</label>
                <input type="text" id="nom_inscrit" name="nom_inscrit" required>
            </div>
           
            <div>
                <label for="nom_manifestation">nom de la manifestation:</label>
                <input type="text" id="nom_manifestation" name="nom_manifestation" reauired>
            </div>
           
           
            <button type="submit" name="action" value="inscript" >S'inscrire</button>
        </form>
</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'inscript') {
        $mail = $_POST['mail'];
        $nom_inscrit = $_POST['nom_inscrit'];
        $nom_manifestation = $_POST['nom_manifestation'];

      
        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

        
        $verifions = $bdd->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
        $verifions->bindValue(':mail', $mail, PDO::PARAM_STR);
        $verifions->execute();
        $reverification = $verifions->fetch(PDO::FETCH_ASSOC);

        
        $reverifions = $bdd->prepare("SELECT * FROM evenements WHERE nom_e = :nom_e");
        $reverifions->bindValue(':nom_e', $nom_manifestation, PDO::PARAM_STR);
        $reverifions->execute();
        $connecter = $reverifions->fetch(PDO::FETCH_ASSOC);

       
        if ($reverification && $connecter) {
           
            $inscription = $bdd->prepare("CALL Inscription(:mail,:nom_inscrit,:nom_manifestation)");
            $inscription->bindParam(':mail', $mail);
            $inscription->bindParam(':nom_inscrit', $nom_inscrit);
            $inscription->bindParam(':nom_manifestation', $nom_manifestation);
            $inscription->execute();

            echo "<h1>$nom_inscrit, vous êtes bien inscrit à la manifestation $nom_manifestation.</h1>";
        } else {
            echo "<h1>$nom_inscrit, vous ne pouvez pas vous inscrire à la manifestation $nom_manifestation, car elle n'existe pas</h1>";
        }
    }
}

?>
 
</body>
</html>
