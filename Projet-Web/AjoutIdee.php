
    <?php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
        $nom_i = $_POST['nom_i'];
        $description_i = $_POST['description_i'];
        $image_i = $_POST['image_i'];    
        $mail_i = $_POST['mail_i'];

        
        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');

       
        $sauvegarde = $bdd->prepare("CALL AjouterIdee(:nom_i, :description_i, :image_i, :mail_i)");
        $sauvegarde->bindParam(':nom_i', $nom_i);
        $sauvegarde->bindParam(':description_i', $description_i);
        $sauvegarde->bindParam(':image_i', $image_i);
        $sauvegarde->bindParam(':mail_i', $mail_i);
        $sauvegarde->execute();
        echo "La manifestation a été ajoutée avec succès.";
        
    }
    ?>
   
</body>
</html>