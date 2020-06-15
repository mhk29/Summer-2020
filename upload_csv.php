<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "image_upload");

if(!$db)

die("no db");

if(!mysqli_select_db($db,"image_upload"))

die("No database selected.");


if(isset($_POST['submit']))
{
$uploaddir = './csvup';
$uploadfile = $uploaddir . basename($_FILES["file"]["name"]);
echo $uploadfile;

$CSVfp = fopen("fruits.csv", "r");
if($CSVfp !== FALSE) {
print "<PRE>";
while(! feof($CSVfp)) {
	$data = fgetcsv($CSVfp, 1000, ",");
	echo "INSERT INTO images (`id`, `name`, `link`) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "');\r\n\n";
}
}
fclose($CSVfp);


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

}
else
{
print "<form action='read_csv_to_query.php' method='post' enctype='multipart/form-data'>";
print "Choose file to import:<br><br>";
print "<input type='file' name='file' id='file'><br><br>";
print "<input type='submit' name='submit' value='extract'></form>";
}
?>
