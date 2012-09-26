var api_key = "AIzaSyBB6HqLtDRgrtj_UDuo-FeesCTTmNgLFd4";
var url = "https://maps.googleapis.com/maps/api/js?key="+api_key+"&sensor=false";
var elementId = "map_canvas";

function loadScript(url, callback)
{
	// adding the script tag to the head	
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = url+"&callback=initialize";
	
	var head = document.getElementsByTagName('head')[0];
	head.appendChild(script);	
}

function initialize() 
{
	var address = "Nieuweweg 75, 2544 Escamp";
		
	var myOptions = {
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	var map = new google.maps.Map(document.getElementById(elementId), myOptions);
	
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( { 'address': address}, function(results, status) {
      							if (status == google.maps.GeocoderStatus.OK) 
      							{
       								map.setCenter(results[0].geometry.location);
        							var marker = new google.maps.Marker({ map: map, position: results[0].geometry.location });
      							} 
      							else 
      							{
        							alert("Geocode was not successful for the following reason: " + status);
      							}
      						 });
}

window.onload = loadScript( url, initialize );

