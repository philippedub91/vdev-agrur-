<?php
session_start();

$message = '';
if(isset($_GET['msg']))
{
	if($_GET['msg'] == 1)
	{
		$message = 'La variété que vous tentez de créer existe déjà.'; 	
	}	
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Variétés</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Variétés</h1>
    <a href="espace_gestionnaire.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">
        <form method="post" action="../src/src_varietes.php">
          <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N°</th>
              <th>Variété</th>
              <th>AOC</th>
              <th style="width:15px;">Supprimer</th>
            </tr>

            <?php
            $num_variete = 1; //Numéro d'affichage de la variété
            
            //Récupération des variétés
            $sql = $connexion->query('SELECT * FROM variete');
            while($donnees_variete = $sql->fetch())
            {
              //Si nombre impaire fond sombre, sinon fond clair
              if($num_variete % 2 == 1)
              {
                echo('<tr style="background-color:rgb(102, 102, 102); color:white;">');
              }
              else
              {
                echo('<tr style="background-color:rgb(210, 210, 210);">');
              }
            ?>
                <td><?php echo($num_variete); ?></td>
                <td><?php echo($donnees_variete['libelle_variete']); ?></td>
                <td style="text-align:center;">
                  <?php
                  if($donnees_variete['AOC'] == 1)
                  {
                  ?>
                    <input type="checkbox" name="ckb_aoc[]" checked value="<?php echo($donnees_variete['id_variete']); ?>">
                  <?php
                  }
                  else
                  {
                  ?>
                    <input type="checkbox" name="ckb_aoc[]" value="<?php echo($donnees_variete['id_variete']); ?>">
                  <?php
                  }
                  ?>
                </td>
                <td style="text-align:center;"><input type="checkbox" name="ckb_supprimer[]" value="<?php echo($donnees_variete['id_variete']); ?>"></td>
              </tr>
            <?php
            $num_variete++;
            }
            ?>
          </table>

          <div id="separateur"><!--vide--></div>

          <label for="txt_libelle_variete">Ajouter une variété</label>
          <input type="text" name="txt_libelle_variete" placeholder="Nom de la variété" size="50">

     	  <div id="separateur"><!--vide--></div>

          <input type="submit" id="form_btn" style="float:right;" value="Enregistrer les modifications">
          <span style="color:red; float:right; margin-top:10px;"><?php echo($message); ?></span>

        </form>
      </div>
  </div>
</body>
</html>
