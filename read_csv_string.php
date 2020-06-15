<?php
$str_CSV = '"Apple","RED","#D62433"
"Orange","ORANDE","#FEB635"
"Banana","YELLOW","#FEE492"
"Grapes","VIOLET","#B370AD"
"KIWI","GREEN","#9BA207"
"Dates","BROWN","#922E2F"';

print "<PRE>";
$row = str_getcsv($str_CSV, "\n");
$length = count($row);
for($i=0;$i<$length;$i++) {
	$data = str_getcsv($row[$i], ",");
	echo "INSERT INTO fruits (`fruits_name`, `fruits_color`, `fruits_color_code`) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "');\r\n\n";
}	
?>