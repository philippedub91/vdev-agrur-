<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('PROD'); //Vérifie les autorisations de l'utilisateur

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
  <title>Mes livraisons</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>

  <!--Eléments nécessaires à l'affichage du calendrier
  lors de la sélection du champ date-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <script>
    $(function() {
      $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
      $( "#locale" ).change(function() {
        $( "#datepicker" ).datepicker( "option",
          $.datepicker.regional[ $( this ).val() ] );
      });
    });
  </script>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Mes livraisons</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Ici, se trouvent toutes les livraisons que vous avez réalisées pour AGRUR.
        Vous pouvez également en ajouter une en cliquant sur le bouton ci-dessous.
      </p>

      <!--Affiche un message de succès ou d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->

      <div data-role="collapsible"> 
        <h4>Ajouter une livraison</h4>

        <p>Pour ajouter une livraison, veuillez renseigner les champs suivants :</p>

        <hr>

        <form method="POST" action="../src/src_ajouter_livraison.php" data-ajax="false">
          
          <!--Date de livraison-->
          <div class="ui-field-contain">
            <label for="txt_date_livraison">Date de livraison :</label>
            <input name="txt_date_livraison"  id="datepicker" type="datr" placeholder="Date de livraison">
          </div>

          <!--Verger d'origine de la livraison-->
          <div class="ui-field-contain">
            <label for="lst_verger" class="select">Verger d'origine</label>
            <select name="lst_verger" data-native-menu="false">
              <?php afficherVergerProducteurLst($_SESSION['num_prod'], $is_lst = TRUE);?>
            </select>
          </div>

          <div class="ui-field-contain">
            <label for="lst_type_produit" class="select">Type de produit :</label>
            <select name="lst_type_produit" data-native-menu="false">
              <?php afficherTypeProduitLst(); ?>
            </select>
          </div>

          <div class="ui-field-contain">
            <label for="txt_quantite">Quantité livrée (kg) </label>
            <input type="text" name="txt_quantite" placeholder="Quantité livrée (kg)">
          </div>

          <input type="submit" value="Valider et ajouter">

        </form>
      </div>

    <ul data-role="listview" data-inset="true" data-theme="c" data-divider-theme="c" data-count-theme="c">
      <li data-role="list-divider">Mes livraisons</li>
      <?php
      $sql = $connexion->prepare('SELECT * FROM livraison WHERE num_prod = :num_prod');
      $sql->bindParam(':num_prod', $_SESSION['num_prod']);
      try
      {
        $sql->execute();
        while($donnees_livraison = $sql->fetch())
        {
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
