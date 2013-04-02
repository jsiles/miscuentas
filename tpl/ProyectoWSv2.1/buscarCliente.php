<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();

$idoperativ=$_SESSION["idoperativo"];
$codmodulo=$_SESSION["codModulo"];
$criterio=$_SESSION["criterio"];
$consulta="buscarCliente";

$numetiquetas=$_SESSION["nroetiquetas"];
$val_etiquetas=$_POST["valores_estiquetas"];
//echo "val_etiquetas ".$val_etiquetas."<br>";
//========ARMADO DE CODIGO==============
$i=0;
$dato_vacio=0;
for($i=0;$i<=$numetiquetas-1;$i++)
{
	$tamaño_cadena=strlen($val_etiquetas);
	$rest=substr($val_etiquetas,0,$tamaño_cadena-1);
	if(!$rest)
	{
		$dato_vacio=1;

	}
	$codigo[$i]=$rest;
	$rest=substr($val_etiquetas,2);
	$val_etiquetas=$rest;
}

if($dato_vacio==0)
{
	$param = array('idOperativo'=>$_SESSION["idoperativo"],
				'codModulo'=>$_SESSION["codModulo"],
				'codCriterio'=>$_SESSION["criterio"],
				'codigo'=>$codigo);
	$result = $obj->call($consulta,$param);
	
	//print_r($result);
	foreach($result as $key => $val)
	{
		$codError=$val['codError'];
		$mensaje=$val['mensaje'];
		$fechaOperativa=$val['fechaOperativa'];
		$nroOperacion=$val['nroOperacion'];
		$cuenta=$val['cuenta'];
	}
 	
	if($codError!=15 || $codError!=16 || $codError!=0)
	{
		echo $mensaje;
	}
	
	$contresult=count($result);
	$cont=count($cuenta['cuenta']);	
	echo "<p align='center'>";
	echo "</p>";
		
	echo "<div class='rowA'>";
		echo "<div class='rWC'><span class='bold2'>Cuenta</span></div>";
		echo "<div class='rWC'><span class='bold2'>nombre</span></div>";
		echo "<div class='rWC'><span class='bold2'>servicio</span></div>";			
	echo "</div>";
		
	if($cont==1)
	{
		echo "<p>";
	
		//echo "CUENTA: ".$cuenta['cuenta']."<br>";	//
			
		echo "<div class='clear'></div>";
		echo "<div class='rowA'>";
		echo "<div class='rWC'>".$cuenta['cuenta'];
		echo "</div>";					
		/*echo "DESCRIPCION DE SERVICIO: ".$cuenta['descServicio']."<br>";	
		echo "DETALLE: ".$cuenta['detalle']."<br>";
		echo "MONEDA: ".$cuenta['moneda']." ".$cuenta['nombre']."<br>";*/
		echo "<div class='rWC'>".$cuenta['nombre']."</div>";
		echo "<div class='rWC'>".$cuenta['descServicio']."</div>";
		$servicio=$cuenta['servicio'];
		$descripcion=$cuenta['descServicio'];
echo "<div class='rWS' onclick='buscar_items_de_cuenta(".$servicio.",\"".$descripcion."\")'><img src='../lib/save_en.gif'/></div>";
		echo "</div>";
		echo "<div class='clear'></div> ";
		
		/*echo "<input type='submit' name='rservicio' value='".$cuenta['servicio']."' />"."<br>";	*/
		/*echo "SERVICIO: "; \"".$nombretxt."\"
			
		//echo "<input type='submit' name='rservicio' value='guardar' />"."</td>";
			/*echo "<br>";
		echo "<br>";
		echo "fecha: ".$fechaOperativa;
		echo "<br>";
		echo "Nro Operacion ".$nroOperacion;
		echo "</p>";*/
		$_SESSION["cuentacli"]=$cuenta['cuenta'];
		}
	if($cont==0)
	{		
		$cont=count($cuenta);	
		$cuentac=$cuenta[0];
		$x=$cuenta[0];
		$y=$x['cuenta'];
		echo "<br>";
		$cuentac=$cuenta[0];
		//
		
		//
		//echo "CUENTA: ".$cuentac['cuenta']."<br>";
		$x=$cuentac['cuenta'];
		$_SESSION["cuentacli"]=$x;
		//echo "<table border='1'>";
//		echo "<tr>";
		/*echo "<td>"."cuenta"."</td>";
		echo "<td>"."nombre"."</td>";
		echo "<td>"."servicio"."</td>";		*/	
		echo "</tr>";	
		for($i=0;$i<=$cont-1;$i++)
		{	
			echo "<tr>";
			$cuentac=$cuenta[$i];
			echo "<div class='clear'></div>";
			echo "<div class='rowA'>";
			echo "<div class='rWC'>".$cuentac['cuenta'];
			echo "</div>";	
			echo "<div class='rWC'>".$cuentac['nombre']."</div>";
			echo "<div class='rWC'>".$cuentac['descServicio']."</div>";
			$servicio=$cuentac['servicio'];
			$descripcion=$cuentac['descServicio'];
			echo "<div class='rWS' onclick='buscar_items_de_cuenta(".$servicio.",\"".$descripcion."\")'><img src='../lib/save_en.gif'/></div>";
			/*echo "<td>";\"".$conty."\"
			echo "DESCRIPCION DE SERVICIO: ".$cuentac['descServicio']."</td>";	
			echo "<td>";
			echo "DETALLE: ".$cuentac['detalle']."</td>";
			echo "<td>";
			echo "MONEDA: ".$cuentac['moneda']."</td>";
			echo "<td>";
			echo "NOMBRE: ".$cuentac['nombre']."</td>";
			echo "<td>";
			echo "SERVICIO:";
			echo "<input type='submit' name='rservicio' value='".$cuentac['servicio']."' />"."</td>";	
			echo "</tr>";*/
			echo "</div>";
			echo "<div class='clear'></div> ";
		}
			
		//echo "</table>";
//		echo "___________________________________________________________";
		/*echo "<br>";
		echo "fecha: ".$fechaOperativa;
		echo "<br>";
		echo "Nro Operacion ".$nroOperacion;*/
	} 	
	
	//====PARAMETROS PARA EL SIGUIENTE MÓDULO====
	$_SESSION["fechaoperativa"]=$fechaOperativa;
	$_SESSION["nrooperacion"]=$nroOperacion;//echo $_SESSION["nrooperacion"];
	//$_SESSION["cuenta"]=$cuenta;
	//===========================================
	
}
else
{
	echo "introdusca sus datos en el campo de texto";
}

?>