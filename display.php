<html>
<body>
<?php 
$mysqli = new mysqli("localhost", "root", "", "image_upload"); 
$query = "SELECT * FROM images";
 echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">ID</font> </td> 
          <td> <font face="Arial">Image Name</font> </td> 
          <td> <font face="Arial">Image Text</font> </td> 
      </tr>';
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["id"];
        $field2name = $row["image"];
        $field3name = $row["image_text"];
        $field4name = $row["link"];
        $field5name = $row["masklink"];
 
        echo '<tr> 
                 <td>'.$field1name.'</td> 
                 <td>'.$field2name.'</td> 
                 <td>'.$field3name.'</td> 
                 <td>'.$field4name.'</td> 
                 <td>'.$field5name.'</td> 
                 <td><a href="./remove.php?name='.$field1name.'" class="button">remove</a></td>
              </tr>';
    }
    $result->free();
} 
?>
<div>
<form method="GET" action="./index.php">
<input type="submit" value="go back">
</form>
</div>
</body>
</html>

<!-- 

                    <td><button type="button" onClick="go(\'./remove.php?name='.$row['image'].'\')">remove</button></td>

<td><a href="./remove.php?name='.$field2name.'">go back</a></td>
  <button type="submit" name="goback" onClick="go('./index.php')">go back</button>

                 <td><button type="button" onClick="go(\'./remove.php?name='.$field2name.'\')">remove</button></td>
  <a href="./index.php" class="button">go back</a> 
