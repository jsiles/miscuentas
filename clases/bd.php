<?php
//require ("common.php");
class Bd
{
	public $query;
	
	function alta($table,$valores,$nrodatos)
	{
		$query="insert into ".$table." values ('";
		foreach($valores as $v)
 		{
			$query=$query.$v."','";
 		}
		
		$query = substr($query, 0, -2);
		$query=$query.")";
		//echo "consulta ".$query;
	  	//$db->db_fill_array($query);
		return $query;
	}
	
	function mostrar_dqatos_user($iduser)
	{
		$iduser=int($iduser);
		$query="select count (*) 
				from clientes 
				where id_facebook='$iduser'";
		echo "------";
		return $query;
	}
	
	function aleatorio()
	{
		//-----GENERA PIN
		$pin=rand(1000,9999);
		///--------------
		return $pin;
	}
}
?>