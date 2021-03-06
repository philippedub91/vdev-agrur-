<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('PROD'); //Vérifie les autorisations de l'utilisateur

##############

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
  <title>Mon profil</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Modifier mon prodil producteur</h1>
  </div>

  <div class="main-container">
      <div class="sub-container">
        <p>
          Ici, vous pouvez gérer votre profil producteur et modifier vote mot
          de passe.
        </p>

        <!--Affichage d'un message d'erreur ou de succès-->
        <?php echo($erreur); ?>
        <?php echo($message); ?>
        <!--Fin messages-->


        <!--Formulaire de gestion des informations personnelles du producteur-->
        <form method="POST" action="../src/src_profil_producteur.php" data-ajax="false">

          <?php $donnees_producteur = getProducteur($_SESSION['num_prod']); //Retourne les information du producteur ?>

          <!--Modifier les informations relatives à l'identité-->
          <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-c">
              <h3>Votre identité : </h3>
            </div>
            <div class="ui-body ui-body-c">
              <div class="ui-field-contain">  
                <label for="txt_nom">Nom :</label>
                <input type="text" name="txt_nom" disabled value="<?php echo(getNomProducteur($_SESSION['num_prod'])); ?>">
              </div>

              <div class="ui-field-contain">
                <label for="txt_prenom">Prenom :</label>
                <input type="text" name="txt_prenom" disabled value="<?php echo(getPrenomProducteur($_SESSION['num_prod'])); ?>">
              </div>

              <div class="ui-field-contain">
                <label for="txt_adresse_prod">Adresse :</label>
                <input type="text" name="txt_adresse_prod" value="<?php echo($donnees_producteur['adresse_prod']); ?>">
              </div>

              <div class="ui-field-contain">
                <label for="txt_data_adhesion">Date d'adhésion :</label>
                <input type="text" name="txt_date_adhesion" disabled value="<?php echo($donnees_producteur['date_adhesion']); ?>">
              </div>
            </div>
          </div>

          <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-c">
              <h3>Votre mot de passe :</h3>
            </div>
            <div class="ui-body ui-body-c">
              <div class="ui-field-contain">  
                <label for="txt_mdp">Mot de passe :</label>
                <input type="password" name="txt_mdp" placeholder="Nouveau mot de passe">
              </div>

              <div class="ui-field-contain">
                <label for="txt_nMdp">Confirmer :</label>
                <input type="password" name="txt_nMdp" placeholder="Retapez votre nouveau mot de passe">
              </div>
            </div>
          </div>

          <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-c">
              <h3>Votre représentant :</h3>
            </div>
            <div class="ui-body ui-body-c">
              <div class="ui-field-contain">  
                <label for="txt_nom_representant">Nom :</label>
                <input type="text" name="txt_nom_representant" value="<?php echo($donnees_producteur['nom_representant_prod']); ?>">
              </div>

              <div class="ui-field-contain">
                <label for="txt_prenom_representant">Prénom :</label>
                <input type="text" name="txt_prenom_representant" value="<?php echo($donnees_producteur['prenom_representant_prod']); ?>">
              </div>

              <div class="ui-field-contain">
                <label for="txt_societe">Société :</label>
                <input type="text" name="txt_societe" value="<?php echo($donnees_producteur['societe']); ?>">
            </div>
          </div>

          <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-c">
              <h3>Valider les informations</h3>
            </div>
            <div class="ui-body ui-body-c">
              <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b" value="Enregistrer les modifications">
            </div>
          </div>
        </form>
        <!--Fin formulaire-->
        
      </div>
  </div>
</body>
</html>
