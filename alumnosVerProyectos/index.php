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
$PAGE->set_url(new moodle_url('/local/alumnosVerProyectos'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Ver proyectos');

// Show the page header
echo $OUTPUT->header();

// Here goes the content

echo "<form method='POST' action='index.php'>";

echo 'Ver Proyectos';
global $USER;
$nom=$USER->username;
echo "<br>";
echo "<select name='select1'>";
if ($resultado1 = $mysqli->query("SELECT * FROM proyectos WHERE integrante='$nom'")) {
	printf("La seleccion devolvio %d filas.\n", $resultado->num_rows);
}
while($fila1=mysqli_fetch_assoc($resultado1)){
	echo "<option value=".$fila1['codigo'].">".$fila1['nombreproyecto']."</option>";
}
echo "</select>";

echo "<input type='submit' value='Ver Proyecto' class='btn btn-success' name='btn1'>";

echo "</form>";
echo "<form method='POST' action='http://localhost/moodle/local/alumnosMisProyectos/index.php'>";
$codigo=$_POST['select1'];
echo "<input type='hidden' name='cod' value='$codigo'>";
if($descripcion1= $mysqli->query("SELECT * FROM proyectos WHERE integrante='$nom' AND codigo='$codigo'" ))
{
while ($row = mysqli_fetch_assoc($descripcion1))
{
	echo "<div align='center'><b>{$row['nombreproyecto']}</b></div><br>";
	echo "<b>Descripcion del proyecto </b>: {$row['descripcion']} <br>";
	echo "<b>Profesor </b>: {$row['profesor']} <br>";
	echo "<b>Tu Rol </b>: {$row['roles']} <br>";
	
	echo "<div align='center'> <input type='submit' value='Detalles del Proyecto' class='btn btn-success' name='btn1'></div>";
}
}
echo "</form>";




// Show the page footer
echo $OUTPUT->footer();