<?php
    require '../db/open.php';
    $sthDoc = $dbh->prepare("SELECT * FROM document ORDER BY titre ASC");
    $sthDoc->execute();
    $resultDoc = $sthDoc->fetchAll(\PDO::FETCH_ASSOC);
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
            <?php foreach ($resultDoc as $rowDoc) { ?>
                <tr>
                    <th scope="row"><?= $rowDoc['titre'] ?></th>
                    <td><a href="<?= $rowDoc['url'] ?>" target="_blank"><?= $rowDoc['url'] ?></a></td>
                    <td>
                        <?php
                            require '../db/open.php';
                            $sthKeywords = $dbh->prepare("SELECT t.motcle FROM document AS doc, terme AS t, decrit AS d WHERE doc.numerod = d.numerod AND d.numerot = t.numerot AND doc.numerod = ? ORDER BY t.motcle");
                            $sthKeywords->bindParam(1, $rowDoc['numerod']);
                            $sthKeywords->execute();
                            $resultKeywords = $sthKeywords->fetchAll(\PDO::FETCH_ASSOC);
                            require '../db/close.php';
                            $motcle = array();
                            foreach ($resultKeywords as $rowKeywords) {
                                array_push($motcle, $rowKeywords['motcle']);
                            }
                            echo implode(" ; ", $motcle);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>