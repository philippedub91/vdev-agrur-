<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php'); 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Commander</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="arrow-l" data-rel="back" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Commander</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <p>
        La commande d'un lot, se réalise en plusieurs étapes. Pour commencer, vous
        devez sélectionner une variété et un type de noix.
      </p>

      <h2>1. Sélectionner une variété</h2>
      <select name="select-custom-1" id="select-custom-1" data-native-menu="false">
      <?php
      //Requete qui retourne la liste des variétés de noix
      $sql = $connexion->query('SELECT * FROM variete');
      try
      {
        $sql->execute();
        while($donnees_variete = $sql->fetch())
        {
        ?>
          <option value="<?php echo($donnees_variete['id_variete']); ?>"><?php echo($donnees_variete['libelle_variete']); ?></option>
        <?php
        }
      }
      catch(Exception $e)
      {
        echo('Erreur : '.$e->getMessage());
      }

      $sql->closeCursor();  
      ?>    
      </select>

      <h2>2. Sélectionner un type de noix</h2>
      <select name="select-custom-2" id="select-custom-2" data-native-menu="false">
        <?php
        //Requete qui retourne la liste des types de produits (noix)
        $sql = $connexion->query('SELECT * FROM type_produit');
        try
        {
          $sql->execute();
          while($donnees_type = $sql->fetch())
          {
          ?>
            <option value="<?php echo($donnees_type['id_type_produit']); ?>"><?php echo($donnees_type['libelle_type_produit']); ?></option>
          <?php
          }
        }
        catch(Exception $e)
        {
          echo('Erreur : '.$e->getMessage());
        }

        $sql->closeCursor();
        ?>
      </select>



      
    </div>
  </div>
</body>
</html>
