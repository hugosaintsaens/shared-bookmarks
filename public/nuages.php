<?php
    require '../db/open.php';
    $sthKeywords = $dbh->prepare("SELECT t.motcle, COUNT(d.numerod) FROM terme AS t, decrit AS d WHERE t.numerot = d.numerot GROUP BY t.motcle ORDER BY t.motcle ASC");
    $sthKeywords->execute();
    $resultKeywords = $sthKeywords->fetchAll(\PDO::FETCH_ASSOC);
    require '../db/close.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Nuage</title>
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
<body class="liste">
    <h1 class="text-center">Nuage de mots-clés</h1>
    <?php
        foreach ($resultKeywords as $terme) {
            echo $terme['motcle'].' ';
        }
    ?>
</body>
</html>