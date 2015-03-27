<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('../common/head.php'); ?>
  
  <?php
  $alert = ''; //Contient un message d'erreur si celui-ci existe, sinon vide.
  //Sélection du message d'erreur en fonction de la variable d'adresse.
  if(isset($_GET['msg']))
  {
    switch($_GET['msg'])
    {
      case 1:
        $alert = 'L\'utilisateur correspondant aux identifiants saisis n\'existe pas. Veuillez réessayer.';
      break;
      case 2:
        $alert = 'Votre compte existe bien, mais ne semble pas activé. Contactez l\'administrateur.';
      break;
      case 3:
        $alert = 'Vous devez saisir votre mot de passe pour vous connecter.';
      break;
      case 4:
        $alert = 'Vous devez saisir votre adresse mail pour vous connecter.';
      break;
      default;
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

      <span style="color:red; font-weight:bold;"><?php echo($alert); ?></span>


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

    </div>

  </div>
</body>
</html>
