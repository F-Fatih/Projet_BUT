<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Pour importer le CSS de Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Pour importer les icons de Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Pour importer le JS de Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- Pour importer le CSS custom-->
    <link href="Content/css/style.css" rel="stylesheet">
    <link href="Content/css/home.css" rel="stylesheet">
    <title>Dracorporation</title>
    <link rel="shortcut icon" href="Content/img/Tapis.ico" />
</head>

<body>
    <header> <!-- Navbar-->
        <nav class="navbar navbar-expand-lg degrade">
            <div class="container-fluid">
            <a href="index.php"> <img src="Content/img/dracorporation-logo.png" class='logo-navbar' alt='dracorporation-logo'/> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"aria-expanded="false">Algorithmes </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?controller=rechercheCommun">Films ou personnes en commun</a></li>
                            <li><a class="dropdown-item" href="?controller=RapprochementDesFilms">Rapprochement des films</a></li>
			    <li><a class="dropdown-item" href="?controller=randomMovie"> Random movie</a></li>
                        </ul>
                        </li>
                    </ul>
                    <form action="index.php"  method="get" class="d-flex" role="search">
                        <input type="hidden" name="controller" value="recherche">
                        <input class="form-control length-search" type="search" placeholder="Search" name = "search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                    <?php
                    if(isset($_SESSION['name'])){
                        ?>
                        <button class="btn btn-outline-light margin-switch" onclick="location.href = './index.php?controller=auth&action=disconnect';" type="">Se D&eacute;connecter</button>
                        <?php
                    } else {
                        ?>
                        <button class="btn btn-outline-light margin-switch" onclick="location.href = './index.php?controller=auth';" type="">Connexion / Inscription</button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>