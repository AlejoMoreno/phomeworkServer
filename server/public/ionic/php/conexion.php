<?php
	
	function conexion()
	{
	    $db_connection =  mysqli_connect("phomework.com.co", "leizycom_admin", "david1234"); //cambiar usuario por osmed
	
        	if (!$db_connection) {
			echo 'conexion';
		    die('No pudo conectarse: ' . mysqli_error($db_connection));
		}
		//--------------------------------------------------------------
		mysqli_select_db($db_connection,"leizycom_phomework") or die(mysqli_error($db_connection));
		return $db_connection;

	}
?>