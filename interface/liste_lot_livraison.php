<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

##############

//Gestion des messages de succès et d'erreur
$erreur = ''; //Contiendra éventuellement le message d'erreur
$message = ''; //Contiendra éventuellement le message de succès
if(isset($_GET['err']))
{
  $erreur = addDecorum($_GET['err'], 'ERR');
}
elseif(isset($_GET['msg']))
{
  $message = addDecorum($_GET['msg'], 'SUC'); 
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Liste des lots créés à partir de la livraison <?php echo($_GET['livraison']); ?></title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Liste des lots</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Voici la liste des lots de production créés à partir de la livraison n°
        <?php echo($_GET['livraison']); ?>.
      </p>

      <!--Affichage du message d'erreur ou de succès-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->


      <!--Liste des lots qui composent la livraison-->
      <ul data-role="listview" data-inset="true" data-theme="c" data-divider-theme="c" data-count-theme="c">
        <li data-role="list-divider">Lots</li>
        <?php
        $sql = $connexion->prepare('SELECT * FROM composer WHERE id_livraison = :id_livraison');
        $sql->bindParam(':id_livraison', $_GET['livraison']);
        try
        {
          $sql->execute();
          while($donnees_lot = $sql->fetch())
          {
          ?>
            <li>
             <table>
               <tr>
                  <td><b>Numéro de lot :</b></td>
                  <td><?php echo($donnees_lot['id_lot']); ?></td>
                </tr>
                <tr>
                  <!--td><b>Calibre :</b></td>
                  <td><?php echo(getLibelleCalibre($donnees_lot['calibre'])); ?></td-->
                </tr>
                <tr>
                  <td><b>Poids :</b></td>
                  <td><?php echo(getPoidsLot($donnees_lot['id_lot'])); ?> Kg</td>
                </tr>
                <tr>
                  <td><b>Code livraison :</b></td>
                  <td><?php echo($donnees_lot['id_livraison']); ?></td>
                </tr>
              </table>
            </li>
        <?php
        }
      }
      catch(Exception $e)
      {
        echo('Erreur : '.$e->getMessage());
      }
      ?>
    </ul>
    <!--Fin liste-->

    </div>
  </div>
</body>
</html>
