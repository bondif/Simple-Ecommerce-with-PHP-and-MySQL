<?php

	session_start();
	require "connexion.php";
	if(isset($_GET["id"]) && isset($_POST["qte"])) {
		$id = $_GET["id"];
		$qte = $_POST["qte"];
		if(!isset($_SESSION["panier"])) {
			$_SESSION["panier"] = array();
			$_SESSION["panier"]["titre"] = array();
			$_SESSION["panier"]["prix"] = array();
			$_SESSION["panier"]["qte"] = array();
			$_SESSION["panier"]["id"] = array();
			$_SESSION["nb"]=0;
		}
		
		$res = mysqli_query($conn, "select * from ouvrage where idouvrage='$id'") or die("Erreur requete");
		$t = mysqli_fetch_assoc($res);
		if (mysqli_num_rows($res) > 0) {
			$_SESSION["resultatReq"] = true;
			$trouve=0;
			$nb = $_SESSION["nb"];
			for($i=0; $i<$nb; $i++) {
				if($_SESSION["panier"]["id"][$i] == $t["idouvrage"]) {
					$_SESSION["panier"]["qte"][$i] += $qte;
					$trouve=1;
				}
			}
			if($trouve == 0) {
				$n = $nb;
				$_SESSION["panier"]["id"][$n] = $t["idouvrage"];
				$_SESSION["panier"]["titre"][$n] = $t["titre"];
				$_SESSION["panier"]["prix"][$n] = $t["prix"];
				$_SESSION["panier"]["qte"][$n] = $qte;
				$_SESSION["nb"]++;
			}
		}
		else $_SESSION["resultatReq"] = false;
		//session_destroy();
		header("location:ajouterPanier.php");
	}
	else
		header("location:ajouterPanier.php");
?>