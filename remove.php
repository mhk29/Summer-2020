<?php
$db=mysqli_connect("localhost","root","","image_upload");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$image = $_GET['name']; // $id is now defined

// or assuming your column is indeed an int
// $id = (int)$_GET['id'];

mysqli_query($db,"DELETE FROM images WHERE id='".$image."'");
mysqli_close($db);
header("Location:display.php");
?> 

