<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

#############

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
  <title>Livraisons et lots</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Livraisons</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Voici la liste des livraisons. Cliquez sur le bouton "Créer un lot" pour créer des lots.
        Le bouton "Voir les lots de cette livraison" vous permet de voir la liste des lots de production
        créés à partir de cette livraison.
      </p>

      <!--Affichage du message d'erreur ou de succès-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->

      <!--Liste livraisons-->
      <ul data-role="listview" data-inset="true" data-theme="c" data-divider-theme="c" data-count-theme="c">
        <li data-role="list-divider">Livraisons</li>
        <?php
        $sql = $connexion->query('SELECT * FROM livraison');
        $sql->bindParam(':num_prod', $_SESSION['num_prod']);
        try
        {
          $sql->execute();
          while($donnees_livraison = $sql->fetch())
          {
            $id_livraison = $donnees_livraison['id_livraison'];
          ?>
            <li>
             <table>
               <tr>
                  <td><b>Date de livraison :</b></td>
                  <td><?php echo($donnees_livraison['date_livraison']); ?></td>
                </tr>
                <tr>
                  <td><b>Poids :</b></td>
                  <td><?php echo($donnees_livraison['poids']); ?> kg</td>
                </tr>
                <tr>
                  <td><b>Verger :</b></td>
                  <td><?php echo(getNomVerger($donnees_livraison['id_verger'])); ?></td>
                </tr>
                <tr>
                  <td><b>Type de produit :</b></td>
                  <td><?php echo(getNomType($donnees_livraison['type'])); ?></td>
                </tr>
                <tr>
                  <td><b>Producteur :</b></td>
                  <td><?php echo(getIdentiteProducteur($donnees_livraison['num_prod'])); ?></td>
                </tr>
                <tr>
                  <td><a href="creer_lot_gestionnaire.php?livraison=<?php echo($donnees_livraison['id_livraison']); ?>" class="ui-btn ui-corner-all">Créer des lots</a></td>
                  <td><a href="liste_lot_livraison.php?livraison=<?php echo($id_livraison); ?>" class="ui-btn ui-corner-all">Voir les lots de cette livraison</a></td>
                  <td><a href="../src/src_creer_pdf.php?livraison=<?php echo($id_livraison); ?>" class="ui-btn ui-corner-all"><img src="../images/icones/pdf.png" title="Editer un PDF" height="50"></a></td>
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
