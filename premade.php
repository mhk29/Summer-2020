<?php

$CSVfp = fopen("fruits.csv", "r");
if($CSVfp !== FALSE) {
print "<PRE>";
$existing = array('0','1','2');

while(! feof($CSVfp)) {	
	$data = fgetcsv($CSVfp, 1000, ",");
	if (! in_array($data[2],$existing)) {
		array_push($existing,$data[2]);
		echo $data[2];
		echo "<a href=\"http://localhost/phppractice/more_read_csv.php?genotype=".$data[2]."\"\n";
	}
}
}
fclose($CSVfp);



?>