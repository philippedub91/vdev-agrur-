<?php
session_start();
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

  <div class="headline">
    <h1>Espace gestionnaire</h1>
  </div>

  <div class="content-body">
      <h4>Bienvenue dans votre espace personnel <?php echo($_SESSION['prenom']); ?> ! </h4>
      <div class="panel">
        <table>
          <tr>
            <td>
              <div id="menu_element">
                <a href="producteurs.php">
                  <img src="../images/icones/producteur.png" height="70" align="absmiddle">
                  Producteurs
                </a>
              </div>
            </td>
            <td>
              <div id="menu_element">
                <a href="varietes.php">
                  <img src="../images/icones/varietes.png" height="70" align="absmiddle">
                  Variétés
                </a>
              </div>
            </td>
            <td>
              <div id="menu_element">
                <a href="vergers.php">
                  <img src="../images/icones/verger.png" height="80" align="absmiddle">
                  Vergers
                </a>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div id="menu_element">
                <a href="communes.php">
                  <img src="../images/icones/map.png" height="70" align="absmiddle">
                  Communes
                </a>
              </div>
            </td>
            <td>
              <div id="menu_element">
                <a href="conditionnements.php">
                  <img src="../images/icones/package.png" height="70" align="absmiddle">
                  Conditionnements
                </a>
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
