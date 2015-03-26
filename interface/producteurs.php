<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Producteurs</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Producteurs</h1>
    <a href="espace_gestionnaire.php"><img src="../images/icones/home.png" height="30" align="absmiddle" > Accueil</a></a>
  </div>

  <div class="content-body">
      <div class="panel">
         <table class="tableau_gestion" style="width:750px;">
            <tr>
              <th>N°</th>
              <th>Identité</th>
              <th>Vergés</th>
              <th>Livraisons</th>
              <th>Commandes</th>
            </tr>

            <?php
            $num_producteur = 1; //Numéro d'affichage de la variété
            
            //Récupération des variétés
            $sql = $connexion->query('SELECT * FROM utilisateur WHERE token IN (SELECT token FROM producteur)');
            while($donnees_producteur = $sql->fetch())
            {
              //Si nombre impaire fond sombre, sinon fond clair
              if($num_producteur % 2 == 1)
              {
                echo('<tr style="background-color:rgb(102, 102, 102); color:white; text-align:center;">');
              }
              else
              {
                echo('<tr style="background-color:rgb(210, 210, 210); text-align:center;">');
              }
            ?>
                <td><?php echo($num_producteur); ?></td>
                <td><?php echo($donnees_producteur['prenom'].' '.$donnees_producteur['nom']); ?></td>
                <td><a href="#">Voir ses vergers</a></td>
                <td><a href="#">Voir ses livraisons</a></td>
                <td><a href="#">Voir ses commandes</a></td>
              </tr>
            <?php
            $num_producteur++;
            }
            ?>
          </table>

          <div id="separateur"><!--vide--></div>


        <form method="POST" action="../src/src_producteur.php">
          <input type="submit" id="form_btn" style="float:right;" value="Enregistrer les modifications">
          <span style="float:right; margin-top:10px;">
            <label for="lst_utilisateurs">Ajouter un producteur</label>
            <select name="lst_utilisateurs">
          	 <?php
          	 $sql = $connexion->query('SELECT token, nom, prenom FROM utilisateur WHERE type = 0');
          	 while($donnees_utilisateur = $sql->fetch())
          	 {
          	 ?>
          	   <option value="<?php echo($donnees_utilisateur['token']); ?>"><?php echo($donnees_utilisateur['prenom'].' '.$donnees_utilisateur['nom']); ?></option>
          	 <?php
          	 }
            ?>
            </select>
          </span>
        </form>
      </div>
  </div>
</body>
</html>
