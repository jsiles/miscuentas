// JavaScript Document
$(document).ready(function(){
				var options = {
					'maxCharacterSize': 90,
					'originalStyle': 'txtLimIn',
					'warningStyle' : 'txtLim',
					'warningNumber': 15,
					'displayFormat': 'Te restan #left caracteres'
				};
				$('#menssage').textareaCount(options);
				
				
				$('#phone').bind('click mouseenter mouseleave focus', function() {
				  $('#phone').removeClass('reqC').addClass('inputC');
				  $('#phone').removeClass('inputC1').addClass('inputC');
				  $('#boxTxtEr').fadeOut('slow');
				});
				$('#name').bind('click mouseenter mouseleave focus', function() {
				  $('#name').removeClass('reqB').addClass('inputB');
				  $('#name').removeClass('inputB1').addClass('inputB');
				  $('#boxTxtEr').fadeOut('slow');
				});
				$('#menssage').bind('click mouseenter mouseleave focus', function() {
				  $('#menssage').removeClass('txtarReq').addClass('txtar');
				  $('#menssage').removeClass('txtar1').addClass('txtar');
				  $('#boxTxtEr').fadeOut('slow');
				});
				
				$('#name').bind('mouseout focusout',function() {
				 $('#name').removeClass('inputB').addClass('inputB1');
				});
				
				$('#phone').bind('mouseout focusout',function() {
				 $('#phone').removeClass('inputC').addClass('inputC1');
				});
				
				$('#menssage').bind('mouseout focusout',function() {
				 $('#menssage').removeClass('txtar').addClass('txtar1');
				});
				
/*				  FB.ui(
				   {
					 method: 'stream.publish',
					 message: 'Carlos acaba de enviar SMSs VIVA a través de Facebook, hazlo tú también! http://apps.facebook.com/sms-viva'
				   }
				  );*/
				  
				/*    FB.ui(
				   {
					 method: 'stream.publish',
					 message: 'Envía SMS a celulares VIVA! http://apps.facebook.com/sms-viva'
				   }
				  );*/

});

function enviar(e)
{
	valId = $('#f1d232a321s23z9x6v5w1da2').val();
	if(e==valId)
	{
			sw=true;
			var phone = $('#phone').val();
			var name = $('#name').val();
			var menssage = $('#menssage').val();
			var token = $('#token').val();
		if (phone.length<8)
		{
			$('#phone').removeClass('inputC1').addClass('reqC');
			$('#boxTxtEr').html("El n&uacute;mero es requerido")
			$('#boxTxtEr').fadeIn('slow');
			sw=false;
		}
		if ( (phone.substr(0,2)!= 60) && (phone.substr(0,2)!= 70) && (phone.substr(0,2)!= 79)&&(phone.length==8) )
		{
			$('#phone').removeClass('inputB').addClass('req');
			$('#boxTxtEr').html("El n&uacute;mero debe ser de un usuario VIVA")
			$('#boxTxtEr').fadeIn('slow');
		   // setTimeout( function() { $('#boxTxtEr').fadeOut('slow'); }, 5000 );
			sw=false;
		}
		if (name.length<1)
		{
			$('#name').removeClass('inputB1').addClass('reqB');
			$('#boxTxtEr').html("El nombre es requerido")
			$('#boxTxtEr').fadeIn('slow');
			sw=false;
		}	
		if (menssage.length<1)
		{
			$('#menssage').removeClass('txtar').addClass('txtarReq');
			$('#boxTxtEr').html("El mensaje es requerido")
			$('#boxTxtEr').fadeIn('slow');
			sw=false;
		}	
		$('#phone').bind('click mouseenter mouseleave focus', function() {
		  $('#phone').removeClass('reqC').addClass('inputC');
		  $('#phone').removeClass('inputC1').addClass('inputC');
		  $('#boxTxtEr').fadeOut('slow');
		});
		$('#name').bind('click mouseenter mouseleave focus', function() {
		  $('#name').removeClass('reqB').addClass('inputB');
		  $('#name').removeClass('inputB1').addClass('inputB');
 		  $('#boxTxtEr').fadeOut('slow');
		});
		$('#menssage').bind('click mouseenter mouseleave focus', function() {
		  $('#menssage').removeClass('txtarReq').addClass('txtar');
		  $('#menssage').removeClass('txtar1').addClass('txtar');
		  $('#boxTxtEr').fadeOut('slow');
		});
				
		$('#name').bind('mouseout focusout',function() {
		 $('#name').removeClass('inputB').addClass('inputB1');
		});
		
		$('#phone').bind('mouseout focusout',function() {
		 $('#phone').removeClass('inputC').addClass('inputC1');
		});
		
		$('#menssage').bind('mouseout focusout',function() {
		 $('#menssage').removeClass('txtar').addClass('txtar1');
		});
		
		/*
		  data: "name="+name+"&phone="+phone+"&menssage="+menssage+"&token="+token+"&valId="+valId+"&uid="+FB.getSession().uid,
				 
		*/
		if(sw)
		{	
			$('#loading').show();
			$.ajax({
				   type: "POST",
				   url: "z1234d34s4re3d23f4r5s3a1sd2s23qa1121scxwss.php",
				   data: "name="+name+"&phone="+phone+"&menssage="+menssage+"&token="+token+"&valId="+valId+"&uid="+FB.getSession().uid,
				   success: function(msg){
					   $('#loading').hide();
					   //alert(msg);
					   if(msg=='OK') $('#boxTxt').fadeIn('slow');
					   else if (msg=='0xERR01') { 
					   	$('#boxTxtEr').html("Lo sentimos, pero has excedido tu cuota de mensajes por minuto. Recuerda que el l&iacute;mite por minuto es de 2 SMSs");
						$('#boxTxtEr').fadeIn('slow'); 
						limitTextAreaByCharacterCount();
						}
					   else if (msg=='0xERR02') { 
					   	$('#boxTxtEr').html("Lo sentimos, pero has excedido tu cuota de mensajes por d&iacute;a. Recuerda que el l&iacute;mite diario es de 25 SMSs");
						$('#boxTxtEr').fadeIn('slow');
						limitTextAreaByCharacterCount(); 
						}
					  else {
						$('#boxTxtEr').html("Lo sentimos, el mensaje no pudo ser enviado");
						$('#boxTxtEr').fadeIn('slow');
						}
					    setTimeout( function() { $('#boxTxt').fadeOut('slow'); $('#boxTxtEr').fadeOut('slow'); $('#menssage').val('');
						//var options = $.extend(options);
						$('#charleft').removeClass('txtLim').addClass('txtLimIn');
						$('#charleft').html('Te restan 90 caracteres');
						 }, 2000 );
				   }
			 });
				
		}
  	}
  	return false;
}