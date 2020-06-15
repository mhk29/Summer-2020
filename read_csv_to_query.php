<?php

  // Create database connection
$db = mysqli_connect("localhost", "root", "", "image_upload");
if(!$db)
die("no db");
if(!mysqli_select_db($db,"image_upload"))
die("No database selected.");



$CSVfp = fopen("fruits.csv", "r");
if($CSVfp !== FALSE) {
print "<PRE>";
while(! feof($CSVfp)) {
	$data = fgetcsv($CSVfp, 1000, ",");
	echo "INSERT INTO images (`id`, `name`, `link`) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "');\r\n\n";
}
}
fclose($CSVfp);
/*
if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)) 
{
$handle = fopen("$uploadfile", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
{
$import="INSERT into images(id,image,image_text,link) values('$data[0]','$data[1]','$data[2]','$data[3]')";
mysqli_query($db,$import) or die(mysql_error());
}
fclose($handle);
print "Import done";
}
*/

?>