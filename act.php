<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Implementasi Algoritma Kruskal | Minimum Spanning Tree</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <meta http-equiv="Content-Type" content="text/html; charset=koi8-r">
</head>
<body bgcolor="#D8D8D8">
<center><h1 style="color:maroon">Implementasi Algoritma Kruskal</h1></center>
<form action="finalact.php" method=POST>
Check apabila edge berikut terhubung<br>
<?php
	$j_dot = $_POST["j_dot"];
	for ($i=65;$i<=$j_dot+63;$i++){
		for ($j=$i+1;$j<=$j_dot+64;$j++){
			$edge = chr($i).chr($j);
			print "<input type=checkbox name=\"$edge\">$edge <br>";
		}
		print "<br>";
	}
	print "<input type=hidden name=\"j_dot\" value=$j_dot>";
?>

<input type=submit value="Hajar bleh!">
</form>

</body>
</html>
