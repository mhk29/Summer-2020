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
<title>Neuroglancer Web Integration</title>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
   /* RADIO BUTTON */
   [type=radio] { 
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
   }
   /* IMAGE STYLES */
   [type=radio] + img {
       cursor: pointer;
   }
   /* CHECKED STYLES */
   [type=radio] + img {
       outline: 5px solid #00f;
   } 
</style>
</head>

<body>
<div id="left" style="float:left; width=800px; margin:50px;">
    <iframe id="myframe" src="http://neuroglancer-demo.appspot.com/#!%7B%22dimensions%22:%7B%22x%22:%5B1%2C%22%22%5D%2C%22y%22:%5B1%2C%22%22%5D%2C%22z%22:%5B1%2C%22%22%5D%7D%2C%22position%22:%5B12.660313606262207%2C6.433258533477783%2C7.5%5D%2C%22crossSectionScale%22:0.04978706836786394%2C%22projectionOrientation%22:%5B0.010284251533448696%2C0.007806878071278334%2C-0.3532925546169281%2C0.9354237914085388%5D%2C%22projectionScale%22:32%2C%22layers%22:%5B%7B%22type%22:%22image%22%2C%22source%22:%22nifti://http://127.0.0.1:9000/Users/mattk/Documents/2019-2020/Spring/BME 394/RARE_niftis/B03616.nii%22%2C%22tab%22:%22source%22%2C%22name%22:%22B03616.nii%22%7D%2C%7B%22type%22:%22segmentation%22%2C%22source%22:%7B%22url%22:%22nifti://http://127.0.0.1:9000/Users/mattk/Documents/2019-2020/Spring/BME 394/RARE_niftis/../Rare_masks/B03616_masked.nii%22%2C%22transform%22:%7B%22matrix%22:%5B%5B1%2C0%2C0%2C0%5D%2C%5B0%2C1%2C0%2C0%5D%2C%5B0%2C0%2C1%2C0%5D%5D%2C%22outputDimensions%22:%7B%22x%22:%5B1%2C%22%22%5D%2C%22y%22:%5B1%2C%22%22%5D%2C%22z%22:%5B1%2C%22%22%5D%7D%7D%7D%2C%22tab%22:%22source%22%2C%22name%22:%22B03616_masked.nii%22%7D%5D%2C%22selectedLayer%22:%7B%22layer%22:%22B03616_masked.nii%22%7D%2C%22layout%22:%224panel%22%7D" width="800" height="600" style="border:1px solid lightgrey;"></iframe>
</div>  

<div>
    <button type="button" onclick="location.href='./upload.php'">Upload</button>
    <button type="button" onclick="location.href='./upload_csv.php'">Upload CSV</button>
    <button type="button" onclick="location.href='./display.php'">Show All</button>
</div>

<script>  
  function go(loc){
      document.getElementById('myframe').src = loc;
  }
</script>

<div id="content" style="float:right;">
 <?php
        while ($row = mysqli_fetch_array($result)) {
          $str1 = substr($row['image'],0,strlen($row['image'])-4);
          $str2 = $row['link'];
          $str3 = $row['masklink'];
          echo "<div id='img_div'>";
          echo "<label>";
          echo "<input type=\"radio\" name=\"iframe\" value=\"type\" onclick = \"go('http://neuroglancer-demo.appspot.com/#!%7B%22dimensions%22:%7B%22x%22:%5B1%2C%22%22%5D%2C%22y%22:%5B1%2C%22%22%5D%2C%22z%22:%5B1%2C%22%22%5D%7D%2C%22position%22:%5B12.660313606262207%2C6.433258533477783%2C7.5%5D%2C%22crossSectionScale%22:0.04978706836786394%2C%22projectionOrientation%22:%5B0.010284251533448696%2C0.007806878071278334%2C-0.3532925546169281%2C0.9354237914085388%5D%2C%22projectionScale%22:32%2C%22layers%22:%5B%7B%22type%22:%22image%22%2C%22source%22:%22nifti://http://127.0.0.1:9000/".$str2."%22%2C%22tab%22:%22source%22%2C%22name%22:%22".$str1.".nii%22%7D%2C%7B%22type%22:%22segmentation%22%2C%22source%22:%7B%22url%22:%22nifti://http://127.0.0.1:9000/".$str3."%22%2C%22transform%22:%7B%22matrix%22:%5B%5B1%2C0%2C0%2C0%5D%2C%5B0%2C1%2C0%2C0%5D%2C%5B0%2C0%2C1%2C0%5D%5D%2C%22outputDimensions%22:%7B%22x%22:%5B1%2C%22%22%5D%2C%22y%22:%5B1%2C%22%22%5D%2C%22z%22:%5B1%2C%22%22%5D%7D%7D%7D%2C%22tab%22:%22source%22%2C%22name%22:%22".$str1."_masked.nii%22%7D%5D%2C%22selectedLayer%22:%7B%22layer%22:%22".$str1."_masked.nii%22%7D%2C%22layout%22:%224panel%22%7D')\" />";
          echo "<img src=\"images/".$str1."\"/>";
          echo "</label>";
          echo "<p>".$row['image_text']."</p>";
          echo "<p>".$row['genotype']."</p>";
          echo "</div>";
        }
 ?>
</div>
</body>
</html>
