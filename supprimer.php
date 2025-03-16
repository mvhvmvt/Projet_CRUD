<?php
    session_start();
    if (!isset($_SESSION['connect'])) {
        header('Location: login.php');
    }

$conn = new mysqli("localhost", "Nassour", "Passer", "crud");

    
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: list.php"); 
            exit;
        } else {
            echo "<p>Erreur: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>ID du joueur non spécifié.</p>";
    }

    $conn->close();
?>