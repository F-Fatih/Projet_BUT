<?php require_once "view_begin.php"; ?>

<div class="container">
    <br>
    <br>
    <div class="hero-view">
        <div class="main-movie">
            <div class="main-movie-poster"></div>
            <p class="main-text">THE LAST OF US</p>
            <div class="explore-button">
                <button type="button" class="btn btn-sm"><a href="?controller=articleTLOU" style="color:white; text-decoration:none"> Voir plus > </a> </button>
             </div>
        </div>
        <div class="secondary-movies-box">
            <div class="secondary-movie">
                <div class="secondary-movie movie-top-left">
                    <p class="secondary-text">Mercredi, la nouvelle série Netflix de Tim Burton</p>
                    <div class="explore-button">
                        <button type="button" class="btn btn-sm "><a href="?controller=articleMercredi" style="color:white; text-decoration:none"> Voir plus > </a> </button>
                    </div>
                </div>
            </div>
            <div class="secondary-movie">
                <div class="secondary-movie movie-top-right">
                    <p class="secondary-text">Top Gun Maverick, le retour d’un classique après 36 ans</p>
                    <div class="explore-button">
                        <button type="button" class="btn btn-sm "><a href="?controller=articleTopgun" style="color:white; text-decoration:none"> Voir plus > </a> </button>
                    </div>
                </div>
            </div>
            <div class="secondary-movie">
                <div class="secondary-movie movie-bottom-left">
                    <p class="secondary-text">La résurrection du monde de Tolkien avec "Les Anneaux du Pouvoir"</p>
                    <div class="explore-button">
                        <button type="button" class="btn btn-sm "><a href="?controller=articleTolkien" style="color:white; text-decoration:none"> Voir plus > </a> </button>
                    </div>
                </div>
            </div>
            <div class="secondary-movie">
                <div class="secondary-movie movie-bottom-right">
                    <p class="secondary-text">House of the Dragon, le nouveau succès de George R.R. Martin</p>
                    <div class="explore-button">
                        <button type="button" class="btn btn-sm "><a href="?controller=articleDragon" style="color:white; text-decoration:none"> Voir plus > </a> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="movies">
        <div class="released">
            <h2>A L'AFFICHE</h2>
            <div class="movie">
                <div class="movie-poster blackpanther"></div>
                <div class="movie-text">
                    <h3 class="movie-title"><a href="?controller=recherche&action=affichage&search=tt9114286" style="color:white; text-decoration:none">Black Panther: Wakanda Forever</a></h3>
                    <p>La Reine Ramonda, Shuri, M'Baku, Okoye et les Dora Milaje luttent pour protéger leur nation des ingérences d'autres puissances mondiales après la mort du roi T'Challa. Alors que le peuple ...</p>
                    <div class="details">
                        <div class="duration"><p><u>Durée :</u> 2h42</p></div>
                        <div class="genres"><p><u>Genres :</u> Action, Aventure, ...</p></div>
                    </div>
                </div>  
            </div>            
        </div>
        <div class="soon">
            <h2>PROCHAINEMENT</h2>
            <div class="movie">
                <div class="movie-poster mariobros">
                    <div class="release-details">
                        <p class="month">Avril</p>
                        <p class="number">5</p>
                        <p class="day">Mercredi</p>
                    </div>
                </div>
                <div class="movie-text">
                    <h3 class="movie-title">Super Mario Bros, le film</h3>
                    <p>Un plombier de Brooklyn nommé Mario voyage à travers le royaume des champignons avec une princesse nommée Peach et un champignon anthropomorphe nommé Toad pour trouver le frère de Mario, Luigi, et pour sauver le monde d'un ...</p>
                    <div class="details">
                        <div class="duration"><p><u>Durée :</u> Inconnue</p></div>
                        <div class="genres"><p><u>Genres :</u> Animation, Aventure, ...</p></div>
                    </div>
                </div>  
            </div>  
        </div>
    </div>
    
<link href="Content/css/home.css" rel="stylesheet">

<?php require_once "view_end.php"; ?>
