// JavaScript Document

function addToDiv(data){
	str =data;
	
	
	el = document.getElementById('popup');
	el.innerHTML="";
	el.innerHTML=""+str;
	
	//$('#popup').center();
	$('#popup').css("position","absolute");
   //this.css("top", ( $(window).height() - this.height() ) / 2  + "px");
   $('#popup').css("top",  window.pageYOffset );
   $('#popup').css("left", ( $(window).width() - $('#popup').width() ) / 2 + "px");
	
	
	$( "#popup" ).hide();
	
	$('#popup').show( 300, function() {
 		
	});
	
$( "#popup" ).click(function() {
	$( "#popup" ).hide();
		
});	

$(document).mouseup(function (e)
{
    var container = $("#popup");
	if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
})	
	
}


$.fn.center = function () {
   this.css("position","absolute");
   //this.css("top", ( $(window).height() - this.height() ) / 2  + "px");
   this.css("top",  window.pageYOffset );
   this.css("left", ( $(window).width() - this.width() ) / 2 + "px");
   return this;
}
