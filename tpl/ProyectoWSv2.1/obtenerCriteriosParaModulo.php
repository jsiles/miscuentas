<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();

$codmodulo=$_POST["cod_modulo"];
$_SESSION["codModulo"]=	$codmodulo;//captura de codModulo
$idope=$_SESSION["idoperativo"];
$consulta="obtenerCriteriosParaModulo";
$param = array('idOperativo'=>$idope,'codModulo'=>$codmodulo);
$result = $obj->call($consulta,$param);
//echo "<form action='obtenerCriteriosParaModulo.php' method='post'>";
//print_r($result);
foreach($result as $key => $val)
{
	$codcriter=$val['codCriterio'];
	$etiqueta=$val['etiqueta'];
	$crit=$val['criterio'];
	$coderror=$val['codError'];
}
if($codError==15 || $codError==16 || $codError!=0)
{
	$param = array('usuario' => "cajeroweb",
				   'password' => "123abc",
				   'origenTransaccion'=>"APWS");
	
	$result = $obj->call($consulta,$param);
	foreach($result as $key => $val)
	{
		$idope=$val['idOperativo'];
		$coderror=$val['codError'];
		$mens=$val['mensaje'];
	}

	$_SESSION["idoperativo"]=$idope;
}
	
$cont=count($crit);	
if($cont>0)
{
	echo "<select name='criterios' id='criterios' onchange='etiquetas()'>";
	echo "<option value='0' selected='selected'>Buscar por:</option>";
		
for($i=0;$i<=$cont-1;$i++)
{
	$codcriterio=$crit[$i];
	echo "descripcion: ";
	echo "<option value='".$codcriterio['codCriterio']."'>".$codcriterio['descripcion'] ;
	echo "</option>";
}
		
echo "</select>";echo "<br>";
echo "</p>";
}

?>