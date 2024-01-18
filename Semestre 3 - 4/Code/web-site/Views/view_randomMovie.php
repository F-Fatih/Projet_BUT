<?php require_once('view_begin.php'); ?>
   
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <form method="post" action="index.php?controller=randomMovie&action=randomMovie" class="text-center">
                <div class="form-group">
                    <label for="genres"> <h4 style="margin-bottom:5%; margin-top:6%"> Selectionner un "Genres" </h4> </label>
                    <select name="genres" id="genres" class="form-control">
                        <option value="null" <?php if (isset($_POST['genres']) && $_POST['genres'] == "null") echo "selected"; ?>>Tout</option>
                        <?php 
                        for ($i = 0; $i < count($data['allgenres']); $i++) {
                            $genre = $data['allgenres'][$i]['genre'];
                            $selected = '';
                            if (isset($_POST['genres']) && $genre == $_POST['genres'] && $_POST['genres'] != "null") {
                                $selected = 'selected';
                            }
                            echo "<option value='$genre' $selected>$genre</option>";
                        }
                        ?>   
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:1%">Get Random Movie</button>
            </form>
            
            <div class="row mt-4">
                <div class="col-6">
                    <div id="image-container" style="position: relative; "> 
                        <?php 
                            if (isset($_POST['genres'])){
                                echo "<img src='" . $data['affiche'] . "' class='img-fluid' style='position: absolute; top: 0; left: 0;'/>";
                            }
                        ?> 
                    </div>
                </div>
                                    
                <div class="col-6" style="height: 800px;">    
                    <div id="image-text" class="text-justify">                              
                        <?php
                            if (isset($_POST['genres'])){
                                echo "<div id='text-1' class='text-element'>";

                                if (str_starts_with($data['const'], 'tt')){
                                    echo "<h4><a href='?controller=recherche&action=affichage&search=" . $data['const'] . "'> Titre : " . $data['primarytitle'] . "</a></h4>";
                                    echo "<p> Année de sortie : " . $data['startyear'] . "<br>";
                                    echo "Genres : " . str_replace(array('{', '}', ','), array("", "", ", "), $data['genres']) . "<br>";
                                    echo "Notes : " . $data['averagerating'] . "/10 avec (" . $data['numvotes'] . " votes)</p>";
                                    echo "<p style='text-align: justify;'>" . $data['description'] . "</p>";
                                }
                                
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>  

        </div>
    </div>
</div>

<?php require_once('view_end.php'); ?>
