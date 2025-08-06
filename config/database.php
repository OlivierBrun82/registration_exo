<?php
    // Information pour se connecter
    //  l'endroit où est ma database
$host = "localhost";
    //  Le nom de la DB
$dbname = "user";
    //  Identifiant de connexion
$username = "root";
    //  password
$password = "*KLp4osj&3PC!29^$^tq%64Q7z7$2i$^";
    // port
$port= 80;
    // charset
$charset= "utf8mb4";

    // function qui crée et renvoi une connection à la db
function dbConnexion() {
    //transforme mes variable en global (accessible partout)
    global $host, $dbname, $password, $username, $port, $charset;

    try {
        // mes param de co
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        // fait mon objet de co
        $pdo = new PDO($dsn, $username, $password);
        // comment récupérer les exception (erreurs)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //comment me renvoyer les données
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;

    } catch (PDOException $e) {
        die("Erreur durant la co la db: " . $e->getMessage());
    }

}

// dbConnexion();
// var_dump($pdo);
?>