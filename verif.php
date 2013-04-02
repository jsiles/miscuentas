<?php

require ("clases/common.php");
$id=$_POST["id_facebook"];
$db->query("select * from tb_clientes where cli_idfacebook='$id'");
$nrf=$db->affected_rows();
if($nrf>0)
{
	echo "OK";
	return "OK";
}
else
{
	echo "NO";
	return "NO";
}
?>