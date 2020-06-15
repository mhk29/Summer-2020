<?php 


$myspec = $_GET['gender']; // $id is now defined


    $file = "mycsv.csv";
    $f = fopen($file, "r");
    $i = 0;

    $file2 = str_replace(".csv", "_new.csv", $file);
    $f2 = fopen($file2,"a");

    while(! feof($f)) { 
        $record = fgetcsv($f, 1000, ",");
        if ($record[4] == $myspec) {
            foreach($record as $field) {
                echo $field . ",";
                fputcsv($f2,$record);
            }
            echo "<br>";
        }
        $i = $i + 1;
    }

    fwrite($f2,fread($f, filesize($file)));

    fclose($f);
    fclose($f2);

?>
