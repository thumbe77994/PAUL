<?php require_once('Connections/easyshop.php'); ?>
<?php
mysql_select_db($database_easyshop, $easyshop);
$query_in = "insert into my(m_acc,m_prod) values('".$_SESSION['MM_Username']."','".$_GET['id2']."')";
$in = mysql_query($query_in, $easyshop) or die(mysql_error());
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport"   content="width=device-width, initial-scale=1" charset="utf-8">
<title>無標題文件</title>
</head>

<body>
</body>
</html>
 
 <script language="javascript">
 
alert('加入完畢');
 setTimeout("location.href='prod.php?id=<?php echo $_GET['id']?>'",0);
 
</script>