<?php
	session_start();
	if(isset($_GET["id"])) {
		$id=$_GET["id"];
		$nb=count($_SESSION["panier"]["id"]);
		for($i=0; $i<$nb-1; $i++) {
			if($id == $_SESSION["panier"]["id"][$i]) {
				foreach($_SESSION["panier"] as $key => $value) {
					for($j=$i; $j<$nb-1; $j++){
						$tmp=$_SESSION["panier"][$key][$j];
						$_SESSION["panier"][$key][$j]=$_SESSION["panier"][$key][$j+1];
						$_SESSION["panier"][$key][$j+1]=$tmp;
					}
				}
			}
		}
		$_SESSION["nb"]=$_SESSION["nb"]-1;
		header("location:ajouterPanier.php");
	}
	else
		header("location:ajouterPanier.php");
?>