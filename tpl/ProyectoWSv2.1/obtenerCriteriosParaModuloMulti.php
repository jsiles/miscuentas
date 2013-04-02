<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();

if(isSet($_REQUEST["ok"]))
{
	$consulta="obtenerCriteriosParaModulo";
	$param = array('idOperativo'=>$_SESSION["idoperativo"],
					'codModulo'=>$_SESSION["codModulo"]);
	$result = $obj->call($consulta,$param);
	
	$var=$_REQUEST["criterios"];//codigo de criterio
	//echo "cod=".$var;
	$cont=count($var);
	echo "->".$cont;//    <---------------------------------------

	foreach($result as $key => $val)
	{
		$codError=$val['codError'];
		$mens=$val['mensaje'];
		$crit=$val['criterio'];
	}
	$cont=count($crit);
	
//	echo "=>".$cont;
	if($codError==15 || $codError==16 || $codError!=0)
	{
		echo "<body class='normal2'>";
		echo "<form action='iniciaSesion.php'>";
		echo "<span style='color:white'>";
		echo $mens;
		echo "</span>";
		echo "<p align='center'>";
		echo "<a href='iniciaSesion.php'>"."<input type='button' name='iniciar' value='INICIAR SESION' />"."</a>";
		echo "</p>";
		echo "</form>";
		echo "</body>";
	}
	else
	{
		echo "<body class='normal2'>";
		echo "<form action='buscarCliente.php' method='post'>";
		echo "<p align='center' class='normal_tr1'>"."INTRODUCIR DATOS".$cont;					echo "</p>";
		echo "<p>";
		
		for($i=0;$i<=$cont-1;$i++)
		{
			$x=$crit['etiqueta'];
			
//			echo $i.count($x);
		//	for($j=0;$j<count($x);$j++)
			//{
				$y=$x[$i];	
				echo "<span style=color:white>"."<strong>".$y['etiqueta']."</strong>";
				echo "</span>";
				echo "</p>";
				$nombretxt="txt".$i;
				echo "<input type='text' name='".$nombretxt."' value=".$nombretxt." />";
				echo "<br>";
			//}
			//if($var==$x['codCriterio'])
			//{
				$_SESSION["criterio"]=$var;

				$y=$x['etiqueta'];
				$conty=count($y)-1;
				$_SESSION["nroetiquetas"]=$conty;
				
			//}
		}
		echo "<p>";
		echo "<input type='submit' name='mostrar' value='MOSTRAR'/>";
		echo "</p>";
		echo "<p align='center'>";
		echo "<a href='obtenerModulos.php'>"."<input type='button'  value='COMENSAR DE NUEVO' />"."</a>";
		echo "</p>";
		echo "</form>";
		echo "</body>";
	}
} 
else
{
	$codmo=$_REQUEST['codmod'];
	$codmodulo=$_REQUEST["$codmo"];
	$_SESSION["codModulo"]=	$codmodulo;//captura de codModulo
	$idope=$_SESSION["idoperativo"];
	$consulta="obtenerCriteriosParaModulo";
	$param = array('idOperativo'=>$idope,
					'codModulo'=>$codmodulo);
	$result = $obj->call($consulta,$param);
	echo "<body class='normal2'>";
	echo "<p align='center' class='normal_tr1'>";
	echo "CRITERIO DE BUSQUEDA";
	echo "</p>";
	echo "<form action='obtenerCriteriosParaModuloMulti.php' method='post'>";
	foreach($result as $key => $val)
	{
		$codcriter=$val['codCriterio'];
		$etiqueta=$val['etiqueta'];
		$crit=$val['criterio'];
	}
	$cont=count($result['criterio']);echo "cont result: ".$cont."<br>";
	$cont2=count($crit);echo "cont crit: ".$cont2."<br>";
	//echo print_r($crit)."<br>";// 1 para Multivision
			echo print_r($crit['descripcion'])."----------"."<br>";

	echo "<select name='criterios'>";
	echo "<option value='' selected='selected'>Buscar por:</option>";
	for($i=0;$i<=$cont;$i++)
	{
		//$codcriterio=$crit[$i];
		//echo "descripcion: ";
		echo "<option value='".$crit['codCriterio']."'>".$crit['descripcion']."-".$crit['codCriterio'];
		echo "</option>";
	}
	echo "</select>";echo "<br>";
	echo "<input type='submit' name='ok' value='OK'/>";
	
	echo "<p align='center'>";
	echo "<a href='obtenerModulos.php'>"."<input type='button'  value='<<<' />"."</a>";
	echo "</p>";
	echo "</form>";
	echo "</body>";
}
?>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />