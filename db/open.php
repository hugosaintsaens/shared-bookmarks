
<?php
    $dsn = 'mysql:dbname=signets;host=localhost';
    $user = 'root';
    $password = '';
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
?>