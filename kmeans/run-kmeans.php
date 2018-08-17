<?php

// include the library
require_once "src/KMeans/Space.php";
require_once "src/KMeans/Point.php";
require_once "src/KMeans/Cluster.php";
ini_set('memory_limit', '20000M');

$myfile = fopen("dataset1.txt", "r") or die("Unable to open file dataset1.txt!"  );
// Output one line until end-of-file
$line = fgets($myfile) . "<br>";
$comp = preg_split('/ +/', $line); 
$nfiles = $comp[0];
$nattr = $comp[1];
$k = $comp[2];
$iter_max = $comp[3];
$has_name = $comp[4];
$points = [];

while(!feof($myfile)) {
  $line = fgets($myfile);
  $comp = preg_split('/ +/', $line); 
//  echo $comp[0] . " ";
//  echo $comp[1] . "<br>";
  $points[] = [(float)$comp[0], (float)$comp[1]];
}
fclose($myfile);

echo "Initialize points...<br>";

for ($i=0; $i < $nfiles; $i++) {
	for ($j=0; $j < $nattr ; $j++){
		echo $points[$i][$j] . " ";	
	}
	echo "<br>";
}

echo "\nDone.";
echo "\nCreating Space...\n";


// create a nattr-dimentions space
$space = new KMeans\Space($nattr);

// add points to space
foreach ($points as $coordinates) {
	$space->addPoint($coordinates);
	//printf("\r%.2f%%", ($i / $n) * 100);
}


echo "done.\n";
echo "Determining clusters";

$clusters = $space->solve($k, KMeans\Space::SEED_DEFAULT, function () {
	echo ".";
});

echo "\n\n";

// display the cluster centers and attached points
foreach ($clusters as $i => $cluster)
	printf("<br>Cluster %s [%d,%d]: %d points\n", $i, $cluster[0], $cluster[1], count($cluster));
