<?php
require ("clases/common.php");
require ('clases/bd.php');
require_once 'clases/Savant3.php';
require ('clases/wsregister.php');
require ('clases/wssms.php');

$obj=new Bd;

/*
$iduser=$db->tosql($_POST["userid"]);
$nombre=$db->tosql($_POST["name"]);
$apellido=$db->tosql($_POST["paterno"]);
$carnet=$db->tosql($_POST["ci"]);
$nrocelular=$db->tosql($_POST["phone"]);
$mail=$db->tosql($_POST["correo"]);
*/
$iduser=$_POST["userid"];//echo $iduser."<br>";
$nombre=$_POST["name"];
$apellido=$_POST["paterno"];
$carnet=$_POST["ci"];
$nrocelular=$_POST["phone"];
$mail=$_POST["correo"];

$array_datos=array(" ","$nombre",$apellido,"","$iduser",$mail,$nrocelular,"n");
//$db->query($obj->alta("tb_clientes",$array_datos,6));

$fecha=date("Ymd");
$fecha=(int)$fecha;
$hora=date("H:i");

$objregister =new wsRegister;
$objregister->conectSWRegister();

$param = array('userWS'=>'desalpz',
				'passwordWS'=>'e10adc3949ba59abbe56e057f20f883e',
				'idUser'=>$iduser,
				'cellPhone'=>$nrocelular,
				'dateRegister'=>$fecha,
				'hourRegister'=>$hora);
$result = $objregister->call('register',$param);
print_r($result);
$objsms =new wsSMS;
$objsms->conectWSSMS();
//Savant
$tpl = new Savant3();
$name = "pin";
$user=$nombre." ".$apellido;
$datos = array(
    array('nombre_usuario' => $user));

$tpl->title = $name;
$tpl->pin = $datos;
$tpl->display('tpl/pin_tpl.php');
?>