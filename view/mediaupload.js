/**
 * The functions used to manage users from the user screens
 */

function mediaFileUpload() {
	
//shows/hides the ajax loading image while requests are being made
//$("#loading").ajaxStart(function(){$(this).show();}).ajaxComplete(function(){$(this).hide();});

$.ajaxFileUpload ({
			url:'../service/photoloader.php',
			secureuri:false,
			fileElementId:'file',
			success: function (data, status)  {
				if(typeof(data.error) != 'undefined') {
					alert(data.error);
				} else {
					//$("#image").append($(document.createElement("img")).attr({src: "uploads/"+data.msg,id:"jcrop"})).show(); // create image and append the html inside <div id=#image>
					$("#upload").slideUp();
				}
			}
		});
	return false;
}
