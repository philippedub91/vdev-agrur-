<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Communes</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Communes</h1>
    <a href="espace_gestionnaire.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">
        <form method="post" action="../src/src_communes.php">
          <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N°</th>
              <th>Commune</th>
              <th>AOC</th>
            </tr>

            <?php
            $num_commune = 1; //Numéro d'affichage de la variété
            
            //Récupération des variétés
            $sql = $connexion->query('SELECT * FROM commune');
            while($donnees_commune = $sql->fetch())
            {
              //Si nombre impaire fond sombre, sinon fond clair
              if($num_commune % 2 == 1)
              {
                echo('<tr style="background-color:rgb(102, 102, 102); color:white;">');
              }
              else
              {
                echo('<tr style="background-color:rgb(210, 210, 210);">');
              }
            ?>
                <td><?php echo($num_commune); ?></td>
                <td><?php echo($donnees_commune['nom_commune']); ?></td>
                <td style="text-align:center;">
                  <?php
                  if($donnees_commune['commune_aoc'] == 1)
                  {
                  ?>
                    <input type="checkbox" name="ckb_aoc[]" checked value="<?php echo($donnees_commune['id_commune']); ?>">
                  <?php
                  }
                  else
                  {
                  ?>
                    <input type="checkbox" name="ckb_aoc[]" value="<?php echo($donnees_commune['id_commune']); ?>">
                  <?php
                  }
                  ?>
                </td>
              </tr>
            <?php
            $num_commune++;
            }
            ?>
          </table>

          <div id="separateur"><!--vide--></div>

          <input type="submit" id="form_btn" style="float:right;" value="Enregistrer les modifications">

        </form>
      </div>
  </div>
</body>
</html>
