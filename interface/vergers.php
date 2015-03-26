<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Vergers</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Vergers</h1>
    <a href="espace_gestionnaire.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">
         <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N°</th>
              <th>Vergé</th>
              <th>Commune</th>
              <th>Producteur</th>
              <th>Plus</th>
            </tr>

            <?php
            $num_verger = 1; //Numéro d'affichage de la variété
            
            //Récupération des variétés
            $sql = $connexion->query('SELECT * FROM verger');
            while($donnees_verger = $sql->fetch())
            {
              //Si nombre impaire fond sombre, sinon fond clair
              if($num_verger % 2 == 1)
              {
                echo('<tr style="background-color:rgb(102, 102, 102); color:white; text-align:center;">');
              }
              else
              {
                echo('<tr style="background-color:rgb(210, 210, 210); text-align:center;">');
              }
            ?>
                <td><?php echo($num_verger); ?></td>
                <td><?php echo($donnees_verger['nom_verger']); ?></td>
                <td><?php echo($donnees_verger['id_commune']); ?></a></td>
                <td><?php echo($donnees_verger['num_prod']); ?></td>
                <td><a href="#">Plus</a></td>
              </tr>
            <?php
            $num_verger++;
            }
            ?>
          </table>
      </div>
  </div>
</body>
</html>
