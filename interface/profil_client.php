<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php');

//Vérifie si l'utilisateur est connecté et producteur
if(!isset($_SESSION['type']))
{
  header('location: index.php');
}
elseif($_SESSION['type'] != 'client')
{
  header('location: index.php');
}

//Récupère les informations du client pour les afficher dans les champs du formulaire
$sql = $connexion->prepare('SELECT * FROM client WHERE num_client = :num_client');
$sql->bindParam(':num_client', $_SESSION['num_client']);
try
{
  $sql->execute();
  $donnees_client = $sql->fetch();
}
catch(Exception $e)
{
  echo('Erreur : '.$e->getMessage());
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
    case 2:
      $msg_erreur = 'Les deux mot passe saisis sont différents.';
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
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Modifier mon profil client</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <p>
          Ici, vous pouvez gérer votre profil client et modifier votre mot
          de passe.
      </p>

     <p style="color:red; font-weight:bold;"><?php echo($msg_erreur) ?></p>

      <form method="POST" action="../src/src_profil_client.php" data-ajax="false">
        <div class="ui-corner-all custom-corners">
          <div class="ui-bar ui-bar-c">
            <h3>Modifier vos informations personnelles :</h3>
          </div>
          <div class="ui-body ui-body-c">        
            <div class="ui-field-contain">
              <label for="txt_nom_client">Identité :</label>
              <input name="txt_nom_client" type="text" value="<?php echo($donnees_client['nom_client']); ?>">
            </div>

            <div class="ui-field-contain">
              <label for="txt_adresse_client">Adresse :</label>
              <input name="txt_adresse_client" type="text" value="<?php echo($donnees_client['adresse_client']); ?>">
            </div>

            <div class="ui-field-contain">
              <label for="txt_nom_responsable_achat">Identité du responsable d'achats :</label>
              <input name="txt_nom_responsable_achat" type="text" value="<?php echo($donnees_client['nom_responsable_achat']); ?>">
            </div>
          </div>
        </div>

        <div class="ui-corner-all custom-corners">
          <div class="ui-bar ui-bar-c">
            <h3>Modifier votre mot de passe</h3>
          </div>
          <div class="ui-body ui-body-c">
            <div class="ui-field-contain">
              <label for="txt_mdp">Mot de passe :</label>
              <input name="txt_mdp" type="password"  placeholder="Tapez votre nouveau mot de passe">
            </div>

            <div class="ui-field-contain">
              <label for="txt_repeter_mdp">Répeter mot de passe :</label>
              <input name="txt_repeter_mdp" type="password" placeholder="Retapez votre nouveau mot de passe">
            </div>

          </div>
        </div>
        <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b" value="Enregistrer les modifications">
      
      </form>
    </div>
  </div>
</body>
</html>
