<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Implementasi Algoritma Kurskal | Minimum Spanning Tree</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <meta http-equiv="Content-Type" content="text/html; charset=koi8-r">
</head>
<body bgcolor="#D8D8D8">
<center><h1 style="color:maroon">Implementasi Algoritma Kruskal</h1></center>
<?php
	//Cek jumlah edge apakah sudah membentuk tree, atau malah ada titik terisolasi
	$j_dot = $_POST["j_dot"];
	$j_edge = 0;
	settype($j_dotconnect,"array");
	for ($i=65;$i<=$j_dot+63;$i++){
		for ($j=$i;$j<=$j_dot+64;$j++){
			$edge = chr($i).chr($j);
			$tmp = $_POST["$edge"];
			if (isset($tmp)){
				$j_edge++;
				if (!in_array(chr($i),$j_dotconnect))
				$j_dotconnect[] = chr($i);
				if (!in_array(chr($j),$j_dotconnect))
				$j_dotconnect[] = chr($j);
			}
		}
	}
	
	if ($j_edge == $j_dot-1 && count($j_dotconnect)==$j_dot){
		die("<h2>Graph Anda sudah membentuk tree looo...</h2>");
	}
	elseif ($j_edge<$j_dot-1 || count($j_dotconnect)<$j_dot){
		die("<h2>Ada isolated point atau graph yang Anda buat tidak terconnect. Mohon ulangi lagi proses...</h2><br><a href=\"index.php\">Kembali ke awal</a>");
	}
?>
Tentukan bobot/nilai masing-masing edge yang telah Anda masukkan (2 digit maksimal)<br>
<form action="superfinalact.php" method=POST>
<?php
	for ($i=65;$i<=$j_dot+63;$i++){
		for ($j=$i+1;$j<=$j_dot+64;$j++){
			$edge = chr($i).chr($j);
			$tmp = $_POST["$edge"];
			if (isset($tmp)){
				print "<input type=text name=\"$edge\" size=5 maxlength=2>$edge<br>\n ";
			}
		}
	}
	print "<input type=hidden name=\"j_dot\" value=$j_dot>";
	print "<input type=hidden name=\"j_edge\" value=$j_edge>";
?>
<input type="submit" value="Bersambung Bos...">
</form>

</body>
</html>
