<?php
    $sql = mysql_query("SELECT * FROM image_upload;");
    while ($data = mysql_fetch_assoc($sql)) {
        echo '<option value="'+$data['value']+'">'+$data['name']+'</option>';
    }
?>