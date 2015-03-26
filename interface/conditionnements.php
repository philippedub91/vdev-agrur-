<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Conditionnements</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Conditionnements</h1>
    <a href="espace_gestionnaire.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">
        <form method="POST" action="../src/src_conditionnements.php">
          <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N°</th>
              <th>Libellé</th>
              <th>Modifier/Infos</th>
              <th>Supprimer</th>
            </tr>

            <?php
            $num_conditionnement = 1; //Numéro d'affichage de la variété
              
            //Récupération des variétés
            $sql = $connexion->query('SELECT * FROM conditionnement GROUP BY libelle_conditionnement');
            while($donnees_conditionnement = $sql->fetch())
            {
              //Si nombre impaire fond sombre, sinon fond clair
              if($num_conditionnement % 2 == 1)
              {
                echo('<tr style="background-color:rgb(102, 102, 102); color:white; text-align:center;">');
              }
              else
              {
                echo('<tr style="background-color:rgb(210, 210, 210); text-align:center;">');
              }
              ?>
                <td><?php echo($num_conditionnement); ?></td>
                <td><?php echo($donnees_conditionnement['libelle_conditionnement']); ?></td>
                <td><a href="options_conditionnement.php?conditionnement=<?php echo($donnees_conditionnement['libelle_conditionnement']); ?>">Cliquer ici</a></td>
                <td><input type="checkbox" name="ckb_supprimer[]" value="<?php echo($donnees_conditionnement['libelle_conditionnement']); ?>"></td>
              </tr>
              <?php
              $num_conditionnement++;
            }
            ?>
            </table>

            <hr>

            <h4>Ajouter un conditionnement</h4>

            <table>
              <tr>
                <td><label for="txt_conditionnement">Libellé : </label></td>
                <td><input type="text" name="txt_conditionnement" placeholder="ex: Filet"></td>
              </tr>
              <tr>
                <td><label for="txt_poids">Poids (séparés par une virgule) :</label></td>
                <td><input type="text" name="txt_poids" placeholder="ex:1000g, 10000g"></td>
              </tr>
            </table>

            <hr>

            <input type="submit" value="Enregistrer les modifications" id="form_btn" style="float:right;">
          </form>
      </div>
  </div>
</body>
</html>
