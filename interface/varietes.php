<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

###########

//Gestion des messages de succès et d'erreur
$erreur = ''; //Contiendra éventuellement le message d'erreur
$message = ''; //Contiendra éventuellement le message de succès
if(isset($_GET['err']))
{
  $erreur = addDecorum($_GET['err'], 'ERR');
}
elseif(isset($_GET['msg']))
{
  $message = addDecorum($_GET['msg'], 'SUC'); 
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Variétés</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Variétés</h1>
  </div>

  <div class="main-container">
      <div class="sub-container">
        <p>
          Voici la liste des différentes variétés cultivées par les producteurs de la 
          coopérative.
        </p>

        <!--Messages d'erreur et de succès-->
        <?php echo($erreur); ?>
        <?php echo($message); ?>
        <!--Fin messages-->

        <!--Liste des variétés-->
        <div class="ui-corner-all custom-corners">
          <div class="ui-bar ui-bar-c">
            <h3>Les variétés</h3>
          </div>
          <div class="ui-body ui-body-c">
            <ul data-role="listview">
              <?php
              $sql = $connexion->query('SELECT * FROM variete');
              while($donnees_variete = $sql->fetch())
              {
              ?>
                <li><?php echo($donnees_variete['libelle_variete']); ?></li>
              <?php
              }

              $sql->closeCursor();
              ?>
            </ul>
          </div>
        </div>
        <!--Fin varietes aoc-->

        <div style="height:30px;"><!--separation--></div>


        <!--Liste des variétés aoc-->
        <div class="ui-corner-all custom-corners">
          <div class="ui-bar ui-bar-c">
            <h3>Les variétés AOC</h3>
          </div>
          <div class="ui-body ui-body-c">

            <!--Bouton pour ajouter le label aoc à une variété-->
            <a href="#popupAjouterVarieteAOC" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-a" data-transition="pop">Ajouter une variété</a>
            <!--Bouton pour retirer le label aoc à une variété-->
            <a href="#popupRetirerVarieteAOC" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-minus ui-btn-a" data-transition="pop">Retirer</a>

            <ul data-role="listview">
              <?php 
              $sql = $connexion->query('SELECT * FROM variete WHERE AOC = 1');
              while($donnees_variete = $sql->fetch())
              {
              ?>
                <li><?php echo($donnees_variete['libelle_variete']); ?></li>
              <?php
              }
              ?>
            </ul>
          </div>
          <!--Fin variétés aoc-->

        <!--FENETRES MODALES-->
        <!--Fenêtre modale d'ajout de label aoc à une variete-->
        <div data-role="popup" id="popupAjouterVarieteAOC" data-theme="c" class="ui-corner-all">
          <div data-role="header" data-theme="c">
            <h1>Ajouter une variete AOC</h1>
          </div>
          <form method="post" action="../src/src_varietes.php" data-ajax="false">
            <div style=" padding:15px; width:300px;">
              <ul data-role="listview">
              <?php
              $sql = $connexion->query('SELECT * FROM variete WHERE AOC = 0');
              try
              {
                $sql->execute();
                while($donnees_variete = $sql->fetch())
                {
                ?>
                <li>
                  <input type="checkbox" name="ckbAjouter[]" value="<?php echo($donnees_variete['id_variete']); ?>">
                  <label for="ckbAjouter[]"><?php echo($donnees_variete['libelle_variete']); ?></label>
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



        <!--Fenêtre modale de suppression de label aoc à une variete-->
        <div data-role="popup" id="popupRetirerVarieteAOC" data-theme="c" class="ui-corner-all">
          <div data-role="header" data-theme="c">
            <h1>Ajouter une variete AOC</h1>
          </div>
          <form method="post" action="../src/src_varietes.php" data-ajax="false">
            <div style=" padding:15px; width:300px;">
              <ul data-role="listview">
              <?php
              $sql = $connexion->query('SELECT * FROM variete WHERE AOC = 1');
              try
              {
                $sql->execute();
                while($donnees_variete = $sql->fetch())
                {
                ?>
                <li>
                  <input type="checkbox" name="ckbRetirer[]" value="<?php echo($donnees_variete['id_variete']); ?>">
                  <label for="ckbRetirer[]"><?php echo($donnees_variete['libelle_variete']); ?></label>
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

        </div>
      </div>
  </div>
</body>
</html>
