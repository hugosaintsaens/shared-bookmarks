<?php
        require '../db/open.php';
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
        require '../db/open.php';
        header("refresh:5;url=index.html");
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Création de la base</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
    <meta http-equiv="Content-Language" content="fr"/>
    <meta name="description" content="Exercices de PHP"/>
    <meta name="author" content="Hugo Saint-Saens"/>
    <meta name="keywords" lang="fr" content="PHP"/>
    <link rel="stylesheet" href="../css/custom.css"/>
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <script src="../js/bootstrap.js"></script>
</head>
<body class="creabase">
    <h1 class="text-center">Création de la base effectuée !</h1>
</body>
</html>