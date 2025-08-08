<?php
    require_once "config/database.php";

    session_start();

    // On fait une function qui génère un token d'identification unique
    function generateToken() {
    return hash('sha256', uniqid('', true));
    }
    // On nomme la function token
    $token = generateToken();

    

    $errors = [];
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim(htmlspecialchars($_POST["email"]) ?? '');
        $password = $_POST["password"] ?? '';
        
        if(empty($password)) {
            $errors[] = "le mdp est obligatoire";
        }

        if(empty($email)) {
            $errors[] = "l'email est obligatoire";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "votre adresse ne correspond au format mail classique";
        }

        if (empty($errors)) {
            try {
                //appel de la fonction de connexion a la db
                $pdo = dbConnexion();
                //prépare une requete sql (email dynamique)
                $sql = "SELECT * FROM login WHERE email = ?";
                //stock ma request préparée 
                $requestDb = $pdo->prepare($sql);
                //"execute la request en lui passant en parametre l'element dynamique
                $requestDb->execute([$email]);
                //recupération des données
                $user = $requestDb->fetch();
                
                if ($user) {
                    //verification
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user_id"] = $user['id'];
                        $_SESSION["name"] = $user['name'];
                        $_SESSION["email"] = $user['email'];
                        $_SESSION['loggin'] = true;

                        $message = "super vous etes connecté " . htmlspecialchars($user['name']);
                        header('location: home.php');
                        exit();
                    }else{
                        $errors[] = "mot de passe pas bon ma gueule";
                    }     
                }else{
                    $errors[] = "compte introuvable ma gueule";
                }  
            } catch (PDOException $e) {
                $errors[] = "nous avons des problemes ma gueule: " . $e->getMessage();
            }
        }

        
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <section>
        <form method="POST">
            <?php
                foreach ($errors as $error) {
                    echo $error;
                }
                if(!empty($message)) {
                    echo $message;
                }
            ?>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Entrez votre email">
            </div>
            <div>
                <label for="password">password</label>
                <input type="password" name="password" id="password" required placeholder="entrer votre mdp">
            </div>
            <div>
                <input type="submit" value="envoyer">
            </div>
        </form>
    </section>
</body>
</html>