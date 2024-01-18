<?php
    require_once "view_begin.php";
?>
<style>
    <?php include_once "Content/css/style_recherche.css";?>
    .films-section,
    .actors-section {
        margin-bottom: 30px;
    }
    
</style>
<body>
    
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <div class="films-section">
                    <h2 class="text-center">Titres</h2>
                    <div class="row row-cols-2 row-cols-md-2 row-cols-lg-1">
                        <?php foreach($titres as $titre):?>
                        <div class="col mb-4">
                            <div class="card">
                                <img src=<?php
                                    if ($titre['poster'] == null){
                                        echo "Content/img/NoImageAvailable.png";
                                    } else {
                                        echo $titre['poster'];
                                    }
                                ?> alt=<?=e($titre['primarytitle']) ?>>
                                <div class="card-body">
                                    <?php if($titre['tconst'] != null):?>
                                    <h3><a href=<?php echo "?controller=recherche&action=affichage&search=".$titre['tconst'];?> style="color:white; text-decoration:none">
                                        <?=e($titre['primarytitle']);?>
                                    </a></h3>
                                    <?php else:?>
                                    <h3><?=e($titre['primarytitle']);?></h3>
                                    <?php endif;?>
                                    <p>Genres: <?=e($titre['genres']) ?><br>
                                        Durée: <?=e($titre['runtimeminutes']) ?>min<br>
                                        Note: <?=e($titre['averagerating']) ?>/10</p>
                                    <p><?php
                                        if ($titre['description'] == null){
                                            echo "Pas de description";
                                        } else {
                                            echo $titre['description'];
                                        }
                                        ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-2">
                <div class="actors-section">
                    <h2 class="text-center">Personnes</h2>
                    <div class="row row-cols-2 row-cols-md-2 row-cols-lg-1">
                        <?php foreach($personnes as $personne):?>
                        <div class="col mb-4">
                            <div class="card">
                                <img src=<?php
                                    if ($personne['poster'] == null){
                                        echo "Content/img/NoImageAvailable.png";
                                    } else {
                                        echo $personne['poster'];
                                    }
                                ?> alt=<?=e($personne['primaryname']) ?>>
                                <div class="card-body">
                                    <?php if($personne['nconst'] != null):?>
                                    <h3><a href=<?php echo "?controller=recherche&action=affichage&search=".$personne['nconst'];?> style="color:white; text-decoration:none">
                                        <?=e($personne['primaryname']);?>
                                    </a></h3>
                                    <?php else:?>
                                    <h3><?=e($personne['primaryname']);?></h3>
                                    <?php endif;?>
                                    <p>Profession: <?=e($personne['primaryprofession'])?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
    require_once "view_end.php";
?>
