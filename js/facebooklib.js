FB.init
	({
    appId      : '117132315001779', // App ID from the App Dashboard
    channelUrl : '//200.87.130.179/demo/smscss/index.php', // Channel File for x-domain communication  WWW.YOUR_DOMAIN.COM/channel.html
    status     : true, // check the login status upon init?
    cookie     : true, // set sessions cookies to allow your server to access the session?
    xfbml      : true  // parse XFBML tags on this page?
    });
 inicia_session();
FB.getLoginStatus(function(response) {
 	if (response.status === 'connected') 
	{
		//alert ("usuario conectado"); 
		mostrardiv("logueado");
		//cerrar("no_logueado")
		login(1);//location.reload(true);
		  	
	} 
	else {
   	
		//alert ("usuario no conectado");
		mostrardiv("no_logueado");
		//cerrar("logueado")
		
  	}
    });
	 
	 
  function login(sw)
  {
   	FB.login(function(response) 
		{perms="email,user_likes,status_update,publish_stream";
			
			if(sw==0)
			{
				location.reload(true);
			}
			
			if (response.authResponse) 
			{	
				FB.api('/me', 
				function(response) 
				{			
					if(response.first_name)
					{
						document.getElementById("name").value=response.first_name;
						document.getElementById("name").readOnly=true;
					}
					
					
					/*if(response.middle_name)
					{
						document.getElementById("materno").value=response.middle_name;
						document.getElementById("materno").readOnly=true;
					}*/
					
					if(response.last_name)
					{
						document.getElementById("paterno").value=response.last_name;
						document.getElementById("paterno").readOnly=true;
					}
					
	    			if(response.email)
					{
						document.getElementById("correo").value=response.email;
						document.getElementById("correo").readOnly=true;
					}

					document.getElementById("userid").value=response.id;
					var idf=response.id;
					verificar_idface(idf);		
					//mostrardiv("logueado");
				}
				);
						
				//TIENES PERMISOS
		
			}
			 else 
			{
			//	  clearDisplay();
            //user cancelled login or did not grant authorization
			location.reload(true);			
        	}
						
		}//,
		);
		
  }
  
  function buscar_cliente(nro_etiquetas)//buscar_cliente(id)
  {
	//alert (nro_etiquetas);
	var string_valores;
	for (var i=0;i<=nro_etiquetas-1;i++)
	{
		var id="txt"+i;
		valor=document.getElementById(id).value;
		string_valores=valor+",";
		//alert (valor);
	} 
	$('#loading').show();
	$.ajax({type: "POST",
			url: "ProyectoWSv2.1/buscarCliente.php",
			data:"valores_estiquetas="+string_valores,
				   success: function(msg)
				   {
					   $('#loading').hide();
					   $('#busca_cliente').html(msg);  						
				   }
		});				
					   		
  }
  
  function buscar_items_de_cuenta(servicio,descrip)
  {
	//alert (descrip);
	//alert (servicio);
	
	$('#loading').show();
	$.ajax({type: "POST",
			url: "ProyectoWSv2.1/buscarItemsDeCuenta.php",
			data: "servicio="+servicio+"&descripcion="+descrip,
				   success: function(msg)
				   {
					   $('#loading').hide();
					   $('#detalle').html(msg);  						
				   }
		});		
  }
  //
  function inicia_session()
  {
	//alert ("inicia session");
	$('#loading').show();
	$.ajax({url: "ProyectoWSv2.1/iniciaSession.php",
		   success: function(msg)
		   {
			   $('#loading').hide();
			   
		   }
		  });
		  //location.reload(true);										
	setTimeout("inicia_session();",200000);	   		
  }
   ///
   ID=window.setTimeout("Actualizar();",1000000);
