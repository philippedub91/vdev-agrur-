<?php
session_start();

//Gestion des messages d'erreur :
$message = ''; //Initialise message

if(isset($_GET['msg']) && $_GET['msg'] == 1 )
{
  $message = 'Un ou plusieurs champs n\'ont pas été saisis correctement.'; 
} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mes commandes</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Mes commandes</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Voici la liste de vos commandes.
      </p>

      <p style="color:red; font-weight=bold;"><?php echo($message); ?></p>

      
    <ul data-role="listview" data-inset="true" data-theme="c" data-divider-theme="c" data-count-theme="c">
      <li data-role="list-divider">Mes commandes :</li>
      <?php
      $sql = $connexion->prepare('SELECT * FROM commande WHERE num_client = :num_client');
      $sql->bindParam(':num_client', $_SESSION['num_client']);
      try
      {
        $sql->execute();
        while($donnees_commande = $sql->fetch())
        {
        ?>
          <li>
            <table>
              <tr>
                <td><b>Commande n° :</b></td>
                <td><?php echo($donnees_commande['id']); ?></td>
              </tr>
              <tr>
                <td><b>Prix :</b></td>
                <td><?php echo($donnees_commande['prixHt']); ?> €</td>
              </tr>
              <tr>
                <td><b>Conditionnement :</b></td>
                <td><?php echo(getLibelleConditionnement($donnees_commande['conditionnement'])); ?></td>
              </tr>
              <tr>
                <td><b>Quantité :</b></td>
                <td><?php echo($donnees_commande['quantite']); ?></td>
              </tr>
              <tr>
                <td><b>Date condi :</b></td>
                <td><?php echo($donnees_commande['dateConditionnement']); ?></td>
              </tr>
              <tr>
                <td><b>Date d'envoi :</b></td>
                <td><?php echo($donnees_commande['dateEnvoi']); ?></td>
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


    </div>
  </div>
</body>
</html>
