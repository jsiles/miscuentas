<?php require_once('nusoap/nusoap.php');
class wsSms
{
	 public $origen, $webservice, $consulta,$param;
	 public $cliente,$error,$conect=0;
	 function conectWSSMS()
	 {
		$this->origen='APWS';
		$webservice='https://smsws.caronte.sintesis.com.bo/WSSMS.php?wsdl'; 
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
		
	 }
	 
}
?>