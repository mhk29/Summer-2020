<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "image_upload");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {

    $products = array("Text1", "Two", "3hree", "4");

    // Number each image
    $id = random_int(0,65535);
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);


     // Iterating through the product array
    foreach($products as $item){
      echo "<option value=\"".strtolower($item)."\"><".$item."></option>";
      }

  	$sql = "INSERT INTO images (id, image, image_text) VALUES ('$id','$image', '$image_text')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

    shell_exec("matlab -nosplash -nodesktop -r \"getmidslice('".$image."'); quit();\"");

  }
  $result = mysqli_query($db, "SELECT * FROM images");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Photo</title>
</head>
<body>
    <form method="POST" action="index.php" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000">
    <div>
      <input type="file" name="image">
    </div>
    <div>
      <textarea 
        id="text" 
        cols="40" 
        rows="4" 
        name="image_text" 
        placeholder="Say something about this image..."></textarea>
    </div>
    <div>
        <select>
          <option selected="selected">Choose one</option>
<?php 
    $products = array("Yes", "Ni", "3hree", "4");
             // Iterating through the product array
    foreach($products as $item){
      echo "<option value=\"".strtolower($item)."\"><".$item."></option>";
      }

?>

        </select>
    </div>
    <div>
      <button type="submit" name="upload">POST</button>
    </div>
  </form>
</body>
</html>