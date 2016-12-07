<?php
	$conn = mysqli_connect("localhost","1260137","123azerty") or die("Erreur Serveur");
	$bd = mysqli_select_db($conn, "1260137") or die("Erreur BD");
	mysqli_query($conn, "SET NAMES 'UTF8'");

?>