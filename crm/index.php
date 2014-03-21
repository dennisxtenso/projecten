<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$tijd = $_POST['tijd'];
	$periode = $_POST['periode'];
	
	//$verticaalbegin = $_POST['verticaalbegin'];
	
	$horizontaal = $_POST['horizontaal'];
	$horizon = count($horizontaal);
	
	$horizontaaleind = $_POST['horizontaaleind'];
	$horizoneind = count($horizontaaleind);
	
	$titels = $_POST['titel'];
	$titel = count($titels);
	
	
	$fases = $_POST['fases'];
	$fase = count($fases);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gantt-diagram</title>
<style>
html
{
 font-family: Arial,"Bitstream Vera Sans",Helvetica,Verdana,sans-serif;	
}
.inputonderdeel
{
	width:200px;
	padding-left:3px;	
}


#grantt_table
{
	width: 800px;
	padding-top:20px;
	padding-bottom:5px;
	padding-right:5px;
	border:1px solid #000;
	box-shadow: 4px 4px 5px #888888;
}
#grantt_table p
{
	text-align:center;
}
table
{
	width: 100%;
}
th, td
{
	width:50px;
}
td
{
	padding-top:5px;
	padding-bottom:5px;
	break-word: word-wrap;
}
.tablelinks
{
	white-space:nowrap;
	text-align:right;
	padding-right:8px;
	font-weight:bold;
}
.vakjein1
{
	background-color:#FFF;
}
.vakjein2
{
	background-color:#e1007a;
}
.vakjein3
{
	background-color:#e85d10;
}

</style>


</head>

<body>
<p>Vul hieronder de gegevens in</p>
<form method="POST" action="http://localhost/projecten/crm/index.php">
	Tijd : <input type="text" style="width:60px; padding-left:3px;" name="tijd" placeholder="Tijd" value="10" /> Periode : <input type="text" style="width:100px; padding-left:3px;" name="periode" value="Weken" /><br /><br />
<!--    
	Verticaal getal : <input type="text" style="width:100px; padding-left:3px;" name="verticaalbegin" placeholder="Verticaalbegin" /><br />
    Horizontaal begin : <input type="text" style="width:100px; padding-left:3px;" name="horizontaal" placeholder="Horizontaal" /><br />
    Horizontaal niet voorbij : <input type="text" style="width:100px; padding-left:3px;" name="horizontaaleind" placeholder="horizontaaleind" /><br /><br />    
-->


	<?php
	//TEKSTBALK TOEVOEGEN EN VERWIJDEREN//
	if(!isset($_GET['toevoegen']))
	{
		$_SESSION['tekst'] = $_SESSION['tekst'];
	}
	else
	{
		($_SESSION['tekst']);
		$_SESSION['tekst'] = $_SESSION['tekst']+1;	
		echo "<p><font color='green'>Er is een tekstbalk toegevoegd</font></p>";
	}
	if(!isset($_GET['verwijderen']))
	{
		$_SESSION['tekst'] = $_SESSION['tekst'];
	}
	else
	{
		($_SESSION['tekst']);
		$_SESSION['tekst'] = $_SESSION['tekst']-1;	
		echo "<p><font color='red'>Er is een tekstbalk verwijderd</font></p>";
	}
	$tekst = $_SESSION['tekst'];
	
	
	$d = 0;
	$e = 0; //dit is voor de checkboxes//
	while($d <= $tekst)
	{
		echo '<input type="text" class="inputonderdeel" name="fases[]" placeholder="Onderdeel?" value="Onderdeel" /> 
				Start : <input type="text" class="inputonderdeel" name="horizontaal[]" placeholder="Start?" value="0" /> 
				Klaar voor week : <input type="text" class="inputonderdeel" name="horizontaaleind[]" placeholder="Klaar voor week?" value="10" /> 
				Titel? <input type="checkbox" name="titel['.$e.']" value="titel"><br />';
	$d++;
	$e++;
	}
	//EINDE TEKSTBALK TOEVOEGEN EN VERWIJDEREN//
	?>

	<a href="http://localhost/projecten/crm/index.php?verwijderen">Tekstveld verwijderen</a><br />
	<a href="http://localhost/projecten/crm/index.php?toevoegen">Tekstveld toevoegen</a><br /><br />
    
