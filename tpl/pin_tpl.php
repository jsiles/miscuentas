<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Mis Cuentas</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!--<script src="http://connect.facebook.net/es_LA/all.js"></script>-->
	<!--<script src="js/facebooklib.js"></script>-->
	<!--<script src="../js/facebooklib.js"></script> -->
  <script type="text/javascript" src="js/jquery.js"></script> 
  
  
    <script src="http://connect.facebook.net/es_LA/all.js"></script>

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
</script>
  
  
  </head>
  
  
  <body>
  
  <div class="boxHeader" ><!-- style="display:none;"-->
	</div>
  <div class="clear"></div>
  <div class="clear"></div>
    <br />
     <div id="formContent"> <!-- style="display:none;"-->
     <p>
      
     </p>   
     
  <form class="formA" name="frmContent" action="pin.php" method="post">
    <fieldset>
		<p>
			<label class="lA">Pin: (*)</label>
			<input type="text" maxlength="30" name="pin" id="pin" value=""/>
		</p>
        <p>
			<label class="lA">&nbsp;</label>
            <input type="submit" name="Registrar" id="Registrar" value="Registrar" />
			<input type="submit" name="Nuevo_pin" value="Nuevo_pin" />

			<!--<a href="send" class="btnSend" onClick="">ENVIAR</a>-->
            <span id="loading" class="loadI" ><!-- style="display:none;"--></span>
            </p>
            
    </fieldset>
  </form>
  <div class="clear"></div>
    <br /><br /><br /><br /><br />
  </div>
  <div id="infoContent" ><!--style="display:none;" -->
    <!--<a href="#" onClick="logout()" target="_blank">Desinstalar</a> <br />-->
    
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
     
 </body> 
</html>
