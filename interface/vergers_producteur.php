<?php
session_start();

//Gestion des messages d'erreur
$message_erreur = '';
if(isset($_GET['msg']))
{
  switch($_GET['msg'])
  {
    case 1:
      $message_erreur = 'Un ou plusieurs champs ne sont pas ou mal saisis. Merci de vérifier le formulaire avant de continuer.';
    break;
    default:
    break;
  }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mes vergers</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

    <nav>
    <div data-role="navbar">
      <ul>
          <li><a href="espace_producteur.php">Accueil</a></li>
      </ul>
    </div>
    
    <div data-role="header">
      <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
      <h1>Mes vergers</h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>
        Voici la liste de tous vos vergers enregistrés.
        Cliquez sur un verger pour afficher plus d'informations 
        et d'options. Vous pouvez également
        <a href="ajouter_verger.php">ajouter des vergers</a>.
      </p>

      <!--Affiche la liste des vergers du producteur-->
      <ul data-role="listview" data-filter="true" data-filter-placeholder="Chercher un verger" data-inset="true">
        <?php
        $sql = $connexion->prepare('SELECT * FROM verger WHERE num_prod = :num_prod');
        $sql->bindParam(':num_prod', $_SESSION['num_prod']);
        try
        {
          $sql->execute();
        }
        catch(Exception $e)
        {
          echo('Erreur : '.$e->getMessage());
        }

        while($donnees_verger = $sql->fetch())
        {
        ?>
          <li>
            <a href="gerer_verger.php?verger=<?php echo($donnees_verger['id_verger']); ?>">
              <?php echo($donnees_verger['nom_verger']); ?>
            </a>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</body>
</html>
