<?php require_once('Connections/easyshop.php'); ?>
<?php
$colname_pp = "-1";
if (isset($_GET['id'])) {
  $colname_pp = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_pp = sprintf("SELECT * FROM s_product WHERE pro_id = %s", $colname_pp);
$pp = mysql_query($query_pp, $easyshop) or die(mysql_error());
$row_pp = mysql_fetch_assoc($pp);
$totalRows_pp = mysql_num_rows($pp);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport"   content="width=device-width, initial-scale=1" charset="utf-8">>
<title>無標題文件</title>
</head>

<body>
<?php  
header("Location: maps.php?id=".$row_pp['s_addtype']);
 ?>


</body>
</html>
<?php
mysql_free_result($pp);
?>
