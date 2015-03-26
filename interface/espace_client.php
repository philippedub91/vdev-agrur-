<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Espace client</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Espace client</h1>
  </div>

  <div class="content-body">
      <h4>Bienvenue dans votre espace personnel <?php echo($_SESSION['prenom']); ?> ! </h4>
      <div class="panel">
        <table>
          <tr>
            <td>
              <div id="menu_element">
                <img src="../images/icones/panier.png" height="70" align="absmiddle">
                Mes commandes
              </div>
            </td>
            <td>
              <div id="menu_element">
                <img src="../images/icones/profil.png" height="70" align="absmiddle">
                Mon profil
              </div>
            </td>
            <td>
              <div id="menu_element">
                <a href="../src/session_destroy.php">
                  <img src="../images/icones/deconnexion.png" height="70" align="absmiddle">
                  Déconnexion
                </a>
              </div>
            </td>
          </tr>
        </table>
      </div>
  </div>
</body>
</html>
