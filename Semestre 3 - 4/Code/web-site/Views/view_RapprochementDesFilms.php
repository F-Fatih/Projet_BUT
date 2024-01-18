<?php require_once('view_begin.php'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
    
            <form action="index.php?controller=RapprochementDesFilms&action=RapprochementDesFilms" method="post">
                <div class="row mt-4">
                    <div class="col-6"> <input type="text" class="form-control" name="start" placeholder="Selectionner un premier film ou acteur."> </div>
                    <div class="col-6"> <input type="text" class="form-control" name="stop" placeholder="Selectionner un second film ou acteur."> </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-center"> <input type="submit" class="btn btn-primary" value="Rechercher"> </div>
                </div>

                <hr>

                <div class="row mt-3">
                    <div class="d-flex mx-auto" style="overflow-y: hidden; padding-bottom: 3%;">
                        <?php 
                            $i=0;
                            foreach($data as $key => $value) {
                                if($i >= 0){$fleche="<div class='align-self-center' style='margin: 0 10px;font-size:3em;'>&rarr;</div>";}
                                else{$fleche="";}

                                if (str_starts_with($value['const'], 'tt')) {
                                    echo '<div class="col-md-3 mb-3">';
                                    echo '<div class="img-thumbnail" style="border:none">';
                                    echo '<h5 class="text-center">' . $value['primarytitle'] . '</h5>';
                                    echo '<img src="' . $value['affiche'] . '" class="w-100 h-100">';
                                    echo '</div>';
                                    echo '</div>';
                                    echo $fleche;
                                } else {
                                    echo '<div class="col-md-3 mb-3">';
                                    echo '<div class="img-thumbnail" style="border:none">';
                                    echo '<h5 class="text-center">' . $value['primaryname'] . '</h5>';
                                    echo '<img src="' . $value['affiche'] . '" class="w-100 h-100">';
                                    echo '</div>';
                                    echo '</div>';
                                    echo $fleche;
                                }
                                $i++;
                            }
                        ?> 
                    </div>
                </div>

                <hr>
                            
                <div class="row mt-4">
                    <div class="col-6">
                        <div id="image-container" style="position: relative; "> 
                            <?php
                                $i=0;
                                foreach ($data as $key => $value) {

                                    if (str_starts_with($value['const'], 'tt')){
                                        echo "<img src='" . $value['affiche'] . "' class='img-fluid image' id='image-" . $i . "' style='position: absolute; top: 0; left: 0;'/>";
                                        $i++;
                                    }

                                    if (str_starts_with($value['const'], 'nm')){
                                        echo "<img src='" . $value['affiche'] . "' class='img-fluid image' id='image-" . $i . "' style='position: absolute; top: 0; left: 0;'/>";
                                        $i++;
                                    }
                                }
                            ?> 
                        </div>
                    </div>
                            
                    <div class="col-6" style="height: 800px;">    
                        <div id="image-text" class="text-justify">                              
                            <?php
                                $j = 0;
                                foreach ($data as $key => $value) {
                                    echo "<div id='text-" . $j . "' class='text-element'>";

                                    if (str_starts_with($value['const'], 'tt')){
                                        echo "<h4> Titre : " . $value['primarytitle'] . "</h4>";
                                        echo "<p> Année de sortie : " . $value['startyear'] . "<br>";
                                        echo "Genres : " . str_replace(array('{', '}', ','), array("", "", ", "), $value['genres']) . "<br>";
                                        echo "Notes : " . $value['averagerating'] . "/10 avec (" . $value['numvotes'] . " votes)</p>";
                                        echo "<p style='text-align: justify;'>" . $value['description'] . "</p>";
                                    }
                                        
                                    if (str_starts_with($value['const'], 'nm')){
                                        echo "<h4> Nom / Prenom : " . $value['primaryname'] . "</h4>";
                                        echo "<p> Profession : " . str_replace(array('{', '}', ','), array("", "", ", "), $value['primaryprofession']);

                                        if ($value['deathyear'] == ""){
                                            echo "<br>Année de naissance : " . $value['birthyear'] . "</p>";
                                        } else {
                                            echo "<br>Année de naissance : " . $value['birthyear'];
                                            echo "<br>Année de mort : " . $value['deathyear'];
                                        }
                                        
                                        echo "Connu pour les titres : ";
                                        foreach ($value['knownfortitles'] as $cle => $valeur) {
                                            echo "<br><span style='padding:0 0 0 40px;'> " . $valeur . "</span>";
                                        }
                                    }
                                                
                                    echo "</div>";
                                    $j++;
                                }
                            ?>
                        </div>
                    </div>
                </div>  

            </form>

        </div>
    </div>         
</div>
<div class="container fixed-bottom">
  <div class="row mt-5" >
    <div class="col-12 text-center">
      <button id="prev" class="btn btn-secondary mx-auto" style="margin: auto;"> Précédent </button>
      <button id="next" class="btn btn-secondary mx-auto" style="margin: auto;"> Suivant </button>
    </div>
  </div>
</div>







<script>
// initialize variable for keeping track of current image
var currentImg = 0;

// get the images and buttons
var images = document.getElementsByClassName("image");

var prevButton = document.getElementById("prev");
var nextButton = document.getElementById("next");
// function to show previous image
prevButton.onclick = function() {
    images[currentImg].style.display = "none";
    currentImg--;
    if (currentImg < 0) {
        currentImg = images.length - 1;
    }
    images[currentImg].style.display = "block";
}

// function to show next image
nextButton.onclick = function() {
    images[currentImg].style.display = "none";
    currentImg++;
    if (currentImg >= images.length) {
        currentImg = 0;
    }
    images[currentImg].style.display = "block";
}

$(document).ready(function(){
    var currentImg = 0;
    var imgCount = $("#image-container img").length;
    $("#image-text div").hide();
    $("#image-text div").eq(currentImg).show();

    $("#next").click(function(){
        currentImg++;
        if(currentImg >= imgCount){
            currentImg = 0;
        }
        $("#image-text div").hide();
        $("#image-text div").eq(currentImg).show();
    });

    $("#prev").click(function(){
        currentImg--;
        if(currentImg < 0){
            currentImg = imgCount-1;
        }
        $("#image-text div").hide();
        $("#image-text div").eq(currentImg).show();
    });
});

</script>

            

<?php require_once('view_end.php'); ?>
