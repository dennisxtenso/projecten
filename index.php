<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tabel</title>
</head>

<body>
Vul hieronder je getal in
<form method="POST" action="http://localhost/crm/index.php" name="test">
<input type="text" name="getal" placeholder="Vul hier getal in" />
<input type="text" name="tijd" placeholder="Vul hier de tijd in" />
<input type="submit" value="Verzenden" />
</form>
<table border="4" rowspan"10">
	<?php
    $getal = $_POST['getal'];
    $a = 1;
	
	$tijd = $_POST['tijd'];

    while($a <= $getal)
        {			
			echo "<tr>";
			
				echo "<td>";
					echo "fase $a";
				echo "</td>";

			$b = 1;
			while($b <= $tijd)
				{
					echo "<td>$a "."$b</td>";
					$b++;
				} 

			echo "</tr>";
			$a++;
        }
	?>
    </table>
</body>
</html>