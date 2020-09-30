<?php
    require '../db/open.php';
    $sth = $dbh->prepare("SELECT * FROM document AS doc, terme AS t, decrit AS d WHERE doc.numerod = d.numerod AND d.numerot = t.numerot");
    $sth->execute();
    $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
    require '../db/close.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste</title>
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
    <h1 class="text-center">Liste des documents</h1>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Titre</th>
            <th scope="col">URL</th>
            <th scope="col">Termes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <th scope="row"><= $row['titre'] ?></th>
                    <td>Mark</td>
                    <td>Otto</td>
                </tr>
            <?php } ?>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</body>
</html>