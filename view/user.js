/**
 * The functions used to manage users from the user screens
 */

$(document).ready(function(){  
	
    $("button#userform").click(function() {  

    // we want to store the values from the form input box, then send via ajax below  
    var firstname     = $('#FIRSTNAME').attr('value');  
    var lastname     = $('#LASTNAME').attr('value'); 
    var username     = $('#USERNAME').attr('value');  
    var password     = $('#PASSWORD').attr('value');   
    var msisdn     = $('#MSISDN').attr('value');    
    var action     = $('#ACTION').attr('value');        
    var url =  "../service/user.php";
    var datastring = "ACTION=" + action + "&FIRSTNAME="+ firstname +"&LASTNAME="+ lastname + "&USERNAME="+ username +"&PASSWORD="+ password  +"&MSISDN="+ msisdn;	
    $.ajax({  
        type: "POST",  
        url: url,  
        data: datastring,  
        success:  function(xml){
        	var error = $(xml).find('error').eq(1).text();
        	alert($('#message').text()); 
			$("#message").text(error);
			alert($("#message").text());
        }  
    });  
    return false;  
    });  
}); 