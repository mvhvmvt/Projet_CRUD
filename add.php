<?php
    session_start();
    if (!isset($_SESSION['connect'])) {
        header('Location: login.php');
        }
    $conn = new mysqli("localhost", "Nassour", "Passer", "crud");
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        $password = md5($mdp);
        $dossier = "uploads/";
        $chemin = $dossier . basename($_FILES["photo"]["name"]);
        if (!is_dir($dossier)) {
            mkdir($dossier, 0755, true);
        }
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $chemin)) {
            $sql = "INSERT INTO users (nom, prenom, login, password, profil) VALUES ('$nom', '$prenom', '$login', '$password', '$chemin')";
        }   
        if ($conn->query($sql) === TRUE) {
            header("Location: list.php");
             exit(); 
         } else {
             echo "<p>Erreur</p>";
         }

    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styletout.css">
    <title>Document</title>
</head>
<body>
    <h1>Informations sur l'utilisateur</h1>
    <nav>
        <a href="list.php">Retour</a>
        <a href="logout.php">Deconnexion</a>   
    </nav>
    <form method="post" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

     	<label for="prenom">Prenom: </label>
        <input type="text" name="prenom" required><br>

        <label for="nom">Login:</label>
        <input type="text" id="login" name="login" required><br>

     	<label for="prenom">Mot de passe: </label>
        <input type="password" name="mdp" required><br>

        <label for="photo">Ajouter une photo</label>
        <input type="file" name="photo" id="photo" required><br>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>