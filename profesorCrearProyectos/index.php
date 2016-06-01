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
$PAGE->set_title('Crear Proyectos');

// Show the page header
echo $OUTPUT->header();

// Here goes the content
echo "<form method='POST' action='creado.php'>";
echo "<div align='center'>Por favor, completa todos los campos.</div><br>";
echo 'Nombre Proyecto: ';
echo "<input type='text' name='nombreproyecto'><br>";
echo 'Usuario de Profesor: ';
echo "<input type='text' name='profesor'>@uai.cl<br>";
echo 'Integrantes/Roles: <br>';
echo "<select name='select1'>";
if ($resultado1 = $mysqli->query("SELECT * FROM mdl_user WHERE lang='es'")) {
	printf("La seleccion devolvio %d filas.\n", $resultado->num_rows);
}
while($fila1=mysqli_fetch_assoc($resultado1)){
	echo "<option value=".$fila1['username'].">".$fila1['firstname']." " .$fila1['lastname']."</option>";
}
echo "</select>";

echo "<input type='text' name='rol1' value=''><br>";
echo "<select name='select2'>";
if ($resultado2 = $mysqli->query("SELECT * FROM mdl_user WHERE lang='es'")) {
	printf("La seleccion devolvio %d filas.\n", $resultado->num_rows);
}
while($fila2=mysqli_fetch_assoc($resultado2)){
	echo "<option value=".$fila2['username'].">".$fila2['firstname']." " .$fila2['lastname']."</option>";
}
echo "</select>";

echo "<input type='text' name='rol2' value=''><br>";
echo "<select name='select3'>";
if ($resultado3 = $mysqli->query("SELECT * FROM mdl_user WHERE lang='es'")) {
	printf("La seleccion devolvio %d filas.\n", $resultado->num_rows);
}
while($fila3=mysqli_fetch_assoc($resultado3)){
	echo "<option value=".$fila3['username'].">".$fila3['firstname']." " .$fila3['lastname']."</option>";
}
echo "</select>";

echo "<input type='text' name='rol3' value=''><br>";

echo "Descripcion: ";
echo "<textarea name='descripcion' rows='10' cols='40'></textarea><br>";

echo "<input type='submit' value='Crear Proyecto' class='btn btn-success' name='btn1'>";

	
echo "</form>";





// Show the page footer
echo $OUTPUT->footer();


