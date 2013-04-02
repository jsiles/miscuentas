<?php
// Pull in the NuSOAP code
require_once('./lib/nusoap.php');
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('wsComelecServer', 'urn:wsComelecServer');
// Register the data structures used by the service
$server->wsdl->addComplexType(
    'WsTransaccion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CodigoEmpresa' => array('name' => 'CodigoEmpresa', 'type' => 'xsd:int'),
	'CodigoRecaudacion' => array('name' => 'CodigoRecaudacion', 'type' => 'xsd:string'),
	'CodigoProducto' => array('name' => 'CodigoProducto', 'type' => 'xsd:string'),
	'NumeroPago' => array('name' => 'NumeroPago', 'type' => 'xsd:int'),
	'Fecha' => array('name' => 'Fecha', 'type' => 'xsd:int'),
	'Secuencial' => array('name' => 'Secuencial', 'type' => 'xsd:int'),
	'Hora' => array('name' => 'Hora', 'type' => 'xsd:int'),
	'OrigenTransaccion' => array('name' => 'OrigenTransaccion', 'type' => 'xsd:string'),
	'Pais' => array('name' => 'pais', 'type' => 'xsd:int'),
	'Departamento' => array('name' => 'Departamento', 'type' => 'xsd:int'),
	'Ciudad' => array('name' => 'Ciudad', 'type' => 'xsd:int'),	
	'Entidad' => array('name' => 'Entidad', 'type' => 'xsd:string'),
	'Agencia' => array('name' => 'Agencia', 'type' => 'xsd:string'),
	'Operador' => array('name' => 'Operador', 'type' => 'xsd:int'),
	'Monto' => array('name' => 'Monto', 'type' => 'xsd:double'),
	'LoteDosificacion' => array('name' => 'LoteDosificacion', 'type' => 'xsd:int', 'minOccurs'=>'0'),
	'NroRentaRecibo' => array('name' => 'NroRentaRecibo', 'type' => 'xsd:string'),
	'MontoCreditoFiscal' => array('name' => 'MontoCreditoFiscal', 'type' => 'xsd:double', 'minOccurs'=>'0'),
	'CodigoAutorizacion' => array('name' => 'CodigoAutorizacion', 'type' => 'xsd:string', 'minOccurs'=>'0'),
        'CodigoControl' => array('name' => 'CodigoControl', 'type' => 'xsd:string', 'minOccurs'=>'0'),
        'NitFacturar' => array('name' => 'NitFacturar', 'type' => 'xsd:string', 'minOccurs'=>'0'),
	'NombreFacturar' => array('name' => 'NombreFacturar', 'type' => 'xsd:string', 'minOccurs'=>'0'),
	'Transaccion' => array('name' => 'Transaccion', 'type' => 'xsd:string')
    )
);
$server->wsdl->addComplexType(
    'RespTransaccion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'CodError' => array('name' => 'CodError', 'type' => 'xsd:int'),
        'Descripcion' => array('name' => 'Descripcion', 'type' => 'xsd:string')
    )
);
// Register the method to expose
$server->register('datosTransaccion',                    // method name
    array('datos' => 'tns:WsTransaccion', 'user'=> 'xsd:string', 'password' => 'xsd:string'),   // input parameters
    array('return' => 'tns:RespTransaccion'),      // output parameters
    'urn:wsComelecServer',                         // namespace
    'urn:wsComelecServer#datosTransaccion',        // soapaction
    'rpc',                                    // style
    'encoded',                                     // use
    'Aqu&iacute; se describe la documentaci&oacute;n y tipos de error posibles'     // documentation
);
// Define the method as a PHP function
function datosTransaccion($datos, $user, $password) {
  // echo "datos recibidos:";		// acá se define lo que se hace con los parámetros de entrada
  //print_r($transacc); 
if(($user=='demo')&&($password=='demo')){
    $retval = array(
                'CodError' => 0,
                'Descripcion' => 'OK datos enviados:'
				. $datos['CodigoEmpresa'] . "|"
				. $datos['CodigoRecaudacion'] . "|"
				. $datos['CodigoProducto'] . "|"
				. $datos['NumeroPago'] . "|"
				. $datos['Fecha'] . "|"
				. $datos['Secuencial'] . "|"
				. $datos['Hora'] . "|"
				. $datos['Pais'] . "|"
				. $datos['Departamento'] . "|"
				. $datos['Ciudad'] . "|"
				. $datos['Entidad'] . "|"
				. $datos['Agencia'] . "|"
				. $datos['Operador'] . "|"
				. $datos['Monto'] . "|"
				. $datos['LoteDosificacion'] . "|"
				. $datos['NroRentaRecibo'] . "|"
				. $datos['MontoCreditoFiscal'] . "|"
				. $datos['CodigoAutorizacion'] . "|"
				. $datos['CodigoControl'] . "|"
				. $datos['NitFacturar'] . "|"
				. $datos['NombreFacturar'] . "|"
				. $datos['Transaccion'] . "|"
                );
}else{

	    $retval = array(
                'CodError' => 99,
                'Descripcion' => 'Usuario o Contraseña erroneos');
	}

 	return $retval; //new soapval('return', 'RespTransaccion', $retval, false, 'urn:wsComelecServer');
}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

// reference: http://www.scottnichol.com/nusoapprogwsdl.htm

?>
