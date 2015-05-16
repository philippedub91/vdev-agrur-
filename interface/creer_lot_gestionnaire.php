<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

//Vérifie si l'identifiant de la livraison n'est pas dans une variable d'adresse
if(!isset($_GET['livraison']))
{
  //Redirection vers la liste des livraisons
  header('location: livraison_gestionnaire.php');
}

//Gestion des messages de succès et d'erreur
$message = ''; //Initialise message

if(isset($_GET['msg']))
{
  $message = affiMessage($_GET['msg']);
} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Créer un lot</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Créer un lot</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Pour créer un lot à partir de cette commande, sélectionnez
        un calibre, puis la quantité de noix de ce calibre contenue 
        dans la livraison.
      </p>

      <!--Affichage d'un message de succès ou d'erreur-->
      <?php echo($message); ?>

      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-c">
          <h3>Création du lot</h3>
        </div>
        <div class="ui-body ui-body-c">
          <form method="POST" action="../src/src_creer_lot.php" data-ajax="false">
            <label>Calibre :</label>
            <?php listeCalibre('lst_calibre'); //Fonction qui crée une liste de noix ?>

            <label>Type produit:</label>
            <select name="lst_type_produit">
              <?php
              $sql = $connexion->query('SELECT * FROM type_produit');
              while($donnees_type = $sql->fetch())
              {
              ?>
                <option value="<?php echo($donnees_type['id_type_produit']); ?>"><?php echo($donnees_type['libelle_type_produit']); ?></option>
              <?php
              }
              ?>
            </select>

            <label for="sld_quantite">Quantité :</label>
            <input type="range" name="sld_quantite" value="60" min="0" max="1000" step="50" data-highlight="true">

            <input type="hidden" name="hd_livraison" value="<?php echo($_GET['livraison']); ?>">
          
            <input type="submit" class="ui-btn ui-shadow" value="Créer le lot">
          </form>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
