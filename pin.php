<?php
require ("clases/common.php");
require ('clases/bd.php');

$obj=new Bd;
require_once 'clases/Savant3.php';
require ('clases/wsregister.php');
require ('clases/wssms.php');

if(isset($_REQUEST["Registrar"]))
{
	//echo "Registrar";
	$pin_txt=get_param("pin");echo "pin txt ".$pin_txt."<br>";
	$cli_id=get_session('pin_cli_id');
	//echo "pin session ".get_session('clave');
	if($pin_txt==get_session('clave'))
	{
		//echo "CORRECTO!!";
		$db->query("UPDATE tb_clientes SET cli_activo='s' 
				WHERE cli_id='$cli_id'");
	?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL='tpl/lista_servicios.php'"><?php
	}
	else
	{
		echo "Pin incorrecto. Ingrese de nuevo su nro de Pin "."<br>";
	}
}

if(isSet($_REQUEST["Nuevo_pin"]))
{
	$pin=get_session('clave');
	$idface=get_session('idfacebook');
	$cli_id=get_session('pin_cli_id');
	$db->query("UPDATE tb_pin SET pin_activo='n' 
				WHERE pin_idfacebook='$idface' AND pin_clave='$pin'");
	
	$aleatorio=rand(1000,9999);	
	set_session('clave',$aleatorio);
	$fecha=date("Ymd");
	$fecha=(int)$fecha;
	$hora=date("H:i");
	$array_tb_pin=array(" ",$cli_id,$idface,$aleatorio,$fecha,$hora,"s");
	$db->query($obj->alta("tb_pin",$array_tb_pin,7));
	//------------------
	$objsms =new wsSms;
	$objsms->conectWSSMS();
	
	$iduser_ws="FK".$cli_id;
	$param_wsSMS = array('userWS'=>'desalpz',
						'passwordWS'=>'e10adc3949ba59abbe56e057f20f883e',
						'idUser'=>$iduser_ws,
						'message'=>$aleatorio);
	$result_sms = $objsms->call('sms',$param_wsSMS);
	
	echo "su nuevo nro. de pin ha sido enviado"."<br>";
}

if(isSet($_REQUEST["enviar"]))
{
	$sw_usuario_no_registrado=1;
	
	$iduser=get_param('userid');
	$nombre=get_param('name');
	$apellido=get_param('paterno');
	$carnet=get_param('ci');
	$nrocelular=get_param('phone');
	$mail=get_param('correo');
	
	set_session('idfacebook',$iduser);
	set_session('nombre_user',$nombre);
	set_session('apellido_user',$apellido);
	
	set_session('nrocelular_user',$nrocelular);
	set_session('mail_user',$mail);

	$array_datos=array(" ","$nombre",$apellido,"","$iduser",$mail,$nrocelular,"n");
	$db->query("select * from tb_clientes where cli_idfacebook='$iduser'");
	$nrf=$db->affected_rows();
	//verifica si ya fue registrado en la tabla tb_clientes
	if($nrf>0)
	{
		$db->query("SELECT cli_id FROM tb_clientes WHERE cli_idfacebook='$iduser'");
		
		if($db->next_record())
		{
			$cli_id=$db->f("cli_id");
			set_session('pin_cli_id',$cli_id);
			$sw_usuario_no_registrado=0;//usuario registrado
			
		}
	}
	else
	{
		
		$db->query($obj->alta("tb_clientes",$array_datos,8));
		$rs=$db->query("SELECT @@identity AS id
						from tb_clientes");
		
		while($db->next_record())
		{
			$cli_id=$db->f("id");
		}		
		set_session('pin_cli_id',$cli_id);
	}
	///
	if($sw_usuario_no_registrado==1)
	{
		echo "usuario no registrado"."<br>";			
		$fecha=date("Ymd");
		$fecha=(int)$fecha;
		$hora=date("H:i");

		$objregister =new wsRegister;
		$objregister->conectSWRegister();
		
		$iduser_ws="FK".$cli_id;
	
		$paramRegister = array('userWS'=>'desalpz',
							'passwordWS'=>'e10adc3949ba59abbe56e057f20f883e',
							'idUser'=>$iduser_ws,
							'cellPhone'=>$nrocelular,
							'dateRegister'=>$fecha,
							'hourRegister'=>$hora);
		$result = $objregister->call('register',$paramRegister);
	
		print_r($result);
		//----GENERA PIN----
		$aleatorio=rand(1000,9999);	
		set_session('clave',$aleatorio);
		//------------------
	
		$array_tb_pin=array(" ",$cli_id,$iduser,$aleatorio,$fecha,$hora,"s");
		$db->query($obj->alta("tb_pin",$array_tb_pin,7));
	
		$objsms =new wsSms;
		$objsms->conectWSSMS();
	
		$param_wsSMS = array('userWS'=>'desalpz',
						'passwordWS'=>'e10adc3949ba59abbe56e057f20f883e',
						'idUser'=>$iduser_ws,
						'message'=>$aleatorio);
		$result_sms = $objsms->call('sms',$param_wsSMS);
		printf($result_sms);echo "<br>";
	
	}
	else
	{
		echo "usuario registrado"."<br>";
		$db->query("select * from tb_clientes where cli_idfacebook='$iduser'");
		while($db->next_record())
		{
			echo "Bienvenido ".$db->f("cli_nombre")." ".
							   $db->f("cli_apellidopatetno")." ".
							   $db->f("cli_apellidomaterno");
			usleep (5000000);
			?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL='tpl/lista_servicios.html'"><?php
		}
		
	}
}


$tpl = new Savant3();
$name = "pin";
$user=$nombre." ".$apellido;
$datos = array(
array('nombre_usuario' => $user));

$tpl->title = $name;
$tpl->pin = $datos;
$tpl->display('tpl/pin_tpl.php');
	
//echo "<a href='pin.php'>"."nuevo pin"."</a>";

?>