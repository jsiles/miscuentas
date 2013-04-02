<?php session_start();
require_once('ProyectoWSv2.1/lib/nusoap.php');
require ('ProyectoWSv2.1/Bd.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Mis Cuentas</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
   
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script src="http://connect.facebook.net/es_LA/all.js"></script>
<!--  <script src="../js/facebooklib.js"></script> -->
<script src="../js/facebooklib.js"></script> 
<!--[if lt IE 7]>
        		<script type="text/javascript" src="js/unitpngfix.js"></script>
	<![endif]--> 
<script type="text/javascript">
$(document).ready(function() {

	//Default Action
	$(".tab_content").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab_content:first").show();
	
	//On Click Event
	$("ul.tabSt li").click(function() {
		$("ul.tabSt li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});

});
//inicia_session();
setTimeout("inicia_session();",3000);
</script>
  
  
</head>
  
  
<body>
<br />
<div class="clear"></div>
    <br />
    <div class="boxHeader" ><!-- style="display:none;"-->
	</div>
    
    <div id="formContent" >
  <div class="bxOptC">
        <div>
          <ul class="tabSt">
            <li class="active"><a href="#tab1">Descripci&oacute;n</a></li>
            <li><a href="#tab3">+ Registros</a></li>
            <li><a href="#tab4">Acerca de nosotros</a></li><a href="file:///C|/AppServ/www/sintesis/sms3/index.html">index</a>
            <!--<li><a href="#tab5">Comparar con otro m&oacute;vil</a></li>-->
          </ul>
          
          
          <div class="clear"></div>
          <div class="tab_cont3">
            <div id="tab3" class="tab_content">
              <div class="tabSn">
        <div class="conTableClose">  
        
        
        <div>
        <p>Consulta y adiciona a tu cuenta</p>
         <div class="clear"></div><br />     
         <form class="formA" name="frmContent" action="" method="post">
    <fieldset>
		<p>
			<label class="lA">Empresa:</label>
           <select maxlength="30" name="modulos" id="modulos" onchange="servicios()">
            <?php 	
				$obj =new Bd;
				$obj->conectSW();
	
				$idope=$_SESSION["idoperativo"];
				$consulta="obtenerModulos";
				$param = array('idOperativo'=>$idope);
				$result = $obj->call($consulta,$param);
				$CON=count($result);
				echo "lolololo";
				if($result)
				{
					foreach($result as $key => $val)
					{
						$modulos=$val['modulo'];
						$codError=$val['codError'];
						$mens=$val['mensaje'];
					}
					if($codError==15 || $codError==16 || $codError!=0)
					{
						$user="cajerweb";
						$password="123abc";
						$origen="APWS";
						$consulta="iniciarSesion";
						$param = array(
										'usuario' => $user,
										'password' => $password,
										'origenTransaccion'=>$origen);
		
						$result = $obj->call($consulta,$param);
						foreach($result as $key => $val)
						{
							$idope=$val['idOperativo'];
							$coderror=$val['codError'];
							$mens=$val['mensaje'];
						}

						$_SESSION["idoperativo"]=$idope;
        			}
					else
					{
						$cont=count($modulos);
						for($i=0;$i<=$cont-1;$i++)
						{
							$mod=$modulos[$i];
							$namesubmit=$i+1;
							echo "<option value='".$mod['codModulo']."'>";
							echo $mod['descripcion']."</option>";
						
						}
					}
				}
			 ?>
		   </select>
		</p>
        <p>
			<label class="lA">Servicio:</label>
             <div id="apDiv1"></div>
        </p>
       

        <p>
			<label class="lA">Telefono / Cuenta:</label>
            <div id="apDiv2"></div>
            
        </p>
        
        <p>
			<label class="lA">&nbsp;</label>
            
            <!--<input type="button" name="Buscar" id="Buscar" value="Buscar" onclick="buscar_cliente()" />-->
			<!--<a href="send" class="btnSend" onClick="">ENVIAR</a>-->
            <span id="loading" class="loadI" ><!-- style="display:none;"--></span>
            </p>
         <div >
           
         </div>
         <br />   
        <p>* El pin sera enviado al telefono consultado</p>    
    </fieldset>
  </form>
  		</div>
      <div class="clear"></div><br />
      
       <div id="buscaCli">
        
      		<div id="busca_cliente"></div>
         
       </div> 
        
        </div><!--conTableClose-->
       </div><!--tabSn-->
       <div class="clear"></div><br />
            </div><!--tab3-->
            
            
            
      <div id="tab4" class="tab_content">

      <img src="../lib/logosintesis.jpg" class="imgfloat"   />
      <div class="pfloat">
      <p>Sintesis es una empresa de TI (tecnología de información) que desde 1996 se especializa en transacciones en línea, desarrollando soluciones que se adaptan a las necesidades del mercado, para así poder brindar una solución especifica a cada negocio. Todos esto bajo el modelo de BPO y soportado por la capacidad y el compromiso de los recursos humanos.</p>
<br />
<span class="title">Mision:</span>
	<p>Facilitar y mejorar responsablemente las operaciones de nuestros clientes, mediante la creación y operación de modelos de negocios innovadores, usando nuestra plataforma tecnológica transaccional.</p>
<br />
<span class="title">Visión:</span>
	<p>Ser el principal proveedor de la industría transaccional en al menos tres países latinoamericanos antes del 2015.</p>
    </div>
<div class="clear"></div>
      </div>
    
    </div>
               
          
        </div>
       
        
      </div>
      <div class="clear"></div>
      <!---->
      <div id="tab1" class="tab_content">
              <h2>DETALLE</h2>
              <br />
              <div id="detalle" class="espLin"></div>
                      
        
              
              
              
              <div align="right"><form><input type="checkbox"/>Deseo recibir mail de las cuentas seleccionadas</form></div>
     <div class="clear"></div>
             
            </div>
      <!---->
  </div>
  
  <div class="boxFooter" ><!-- style="display:none;"-->
          <a href="http://www.sintesis.com" target="_blank" class="logos" title="Desarrollado por Sintesis">Desarrollado por Sintesis</a> 
</div>
  
  
  <div id="infoContent" ><!--style="display:none;" -->
    
   <a href="#" onClick="logout()"> Desinstalar </a>
    <div class="clear"></div>
    
    
	<p class="bold2">Recuerda:</p>
    
    
    
    <ul class="liOpt">
      <li>Puedes </li>
      <li>Puedes </li>
      <li>Solo se pueden </li>
      <li>No est&aacute; habilitada </li>
    </ul>
    
    <div class="clear"></div>
   
    <div class="txtInf" ><!--style="display:none;"-->
	NuevaTel PCS - VIVA no se hace responsable de los mensajes enviados a trav&eacute;s de Facebook.</div>
	<p class="small">Ya no quieres usar esta aplicaci&oacute;n, <!--<a href="desinstalar" onClick="FB.api({ method: 'Auth.revokeAuthorization' }, function(response) {clearDisplay()});return false;" id="disconnect" class="lnkSmall">desinst&aacute;lala aqu&iacute;</a>-->.</p>
    <a href="http://www.miscuentas.com" target="_blank" class="logos" title="Desarrollado por Sintesis">Desarrollado por Sintesis</a> </div>
     </div>
     <div id="apDiv3"></div>
</body> 
</html>
