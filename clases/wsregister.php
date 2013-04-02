<?php require_once('nusoap/nusoap.php');
class wsRegister
{
	 public $origen, $webservice, $consulta,$param;
	 public $cliente,$error,$conect=0;
	 function conectSWRegister()
	 {
		$this->origen='APWS';
		$webservice='https://smsws.caronte.sintesis.com.bo/WSRegister.php?wsdl'; 
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