<?php
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<!-- BASICS -->
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DLS ARENA 4</title>
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />
		<link rel="stylesheet" href="../js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/bootstrap-theme.css">
        <link rel="stylesheet" href="../css/style.css">
		<!-- skin -->
		<link rel="stylesheet" href="../skin/default.css">
        <link rel="stylesheet" href="../compiled/flipclock.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="../compiled/flipclock.js"></script>
		<script src="../js/jquery.countdown.js"></script>

</head>
    <?php include("../navbar.php");
          include("../include/_inc_parametres.php");
          include("../include/_inc_connexion.php");?>

    <section class="featured" id="featured">
			<div class="container">
			    <!-- Titre DLS -->
				<div class="row mar-bot40">
					<div class="col-md-6 col-md-offset-3">

						<div class="align-center">
							<i class="fa fa-gamepad fa-5x mar-bot20"></i>
							<h2 class="slogan">ESPACE MEMBRE</h2>
							<br/>
						</div>
					</div>
				</div>
			</div>
		</section>
<body>
<?php
    if (isset($_SESSION['connect'])) // on re-vérifie si l'utilisateur est connecté, même procédé que la page précédente.
    {
        if ( $_SESSION['connect'] == true ) // si l'utilisateur est confirmé, on affiche l'espace membre.
        { ?>

        <?php
         //on vérifie si l'utilisateur a une équipe
			$req_pre = $cnx->prepare("SELECT * FROM inscriptionequipe, utilisateurs WHERE utilisateurs.pseudo=:pseudo AND idJoueur=utilisateurs.id");
			// liaison de la variable à la requête préparée
			$req_pre->bindValue(':pseudo', $_SESSION['pseudo'] , PDO::PARAM_STR);
			$req_pre->execute();
			//le résultat est récupéré sous forme d'objet
			$ligne=$req_pre->fetch(PDO::FETCH_OBJ);
			// récupération du résultat
            if(empty($ligne)){$equipe=false;}
            else
            {
                $equipe=true;
                if ($ligne->chef==1)
                {$chef=true;}
                else
                {$chef=false;}
            }

			// fermeture du curseur associé à un jeu de résultats
			$req_pre->closeCursor();
        ?>
            <section id="section-services" class="section pad-bot30 bg-white">
		<div class="container" style="height:100%">
        <?php
            if($equipe==true)
            {
                //Si le membre est chef d'équipe
                if($chef==true)
                {

                }
                //Si le membre est simple membre d'équipe
                else($chef==false)
                {

                }
            }
            //Si le membre n'a pas d'équipe
            else
            { ?>
                <div class="row mar-bot40"> <!-- Début div "page" -->
				<div class="col-lg-6" >
				    <a href="">
					<div class="align-center" style="background-color:#dcdcdc;padding:50px;margin:50px;border-radius:32px;">
                            <i class="fa fa-plus fa-5x mar-bot20" aria-hidden="true"></i>
                            <h2>CRÉER</h2>
					</div>
					</a>
				</div>

				<div class="col-lg-6" >
					<a href="">
					<div class="align-center" style="background-color:#dcdcdc;padding:50px;margin:50px;border-radius:32px;">
                            <i class="fa fa-share fa-5x mar-bot20" aria-hidden="true"></i>
                            <h2>REJOINDRE</h2>
					</div>
					</a>
                </div>
			</div> <!-- Fin div "page" -->
            <?php
            }
            ?>
        </div>
    </section>
    <?php include("../footer.php"); ?>
       <?php
        }
        else // si on arrive ici, il y a une erreur donc on détruit sa session et on le redirige vers l'index.
        {
            session_destroy();
            header('Location: index.php');
            exit();
        }
    }
    else //si l'utilisateur n'est pas connecté, on le redirige vers la page login/inscription
    {
        session_destroy();
            header('Location: index.php');
            exit();
    }
    ?>

</body>
</html>