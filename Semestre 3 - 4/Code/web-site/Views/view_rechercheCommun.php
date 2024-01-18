<?php
require_once "view_begin.php";
?>
<style>
  <?php include_once "Content/css/style_rechercheCommun.css"; ?>
</style>

<body>
  </br>
  <div class="container" style="margin auto">
    <div class="row mt-4">
      <div class="col-lg-6">
        <div class="row mt-4">
          <div class="col-12">
            <div class="input-group">
              <input type="text" id="constAjout" class="form-control" name="start" placeholder="Entrer <?=e($type)?>">
              <button id="ajouter" class="btn btn-primary">Ajouter</button>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            Vous êtes actuellement en cours de recherche des
            <?php if ($type == 'personnes'): ?>
              films en commun entre les personnes.
            <?php else: ?>
              personnes en commun entre les films.
            <?php endif; ?>
            <a href="index.php?controller=rechercheCommun&action=changementRecherche" class="button">Changer de type de
              recherche commun</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row mt-3">
          <div class="col-12 mx-auto">
            <form id="form-donnees" method="post" action="index.php?controller=rechercheCommun&action=rechercheCommun">
              <ul id="liste-valeurs" class='text-center' >
                <!-- Les valeurs ajoutées seront générées dynamiquement en JavaScript -->
              </ul>
              <input type="hidden" id="valeurs-hidden" name="listRecherche">
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12 text-center">
            <input id='rechercher' type="submit" class="btn btn-primary" value="Rechercher">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" style="margin auto">
    <div class="row justify-content-center">
      <?php if (isset($titres)): ?>
        <div class="col-lg-8 ">
          <div class="films-section">
            <h2 class="text-center">Titres</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
              <?php foreach ($titres as $titre): ?>
                <div class="col mb-4">
                  <div class="card">
                    <img src=<?php
                    if ($titre['poster'] == null) {
                      echo "Content/img/NoImageAvailable.png";
                    } else {
                      echo $titre['poster'];
                    }
                    ?> alt=<?= e($titre['primarytitle']) ?>>
                    <div class="card-body">
                      <?php if ($titre['tconst'] != null): ?>
                        <h3><a href=<?php echo "?controller=recherche&action=affichage&search=" . $titre['tconst']; ?>
                            style="color:white; text-decoration:none">
                            <?= e($titre['primarytitle']); ?>
                          </a></h3>
                      <?php else: ?>
                        <h3>
                          <?= e($titre['primarytitle']); ?>
                        </h3>
                      <?php endif; ?>
                      <p>Genres:
                        <?= e($titre['genres']) ?><br>
                        Durée:
                        <?= e($titre['runtimeminutes']) ?>min<br>
                        Note:
                        <?= e($titre['averagerating']) ?>/10
                      </p>
                      <p>
                        <?php
                        if ($titre['description'] == null) {
                          echo "Pas de description";
                        } else {
                          echo $titre['description'];
                        }
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php elseif(isset($personnes)): ?>
        <div class="col-lg-8">
          <div class="actors-section">
            <h2 class="text-center">Personnes</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
              <?php foreach ($personnes as $personne): ?>
                <div class="col mb-4">
                  <div class="card">
                    <img src=<?php
                    if ($personne['poster'] == null) {
                      echo "Content/img/NoImageAvailable.png";
                    } else {
                      echo $personne['poster'];
                    }
                    ?> alt=<?= e($personne['primaryname']) ?>>
                    <div class="card-body">
                      <?php if ($personne['nconst'] != null): ?>
                        <h3><a href=<?php echo "?controller=recherche&action=affichage&search=" . $personne['nconst']; ?>
                            style="color:white; text-decoration:none">
                            <?= e($personne['primaryname']); ?>
                          </a></h3>
                      <?php else: ?>
                        <h3>
                          <?= e($personne['primaryname']); ?>
                        </h3>
                      <?php endif; ?>
                      <?php if (isset($personne['primaryprofession'])): ?>
                        <p>Profession:
                          <?= e($personne['primaryprofession']) ?>
                        </p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php else:?>
        Vous n'avez pas effectué de recherche !
      <?php endif; ?>
    </div>
  </div>





  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>


    $(document).ready(function () {
      var donnees = [];

      function genererTable() {
        var table = $('#table-donnees');
        var list = <?php if (isset($listRecherche)) {
          echo json_encode($listRecherche);
        } else {
          echo '[]';
        } ?>;
        list.forEach(val => {
          donnees.push(val);
          var liste = $('#liste-valeurs');
          var listItem = $('<li>').text(val);
          var deleteButton = $('<button>').text('Supprimer');
          deleteButton.on('click', function () {
            supprimerValeurListe(val);
          });
          listItem.append(deleteButton);
          liste.append(listItem);
          mettreAJourValeursCache();
        })
      }

      genererTable();

      function ajouterValeurListe(valeur) {
        if ('<?= e($_SESSION['type']) ?>' == 'personnes') {
          var regex = /^.*nm\d{7,15}$/;
        } else {
          var regex = /^.*tt\d{7,15}$/;
        }
        if (regex.test(valeur)) {
          if (!donnees.includes(valeur)) { // Vérification si la valeur existe déjà dans le tableau
            donnees.push(valeur);
            var liste = $('#liste-valeurs');
            var listItem = $('<li>').text(valeur);
            var deleteButton = $('<button>').text('Supprimer');
            deleteButton.on('click', function () {
              supprimerValeurListe(valeur);
            });
            listItem.append(deleteButton);
            liste.append(listItem);
            mettreAJourValeursCache();
          } else {
            alert("Vous avez déjà effectué la recherche.");
          }
        } else {
          alert("Non, vous ne pouvez pas ajouter cette valeur. Assurez-vous qu'il s'agit du bon id.");
        }
      }

      function supprimerValeurListe(valeur) {
        var index = donnees.indexOf(valeur);
        if (index !== -1) {
          donnees.splice(index, 1);
          $('#liste-valeurs li').eq(index).remove();
        }
        mettreAJourValeursCache();
      }

      function mettreAJourValeursCache() {
        $('#valeurs-hidden').val(JSON.stringify(donnees));
      }

      $('#ajouter').on('click', function () {
        var inputValue = $('#constAjout').val();
        ajouterValeurListe(inputValue);
        $('#constAjout').val('');
      });

      $('#rechercher').on('click', function () {
        $('#form-donnees').submit();
      });
    });
  </script>

</body>
<?php
require_once "view_end.php";
?>