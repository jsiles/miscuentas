<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();
/*echo "idope: ".$_SESSION["idoperativo"]."cod Modulo: ".$_SESSION["codModulo"]."Nro Operacion: ".$_SESSION["nrooperacion"]."<br>";
echo "fecha operativa: ".$_SESSION["fechaoperativa"]."Cuenta: ".$_SESSION["cuenta"]."servicio: ".$_SESSION["servicio"]."Nro Item:".$_SESSION["nroitem"];*/
echo "<body class='normal2'>";
echo "<p align='center' class='normal_tr1'>";
		echo "<br>";
		echo "DETALLE DE ITEM";
echo "</p>";
echo "<span style='color:white'>";
$param = array('idOperativo'=>$_SESSION["idoperativo"],
				'codModulo'=>$_SESSION["codModulo"],
				'nroOperacion'=>$_SESSION["nrooperacion"],
				'fechaOperativa'=>$_SESSION["fechaoperativa"],
				'cuenta'=>$_SESSION["cuenta"],
				'servicio'=>$service);
echo "<br>";
$consulta="buscarItemsDeCuenta";				
$result = $obj->call($consulta,$param);

foreach($result as $key => $val)
{
	$codError=$val['codError'];
	$mensaje=$val['mensaje'];
	$cambianit=$val['cambiaNitYNombreFac'];
	$item=$val['item'];//[]
	$nitfac=$val['nitFac'];
	$nombrefac=$val['nombreFac'];
	$tienerequisito=$val['tieneRequisito'];
}
echo "</span>";
echo "</body>";
?>