
<?php
    $dsn = 'mysql:dbname=shared-bookmarks;host=localhost';
    $user = 'root';
    $password = '';
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
?>