<!--
	<input type="text" style="width:200px; padding-left:3px;" name="fases[]" value="Kick-off" /> Horizontaal begin : <input type="text" style="width:100px; padding-left:3px;" name="horizontaal[]" placeholder="Horizontaal" value="0" /> Horizontaal niet voorbij : <input type="text" style="width:100px; padding-left:3px;" name="horizontaaleind[]" placeholder="horizontaaleind" value="2" /><br />
    <input type="text" style="width:200px; padding-left:3px;" name="fases[]" value="Navigation & wireframes" /> Horizontaal begin : <input type="text" style="width:100px; padding-left:3px;" name="horizontaal[]" placeholder="Horizontaal" value="2" /> Horizontaal niet voorbij : <input type="text" style="width:100px; padding-left:3px;" name="horizontaaleind[]" placeholder="horizontaaleind" value="4" /><br />
    <input type="text" style="width:200px; padding-left:3px;" name="fases[]" value="Design concept" /> Horizontaal begin : <input type="text" style="width:100px; padding-left:3px;" name="horizontaal[]" placeholder="Horizontaal" value="3" /> Horizontaal niet voorbij : <input type="text" style="width:100px; padding-left:3px;" name="horizontaaleind[]" placeholder="horizontaaleind" value="6" /><br />
    <input type="text" style="width:200px; padding-left:3px;" name="fases[]" value="Visual design" /> Horizontaal begin : <input type="text" style="width:100px; padding-left:3px;" name="horizontaal[]" placeholder="Horizontaal" value="6" /> Horizontaal niet voorbij : <input type="text" style="width:100px; padding-left:3px;" name="horizontaaleind[]" placeholder="horizontaaleind" value="10" /><br />
    <input type="text" style="width:200px; padding-left:3px;" name="fases[]" value="Delivery" /> Horizontaal begin : <input type="text" style="width:100px; padding-left:3px;" name="horizontaal[]" placeholder="Horizontaal" value="10" /> Horizontaal niet voorbij : <input type="text" style="width:100px; padding-left:3px;" name="horizontaaleind[]" placeholder="horizontaaleind" value="11" /><br /><br />
-->

    <input type="submit" value="Verzenden" />
</form>
<br />
<div id="grantt_table">
    <table rules="cols">
    <?php
    
    $a = 0;
    while($a < $fase)
    {
        echo "<tr>";
            echo "<td class='tablelinks' width='auto'>";
                echo "$fases[$a]";
            echo "</td>";
    
            $c = 0;
            while($c <= $tijd)
            {
                echo "<td ";
                $d = $c;
            //	var_dump($_POST['horizontaal'][$a]);
                if ($c >= $horizontaal[$a])
                {
                    if ($d >= $horizontaaleind[$a])
                    {
                        echo "class='vakjein1'>";
                    }
                    elseif (!empty($titels[$a]) && $d >= $titels[$a])
                    {
                        echo "class='vakjein2'>";
                    }
                    else
                    {
                        echo "class='vakjein3'>";
                    }
                }
                else
                {
                    echo "class='vakjein1'>";
                }
                echo "</td>";
            $c++;
            }
        echo "</tr>";
		
		echo "<tr style='background-color: transparent;'>";
		$f = 0;
		while($f <= $tijd)
		{
			echo "<td style='padding-top:0px; padding-bottom:0px; font-size:8px;'>&nbsp;</td>";
            $f++;
		}
		echo "</tr>";
		
        if ($a == $fase-1)
        {
            echo "<td>";
            echo "</td>";
        }
        $b = 0;
        while($b <= $tijd)
        {
            if ($a == $fase-1)
            {
                echo "<td>";
                    echo "$b";
                echo "</td>";
            }
        $b++;
        }
    $a++;
    }	
    ?>
    </table>
    <p><?php echo "$periode" ?></p>
</div>
<div style="float:right">
    <pre>
		<?php
			print_r ($titels);
        ?>
    </pre>
</div>
</body>
</html>