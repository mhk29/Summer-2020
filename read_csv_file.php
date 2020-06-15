<HTML>
<HEAD>
<STYLE>
table{
width:500px;
border: #CCCCCC 1px solid;
background-color: #555555;
color:#FFFFFF;
font-family: "Century Gothic",CenturyGothic,AppleGothic,sans-serif;
}
td{
padding: 5px;
}
tr.data {
background-color: #FAFFFF;
color:#000000;
}
div {
color:#FAFAFA;
font-size:12px;
width:60px;
letter-spacing:1px;
padding:2px;
text-align: center
}
</STYLE>
</HEAD>
<BODY>
<?php
$CSVfp = fopen("fruits.csv", "r");
if($CSVfp !== FALSE) {
?>
<table cellspacing="1">
<tr>
<td align="center">NAME</td>
<td align="center">COLOR</td>
</tr>
<?php	
while(! feof($CSVfp)) {
	$data = fgetcsv($CSVfp, 1000, ",");
?>
<tr class="data">
<td align="center"><?php echo $data[0]; ?></td>
<td align="center"><div style="background-color:<?php echo $data[2]; ?>"><?php echo $data[1]; ?></div></td>
</tr>
<?php
}
?>
</table>
<?php	
}
fclose($CSVfp);
?>
</BODY>
</HTML>