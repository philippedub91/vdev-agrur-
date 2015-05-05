<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Communes</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Communes</h1>
  </div>

  <div class="main-container">
      <div class="sub-container">
        <p>
          Voici la liste des communes.
        </p>

        <!--Liste des communes AOC-->
        <div data-role="header">
          <h6>Les communes</h6>
        </div>

        <ul data-role="listview">
          <?php
          $sql = $connexion->query('SELECT id_commune, nom_commune FROM commune WHERE commune_aoc = 0');
          try
          {
            $sql->execute();
            while($donnees_commune = $sql->fetch())
            {
            ?>
              <li>
                <?php echo($donnees_commune['nom_commune']); ?>
              </li>

            <?php
            }
          }
          catch(Exception $e)
          {
            echo('Erreur : '.$e->getMessage());
          }
          ?>
        </ul>
        <!--Fin communes AOC-->

        <div style="height:30px;"><!--separation--></div>

        <!--Liste des communes non AOC-->
        <div class="ui-corner-all custom-corners">
          <div class="ui-bar ui-bar-c">
            <h3>Communes AOC</h3>
          </div>
          <div class="ui-body ui-body-c">
            
            <!--Bouton pour ajouter le label aoc à une commune-->
            <a href="#popupAjouterCommuneAOC" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-a" data-transition="pop">Ajouter une commune</a>
            <!--Bouton pour retirer le label aoc à une commune-->
            <a href="#popupRetirerCommuneAOC" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-minus ui-btn-a" data-transition="pop">Retirer</a>
            
            <ul data-role="listview">
              <?php
              $sql = $connexion->query('SELECT id_commune, nom_commune FROM commune WHERE commune_aoc = 1');
              try
              {
                $sql->execute();
                while($donnees_commune = $sql->fetch())
                {
                ?>
                <li>
                  <?php echo($donnees_commune['nom_commune']); ?>
                </li>

                <?php
                }
              }
              catch(Exception $e)
              {
                echo('Erreur : '.$e->getMessage());
              }
              ?>
            </ul>
          </div>
        </div>
        <!--Fin communes-->


        <!--Fenêtre modale d'ajout de label aoc à une commune-->
        <div data-role="popup" id="popupAjouterCommuneAOC" data-theme="c" class="ui-corner-all">
          <div data-role="header" data-theme="c">
            <h1>Ajouter une commune AOC</h1>
          </div>
          <form method="post" action="../src/src_communes.php" data-ajax="false">
            <div style=" padding:15px; width:300px;">
              <ul data-role="listview">
              <?php
              $sql = $connexion->query('SELECT id_commune, nom_commune FROM commune WHERE commune_aoc = 0');
              try
              {
                $sql->execute();
                while($donnees_commune = $sql->fetch())
                {
                ?>
                <li>
                  <input type="checkbox" name="ckbAjouter[]" value="<?php echo($donnees_commune['id_commune']); ?>">
                  <label for="ckbAjouter[]"><?php echo($donnees_commune['nom_commune']); ?></label>
                </li>

                <?php
                }
              }
              catch(Exception $e)
              {
                echo('Erreur : '.$e->getMessage());
              }
              ?>
            </ul>
              <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-plus">Ajouter</button>
            </div>
          </form>
        </div>
        <!--Fin ajout label-->


        <!--Fenêtre modale de suppression de label aoc à une commune-->
        <div data-role="popup" id="popupRetirerCommuneAOC" data-theme="c" class="ui-corner-all">
          <div data-role="header" data-theme="c">
            <h1>Retirer une commune</h1>
          </div>
          <form method="POST" action="../src/src_communes.php" data-ajax="false">
            <div style=" padding:15px; width:300px;">
              <ul data-role="listview">
              <?php
              $sql = $connexion->query('SELECT id_commune, nom_commune FROM commune WHERE commune_aoc = 1');
              try
              {
                $sql->execute();
                while($donnees_commune = $sql->fetch())
                {
                ?>
                <li>
                  <input type="checkbox" name="ckbRetirer[]" value="<?php echo($donnees_commune['id_commune']); ?>">
                  <label for="ckbRetirer[]"><?php echo($donnees_commune['nom_commune']); ?></label>
                </li>

                <?php
                }
              }
              catch(Exception $e)
              {
                echo('Erreur : '.$e->getMessage());
              }
              ?>
            </ul>
              <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-minus">Retirer</button>
            </div>
          </form>
        </div>
        <!--Fin suppression label-->

    </div>
  </div>
</body>
</html>
