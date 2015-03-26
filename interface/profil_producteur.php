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

  <div class="headline">
    <h1>Mon profil</h1>
    <div class="ui-input-btn ui-btn ui-corner-all ui-shadow" style="width:100px;">
      <a href="espace_producteur.php"><img src="../images/icones/home.png" height="30" align="absmiddle"> Accueil</a>
    </div>
  </div>

  <div class="content-body">
      <div class="panel">
        <!--Affichage de la variable contenant le message d'erreur-->
        <span style="color:red;"><?php echo($msg_erreur); ?></span>

        <p>Ici, vous pouvez modifier votre profil personnel.</p>

        <?php
        //Récupère toutes les informations du producteur
        //Données utilisateur
        $sql = $connexion->prepare('SELECT * FROM utilisateur WHERE token = :token');
        $sql->bindParam(':token', $_SESSION['token']);
        try 
        {
          $sql->execute();
          $donnees_utilisateur = $sql->fetch();

          //Données producteur
          $sql = $connexion->prepare('SELECT * FROM producteur WHERE token = :token');
          $sql->bindParam(':token', $_SESSION['token']);
          try
          {
            $sql->execute();
            $donnees_producteur = $sql->fetch();
          }
          catch(Exception $e)
          {
            echo('Erreur : '.$e->getMessage());
          }

        } 
        catch (Exception $e) 
        {
           echo('Erreur : '.$e->getMessage());
        } 
        ?>

        <form method="POST" action="../src/src_profil_producteur.php">
          <h4>Vos informations : </h4>

          <table>
            <tr>
              <td><label for="txt_nom">Nom :</label></td>
              <td><input type="text" name="txt_nom" disabled value="<?php echo($donnees_utilisateur['nom']); ?>"></td>
            </tr>
            <tr>
              <td><label for="txt_prenom">Prenom :</label></td>
              <td><input type="text" name="txt_prenom" disabled value="<?php echo($donnees_utilisateur['prenom']); ?>"></td>
            </tr>
            <tr>
              <td><label for="txt_adresse_prod">Adresse :</label></td>
              <td><input type="text" name="txt_adresse_prod" value="<?php echo($donnees_producteur['adresse_prod']); ?>"></td>
            </tr>
            <tr>
              <td><label for="txt_date_adhesion">Date d'adhésion :</label></td>
              <td><input type="text" name="txt_date_adhesion" disabled value="<?php echo($donnees_producteur['date_adhesion']); ?>"></td>
            </tr>
          </table>

          <hr>

          <h4>Modifier votre mot de passe</h4>

          <table>
            <tr>
              <td><label for="txt_mdp">Mot de passe :</label></td>
              <td><input type="password" name="txt_mdp" placeholder="Nouveau mot de passe"></td>
            </tr>
            <tr>
              <td><label for="txt_nMdp">Confirmer :</label></td>
              <td><input type="password" name="txt_nMdp" placeholder="Retapez votre mot de passe"></td>
            </tr>
          </table>

          <hr>

          <h4>Votre représentant :</h4>

          <table>
            <tr>
              <td><label for="txt_nom_representant">Nom :</label></td>
              <td><input type="text" name="txt_nom_representant" value="<?php echo($donnees_producteur['nom_representant_prod']); ?>"></td>
            </tr>
            <tr>
              <td><label for="txt_prenom_representant">Prenom :</label></td>
              <td><input type="text" name="txt_prenom_representant" value="<?php echo($donnees_producteur['prenom_representant_prod']); ?>"></td>
            </tr>
            <tr>
              <td><label for="txt_societe">Société :</label></td>
              <td><input type="text" name="txt_societe" value="<?php echo($donnees_producteur['societe']); ?>"></td>
            </tr>
          </table>

          <hr>

          <input type="submit" style="float:right;" id="form_btn" value="Enregistrer les modifications">

          <p>
            Après avoir enregistré vos informations, vous pouvez gérer vos vergers 
            <a href="vergers_producteur.php">dans la rubrique dédiée</a>
          </p>

        </form>
      </div>
  </div>
</body>
</html>
