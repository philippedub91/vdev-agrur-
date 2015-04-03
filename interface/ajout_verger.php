<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php');

//Gestion des messages d'erreur
$message_erreur = '';
if(isset($_GET['msg']))
{
  switch($_GET['msg'])
  {
    case 1:
      $message_erreur = 'La variété n\'est pas ou mal renseignée.';
    break;
    case 2:
      $message_erreur = 'La commune n\'est pas ou mal renseignée.';
    break;
    case 3:
      $message_erreur = 'Le nombre d\'arbres par hectare n\'est pas ou mal renseigné.';
    break;
    case 4:
      $message_erreur = 'La superficie n\'est pas ou mal renseignée.';
    break;
    case 5:
      $message_erreur = 'Le nom du verger n\'est pas ou mal renseigné.';
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
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>
    <div data-role="header" data-theme="c">
      <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" class="ui-icon"></a>
      <h1>Ajouter un verger</h1>
    </div>
  </nav>


  <div class="main-container">
    <div class="sub-container">
      <p>
        Ce formulaire, vous permet d'ajouter un verger. Une fois votre ajout validé par
        un gestionnaire, votre verger apparaîtra dans la liste.
      </p>

      <span style="color:red; font-weight:bold;"><?php echo($message_erreur); ?></span>

      <?php echo($_SESSION['num_prod']); ?>

      <!--Formulaire permettant d'ajouter un verger-->
      <form method="post" action="../src/src_ajouter_verger.php" data-ajax="false">
        <div class="ui-field-contain">
          <label for="txt_nom_verger">Nom du verger :</label>
          <input type="text" name="txt_nom_verger" placeholder="Verger d'El Pato Donald">
        </div>

        <div class="ui-field-contain">
          <label for="sld_superficie">Superficie du verger (ha)</label>
          <input type="range" name="sld_superficie" value="30" min="0" max="1000" data-highlight="true">
        </div>

        <div class="ui-field-contain">
          <label for="sld_nb_arbre">Nb d'arbres /ha :</label>
          <input type="range" name="sld_nb_arbre" value="10" min="0" max="300" data-highlight="true">
        </div>

        <div class="ui-field-contain">
          <label for="txt_commune">Commune :</label>
          <input type="text" name="txt_commune" id="txt_commune" onkeyup="autocomplete()" placeholder="Grenoble">
        </div>

        <ul data-role="listview" id="lst_commune">
          <!--vide-->
        </ul>

        <div class="ui-field-contain">
          <label for="txt_variete">Variété :</label>
          <input type="text" name="txt_variete" placeholder="Franquette">  
        </div>

        <div class="ui-field-contain">
          <input type="submit" data-theme="b" value="Ajouter le verger">
          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-c" data-rel="back">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
