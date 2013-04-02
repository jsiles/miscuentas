<?php session_start();
require_once('lib/nusoap.php');
require ('Bd.php');
$obj =new Bd;
$obj->conectSW();

$service=$_REQUEST["servicio"];
$desc_servicio=$_REQUEST["descripcion"];
/*echo "service ".$service;
echo "idoperativo ".$_SESSION["idoperativo"]."<br>";
echo "codModulo ".$_SESSION["codModulo"]."<br>";
echo "nrooperacion ".$_SESSION["nrooperacion"]."<br>";
echo "fechaoperativa ".$_SESSION["fechaoperativa"]."<br>";
echo "cuentacli ".$_SESSION["cuentacli"]."<br>";*/
$param = array('idOperativo'=>$_SESSION["idoperativo"],
				'codModulo'=>$_SESSION["codModulo"],
				'nroOperacion'=>$_SESSION["nrooperacion"],
				'fechaOperativa'=>$_SESSION["fechaoperativa"],
				'cuenta'=>$_SESSION["cuentacli"],
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

if($codError==15 || $codError==16 )
{
	echo $mensaje;
}
else
{
	if($codError!=0)
	{
		
		echo $mensaje;
		
	}
	else
	{
		$cont=count($item);
		//
		echo "<div class='bxRS'>";
        echo "<ul>";
          echo "<li class='img'><a href='#'><img src='lib/small_entel.jpeg' /></a></li>";
		echo "<li class='texts'>";
	      echo "<ul class='liOpt'>";
             echo "<li><span class='title'>Cuenta</span></li>";
             echo"<li><span>".$_SESSION['cuentacli']."</span></li>";
          echo "</ul>";
         echo "</li>";
         echo "<li class='texts'>";
	        echo "<ul class='liOpt'>";
             echo "<li><span class='title'>Servicio</span></li>";
             echo "<li><span>".$desc_servicio."</span></li>";
           echo "</ul>";
         echo "</li>";
         echo "<li class='texts2'>";
	        echo "<ul class='liOpt2'>";
             echo "<li><span class='title'>Periodo</span></li>";
             echo "<li><span>".substr($item['descItem'],-7)."</span></li>";
           echo "</ul>";
         echo "</li>";
         echo "<li class='texts'>";
	        echo "<ul class='liOpt'>";
             echo "<li><span class='title'>Monto</span></li>";
             echo "<li><span>".$item['monto']." ".$item['moneda']."</span></li>";
           echo "</ul>";
         echo "</li>";
		  echo "</ul>";
        
              echo "</div>";
		//
	/*	echo "<span style='color:blue'>";
		echo "Cambia Nit: ".$cambianit."<br>";
		echo "Depende de Item: ".$item['dependeDeItem']."<br>";
		echo "Descripcion: ".$item['descItem']."<br>";
		echo "Forma de pago: ".$item['formaPago']."<br>";//
		echo "Moneda: ".$item['moneda']."<br>";//
		echo "Monto: ".$item['descItem']."<br>";//
		echo "Nro. de Item: ".$item['nroItem']."<br>";
		
		$_SESSION["nroitem"]=$item['nroItem'];
		
		echo "Nit.factura: ".$nitfac."<br>";
		echo "Nombre del/la facturado/a: ".$nombrefac."<br>";
		echo "Requisito: ".$tienerequisito."<br>";
		echo "_________________________________________________________________________";
		echo "</span>";*/
	}
}

///-----VARIABLES SESSION-----
$_SESSION["servicio"]=$service;
///---------------------------
?>
