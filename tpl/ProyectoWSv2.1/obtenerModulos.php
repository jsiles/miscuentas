<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();
	
$idope=$_SESSION["idoperativo"];
$consulta="obtenerModulos";
$param = array('idOperativo'=>$idope);
$result = $obj->call($consulta,$param);
$CON=count($result);

if(!$result)
{
	echo "<span style='color:white'>";
	echo "no se encontro resultados";
	echo "</span>";
}
else
{
	foreach($result as $key => $val)
	{
		$modulos=$val['modulo'];
		$codError=$val['codError'];
		$mens=$val['mensaje'];
	}
	
	if($codError==15 || $codError==16 || $codError!=0)
	{
		$param = array(	'usuario' => "cajeroweb",
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
	else
	{	
		$cont=count($modulos);
		echo "<body class='normal2'>";
		echo "<p align='center' class='normal_tr1'>";
		echo "MODULOS"."<br>";
		echo "</p>";
		echo "<form action='obtenerCriteriosParaModulo.php' method='post'>";
		echo "<table border='1'>";
		echo "<font size='2'>";
		
		for($i=0;$i<=$cont-1;$i++)
		{
			$mod=$modulos[$i];
			$namesubmit=$i+1;
			echo "<tr>";
			echo "<th>";
			echo "<input type='submit' name='codmod' value=".$namesubmit." height='8'/>";
			echo "</th>";
			echo "<input type='hidden' name='".$namesubmit."' value='".$mod['codModulo']."' />";
			echo "<th>";
			echo "<p align='justify'>".$mod['descripcion']."</p>";
			echo "</th>	";
			echo "</tr>";
		}
		
		echo "</font>";			
		echo "</table>";
		echo "</body>";
	}
}
?>