<!Doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Liste Ouvrage</title>
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
			<div class="row">
					<?php
						require "connexion.php";
						if(isset($_GET["choix"])) {
							$choix = $_GET["choix"];
							//side menu
							$reqlibelle = mysqli_query($conn, "select * from categorie");
							echo "<div class='col-md-3'>";
							echo "<ul class='nav nav-pills nav-stacked'>";
							echo "<li><a href='listeOuvrage.php'>Les nouveautés</a></li>";
							while($tab = mysqli_fetch_assoc($reqlibelle)) {
								if($tab["codecat"]==$choix)
									echo "<li class='active'><a href='?choix={$tab["codecat"]}'>{$tab["libelle"]}</a></li>";
								else
									echo "<li><a href='?choix={$tab["codecat"]}'>{$tab["libelle"]}</a></li>";
							}
							echo "</ul></div>";
							//multipages
							$ouvrages_par_page = 3;
							if(!isset($_GET["page"]))
								$page = 1;
							else
								$page = $_GET["page"];
							$reqouv = mysqli_query($conn, "select * from ouvrage where codecat='$choix'");
							$nbPages = ceil(mysqli_num_rows($reqouv)/$ouvrages_par_page);
							if($page>$nbPages || $page<=0) {
								mysqli_close($conn);
								die("pas de pages à afficher");
							}
							
							$debut= ($page-1)*$ouvrages_par_page;

							//diplaying data
							echo "<div class='col-md-9'>";
							$reqcat = mysqli_query($conn, "select * from categorie where codecat = '$choix'");
							$cat = mysqli_fetch_assoc($reqcat);
							$reqOuvrages = mysqli_query($conn, "select * from ouvrage where codecat='$choix' limit $debut,$ouvrages_par_page");

							echo "<h1 align='center' style='margin: 10px 0;'>Les ouvrages de {$cat["libelle"]}</h1>";
							$i=0;
							while($l = mysqli_fetch_assoc($reqOuvrages)) {
								if($i%3==0)
									echo "<div class='row'>";
								echo "<div class='col-md-4'>";
								echo "<div class='hover14 column'>
										<div class='agile_top_brand_left_grid'>
											<div class='agile_top_brand_left_grid1'>
												<figure style='height:400px'>
													<div class='snipcart-item block'>
														<div class='snipcart-thumb'>
														<a href='#' >
															<img src='images/{$l["image"]}.gif'>
														</a>
															<p>Titre : {$l["titre"]}</p>
															<p>Editeur : {$l["editeur"]}</p>
															<p>Année : {$l["anedi"]}</p>
															<p>prix : {$l["prix"]} DH</p>
														</div>
														<div class='snipcart-details top_brand_home_details' style='position: absolute;bottom: 0px;right: 13%;'>
															<form action='panier.php?id={$l["idouvrage"]}' method='post' name='f_ouvrage'>
																<fieldset>
																	<label for=".$i.">Qté : </label>
																	<input class='form-control' id=".$i." name='qte' type='number' value='1' min='1' required>
																	<input type='submit' value='Ajouter au panier' class='button'>
																</fieldset>
															</form>
														</div>
													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>";
									if($i%3==2)
										echo "</div>";
								$i++;
							}
							echo "<div class='row'>";
							echo "<div class='col-md-12'>";
							echo "<ul class='pagination'>";
							for($i=1; $i<=$nbPages; $i++) {
								if($i==$page)
									echo "<li class='active'><a href='#'>".$i."</a></li>";
								else
									echo "<li><a href='?choix={$choix}&page={$i}'>".$i."</a></li>";
							}
							echo "</ul></div></div></div>";

						}
						else {
							require "connexion.php";
							//side menu
							$reqlibelle = mysqli_query($conn, "select * from categorie");
							echo "<div class='col-md-3'>";
							echo "<ul class='nav nav-pills nav-stacked'>";
							echo "<li class='active'><a href='listeOuvrage.php'>Les nouveautés</a></li>";
							while($tab = mysqli_fetch_assoc($reqlibelle))
									echo "<li><a href='?choix={$tab["codecat"]}'>{$tab["libelle"]}</a></li>";

							echo "</ul></div>";
							//multipages
							$ouvrages_par_page = 3;
							if(!isset($_GET["page"]))
								$page = 1;
							else
								$page = $_GET["page"];
							$reqouv = mysqli_query($conn, "select * from ouvrage where anedi=2012");
							$nb = mysqli_num_rows($reqouv);
							$nbPages = ceil($nb/$ouvrages_par_page);
							
							$debut= ($page-1)*$ouvrages_par_page;
							if($page>$nbPages || $page<=0) {
								mysqli_close($conn);
								die("pas de pages à afficher");
							}
							//displaying data
							echo "<div class='col-md-9'>";
							$reqOuvrages = mysqli_query($conn, "select * from ouvrage where anedi=2012 limit $debut,$ouvrages_par_page");

							echo "<h1 align='center' style='margin: 10px 0;'>Les ouvrages les plus recents</h1>";
							$i=0;
							while($l = mysqli_fetch_assoc($reqOuvrages)) {
								if($i%3==0)
									echo "<div class='row'>";
										echo "<div class='col-md-4'>";
											echo "<div class='hover14 column'>
														<div class='agile_top_brand_left_grid'>
															<div class='agile_top_brand_left_grid1'>
																<figure style='height:400px'>
																	<div class='snipcart-item block'>
																		<div class='snipcart-thumb'>
																			<a href='#' >
																				<img src='images/{$l["image"]}.gif'>
																			</a>
																			<p>Titre : {$l["titre"]}</p>
																			<p>Editeur : {$l["editeur"]}</p>
																			<p>Année : {$l["anedi"]}</p>
																			<p>prix : {$l["prix"]} DH</p>
																		</div>
																		<div class='snipcart-details top_brand_home_details' style='position: absolute;bottom: 0px;right: 13%;'>
																			<form action='panier.php?id={$l["idouvrage"]}' method='post' name='f_ouvrage'>
																				<fieldset>
																					<label for=".$i.">Qté : </label>
																					<input class='form-control' id=".$i." name='qte' type='number' value='1' min='1' required>
																					<input type='submit' value='Ajouter au panier' class='button'>
																				</fieldset>
																			</form>
																		</div>
																	</div>
																</figure>
															</div>
														</div>
													</div>
												</div>";
									if($i%3==2)
										echo "</div>";
								$i++;
							}
							echo "<div class='row'>";
							echo "<div class='col-md-12'>";
							echo "<ul class='pagination'>";
							for($i=1; $i<=$nbPages; $i++) {
								if($i==$page)
									echo "<li class='active'><a href='#'>".$i."</a></li>";
								else
									echo "<li><a href='?page={$i}'>".$i."</a></li>";
							}
							echo "</ul></div></div></div>";
						}
					?>
				</div>
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