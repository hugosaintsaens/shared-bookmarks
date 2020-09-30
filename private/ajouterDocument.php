<?php
    if (isset($_POST["submit"]) && isset($_POST["title"]) && isset($_POST["url"]) && isset($_POST["keyword"]) && !is_null($_POST["title"]) && !is_null($_POST["url"]) && !is_null($_POST["keyword"])) {
        $title = htmlspecialchars($_POST["title"]);
        $url = htmlspecialchars($_POST["url"]);
        $keyword = htmlspecialchars($_POST["keyword"]);
        $url = strtolower($url);
        $keyword = strtolower($keyword);
        $keyword = explode(";",$keyword);
        $keywords = str_replace(" ", "", $keyword);
        unset($keyword);
        require '../db/open.php';
        // ON VERIFIE QUE L'URL DU DOCUMENT N'EXISTE PAS
        // SI L'URL EXISTE
        // ON L'AJOUTE PAS
        $sth = $dbh->prepare("SELECT * FROM document WHERE url = ?");
		$sth->bindParam(1, $url);
        $sth->execute();
        $sth->fetch(\PDO::FETCH_ASSOC);
        if ($sth->rowCount() == 0) {
            $numerod = uniqid(rand(), true);
            $insert = $dbh->prepare("INSERT INTO document(numerod, titre, url) VALUES(?, ?, ?)");
            $insert->bindParam(1, $numerod);
            $insert->bindParam(2, $title);
            $insert->bindParam(3, $url);
            $insert->execute();
        }
        // ON VERIFIE QUE LES MOTS CLES N'EXISTENT PAS
        // SI LES MOTS CLES EXISTE
        // ON LES AJOUTENT PAS
        foreach ($keywords as $keyword) {
            $sth = $dbh->prepare("SELECT * FROM terme WHERE motcle = ?");
            $sth->bindParam(1, $keyword);
            $sth->execute();
            $sth->fetch(\PDO::FETCH_ASSOC);
            if ($sth->rowCount() == 0) {
                $numerot = uniqid(rand(), true);
                $insert = $dbh->prepare("INSERT INTO terme(numerot, motcle) VALUES(?, ?)");
                $insert->bindParam(1, $numerot);
                $insert->bindParam(2, $keyword);
                $insert->execute();
            }
        }
        require '../db/close.php';
    }
?>