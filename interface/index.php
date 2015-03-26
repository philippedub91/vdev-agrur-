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

  <div class="headline">
    <h1>Identification</h1>
  </div>

  <div class="content-body">

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

    <section>
      <h4>Comment adhérer à agrur ?</h4>
      Si vous souhaitez adhérer à AGRUR, contactez nous au : 00.00.00.00.00.
    </section>
  </div>
</body>
</html>
