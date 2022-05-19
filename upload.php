<?php
    $target_dir = "./upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if(isset($_POST["submit"])){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false){
            echo "Le fichier est un image - ". $imageFileType  . ".\n";
            $uploadOk = 1;
        } else {
            echo "file is not an image.\n";
            $uploadOk = 0;
        }

        if(file_exists($target_file)){
            echo "Désolé le fichier existe déja\n";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Désolé,le fichier est trop volumineux.\n";
            $uploadOk = 0;
        }

        // teste le format du fichier
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisées.\n";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Désolé, votre ficher n'a pas pu etre télécharger .\n";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " est téléchargé .\n";
            } else {
                echo "Désolé, il y a une erreur lors du téléchargement de votre fichier .\n";
            }
        }
    }