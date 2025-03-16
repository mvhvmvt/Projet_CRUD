<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="styletout.css">
</head>
<body>
    <?php
        if (!isset($_POST['login'], $_POST['password'])) 
        {?>
        <div class="form-container">
            <h1>Connexion</h1>
                <form method="post">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <input type="submit" value="Connexion">
                </form>
        </div><?php
            
        } else {
            $login = $_POST['login'];
            $passwd = $_POST['password'];

            if ($login == 'admin' && $passwd == 'passer') {
                $_SESSION['connect'] = 'yes';
                header('Location: list.php');
                exit(); 
            } else {
                echo "<script>alert('mot de passe ou/et login incorrect');</script>";
                echo '<a href="login.php">retour</a>';
            }
        }
    ?>
</body>
</html>