<?php
session_start();

//Redirige vers la page des conditionnements si le conditionnement
//n'est pas renseigné dans l'adresse.
if(!isset($_GET['conditionnement']))
{
  header('location: conditionnements.php');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Modifier conditionnement : <?php echo($_GET['conditionnement']); ?></title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Modifier conditionnement : <?php echo($_GET['conditionnement']); ?></h1>
    <a href="espace_gestionnaire.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a>
    <a href="conditionnements.php"><img src="../images/icones/package.png" height="30" align="absmiddle" > Conditionnements</a>
  </div>

  <div class="content-body">
      <div class="panel">
        <p>Ici, vous pouvez, ajouter ou supprimer un poids pour ce type de conditionnement :</p>
        
        <form method="POST" action="../src/src_options_conditionnement.php">
          <table class="tableau_gestion" style="width:750px;">
            <th>N°</th>
            <th>Poids</th>
            <th>Supprimer</th>

            <?php
            $num_poids = 1; //Numéro d'affichage du poids

            //Récupère tous les poids associés au conditionnement
            $sql = $connexion->prepare('SELECT id_conditionnement, poids_conditionnement FROM conditionnement WHERE libelle_conditionnement = :libelle_conditionnement ORDER BY poids_conditionnement ASC');
            $sql->bindParam(':libelle_conditionnement', $_GET['conditionnement']);
            try
            {
              $sql->execute();
              while($donnees_conditionnement = $sql->fetch())
              {
                //Si nombre impaire fond sombre, sinon fond clair
                if($num_poids % 2 == 1)
                {
                  echo('<tr style="background-color:rgb(102, 102, 102); color:white; text-align:center;">');
                }
                else
                {
                  echo('<tr style="background-color:rgb(210, 210, 210); text-align:center;">');
                }
                ?>
                  <td><?php echo($num_poids); ?></td>
                  <td><?php echo($donnees_conditionnement['poids_conditionnement']); ?></td>
                  <td style="text-align:center;"><input type="checkbox" name="ckb_supprimer[]" value="<?php echo($donnees_conditionnement['id_conditionnement']); ?>"></td>
                </tr>
              <?php
              $num_poids++;
              }
            }
            catch(Exception $e)
            {
              echo('Erreur : '.$e->getMessage());
            }
            ?>
          </table>

          <hr>

          <label for="txt_poids">Poids (en grammes) :</label>
          <input type="text" name="txt_poids" placeholder="100">
          <!--Champ caché qui contient le libellé du conditionnement-->
          <input type="hidden" name="hd_libelle" value="<?php echo($_GET['conditionnement']); ?>">
          <label>grammes</label>

          <hr>

          <input type="submit" value="Enregistrer les modifications" id="form_btn" style="float:right;">
          <a href="conditionnements.php" id="form_btn" style="float:right; margin-top:2px;">Annuler</a>
        </form>
      </div>
  </div>
</body>
</html>
