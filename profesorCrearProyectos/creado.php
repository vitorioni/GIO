<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package local
 * @subpackage tics331
 * @copyright 2012-onwards Jorge Villalon <jorge.villalon@uai.cl>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$mysqli = new mysqli("localhost", "root", "", "moodle");
$mysqli = new mysqli("localhost", "root", "", "moodle", 3306);

// Minimum for Moodle to work, the basic libraries
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');


// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/profesorCrearProyectos'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Creacion de Proyecto');

// Show the page header
echo $OUTPUT->header();

// Here goes the content
echo "<div align='center'>";
		
$nombreproyecto = $_POST['nombreproyecto'];
$profesor = $_POST['profesor'];
$integrante1 = $_POST['select1'];
$rol1 = $_POST['rol1'];
$integrante2 = $_POST['select2'];
$rol2 = $_POST['rol2'];
$integrante3 = $_POST['select3'];
$rol3 = $_POST['rol3'];
$descripcion = $_POST['descripcion'];
if($result = $mysqli->query("SELECT roles FROM proyectos"))
{
	$row_cnt= $result->num_rows;
	printf("", $row_cnt);
	$result->close();
}
$row_cnt1=$row_cnt/3;


	$mysqli->query("INSERT INTO proyectos (nombreproyecto,profesor,integrante,roles,descripcion,codigo) values
			('$nombreproyecto','$profesor','$integrante1','$rol1','$descripcion','$row_cnt1')");

	$mysqli->query("INSERT INTO proyectos (nombreproyecto,profesor,integrante,roles,descripcion,codigo) values
			('$nombreproyecto','$profesor','$integrante2','$rol2','$descripcion','$row_cnt1')");

	$mysqli->query("INSERT INTO proyectos (nombreproyecto,profesor,integrante,roles,descripcion,codigo) values
			('$nombreproyecto','$profesor','$integrante3','$rol3','$descripcion','$row_cnt1')");
	echo "Proyecto Creado con Exito!";

echo "<br>";
echo "(<a href='http://localhost/moodle/index.php'>Volver</a>)";
// Show the page footer
echo $OUTPUT->footer();