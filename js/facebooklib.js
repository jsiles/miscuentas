FB.init
	({
    appId      : '117132315001779', // App ID from the App Dashboard
    channelUrl : '//200.87.130.179/demo/smscss/index.php', // Channel File for x-domain communication  WWW.YOUR_DOMAIN.COM/channel.html
    status     : true, // check the login status upon init?
    cookie     : true, // set sessions cookies to allow your server to access the session?
    xfbml      : true  // parse XFBML tags on this page?
    });
 
FB.getLoginStatus(function(response) {
 	if (response.status === 'connected') 
	{
		//alert ("usuario conectado"); 
		mostrardiv("logueado");
		login(1);//location.reload(true);
		  	
	} 
	else {
   	
		//alert ("usuario no conectado");
		mostrardiv("no_logueado");
		
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
      
  function logout()
  {
	  //alert ("logout");
       //document.getElementById('login').style.display = "none";
	   FB.logout(function(response) {
  		//alert(" user is now logged out");
		location.reload(true);
		});
		FB.api({ method: 'Auth.revokeAuthorization' }, 
		function(response) {clearDisplay		
		()});//return false;
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
	 	if (response.status === 'connected') 
		{
	   
    	
	 	 } else {
    	// the user isn't logged in to Facebook.
	  	}
		 });
	 
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