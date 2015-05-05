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

      <ul data-role="listview" data-inset="true" data-theme="c" data-divider-theme="c" data-count-theme="c">
        <li data-role="list-divider">Lots</li>
        <?php
        $sql = $connexion->prepare('SELECT * FROM lot_production WHERE id_livraison = :id_livraison');
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
                  <td><b>Calibre :</b></td>
                  <td><?php echo(getLibelleCalibre($donnees_lot['calibre'])); ?></td>
                </tr>
                <tr>
                  <td><b>Poids :</b></td>
                  <td><?php echo($donnees_lot['poids'].' Kg'); ?></td>
                </tr>
                <tr>
                  <td><b>Livraison :</b></td>
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

    </div>
  </div>
</body>
</html>
