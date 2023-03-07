<?php
  
  if(isset($_POST['submit'])) { // Si user a cliqué sur le bouton Submit : 
    // 1- CONNEXION BDD = FILE
    $pdo = new PDO('mysql:host=localhost;dbname=file', 'root', '');
    // 2- PREPARATION DE LA REQUETE SQL AVEC DES MARQUEURS INTERROGATIFS
    $req = $pdo->prepare("INSERT INTO images (nom, taille, type, bin) VALUES (?, ?, ?, ?)");
    $name = $_FILES["file"]["name"]; // RECUP NOM DU FICHIER
    $size = $_FILES['file']['size']; // RECUP TAILLE DU FICHIER
    $type = $_FILES['file']['type']; // RECUP TYPE / EXTENSION DU FICHIER
    $content = file_get_contents($_FILES['file']['tmp_name']); // RECUP CONTENU DU FICHIER
    $req->bindParam(1, $name);  // Attribut $name au marqueur interrogatif à la position 1 (celui tout à gauche)
    $req->bindParam(2, $size); // Attribut $size au marqueur interrogatif à la position 2
    $req->bindParam(3, $type); // Atrbbit $size au marqueur interrogatif à la position 3
    $req->bindParam(4, $content); // Attribut $content au marqueur interrogatif à la position 4
    $req->execute(); // 3- Exécution de la requête et enregistrement en BDD.

  };
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title>Enregistrer un fichier dans une base de données</title>
</head>
<body>
  <h1>Méthode pour enregistrer un fichier dans une base de données</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Envoyer">
  </form>
</body>
</html>