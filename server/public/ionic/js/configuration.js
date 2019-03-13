var encrypt = "phomework:wakusoft";

/**

 * @param String name

 * @return String

 */

function tokens(){
	$('#tokens').html(localStorage.getItem("tokens")+" Tokens");
}

function getParameterByName(name) {

    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),

    results = regex.exec(location.search);

    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

}

function formatearTel(this){
	var num_sf=document.getElementById(this).value;
	var num_cf='';
	num_cf=num_sf.substring(0,3)+"-";
	num_cf+=num_sf.substring(3,6)+"-";
	num_cf+=num_sf.substring(6,9);
	document.getElementById(this).value=num_cf;
}
