<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
</head>
<body>

    
        <h2>Formulaire d'ajout d'utilisateur</h2>
        <form action="ajoututilisateur.php" method="POST">
           <div>
             <label for="mail">mail:</label>
              <input type="text" id="mail" name="mail" required>
           </div>    
            <div>
                <label for="nom_u">nom:</label>
                <input type="text" id="nom_u" name="nom_u" required>
            </div>    
            <div>
                <label for="prenom_u">prenom:</label>
                <input type="text" id="prenom_u" name="prenom_u" required>
            </div>
            <div>
              <label for="password">password:</label>
              <input type="password" id="password" name="password" required>
           </div>
           <div>
             <label for="localisation">localisation:</label>
             <input type="text" id="localisation" name="localisation" required>
          </div>    
          <div>
            <label for="statut">statut:</label>
            <select id="statut" name="statut">
              <option value="etudiant">Étudiant</option>
              <option value="membre_bde">Membre du BDE</option>
              <option value="salaries cesi">Salarié Cesi</option>
            </select>
        <br><br>
         </div>
            <button type="submit" name="action" value="inscription" >s'incrire</button>
        </form>
</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    $mail = $_POST['mail'];
    $nom_u = $_POST['nom_u'];
    $prenom_u = $_POST['prenom_u'];
    $password = $_POST['password'];
    $localisation = $_POST['localisation'];
    $statut = $_POST['statut'];

   
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

    $creation = $bdd->prepare("CALL AjoutUtilisateur(:mail,:nom_u, :prenom_u,:password,:localisation,:statut)");
    $creation ->bindParam(':mail', $mail);
    $creation ->bindParam(':nom_u', $nom_u);
    $creation ->bindParam(':prenom_u', $prenom_u);
    $creation ->bindParam(':password', $password); 
    $creation ->bindParam(':localisation', $localisation);
    $creation ->bindParam(':statut', $statut);

    
    $creation ->execute();
    echo " Bienvenue $nom_u";
}
    ?>

   