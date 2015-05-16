<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php'); 

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('CLI'); //Vérifie les autorisations de l'utilisateur
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Commander</title>

  <?php include('../common/head.php'); ?>

  <?php
  //Vérifie si $_GET['lot'] est renseigné
  if(isset($_GET['lot']))
  {
    //Récupère le poids du lot
    $poids_lot = getPoidsLot($_GET['lot']);
  }
  else
  {
    header('location: selection_lot_commander.php');
  }
  ?>

  <!--Javascript-->
  <script type="text/javascript">

    //Contient le poids total du lot
    //Cette est obtenue a partir de la variable PHP $poids_lot
    //obtenue précédemment.
    var poids_lot = <?php echo($poids_lot); ?>;
    var poidsRestant = 0; //Contient le poids restant pour le lot
    var poidsCommande = 0; //Contient le poids commandé sur le lot
    var poidsConditionnement = 0; //Contient le poids que peut contenir le conditionnement sélectionné
    var quantiteSelectionnee = 0; //Quantité de conditionnements sélectionnée par l'utilisateur

    //Fonction qui permet de mettre à jour le poids
    //restant pour le lot sélectionné en fonction du
    //poids commandé.
    function mettreAJourPoids()
    {
        //Vérifie si le champ nb_quantite est vide
        if(document.getElementById('nb_quantite').length == 0)
        {
          //attribue la valeur zéro pour éviter les erreurs de type NaN (Non a Numeric) si
          //le champ est vide.
          document.getElementById('nb_quantite').text = 0;
        }

        poidsConditionnement = parseFloat(document.getElementById('lst_conditionnement').value);
        quantiteSelectionnee = parseInt(document.getElementById('nb_quantite').value);

        poidsCommande  = quantiteSelectionnee * poidsConditionnement;
        poidsRestant = poids_lot - poidsCommande;

        //Vérifie si le poids restant (poids du lot - poids commandé) est plus petit
        //que 0.
        if(poidsRestant < 0)
        {
          //poidsRestant plus petit que 0 (le poids commandé est inférieur au poids du lot)
          //Affiche un message d'erreur et désactive le bouton de validation
          document.getElementById('msgErreur').innerHTML = 'Le poids commandé est supérieur au poids du lot !';
          document.getElementById('btn_valider').disabled = true;
        }
        else
        {
          //poidsRestant est supérieur ou égal à 0 (il reste des noix à commander)
          //Supprime le message d'erreur et réactive le bouton de validation
          document.getElementById('msgErreur').innerHTML = '';
          document.getElementById('btn_valider').disabled = false;
        }

        //Affiche le poids en direct dans les balises <span id="poidsCommande"></span
        // et <span id="poidsRestant"></span>.
        document.getElementById('poidsCommande').innerHTML = poidsCommande;
        document.getElementById('poidsRestant').innerHTML = poidsRestant;
    }
  </script>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="arrow-l" data-rel="back" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Commander</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <p>Sélectionnez un type de conditionnement, puis la quantité souhaité</p>

      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-c">
          <h3>Sélectionner et valider la commande</h3>
        </div>
        <div class="ui-body ui-body-c">

          <h2>Poids commandé : <span id="poidsCommande">0</span> kg</h2>
          <h2>Poids restant : <span id="poidsRestant"><?php echo($poids_lot); ?></span> kg</h2>

          <span style="font-weight:bold; color:red;" id="msgErreur"><!--message d'erreur--></span>

          <hr>

          <form method="POST" action="../src/src_commander.php" data-ajax="false">

            <!--Liste déroulante contenant tous les conditionnements-->
            <label for="select-choice-a" class="select">Choisir un  conditionnement :</label>
            <select name="lst_conditionnement" id="lst_conditionnement" onChange="mettreAJourPoids();">
              <?php
              $sql = $connexion->query('SELECT * FROM conditionnement');
              try
              {
                $sql->execute();
                while($donnees_conditionnement = $sql->fetch())
                {
                ?>
                  <option value="<?php echo($donnees_conditionnement['poids_conditionnement']); ?>"><?php echo($donnees_conditionnement['libelle_conditionnement'].' '.$donnees_conditionnement['poids_conditionnement'].' kg'); ?></option>
                <?php
                }
              }
              catch(Exception $e)
              {
                echo('Erreur : '.$e->getMessage());
              }
              ?>
            </select>
            <!--Fin liste-->

            <label for="nb_quantite">Quantité souhaitée :</label>
            <input type="number" name="nb_quantite" id="nb_quantite" value="0" min="0" onChange="mettreAJourPoids(); onlyNumber();">

            <input type="hidden" name="hd_lot" value="<?php echo($_GET['lot']); ?>">
            <input type="hidden" name="hd_poids" value="<?php echo($poids_lot); ?>">

            <!--Bouton pour valider-->
            <button type="submit" name="btn_valider" id="btn_valider" class="ui-btn ui-btn-inline">Commander</button>

          </form>

        </div>  
      </div>
    </div>
  </div>
</body>
</html>
