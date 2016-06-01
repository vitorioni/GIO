<?php

$host = "localhost";
$basededatos = "moodle";
$usuariodb = "root";
$clavedb = "";

$tabla_db1 = "proyectos";

error_reporting(0);

$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);

if($conexion->connect_errno)
{
	echo "Nuestro sitio experimenta fallos...";
	exit();
}