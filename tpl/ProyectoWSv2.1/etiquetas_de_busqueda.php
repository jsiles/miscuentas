<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();

$var=$_REQUEST["cod_etiqueta"];
	
$consulta="obtenerCriteriosParaModulo";
$param = array('idOperativo'=>$_SESSION["idoperativo"],
				'codModulo'=>$_SESSION["codModulo"]);
$result = $obj->call($consulta,$param);
		
$cont=count($var);
for($i=0;$i<=$cont-1;$i++)
{
	$etiqueta=$var[$i];
}

foreach($result as $key => $val)
{
	$codError=$val['codError'];
	$mens=$val['mensaje'];
	$crit=$val['criterio'];
}
$cont=count($crit);
	
if($codError==15 || $codError==16 || $codError!=0)
{
	$user="cajerweb";
	$password="123abc";
	$origen="APWS";
	$consulta="iniciarSesion";
	$param = array(
			'usuario' => $user,
			'password' => $password,
			'origenTransaccion'=>$origen);

	$result = $obj->call($consulta,$param);
	foreach($result as $key => $val)
	{
		$idope=$val['idOperativo'];
		$coderror=$val['codError'];
		$mens=$val['mensaje'];
	}
	
	$_SESSION["idoperativo"]=$idope;
}
		

echo "<p align='center' class='normal_tr1'>";
			
for($i=0;$i<=$cont-1;$i++)
{
	$x=$crit[$i]; 
	if($var==$x['codCriterio'])
	{
		$_SESSION["criterio"]=$var;
		$y=$x['etiqueta'];
		$conty=count($y)-1;
		$_SESSION["nroetiquetas"]=$conty;
		for($j=0;$j<$conty;$j++)
		{
			echo "</p>";
			echo "<p>";
			echo "<span >"."<strong>".$y['etiqueta']."
				</strong>";
			echo "</span>";
			echo "</p>";
			$nombretxt="txt".$j;
			$_SESSION["nro_de_etiquetas"]=$j;
			//echo "<input type='text' id='".$nombretxt."'/>";
			echo "<input type='text' id='".$nombretxt."'/>";
			echo "<p align='center'>";
			echo "<label class='lA'>&nbsp;</label>";
			/*echo "<input type='button' name='".$nombretxt."' id='".$nombretxt."' value='Buscar' onclick='buscar_cliente(\"".$nombretxt."\")' />";*/
			echo "<input type='button' name='".$nombretxt."' id='".$nombretxt."' value='Buscar' onclick='buscar_cliente(\"".$conty."\")' />";
			echo "</p>";
			echo "<br>";
		}
	}
}

		
?>