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
        /*
        * Si l'url existe 
        * On l'ajoute pas
        * Sinon
        * On l'ajoute
        */
        $sthDocument = $dbh->prepare("SELECT * FROM document WHERE url = ?");
		$sthDocument->bindParam(1, $url);
        $sthDocument->execute();
        $resultDocument = $sthDocument->fetch(\PDO::FETCH_ASSOC);
        if ($sthDocument->rowCount() == 0) {
            $numerod = uniqid(rand(), true);
            $insertDocument = $dbh->prepare("INSERT INTO document(numerod, titre, url) VALUES(?, ?, ?)");
            $insertDocument->bindParam(1, $numerod);
            $insertDocument->bindParam(2, $title);
            $insertDocument->bindParam(3, $url);
            $insertDocument->execute();
        }
        /*
        * Si les mots cles existent
        * On les ajoute pas
        * Sinon
        * On les ajoute
        */
        foreach ($keywords as $keyword) {
            $sthTerme = $dbh->prepare("SELECT * FROM terme WHERE motcle = ?");
            $sthTerme->bindParam(1, $keyword);
            $sthTerme->execute();
            $resultTerme = $sthTerme->fetch(\PDO::FETCH_ASSOC);
            if ($sthTerme->rowCount() == 0) {
                $numerot = uniqid(rand(), true);
                $insertTerme = $dbh->prepare("INSERT INTO terme(numerot, motcle) VALUES(?, ?)");
                $insertTerme->bindParam(1, $numerot);
                $insertTerme->bindParam(2, $keyword);
                $insertTerme->execute();
            }
            /*
            * On lie les mots cles au document
            */
            $sthDecrit = $dbh->prepare("SELECT * FROM decrit WHERE numerod = ? AND numerot = ?");
            if ($sthDocument->rowCount() == 0) {
                $sthDecrit->bindParam(1, $numerod);
            } else {
                $sthDecrit->bindParam(1, $resultDocument['numerod']);
            }
            if ($sthTerme->rowCount() == 0) {
                $sthDecrit->bindParam(2, $numerot);
            } else {
                $sthDecrit->bindParam(2, $resultTerme['numerot']);
            }
            $sthDecrit->execute();
            $resultDecrit = $sthDecrit->fetch(\PDO::FETCH_ASSOC);
            if ($sthDecrit->rowCount() == 0) {
                $insertDecrit = $dbh->prepare("INSERT INTO decrit(numerod, numerot) VALUES(?, ?)");
                if ($sthDocument->rowCount() == 0) {
                    $insertDecrit->bindParam(1, $numerod);
                } else {
                    $insertDecrit->bindParam(1, $resultDocument['numerod']);
                }
                if ($sthTerme->rowCount() == 0) {
                    $insertDecrit->bindParam(2, $numerot);
                } else {
                    $insertDecrit->bindParam(2, $resultTerme['numerot']);
                }
                $insertDecrit->execute();
            }
        }
        require '../db/close.php';
    }
?>