<?php
define ('login', TRUE);
include 'mysql_login.php';
?>


<html>
<head>
<title>Grocery Prices</title>
<link rel='stylesheet' href='style.css' id='styler'>
</head>
<body>
<div class="container">
<div id="nocustom">
<header id="myHeader"></header>
<nav id="navBar">



</nav>
<article>

<h1>Grocery Prices</h1>

<p align="center">These prices are from a discount store in Ottawa, KS.</p>

<?php
//Step2
$query = "SELECT * FROM `grocery_prices` ORDER BY `date` ASC";
mysqli_query($db, $query) or die('Error querying list.');
$result = mysqli_query($db, $query);

echo "<p align='center'><table width='70%'><tr><th width='10%'>Date</th><th width='10%'>Beef</th><th width='10%'>Bread</th><th width='10%'>Eggs</th><th width='10%'>Milk</th><th width='10%'>Detergent</th><th width='10%'>T.P.</th><th width='10%'>P.T.</th><th width='10%'>Alum. Foil</th><th width='10%'>Soda</th></tr>";
echo "<tr>";

$food = array(0,0,0,0,0,0,0,0,0);
$foodflag = array(0,0,0,0,0,0,0,0,0);
$fooddif = array(0,0,0,0,0,0,0,0,0);
$foodnames = array('beef','bread','eggs','milk','detergent','tp','pt','alumfoil','soda');

//From http://php.net/manual/en/function.gmp-sign.php
function sign( $number ) { 
    return ( $number > 0 ) ? 1 : ( ( $number < 0 ) ? -1 : 0 ); 
}
function percent($number){
    return $number * 100 . '%';
}
while ($row = mysqli_fetch_array($result))
{
	echo "<td>".$row['date']."</td>";
	for ($a = 0; $a <= 8; $a++)
	{
		$foodflag[$a] = sign($row[$foodnames[$a]] - $food[$a]);
		if ($food[$a] == 0) 
			{
				$foodflag[$a] = 0;
				$fooddif[$a] = $row[$foodnames[$a]] - $food[$a];
			}
		echo "<td ";
		if ($foodflag[$a] == -1) { echo " style='background: linear-gradient(green, lime); color:black'>".$row[$foodnames[$a]];  }
		else if ($foodflag[$a] == 0) { echo ">".$row[$foodnames[$a]];  }
		else if ($foodflag[$a] == 1) { echo " style='background: linear-gradient(maroon, red); color:white'>".$row[$foodnames[$a]];  }
		echo "</td>";
		$food[$a] = $row[$foodnames[$a]];
		
	}
	echo "</tr>";

}

echo "</table>";


?>

<p align="center"><h1>Specific Foods Cited</h1></p>
<p align="center">
	<table>
		<tr>
			<th>Item</th>
			<th>Description</th>
		</tr>
		<tr>
			<td>Beef</td>
			<td>2.25 lbs package of 80% lean hamburger, per pound</td>
		</tr>
		<tr>
			<td>Bread</td>
			<td>Store Brand wheat bread</td>
		</tr>
		<tr>
			<td>Eggs</td>
			<td>1 dozen Store Brand eggs</td>
		</tr>
		<tr>
			<td>Milk</td>
			<td>1 gallon of Store Brand 2% milk</td>
		</tr>
		<tr>
			<td>Detergent</td>
			<td>Package of 12 Tide Pods</td>
		</tr>
		<tr>
			<td>Toilet Paper</td>
			<td>Package of Angel Soft 9 2-ply rolls</td>
		</tr>
		<tr>
			<td>Paper Towels</td>
			<td>Package of Bounty 6 giant rolls</td>
		</tr>
		<tr>
			<td>Aluminum Foil</td>
			<td>37.5 square feet roll of Store Brand extra wide foil</td>
		</tr>
		<tr>
			<td>Soda</td>
			<td>20oz bottle of Pepsi</td>
		</tr>
	</table>


		


</article>
<footer id="myFooter"></footer>
<script src="elements.js"></script>
</div>
</div>
</body>
</html>

