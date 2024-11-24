<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'triplek', 'K3m@j0uK3rry');
    
$recuper = $bdd->prepare("CALL RecupereIdee");
$recuper->execute();

while ($tout = $recuper->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="image-container">
                    <img src="' . $tout["image_i"] . '" class="img-fluid" alt="Image" width="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <p>' . $tout["description_i"] . '</p>
                <p>' . $tout["date_i"] . '</p>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 text-center">
                <div class="button-group">
                    <button id="like" onclick="clike()">
                        <img id="like-image" src="likes.png"></button> 
                    <span id="like-count">0</span>
                    <button id="dislike" onclick="diclike()">
                        <img id="dislike-image" src="dislike.png"></button> 
                    <span id="dislike-count">0</span>
                    <script>
                        let likeCount = 0;
                        let dislikeCount = 0;

                        function clike() {
                            likeCount++;
                            document.getElementById("like-image").src = "like bleu.png";
                            document.getElementById("dislike-image").src = "dislike.png";
                            document.getElementById("like-count").textContent = likeCount;
                        }

                        function diclike() {
                            dislikeCount++;
                            document.getElementById("dislike-image").src = "bleu.png";
                            document.getElementById("like-image").src = "likes.png";
                            document.getElementById("dislike-count").textContent = dislikeCount;
                        }
                    </script>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 text-center">
                <div class="button-group1">
                    <button class="modifier-button" id="okay" onclick="modifierdate()">ModifierDate</button>
                </div>
                <div class="button-group1">
                    <button class="modifier-button" id="okay" onclick="modifieridee()">ModifierIdee</button>
                </div>
            </div>
        </div>
    </div>
    ';
}
?>