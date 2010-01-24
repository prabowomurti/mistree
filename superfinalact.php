<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title>Implementasi Algoritma Kruskal | Minimum Spanning Tree</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <meta http-equiv="Content-Type" content="text/html; charset=koi8-r">
</head>
<body bgcolor="#D8D8D8">
<center><h1 style="color:maroon">Implementasi Algoritma Kruskal</h1></center>
<?php
	//waktu eksekusi
	$timestart = microtime();
	$j_dot = $_POST["j_dot"];
	$j_edge = $_POST["j_edge"];
	$opcount = 18;//yg pasti

	//erorr handler: jika ada yang salah memasukkan
	$count = 0;
	for ($i=65;$i<=$j_dot+63;$i++){
		for ($j=$i+1;$j<=$j_dot+64;$j++){
			$sisi = chr($i).chr($j);
			$$sisi = $_POST["$sisi"];
			if ((!empty($$sisi)) and (intval($$sisi)!==0) and (intval($$sisi)>0)){
				$count++;
				$opcount++;
			}
			$opcount +=2;
		}
	}

	if ("$count" !== "$j_edge"){
		die("Maaf, ada titik yang belum diberi bobot, bernilai 0 (nol), bernilai negatif atau bukan angka. Mohon ulangi.");
	}

	function createmasuk($x,$y){
		global $masuk,$sisa,$opcount;
		$masuk[$x] = "$x"."$y";
		$sisa = str_replace("$x","",$sisa);
		$sisa = str_replace("$y","",$sisa);
		$opcount += 3;
	}

	function gabungmasuk($x,$y){
		global $masuk,$sisa,$opcount;
		foreach ($masuk as $kunci=>$nilai){
			if (ereg("$y",$masuk[$kunci])){
				if ($x<$kunci){
					$masuk[$x] = "$x"."$nilai";
					unset($masuk[$kunci]);
					$sisa = str_replace("$x","",$sisa);
					break ;
				}else {
					$masuk[$kunci] = "$x"."$nilai";
					$sisa = str_replace("$x","",$sisa);
					break ;
				}
				$opcount +=4;
			}
			$opcount++;
		}
		return FALSE;
	}

	//Ini yang penting dan dapat mengubah hidupmu
	function caridimasuk($x,$y){
		global $sisa,$masuk,$opcount;
		foreach ($masuk as $kunci=>$nilai){
			$opcount++;
			if (ereg("$x",$nilai) and (ereg("$y",$nilai))){
				$opcount++;
				return TRUE;
			}elseif (ereg("$x",$nilai) xor (ereg("$y",$nilai))){
				$opcount++;
				if (ereg("$x",$nilai)){
					foreach ($masuk as $konci => $value){
						if (ereg("$y",$masuk[$konci])){
							$nkey = min("$kunci","$konci");
							$masuk[$nkey] = "$nilai"."$value";
							if ($nkey==$kunci){
								unset($masuk[$konci]);
							}else {
								unset($masuk[$kunci]);
							}
							$opcount+=3;
							break ;
						}
						$opcount++;
					}
					return FALSE;
				}else{
					foreach ($masuk as $konci => $value){
						if (ereg("$x",$masuk[$konci])){
							$nkey = min("$kunci","$konci");
							$masuk[$nkey] = "$nilai"."$value";
							if ($nkey==$kunci){
								unset($masuk[$konci]);
							}else {
								unset($masuk[$kunci]);
							}
							$opcount+=3;
							break ;
						}
						$opcount++;
					}
					return FALSE;
				}
			}
		}
	}
	
	function cekcycle($x,$y){
		global $sisa,$masuk,$opcount;
		if (ereg($x,$sisa) and ereg($y,$sisa)){
			$opcount++;
			return createmasuk($x,$y);
		}elseif (ereg($x,$sisa) xor ereg($y,$sisa)){
			$opcount+=3;
			if (ereg("$x",$sisa)){
				return gabungmasuk($x,$y);
			}else {
				return gabungmasuk($y,$x);
			}
		}else {
			$opcount++;
			return caridimasuk($x,$y);
		}
	}

	//*********** MAIN ***********
	settype($masuk,"array");
	$sisa = "";
	$batas = 0;
	for ($index=1;$index<=$j_dot;$index++)
		$sisa .= chr($index+64);
	$opcount += $j_dot;
	for ($i=65;$i<=$j_dot+63;$i++){
		for ($j=$i+1;$j<=$j_dot+64;$j++){
			$edge = chr($i).chr($j);//edge isinya AB,CF,GH dst
			$$edge = intval($_POST["$edge"]);//$edge atau AB,CF,GH isinya bobotnya
			$opcount+=2;
			if ((!empty($$edge))){
				$bobotedge["$edge"] = $$edge;//simpan bobotnya
				$batas++;
				$opcount+=2;
				if ($batas >= $j_edge){
					$opcount++;
					break 2;
				}
			}
		}
	}

	//urutkan bobotedge
	asort($bobotedge);// ADA SORTING DI SINI
	$batas = 0;
	$total = 0;

	foreach ($bobotedge as $konci => $mark){//$konci -nya adalah AB,AC,FH dst //mark -nya adalah bobotnya
		$l = substr($konci,0,1);
		$m = substr($konci,1);
		$opcount+=3;
		if (cekcycle($l,$m)){
			$opcount++;
			continue;//jika dijumpai cycle
		}else{
			$opcount+=3;
			$total += $mark;
			$connect[] = "$konci";
		$batas++;
		if ($batas >= $j_dot-1){
 			$opcount++;
			break ;
		}
		}
	}

	//tampilkan MST (edge yg memenuhi)
	print "Minimum Spanning Tree dari graph yang Anda masukkan adalah<br>";
	asort($connect);// SORTING DI SINI
	foreach ($connect as $kanci => $point){
		print "$point : $bobotedge[$point] <br> ";
		$opcount++;
	}
	print "dengan total bobot/nilai = $total<br><br>";
	$timestop = microtime();
	$timeop = $timestop - $timestart;
	print "<div style=\"font-size:12px\">executiontime = $timeop &#181;s<br>";
	print "operation_counter = $opcount</div>";
?>
<br>
<h1><a href="index.php">Lagi Dong Maass....</a>&#160;</h1>
</body>
</html>
