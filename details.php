<?php
    session_start();
    if (!isset($_SESSION['connect'])) {
        header('Location: login.php');
    }
    
    $conn = new mysqli("localhost", "Nassour", "Passer", "crud");
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    if (!isset($_GET['id'])) {
        die("ID invalide.");
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        die("Utilisateur introuvable.");
    }

    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'utilisateur</title>
    <link rel="stylesheet" href="styletout.css">
</head>
<body>
    <h1>Détails de l'utilisateur</h1>
    <nav>
        <a href="list.php">Retour</a> <!-- Lien pour retourner à la liste des utilisateurs -->
        <a href="logout.php">Deconnexion</a>
    </nav>
    <table border="1">
        <tr>
            <th>ID</th>
            <td><?= $row['id'] ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?= $row['nom'] ?></td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td><?= $row['prenom'] ?></td>
        </tr>
        <tr>
            <th>Login</th>
            <td><?= $row['login'] ?></td>
        </tr>
        <tr>
            <th>Photo</th>
            <td>
                <a href="<?= $row['profil']; ?>">Afficher la photo</a>
            </td>
        </tr>
    </table>
</body>
</html>