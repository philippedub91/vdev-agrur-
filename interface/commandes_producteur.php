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
  <title>Mes commandes</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Mes commandes</h1>
    <a href="espace_producteur.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">

        <!--Affiche le message d'erreur contenu dans la variable $message_erreur-->
        <span style="color:red;"><?php echo($message_erreur); ?></span>

        <form method="POST" action="../src/src_vergers_producteur.php">
          <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N° commande</th>
              <th>Client</th>
              <th>Quantité</th>
              <th>Date commande</th>
              <th>Gestion</th>

            </tr>

            <?php
            $num_commande = 1; //Numéro d'affichage de la variété
              
            //Récupération des variétés
            $sql = $connexion->prepare('SELECT * FROM commande WHERE num_prod = :num_prod');
            $sql->bindParam(':num_prod', $_SESSION['num_prod']);
            try
            {
              $sql->execute();
              while($donnees_commande = $sql->fetch())
              {
                //Si nombre impaire fond sombre, sinon fond clair
                if($num_commande % 2 == 1)
                {
                  echo('<tr style="background-color:rgb(102, 102, 102); color:white; text-align:center;">');
                }
                else
                {
                  echo('<tr style="background-color:rgb(210, 210, 210); text-align:center;">');
                }
                ?>
                <td><?php echo($donnees_commande['num_commande']); ?></td>
                <td><?php echo($donnees_commande['num_client']); ?></td>
                <td><?php echo($donnees_commande['quantite']); ?></td>
                <td><?php echo($donnees_commande['date_commande']); ?></td>
                <td><a href="option_commandes_producteur.php?cmd=<?php echo($donnees_commande['num_commande']); ?>">Gérer</a></td>
                <?php
              }
            }
            catch(Exception $e)
            {
              echo('Erreur : '.$e->getMessage());
            }
            ?>
      </div>
  </div>
</body>
</html>
