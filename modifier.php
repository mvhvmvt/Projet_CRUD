<?php
    session_start();
    if (!isset($_SESSION['connect'])) {
        header('Location: login.php');
    }
    $conn = new mysqli("localhost", "Nassour", "Passer", "crud");
    if ($conn->connect_error) {
       die("Connexion échouée: " . $conn->connect_error);
    }
    $id = $_GET['id'];
    if (!isset($_GET['id'])) {
        die("ID invalide.");
    }
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    if ($result->num_rows == 0) {
        die("Utilisateur introuvable.");
    }
    $row = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $password = md5($mdp);
    
       
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $dossier = "uploads/";
            $chemin = $dossier . basename($_FILES["photo"]["name"]);
    
            if (!is_dir($dossier)) {
                mkdir($dossier, 0755, true);
            }
    
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $chemin)) {
                
                $sql = "UPDATE users SET nom='$nom', prenom='$prenom', login='$login', password='$password', profil='$chemin' WHERE id=$id";
            } else {
                echo "Erreur lors de l'upload de la photo.";
            }
        } else {
           
            $sql = "UPDATE users SET nom='$nom', prenom='$prenom', login='$login', password='$password' WHERE id=$id";
        }
    
        
        if ($conn->query($sql) === TRUE) {
            header("Location: list.php");
            exit();
        } else {
            echo "Erreur : " . $conn->error;
        }
    }   
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styletout.css">
</head>
<body>
    <h1>Modification des Informations</h1>
    <nav>
        <a href="list.php">Retour</a> 
        <a href="logout.php">Deconnexion</a>
    </nav>
    <form method="POST" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>" required><br>

     	<label for="prenom">Prenom: </label>
         <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>" required><br>

        <label for="nom">Login:</label>
        <input type="text" id="login" name="login" value="<?php echo $row['login']; ?>" required><br>

     	<label for="prenom">Mot de passe: </label>
         <input type="password" name="mdp" value="<?php echo $row['password']; ?>" required><br>

        <label for="photo">Ajouter une photo</label>
        <input type="file" name="photo" id="photo"><br>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>