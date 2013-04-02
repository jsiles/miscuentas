<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();

$consulta="iniciarSesion";
$param = array(
		'usuario' => "cajeroweb",
		'password' => "123abc",
		'origenTransaccion'=>"APWS");
		
$result = $obj->call($consulta,$param);
print_r($result);
foreach($result as $key => $val)
{
	$idope=$val['idOperativo'];
	$coderror=$val['codError'];
	$mens=$val['mensaje'];
}

$_SESSION["idoperativo"]=$idope;
echo "OK";
return "OK";
?>
