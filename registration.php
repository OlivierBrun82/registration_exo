<?php

    $errors =[

    ];

//  condition pour vérifier si on a reçu une request en post (formulaire)
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // var_dump($_POST);
        // récupération des données
        $name = (trim(htmlspecialchars($_POST["name"])));
        $email = (trim(htmlspecialchars ($_POST["email"])));
        $password =  $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        //validation username
        //valide que le champ soit remplis
        if (empty($username)) {
            $errors[] = "nom obligatoire !";
        //valide avec la function strlen si la string est de plus de 3 carac
        }elseif (strlen($username) < 3) {
            $errors[] = "mini 3 carac";
        //valide avec la function strlen si la string est de moins de 55 carac
        }elseif (strlen($username) > 55) {
            $errors[] = "max 55 carac";
        }
        //validation email
        if (empty($email)) {
            $errors[] = "email obligatoire ! ( connard )";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "votre adresse ne correspond au format mail classique";
        }
        //validation password
        if (empty($password)) {
            $errors[] = "password obligatoire";
        }elseif ( strlen($password) < 3 ) {
            $errors[] = "password trop juste";
            // normalement ici on met un pattern pour le mdp
        }elseif ( $password !== $confirmPassword ) {
            $errors[] = "mot de passe doivent etre identique";
        };
    };
         
    // var_dump("$name,$email,$password,$confirmPassword");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1><strong>Formulaire de connection</strong></h1>
    </header>
    <main>
        <section class="formContainer">
            <form action="" method="POST">
                <div>
                    <label for="name">Pseudo</label>
                    <input type="text" name="name" id="name" required placeholder="Entrez votre Pseudo">
                </div>
                <div>
                    <label for="email">e-mail</label>
                    <input type="email" name="email" id="email" required placeholder="Entrez votre E-mail">
                </div>    
                <div>
                <label for="password">mot de passe</label>
                <input type="password" name="password" id="password" required placeholder="Entrez votre mot de passe">
                </div>
                <div>
                <label for="confirmPassword">mot de passe</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required placeholder="Confirmez votre mot de passe">
                </div>
                <input type="submit" value="submit">
            </form>
        </section>

    </main>
    <footer>
        <span>© Legal Content</span>
    </footer>    
</body>
</html>