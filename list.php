<?php
    session_start();
    if (!isset($_SESSION['connect'])) {
        header('Location: login.php');
    }
    $conn = new mysqli("localhost", "Nassour", "Passer", "crud");
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    
    $result = $conn->query("SELECT id, nom, prenom, login FROM users");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="styletout.css"> 
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <nav>
        <a href="add.php">Ajouter</a>    
        <a href="logout.php">Deconnexion</a>
    </nav>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Actions</th>
        </tr>
        <?php while ($ligne = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $ligne['id'] ?></td>
                <td><?= $ligne['nom'] ?></td>
                <td><?= $ligne['prenom'] ?></td>
                <td><?= $ligne['login'] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $ligne['id']; ?>">✏️ Modifier</a> |
                    <a href="supprimer.php?id=<?= $ligne['id']; ?>" onclick="return confirm('Confirmer la suppression ?');">❌ Supprimer</a> |
                    <a href="details.php?id=<?= $ligne['id']; ?>"> 📰 Détails</a> 
                </td>
            </tr>
        <?php } ?>
    </table>  
    
</body>
</html>
