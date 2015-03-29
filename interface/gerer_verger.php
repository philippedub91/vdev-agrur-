<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mes vergers</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>

  <?php

  //Récupère les informations du verger
  if(isset($_GET['verger']) && is_numeric($_GET['verger']))
  {
    $sql = $connexion->prepare('SELECT * FROM verger WHERE id_verger = :id_verger');
    $sql->bindParam(':id_verger', $_GET['verger']);
    try
    {
      $sql->execute();
      $donnees_verger = $sql->fetch();
    }
    catch(Exception $e)
    {
      header('location: vergers_producteur.php');
    }
  }
  else
  {
    header('location: vergers_producteur.php');
  }


  //Récupère le nom de la ville où se situe le verger
  $sql = $connexion->prepare('SELECT nom_commune FROM commune WHERE id_commune = :id_commune');
  $sql->bindParam(':id_commune', $donnees_verger['id_commune']);
  try
  {
    $sql->execute();
    $donnees_commune = $sql->fetch();
  }
  catch(Exception $e)
  {
    echo('Erreur : '.$e->getMessage());
  }

  //Récupère le nom de la variété cultivée
  $sql = $connexion->prepare('SELECT libelle_variete FROM variete WHERE id_variete = id_variete');
  $sql->bindParam(':id_variete', $donnees_verger['id_variete']);
  try
  {
    $sql->execute();
    $donnees_variete = $sql->fetch();
  }
  catch(Exception $e)
  {
    echo('Erreur : '.$e->getMessage());
  }


  //Gestion du message d'erreur
  $erreur = '';

  if(isset($_GET['msg']))
  {
    switch($_GET['msg'])
    {
      case 1:
        $erreur = 'Modification non réalisée. Le nom n\'est pas correctement saisi.';
      break;
      case 2:
        $erreur = 'Modification non réalisée. La superficie saisie n\'est pas conforme';
      break;
      case 3:
        $erreur = 'Modification non réalisée. Le nombre d\'arbres n\'est pas ou mal saisi';
      default:
      break;
    }
  }
  ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>    
    <div data-role="header">
      <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
      <h1><?php echo($donnees_verger['nom_verger']); ?></h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>
        Vous pouvez modifier les informations de ce verger directement
        sur cette page.
      </p>

      <!--Affichage d'un message d'erreur-->
      <p style="color:red;">
        <?php echo($erreur); ?>
      </p>

      <ul data-role="listview">
        <li><b>Nom : </b><?php echo($donnees_verger['nom_verger']); ?></li>
        <li><b>Superficie : </b><?php echo($donnees_verger['superficie']); ?></li>
        <li><b>Arbre /ha : </b><?php echo($donnees_verger['nbr_arbre']); ?></li>
        <li><b>Commune : </b><?php echo($donnees_commune['nom_commune']); ?></li>
        <li><b>Variété cultivée : </b><?php echo($donnees_variete['libelle_variete']); ?></li>
      </ul>


      <!--Fenêtre permettant de modifier les informations du verger-->
      <a href="#popupModifier" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-gear ui-btn-icon-left ui-btn-b">Modifier</a>
      <div data-role="popup" id="popupModifier" data-overlay-theme="b" data-theme="c" data-dismissible="false" style="min-width:300px; max-width:400px;">
        <div data-role="header" data-theme="c">
          <h1>Modifier</h1>
        </div>
        <div role="main" class="ui-content">
          <form method="post" action="../src/src_modifier_verger.php" data-ajax="false">
            <label for="txt_nom_verger">Nom du verger :</label>
            <input type="text" name="txt_nom_verger" value="<?php echo($donnees_verger['nom_verger']); ?>">

            <label for="txt_superficie">Superficie :</label>
            <input type="text" name="txt_superficie" value="<?php echo($donnees_verger['superficie']); ?>">

            <label for="sld_nbr_arbres">Arbres par hectare :</label>
            <input name="sld_nbr_arbres" data-highlight="true" min="1" max="100" value="50" type="range"><br/>

            <!--Champ caché contenant  l'id du verger-->
            <input type="hidden" name="id_verger" value="<?php echo($donnees_verger['id_verger']); ?>">

            <input value="Valider" type="submit" data-theme="b">
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-a" data-rel="back">Annuler</a>
          </form>
        </div>
      </div>

      <!--Fenêtre permettant de supprimer le verger-->
      <a href="#popupSupprimer" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Supprimer le verger</a>
      <div data-role="popup" id="popupSupprimer" data-overlay-theme="b" data-theme="c" data-dismissible="false" style="max-width:400px;">
        <div data-role="header" data-theme="c">
          <h1>Confirmation</h1>
        </div>
        <div role="main" class="ui-content">
          <h3 class="ui-title">Etes-vous sûr de vouloir supprimer ce verger ?</h3>
          <p>Cette action ne peut être annulée.</p>
          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-c" data-rel="back">Annuler</a>
          <a href="../src/src_supprimer_verger.php?verger=<?php echo($donnees_verger['id_verger']); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow">Supprimer</a>
        </div>
      </div>
      
    </div>
  </div>
</body>
</html>
