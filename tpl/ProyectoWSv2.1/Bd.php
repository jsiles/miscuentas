<?php require_once('lib/nusoap.php');
class Bd
{
	 public $origen, $webservice, $consulta,$param;
	 public $cliente,$error,$conect=0;
	 function conectSW()
	 {
		$this->origen='APWS';
		$webservice='https://199.14.10.195:8082/ws2.1_ws/IntegradoWSService?WSDL'; //JOSÈ
//		$webservice='https://199.14.10.70:7006/ws2.1_ws/IntegradoWSService?wsdl';
		$this->cliente = new nusoap_client($webservice,'webservice');
		$error = $this->cliente->getError();
		//echo $cliente->getError();
		
		if ($error) 
	    {
			//echo "hay error"."<br>";
			print_r($cliente->getError());
    		return $error	;
    	}
		else
		{
			//echo "no hay error"."<br>";
			return $client;
		}
	 }
	 function call($consulta,$param)
	 { 
		$result = $this->cliente->call($consulta,$param,$webservice,true);
	    //print_r($this->client);
		if($result==null)
		{
			//echo "no hay datos";
			print_r($result);
		}
		else
		{
			return $result; 
		}
		//mi array

		//$salida=array("null","2","true","acceso al sistema no autorizado");
				///
		//var_dump ($salida);
		//return $salida; 
	 }
	 function dddd()
	 {
		 echo "hjhjhj";
	 }
}
?>