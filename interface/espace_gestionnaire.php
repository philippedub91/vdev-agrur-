<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

//Gestion des message d'erreur
$msg = '';

if(isset($_GET['msg']) && !empty($_GET['msg']))
{
  switch($_GET['msg'])
  {
    case 1:
      $msg = '<span style="color:red;">Certains ne champs ne semblent pas saisis correctement.</span>';
    break;
    case 2:
      $msg = '<span style="color:red;">Une erreur interne (connexion à la base de données) empêche la réalisation de l\'opération.</span>';
    break;
    case 'ok':
      $msg = '<span style="color:green;">L\'utilisateur a été ajouté avec succès !</span>';
    break;
    default:
    break;
  }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Espace gestionnaire</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#popupAjouterUtilisateur" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-icon-plus ui-btn-icon-left">Ajouter un utilisateur</a>
    <h1>Espace gestionnaire</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <h4 style="margin-left:10px; margin-right:10px;">Bienvenue dans votre espace personnel <?php echo($_SESSION['prenom']); ?> ! </h4>

      <?php echo($msg); ?>

      <div data-role="controlgroup">
        <a href="producteurs.php" class="ui-btn ui-corner-all"><img src="../images/icones/producteur.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Producteurs</span></a>
        <a href="clients.php" class="ui-btn ui-corner-all"><img src="../images/icones/client.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Clients</span></a>
        <a href="livraison_gestionnaire.php" class="ui-btn ui-corner-all"><img src="../images/icones/truck.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle">Livraisons et lots</span></a>
        <a href="varietes.php" class="ui-btn ui-corner-all"><img src="../images/icones/varietes.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Varietes</span></a>
        <a href="vergers_gestionnaire.php" class="ui-btn ui-corner-all"><img src="../images/icones/verger.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle">Vergers</span></a>
        <a href="communes.php" class="ui-btn ui-corner-all"><img src="../images/icones/map.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle">Communes</span></a>
        <a href="conditionnements.php" class="ui-btn ui-corner-all"><img src="../images/icones/package.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle">Conditionnements</span></a>
        <a href="certifications.php" class="ui-btn ui-corner-all"><img src="../images/icones/certificat.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle">Certifications</span></a>
        <a href="../src/session_destroy.php" class="ui-btn ui-corner-all"><img src="../images/icones/deconnexion.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Déconnexion</span></a>
      </div>

      <div data-role="popup" id="popupAjouterUtilisateur" data-theme="c" class="ui-corner-all">
        
        <form method="post" action="../src/src_ajouter_utilisateur.php" data-ajax="false">
          <div style="padding:15px; width:300px;">
            <h3>Ajouter un utilisateur</h3>
            <p>
              Vous pouvez ajouter un utilisateur en remplissant les champs suivants.
              Les informations complémentaires seront saisies par l'utilisateur lui même.
            </p>

            <p>
              <label for="txt_nom">Nom :</label>
              <input type="text" name="txt_nom" placeholder="Nom" data-theme="c">
              <label for="txt_prenom">Prénom :</label>
              <input type="text" name="txt_prenom" placeholder="Prénom" data-theme="c">
              <label for="txt_mail">Adresse mail :</label>
              <input type="email" name="txt_mail" placeholder="Adresse mail" data-theme="c">
              <label for="txt_mdp">Mot de passe :</label>
              <input type="password" name="txt_mdp" placeholder="Mot de passe" data-theme="c">
              
              <!--Liste déroulante contenant les types de comptes-->
              <label for="lst_type_compte" class="select">Type de compte :</label>
              <select name="lst_type_compte" id="lst_type_compte" data-native-menu="false">
                <option>Type de compte</option>
                <option value="prod">Producteur</option>
                <option value="cli">Client</option>
                <option value="gest">Gestionnaire</option>
              </select>
            </p>
            
            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Valider</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</body>


</html>