function Actualizar() {
   contador ++;
   window.status="El contador esta ahora en " + contador + " segundos";
   document.msg.txt.value="El contador esta ahora en " + contador + " segundos";
// poné otro timeout para el siguiente contador
   ID=window.setTimeout("Actualizar();",1000);
}
   
  function servicios()
  {
	//alert ("servicios");
  	var lista = document.getElementById("modulos");
  	var codmod=lista.options[lista.selectedIndex].value;
	//alert (codmod);
	$('#loading').show();
	$.ajax({
		   type: "POST",
		   url: "ProyectoWSv2.1/obtenerCriteriosParaModulo.php",
		   data: "cod_modulo="+codmod,
		   success: function(msg)
		   {
			   $('#loading').hide();
		   	   $('#apDiv1').html(msg);
	  						
		  }
		  });
  } 
  
  function etiquetas()
  {
	//alert ("etiquetas");
  	var lista = document.getElementById("criterios");
  	var codetiqueta=lista.options[lista.selectedIndex].value;
	
	$('#loading').show();
			$.ajax({
				   type: "POST",
				   url: "ProyectoWSv2.1/etiquetas_de_busqueda.php",
				   data: "cod_etiqueta="+codetiqueta,
				   success: function(msg)
				   {
					   $('#loading').hide();
					   $('#apDiv2').html(msg);
					   						
					}
			 	});
  }  
   ///
  function verificar_idface(id)
  {
	$('#loading').show();
			$.ajax({
				   type: "POST",
				   url: "./verif.php",
				   data: "id_facebook="+id,
				   success: function(msg)
				   {
					   $('#loading').hide();
					   //alert(msg);
					   if(msg=='OK')
					   {
						   	inicia_session();
					   		document.getElementById("logueado").style.display="none";
							location.href="./tpl/lista_servicios.php";
					    	$('#boxTxt').fadeIn('slow');
						
					   }
					  
					  /* if(msg=='NO_S')
					   {
							document.getElementById("logueado").style.display=	"none";
							location.href="./pin.php";
					    	$('#boxTxt').fadeIn('slow');
						}
					 						
						if(msg=='NO')
						{
							mostrardiv("logueado");
						}*/
						
					}
			 	});inicia_session();
  }
      
  function logout()
  {
	  //alert ("logout");
       //document.getElementById('login').style.display = "none";
	   FB.logout(function(response) {
  		//alert(" user is now logged out");
		location.reload(true);
		});
		FB.api({ method: 'Auth.revokeAuthorization' }, 
		function(response) {clearDisplay()});//return false;
		//window.location.reload(true);
  }

      
  function streamPublish(name, description, hrefTitle, hrefLink, userPrompt)
  {
  	 FB.ui
  	 (
    	{
        	method: 'stream.publish',
        	message: '',
        	attachment: 
				{
        		name: name,
            	caption: '',
            	description: (description),
            	href: hrefLink
        		},
       		action_links: [{ text: hrefTitle, href: hrefLink } ],
	   		   user_prompt_message: userPrompt
		}	
	 );//fin FB.ui

  }
     
   function showStream()
   {
      FB.api('/me',
	  	function(response) 
	  	{
     	 	//console.log(response.id);
        	streamPublish(response.name, 'dn-esoftware.com contains geeky stuff', 'hrefTitle', 'http://dn-esoftware.com', "Share dn-esoftware.com");
      	}
	  
	  );
   }

   function share()
   {
       var share = 
	   {
       		method: 'stream.share',
       		u: 'http://dn-esoftware.com/'
       };

       FB.ui(share,
	  			 function(response) 
				 { console.log(response); }
			);
   }

   function graphStreamPublish()
   {
        var body = 'Reading New Graph api & Javascript Base FBConnect Tutorial';
        FB.api('/me/feed', 'post', { message: body }, 
		  
	    	function(response) 
			{
          		if (!response || response.error) 
		  		{
             		alert('Error occured');
          		}
		  		else 
		  		{
            		alert('Post ID: ' + response.id);
         		}
        	}
	  	
		);//fin FB.api
   }//fin graphStreamPublish
   
   function handleSessionResponse(response) {
        // if we dont have a session, just hide the user info
       if (response.authResponse) {
		 
            FB.api('/me', function(response) {
	      
		  alert (response.name);
		  
		
	    	});
		
		//TIENES PERMISOS
		   } else {
		//	  clearDisplay();
            //user cancelled login or did not grant authorization
          }
        //perms:'publish_stream';
		//scope="email,user_likes,status_update,publish_stream";
      }
	 function estado()
	 { 
	  	FB.getLoginStatus(function(response) {
	 	if (response.status == 'connected') 
		{
	   
    	
	 	 } else {
    	// the user isn't logged in to Facebook.
	  	}
		 });
	 
	 }
   	 
function cambia_clase(id)
{
	var cont=0;
	if(!id.value)
	{
		id.className="reqB";
	}
	else
	{
		id.className="inputC1";
	}
	
	
	if(document.getElementById("name").value)
	{	cont++;}
	else
	{	document.frmContent.enviar.disabled=true;
	}

	if(document.getElementById("paterno").value)
	{	cont++;}
	else
	{	document.frmContent.enviar.disabled=true;
	}
	
	if(document.getElementById("ci").value)
	{	cont++;}
	else
	{	document.frmContent.enviar.disabled=true;
	}	
	
	if(document.getElementById("phone").value)
	{	cont++;}
	else
	{	document.frmContent.enviar.disabled=true;
	}
	
	if(document.getElementById("correo").value)
	{	cont++;}
	else
	{	document.frmContent.enviar.disabled=true;
	}
	
	
	if(cont==5)
	{
		document.frmContent.enviar.disabled=false;
	}
}
function mostrardiv(id) {
//alert (id);
div = document.getElementById(id);

div.style.display = '';

}

function cerrar(id) {
//alert (id);
div = document.getElementById(id);

div.style.display='none';

}				