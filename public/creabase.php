<?php
        require 'db/open.php';
        // CREATE TABLE document
        $sth = $dbh->prepare("CREATE TABLE document(
            numerod VARCHAR(150) PRIMARY KEY,
            titre VARCHAR(255) NOT NULL,
            url VARCHAR(255) NOT NULL)");
        $sth->execute();
        // CREATE TABLE terme
        $sth = $dbh->prepare("CREATE TABLE terme(
            numerot VARCHAR(150) PRIMARY KEY,
            motcle VARCHAR(255) NOT NULL)");
        $sth->execute();
        // CREATE TABLE decrit
        $sth = $dbh->prepare("CREATE TABLE decrit(
            numerod VARCHAR(100),
            numerot VARCHAR(100),
            PRIMARY KEY (numerod, numerot),
            FOREIGN KEY (numerod) REFERENCES document(numerod),
            FOREIGN KEY (numerot) REFERENCES terme(numerot)
        )");
        $sth->execute();
        require 'db/open.php';
        header("refresh:5;url=index.php");
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de la base</title>
</head>
<body>
    <h1>Création de la base effectuée !</h1>
</body>
</html>