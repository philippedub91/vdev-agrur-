<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

//Gestion des messages de succès et d'erreur
$erreur = ''; //Contiendra éventuellement le message d'erreur
$message = ''; //Contiendra éventuellement le message de succès
if(isset($_GET['err']))
{
  $erreur = addDecorum($_GET['err'], 'ERR');
}
elseif(isset($_GET['msg']))
{
  $message = addDecorum($_GET['msg'], 'SUC'); //
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('../common/head.php'); ?> 
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>
    <div data-role="header">
      <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
      <h1>Identification</h1>
    </div>
  </nav>


  <div class="main-container">
    <div class="sub-container">

      <h4>Comment se connecter ?</h4>
      <p>
        Pour vous connecter veuillez, saisir votre adresse mail, ainsi que votre
        mot de passe.
      </p>

      <!--Affichage du message de succès ou d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>

      <form method="POST" action="../src/src_index.php" data-ajax="false">
        <table>
          <tr>
            <td><input type="email" name="txt_mail" id="form_txt" placeholder="Adresse mail"></td>
          </tr>
          <tr>
            <td><input type="password" name="txt_mdp" id="form_txt" placeholder="Mot de passe"></td>
          </tr>
          <tr>
            <td><input type="submit" value="Se connecter" name="btn_valider" id="form_btn"></td>
          </tr>
        </table>
      </form>

      <h4>Travailler avec nous :</h4>
      <p>
        Si vous souhaitez travailler avec nous ou obtenir des
        informations concernant notre coopérative, vous pouvez
        nous contacter au 00.00.00.00.00.
      </p>

      <!--h4>Proposer une livraison :</h4>
      <p>
        Si vous êtes producteur de noix mais que vous ne travaillez pas
        avec la coopérative AGRUR, vous pouvez tout de même livrer des noix
        en remplisant ce formulaire. Votre livraison sera ensuite validée par
        un de nos gestionnaires.
      </p-->
    </div>

  </div>
</body>
</html>
