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
$PAGE->set_url(new moodle_url('/local/profesorAsignarProyectos'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Asignar Proyectos');

// Show the page header
echo $OUTPUT->header();

// Here goes the content
echo "<form method='POST' action='feedback.php'>";

global $USER;
$nom=$USER->username;
$cod=$_POST['cod'];
if($descripcion1= $mysqli->query("SELECT * FROM proyectos WHERE profesor='$nom' AND codigo='$cod' GROUP BY profesor" ))
{
	while ($row = mysqli_fetch_assoc($descripcion1))
	{
		echo "<font size='5'><div align='center'><b>{$row['nombreproyecto']}</b></font><br><br>";
		echo "<b>Descripcion del proyecto </b><br> {$row['descripcion']} <br>";
		echo "<b>Integrantes</b><br>";
	}
}
if($descripcion2= $mysqli->query("SELECT * FROM proyectos WHERE codigo='$cod'"))
{
	while($row1= mysqli_fetch_assoc($descripcion2))
	{
		printf ("%s \n", $row1['integrante']);
	}
}
echo "<hr>";
//Aquí se muestran los feedbacks que se han realizado a este proyecto
echo "<b>Bitacoras</b><br>";
if($descripcion4= $mysqli->query("SELECT bitacora FROM proy_carac WHERE codigo='$cod' AND feedback=''"))
{
	while($row2=mysqli_fetch_assoc($descripcion4))
	{
		printf ("<b>Bitacora</b>: %s \r<br>", $row2['bitacora']);
	}
}	
echo "<hr>";
//Aquí se muestran los feedbacks que se han realizado a este proyecto
echo "<b>Feedbacks</b><br>";
if($descripcion6= $mysqli->query("SELECT feedback FROM proy_carac WHERE codigo='$cod' AND bitacora=''"))
{
	while($row3=mysqli_fetch_assoc($descripcion6))
	{
		printf ("<b>Feedback</b>: %s \r<br>", $row3['feedback']);
	}
}
echo "<input type='hidden' name='cod1' value='$cod'>";
if($descripcion5= $mysqli->query("SELECT * FROM proyectos WHERE integrante='$nom' AND codigo='$cod'" ))
{
	echo "Ingese un feedback aqui: ";
	echo "<textarea name='fnuevo' rows='3' cols='40'></textarea><br>";
	echo "<input type='submit' value='Subir Feedback' class='btn btn-success' name='btn1'>";
}


echo "</form>";



// Show the page footer
echo $OUTPUT->footer();