<?php
session_start();

//Vérifie si l'utilisateur est connecté et producteur
if(!isset($_SESSION['type']))
{
  header('location: index.php');
}
elseif($_SESSION['type'] != 'producteur')
{
  header('location: espace_producteur.php');
}


//Gestion des messages d'erreur
$msg_erreur = '';
if(isset($_GET['msg']))
{
  switch($_GET['msg'])
  {
    case 1:
      $msg_erreur = 'Certains champs sont vide ou ne sont pas saisis correctement. Veuillez recommancer votre saisie.';
    break;
    default:
    break;
  }
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
        <!--Affichage de la variable contenant le message d'erreur-->
        <span style="color:red;"><?php echo($msg_erreur); ?></span>

        <p>
          Ici, vous pouvez gérer votre profil producteur et modifier vote mot
          de passe.
        </p>

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
      </div>
  </div>
</body>
</html>
