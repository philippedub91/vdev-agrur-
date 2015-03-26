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
  <title>Mes vergers</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Mes vergers</h1>
    <a href="espace_producteur.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">

        <!--Affiche le message d'erreur contenu dans la variable $message_erreur-->
        <span style="color:red;"><?php echo($message_erreur); ?></span>

        <form method="POST" action="../src/src_vergers_producteur.php">
          <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N°</th>
              <th>Nom</th>
              <th>Superficie</th>
              <th>Nb arbres</th>
              <th>Commune</th>
              <th>Variété</th>
              <th>Supprimer</th>
            </tr>

            <?php
            $num_verger = 1; //Numéro d'affichage de la variété
              
            //Récupération des variétés
            $sql = $connexion->prepare('SELECT * FROM verger WHERE num_prod = :num_prod');
            $sql->bindParam(':num_prod', $_SESSION['num_prod']);
            try
            {
              $sql->execute();
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
                <td><?php echo($donnees_verger['superficie']); ?></td>
                <td><?php echo($donnees_verger['nbr_arbre']); ?></td>
                <?php

                //Récupére le nom de la commune dans lequel se trouve le verger en fonction de son id
                $sql_commune = $connexion->prepare('SELECT nom_commune FROM commune WHERE id_commune = :id_commune');
                $sql_commune->bindParam(':id_commune', $donnees_verger['id_commune']);
                try
                {
                  $sql_commune->execute();
                  $donnees_commune = $sql_commune->fetch();
                  ?>
                  
                  <td><?php echo($donnees_commune['nom_commune']); ?></td>

                <?php
                }
                catch(Exception $e)
                {
                  echo('Erreur : '.$e->getMessage());
                }

                //Récupère le libelle de la variete en fonction de son id
                $sql_variete = $connexion->prepare('SELECT libelle_variete FROM variete WHERE id_variete = :id_variete');
                $sql_variete->bindParam(':id_variete', $donnees_verger['id_variete']);
                try
                {
                  $sql_variete->execute();
                  $donnees_variete = $sql_variete->fetch();
                  echo('<td>'.$donnees_variete['libelle_variete'].'</td>');
                }
                catch(Exception $e)
                {
                  echo('Erreur : '.$e->getMessage());
                }

                ?>
                <!--Case à cocher permettant de supprimer le verger-->
                <td><input type="checkbox" name="ckb_supprimer[]" value="<?php echo($donnees_verger['id_verger']); ?>"></td>
                <?php

                $num_verger++;
              }
            }
            catch(Exception $e)
            {
              echo('Erreur '.$e->getMessage());
            }
            ?>
            <table>
            
            <hr>

            <h4>Ajouter un verger</h4>

            <form method="POST" action="../src/src_verger_producteur.php">
              <table>
                <tr>
                  <td><label for="txt_nom_verger">Nom : </label></td>
                  <td><input type="text" name="txt_nom_verger" placeholder="ex:Verger du Berger"></td>
                </tr>
                <tr>
                  <td><label for="txt_superficie">Superficie : </label></td>
                  <td><input type="text" name="txt_superficie"></td>
                </tr>
                <tr>
                  <td><label for="txt_nbr_arbres">Nombre d'arbres : </label></td>
                  <td><input type="text" name="txt_nbr_arbres" placeholder="ex:5"></td>
                </tr>
                <tr>
                  <td><label for="lst_commune">Commune : </label></td>
                  <td>
                    <select name="lst_commune">
                      <option>Sélectionner une commune</option>
                      <?php
                      $sql = $connexion->query('SELECT id_commune, nom_commune FROM commune');
                      while($donnees_commune = $sql->fetch())
                      {
                      ?>
                        <option value="<?php echo($donnees_commune['id_commune']); ?>"><?php echo($donnees_commune['nom_commune']); ?></option>
                      <?php
                      }
                      $sql->closeCursor();
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="lst_variete">Variété :</label></td>
                  <td>
                    <select name="lst_variete">
                      <option>Sélectionner une variété</option>
                      <?php
                      $sql = $connexion->query('SELECT id_variete, libelle_variete FROM variete');
                      while($donnees_variete = $sql->fetch())
                      {
                      ?>
                        <option value="<?php echo($donnees_variete['id_variete']); ?>"><?php echo($donnees_variete['libelle_variete']); ?></option>
                      <?php
                      }
                      $sql->closeCursor();
                      ?>
                    </select>
                  </td>
                </tr>
              </table>

              <hr>

              <input type="submit" value="Enregistrer les modifications" id="form_btn" style="float:right;">
          </form>
      </div>
  </div>
</body>
</html>
