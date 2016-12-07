<?php
	session_start();
	require "connexion.php";
	if($_SESSION["resultatReq"] == false)
		echo "0 resultat";
?>
<!Doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../favicon.ico">
	    <title>Votre Panier</title>
	    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">E-Book</a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <form action="#" class="navbar-form navbar-right">
	            <div class="form-group">
	              <input type="text" placeholder="Email" class="form-control">
	            </div>
	            <div class="form-group">
	              <input type="password" placeholder="Password" class="form-control">
	            </div>
	            <button type="submit" class="btn btn-success">Sign in</button>
	          </form>
	        </div><!--/.navbar-collapse -->
	      </div>
	    </nav>
	    <div class="jumbotron">
	      <div class="container">
	        <h1>Site E-commerce</h1>
	        <p>Vente des livres en ligne</p>
	        <p><a class="btn btn-primary btn-lg" href="http://www.facebook.com/mohamed.boukhlif.9" target="_blank" role="button">Voir le compte de l'admin &raquo;</a></p>
	      </div>
	    </div>
	    <div class="container">
	    	<h1>Votre Panier</h1>
			<div class="table-responsive" style="width:50%;margin: 0 auto">
				<table class="table table-hover" border="1">
					<tr>
						<th>Supprimer</th>
						<th>Titre</th>
						<th>Prix</th>
						<th>Quantite</th>
						<th>Montant</th>
					</tr>
					<?php
						echo "<tr>";
						$nb = $_SESSION["nb"];
						$s=0;
						for($i=0; $i<$nb; $i++) {
							echo "<td><a href='supprFromPanier.php?id={$_SESSION["panier"]["id"][$i]}' onclick='return confirm(\"Vous êtes sûr de vouloir supprimer ce produit\")'><img src='images/corb.ico' /></a></td>";
							echo "<td>" . $_SESSION["panier"]["titre"][$i] . "</td>";
							echo "<td>" . $_SESSION["panier"]["prix"][$i] . "</td>";
							echo "<td>" . $_SESSION["panier"]["qte"][$i] . "</td>";
							echo "<td>" . $_SESSION["panier"]["qte"][$i]*$_SESSION["panier"]["prix"][$i] . "</td>";
							echo "</tr>";
							$s +=$_SESSION["panier"]["qte"][$i]*$_SESSION["panier"]["prix"][$i];
						}
					?>
					<tr>
						<td colspan="4" align="right" style="font-weight: bold">Total</td>
						<td style="font-weight: bold"><?php echo $s; ?></td>
					</tr>
				</table>
			</div>
			<div class="center-block" style="width:200px;height: 50px;">
				<a class="btn btn-default" role="button" href="listeOuvrage.php">Continuer vos achats</a>
			</div>
		</div>

		<div class="footer">
			<div class="container">
				<div class="agile_footer_grids">
					<div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
						<div class="w3_footer_grid_bottom">
							<h4>Payments 100% securisés</h4>
							<img src="images/card.png" alt=" " class="img-responsive" />
						</div>
					</div>
					<div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
						<div class="w3_footer_grid_bottom">
							<h5>Nous contacter avec</h5>
							<ul class="agileits_social_icons">
								<li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								<li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="wthree_footer_copy">
					<p>© 2016 E-Book. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
			</div>
		</div>
	</body>
</html>