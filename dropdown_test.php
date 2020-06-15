<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dynamically Generate Select Dropdowns</title>
</head>
<body>
<form>
    <select>
        <option selected="selected">Choose one</option>
        <?php
        // A sample product array
        $products = array("Mobile", "Laptop", "Tablet", "Camera");
        
        // Iterating through the product array
        foreach($products as $item){
        ?>
        <option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>
</body>
</html>

<!--

<html>
    <head>
    </head>
    <body>
        <select id="dropdown">
            <option value="default" selected="selected">Default option</option>
        </select>
        <script type="text/javascript">
            $.ajax({
              url: 'dropdown-choices.php',
              success: function(data) {
                $('#dropdown').append(data);
              }
            });                
        </script>
    </body>
</html>
