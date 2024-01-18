<?php

class Model
{

    private $bd;

    private $omdbApi;

    private static $instance = null;

    private function __construct()
    {
        include_once("credentials.php");
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->omdbApi = $omdb_key;
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // MyDataBase
    public function getPersonneByTconst($tconst)
    {
        $req = $this->bd->prepare('SELECT DISTINCT nconst FROM titleprincipals where tconst= :tconst');
        $req->bindValue(":tconst", $tconst);
        $req->execute();
        return $req->fetchAll();
    }

    public function getTitreByNconst($nconst)
    {
        $req = $this->bd->prepare('SELECT DISTINCT tconst FROM titleprincipals where nconst= :nconst');
        $req->bindValue(":nconst", $nconst);
        $req->execute();
        return $req->fetchAll();
    }

    public function getActorInformationByNconst($nconst)
    {
        $req = $this->bd->prepare('SELECT * FROM namebasics where nconst= :nconst');
        $req->bindValue(':nconst', $nconst);
        $req->execute();
        return $req->fetchall();
    }

    public function getMovieInformationByTconst($tconst)
    {
        $req = $this->bd->prepare("SELECT * FROM titlebasics where tconst= :tconst");
        $req->bindValue(":tconst", $tconst);
        $req->execute();
        return $req->fetchall();
    }

    public function getMovieAndRatingInformationByTconst($tconst)
    {
        $req = $this->bd->prepare("SELECT * FROM titlebasics JOIN titleratings ON titlebasics.tconst=titleratings.tconst where titlebasics.tconst= :tconst");
        $req->bindValue(":tconst", $tconst);
        $req->execute();
        return $req->fetchall();
    }

    public function getTitreAndRatingInformationByTconst($tconst)
    {
        $req = $this->bd->prepare("SELECT * FROM titlebasics LEFT JOIN titleratings ON titlebasics.tconst=titleratings.tconst where titlebasics.tconst= :tconst");
        $req->bindValue(":tconst", $tconst);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }


    // OMDB API
    public function getOmdbDescription(String $tconst)
    {
        $verifierDonneeExistant = $this->bd->prepare("SELECT plot FROM omdbData WHERE tconst = :tconst");
        $verifierDonneeExistant->bindValue(":tconst", $tconst);
        $verifierDonneeExistant->execute();

        if ($verifierDonneeExistant->rowCount() > 0) {
            $verifierDonneeExistant = $verifierDonneeExistant->fetch();
            if ($verifierDonneeExistant != null && $verifierDonneeExistant['plot'] != null) {
                return $verifierDonneeExistant['plot'];
            }
        }

        $getContentsOmdb = file_get_contents('http://www.omdbapi.com/?i=' . $tconst . '&plot=full&apikey=' . $this->omdbApi);
        $omdb = json_decode($getContentsOmdb, TRUE);

        if ($omdb["Response"] == "True") {
            $verifierTconst = $this->bd->prepare("SELECT plot FROM omdbData WHERE tconst = :tconst");
            $verifierTconst->bindValue(":tconst", $tconst);
            $verifierTconst->execute();

            if ($omdb["Plot"] == "N/A") {
                if ($verifierTconst->rowCount() > 0) {
                    $ajoutPlot = $this->bd->prepare("UPDATE omdbdata set plot='Description non disponible' WHERE tconst=:tconst");
                    $ajoutPlot->bindValue(":tconst", $tconst);
                    $ajoutPlot->execute();
                } else {
                    $ajoutPlot = $this->bd->prepare("INSERT INTO omdbdata(tconst, plot) VALUES (:tconst, 'Description non disponible')");
                    $ajoutPlot->bindValue(":tconst", $tconst);
                    $ajoutPlot->execute();
                }

                return "Description non disponible";
            } else {

                if ($verifierTconst->rowCount() > 0) {
                    $ajoutPlot = $this->bd->prepare("UPDATE omdbdata set plot=:plot WHERE tconst=:tconst");
                    $ajoutPlot->bindValue(":tconst", $tconst);
                    $ajoutPlot->bindValue(":plot", $omdb["Plot"]);
                    $ajoutPlot->execute();
                } else {
                    $ajoutPlot = $this->bd->prepare("INSERT INTO omdbdata(tconst, plot) VALUES (:tconst, :plot)");
                    $ajoutPlot->bindValue(":tconst", $tconst);
                    $ajoutPlot->bindValue(":plot", $omdb["Plot"]);
                    $ajoutPlot->execute();
                }

                return $omdb["Plot"];
            }
        } else {
            return "Description non disponible";
        }
    }

    public function getOmdbAwards(String $tconst)
    {
        $verifierDonneeExistant = $this->bd->prepare("SELECT awards FROM omdbData WHERE tconst = :tconst");
        $verifierDonneeExistant->bindValue(":tconst", $tconst);
        $verifierDonneeExistant->execute();

        if ($verifierDonneeExistant->rowCount() > 0) {
            $verifierDonneeExistant = $verifierDonneeExistant->fetch();

            if ($verifierDonneeExistant != null && $verifierDonneeExistant['awards'] != null) {
                return $verifierDonneeExistant['awards'];
            }
        }

        $getContentsOmdb = file_get_contents('http://www.omdbapi.com/?i=' . $tconst . '&plot=full&apikey=' . $this->omdbApi);
        $omdb = json_decode($getContentsOmdb, TRUE);

        if ($omdb["Response"] == "True") {

            $verifierTconst = $this->bd->prepare("SELECT awards FROM omdbData WHERE tconst = :tconst");
            $verifierTconst->bindValue(":tconst", $tconst);
            $verifierTconst->execute();

            if ($omdb["Awards"] == "N/A") {
                if ($verifierTconst->rowCount() > 0) {
                    $ajoutAwards = $this->bd->prepare("UPDATE omdbdata set awards='Ce filmes n'a pas eu d'Awards' WHERE tconst=:tconst");
                    $ajoutAwards->bindValue(":tconst", $tconst);
                    $ajoutAwards->execute();
                } else {
                    $ajoutAwards = $this->bd->prepare("INSERT INTO omdbdata(tconst, awards) VALUES (:tconst, 'Ce filmes n'a pas eu d'Awards')");
                    $ajoutAwards->bindValue(":tconst", $tconst);
                    $ajoutAwards->execute();
                }

                return "Ce filmes n'a pas eu d'Awards";
            } else {
                if ($verifierTconst->rowCount() > 0) {
                    $ajoutAwards = $this->bd->prepare("UPDATE omdbdata set awards=:awards WHERE tconst=:tconst");
                    $ajoutAwards->bindValue(":tconst", $tconst);
                    $ajoutAwards->bindValue(":awards", $omdb["Awards"]);
                    $ajoutAwards->execute();
                } else {
                    $ajoutAwards = $this->bd->prepare("INSERT INTO omdbdata(tconst, awards) VALUES (:tconst, :awards)");
                    $ajoutAwards->bindValue(":tconst", $tconst);
                    $ajoutAwards->bindValue(":awards", $omdb["Awards"]);
                    $ajoutAwards->execute();
                }

                return $omdb["Awards"];
            }
        } else {
            return "Ce filmes n'a pas eu d'Awards";
        }
    }

    public function getOmdbPoster(String $tconst)
    {
        $verifierDonneeExistant = $this->bd->prepare("SELECT poster FROM omdbData WHERE tconst = :tconst");
        $verifierDonneeExistant->bindValue(":tconst", $tconst);
        $verifierDonneeExistant->execute();

        if ($verifierDonneeExistant->rowCount() > 0) {
            $verifierDonneeExistant = $verifierDonneeExistant->fetch();

            if ($verifierDonneeExistant != null && $verifierDonneeExistant['poster'] != null) {
                return $verifierDonneeExistant['poster'];
            }
        }

        $getContentsOmdb = file_get_contents('http://www.omdbapi.com/?i=' . $tconst . '&plot=full&apikey=' . $this->omdbApi);
        $omdb = json_decode($getContentsOmdb, TRUE);

        if ($omdb["Response"] == "True") {

            $verifierTconst = $this->bd->prepare("SELECT poster FROM omdbData WHERE tconst = :tconst");
            $verifierTconst->bindValue(":tconst", $tconst);
            $verifierTconst->execute();

            if ($omdb["Poster"] == "N/A") {
                if ($verifierTconst->rowCount() > 0) {
                    $ajoutPoster = $this->bd->prepare("UPDATE omdbdata set poster='Content/img/NoImageAvailable.png' WHERE tconst=:tconst");
                    $ajoutPoster->bindValue(":tconst", $tconst);
                    $ajoutPoster->execute();
                } else {
                    $ajoutPoster = $this->bd->prepare("INSERT INTO omdbdata(tconst, poster) VALUES (:tconst, 'Content/img/NoImageAvailable.png')");
                    $ajoutPoster->bindValue(":tconst", $tconst);
                    $ajoutPoster->execute();
                }

                return "Content/img/NoImageAvailable.png";

            } else {
                if ($verifierTconst->rowCount() > 0) {
                    $ajoutPoster = $this->bd->prepare("UPDATE omdbdata set poster=:poster WHERE tconst=:tconst");
                    $ajoutPoster->bindValue(":tconst", $tconst);
                    $ajoutPoster->bindValue(":poster", $omdb["Poster"]);
                    $ajoutPoster->execute();
                } else {
                    $ajoutPoster = $this->bd->prepare("INSERT INTO omdbdata(tconst, poster) VALUES (:tconst, :poster)");
                    $ajoutPoster->bindValue(":tconst", $tconst);
                    $ajoutPoster->bindValue(":poster", $omdb["Poster"]);
                    $ajoutPoster->execute();
                }

                return $omdb["Poster"];
            }
        } else {
            return "Content/img/NoImageAvailable.png";
        }
    }


    //Wikipedia affiche
    public function getActorPoster(String $nconst)
    {
        $verifierDonneeExistant = $this->bd->prepare("SELECT nconst, lien, date FROM afficheacteurs WHERE nconst = :nconst");
        $verifierDonneeExistant->bindValue(":nconst", $nconst);
        $verifierDonneeExistant->execute();

        if ($verifierDonneeExistant->rowCount() > 0) {
            $donnees = $verifierDonneeExistant->fetch();
            if ($donnees['lien'] != "" || $donnees['lien'] != null) {
                return $donnees['lien'];
            } else {
                return "Content/img/NoPictureAvailable.png";
            }
        } else {
            $ajoutNconst = $this->bd->prepare("INSERT INTO afficheacteurs VALUES (:nconst, null, now())");
            $ajoutNconst->bindValue(":nconst", $nconst);
            $ajoutNconst->execute();

            $command = "/usr/bin/python3 /home/DraCorporation/public_html/Content/json/python/AfficheActeurs.py 2>&1";

            try {
                exec($command, $output, $status);
                /* if ($status !== 0) {
                    echo "Erreur lors de l'exécution de la commande: $command";
                    var_dump($output);
                    exit();
                }//*/
            } catch (Exception $e) {
                echo 'Erreur lors de l\'exécution du script Python : ',  $e->getMessage(), "\n";
            }

            $recupererDonneeExistant = $this->bd->prepare("SELECT nconst, lien, date FROM afficheacteurs WHERE nconst = :nconst");
            $recupererDonneeExistant->bindValue(":nconst", $nconst);
            $recupererDonneeExistant->execute();

            $donnees = $recupererDonneeExistant->fetch();
            if ($donnees['lien'] != "" || $donnees['lien'] != null) {
                return $donnees['lien'];
            } else {
                return "Content/img/NoPictureAvailable.png";
            }
        }
    }

    public function getRapprochementDesFilms($startConst, $endConst)
    {
        $verifierDonneeExistant = $this->bd->prepare("SELECT sconst, econst, path FROM shortestPath WHERE sconst = :startConst and econst = :endConst");
        $verifierDonneeExistant->bindValue(":startConst", $startConst);
        $verifierDonneeExistant->bindValue(":endConst", $endConst);
        $verifierDonneeExistant->execute();

        if ($verifierDonneeExistant->rowCount() > 0) {
            $donnees = $verifierDonneeExistant->fetch();
            return $donnees['path'];
        } else {
            $ajoutConst = $this->bd->prepare("INSERT INTO shortestpath(sconst, econst, path, date) VALUES (:startConst, :endConst, null, now());");
            $ajoutConst->bindValue(":startConst", $startConst);
            $ajoutConst->bindValue(":endConst", $endConst);
            $ajoutConst->execute();

            $command = "/usr/bin/python3 /home/DraCorporation/public_html/Content/python/Algorithme_Rapprochement_des_films.py 2>&1";

            try {
                exec($command, $output, $status);
                /*if ($status !== 0) {
                    echo "Erreur lors de l'exécution de la commande: $command";
                    var_dump($output);
                    exit();
                }//*/
            } catch (Exception $e) {
                echo 'Erreur lors de l\'exécution du script Python : ',  $e->getMessage(), "\n";
            }

            $recupererDonneeExistant = $this->bd->prepare("SELECT sconst, econst, path FROM shortestPath WHERE sconst = :startConst and econst = :endConst");
            $recupererDonneeExistant->bindValue(":startConst", $startConst);
            $recupererDonneeExistant->bindValue(":endConst", $endConst);
            $recupererDonneeExistant->execute();

            $recupererDonneeExistant = $recupererDonneeExistant->fetchAll();

            return $recupererDonneeExistant[0]['path'];
        }
    }


    /**
     * Retourne les titre que la personne a participé
     * @return [array] Contient les tconst que le nconst a participé
     */
    public function getTitleInformation($tconst)
    {
        $req = $this->bd->prepare('SELECT tconst, titleType, primaryTitle, originalTitle, isAdult, startYear, endYear, runtimeMinutes, genres FROM titlebasics where tconst= :tconst');
        $req->bindValue("tconst", $tconst);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPersonneInformation($nconst)
    {
        $req = $this->bd->prepare('SELECT  nconst, primaryname, birthyear, deathyear, primaryprofession, knownfortitles FROM namebasics where nconst= :nconst');
        $req->bindValue("nconst", $nconst);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rechercheTitreAvecArgu($arguRecherche)
    {
        $queryFilm = "SELECT tconst, primarytitle FROM titlebasics WHERE similarity(lower(unaccent(primarytitle)), lower(unaccent(:arg))) > 0.7 limit 20";
        $resultFilms = $this->bd->prepare($queryFilm);
        $resultFilms->bindValue(':arg', $this->bd->quote($arguRecherche));
        $resultFilms->execute();
        return $resultFilms->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recherchePersonneAvecArgu($arguRecherche)
    {
        $queryPerso = "SELECT nconst, primaryname FROM namebasics WHERE similarity(lower(unaccent(primaryname)), lower(unaccent(:arg))) > 0.7 limit 20";
        $resultPerso = $this->bd->prepare($queryPerso);
        $resultPerso->bindValue(':arg', $this->bd->quote($arguRecherche));
        $resultPerso->execute();
        return $resultPerso->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getRandomMovie(String $genres)
    {

        if ($genres != "null") {
            $req = $this->bd->prepare("SELECT * FROM titlebasics WHERE :genres = ANY(genres) ORDER BY random() LIMIT 1");
            $req->execute(['genres' => $genres]);
            $req->execute();
            return $req->fetchall();
        } else {
            $req = $this->bd->prepare("SELECT * FROM titlebasics ORDER BY random() LIMIT 1");
            $req->execute();
            return $req->fetchall();
        }
    }

    public function getGenresMovie()
    {
        $req = $this->bd->prepare("SELECT * from genres");
        $req->execute();
        return $req->fetchall();
    }

    public function verifyCredentials($email, $passw)
    {
        try {
            $query = "SELECT email, passw FROM users WHERE email = :email;";
            $stmt = $this->bd->prepare($query);
            $stmt->execute([':email' => $email]);
            $row = $stmt->fetchAll();
            if (isset($row[0]['passw']) && password_verify($passw, $row[0]['passw'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createAccount($email, $passw, $username)
    {
        try {
            $query = "INSERT INTO Users VALUES (:email, :username, :passw);";
            $stmt = $this->bd->prepare($query);
            $passw = password_hash($passw, PASSWORD_DEFAULT);
            $stmt->execute(['email' => $email, 'username' => $username, 'passw' => $passw]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getName($email)
    {
        try {
            $query = "SELECT name FROM users WHERE email = :email;";
            $stmt = $this->bd->prepare($query);
            $stmt->execute(['email' => $email]);
            $name = $stmt->fetchAll()[0]['name'];
            return $name;
        } catch (PDOException $e) {
            return "Name";
        }
    }

    public function insererNotation($email,$tconst,$rating)
    {
        try {
            $query = "INSERT INTO Usersnotes VALUES (:email, :tconst, :rating);";
            $stmt = $this->bd->prepare($query);
            $stmt->execute(['email' => $email, 'tconst' => $tconst, 'rating' => $rating]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getNotationDraCorportaion($tconst){
        try {
            $query = "Select Count(note) as nbVotes,tconst, AVG(note)::NUMERIC(10,1) as moyenne from Usersnotes where tconst=:tconst group by tconst;";
            $stmt = $this->bd->prepare($query);
            $stmt->bindValue('tconst',$tconst);
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return array();
        }
    }

    public function getNotationByUserOnTconst($email,$tconst){
        try {
            $query = "Select tconst,note from Usersnotes where tconst=:tconst and useremail=:email;";
            $stmt = $this->bd->prepare($query);
            $stmt->bindValue('tconst',$tconst);
            $stmt->bindValue('email',$email);
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return array();
        }
    }

}
