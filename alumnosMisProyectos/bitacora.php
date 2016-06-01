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
// Minimum for Moodle to work, the basic libraries
$mysqli = new mysqli("localhost", "root", "", "moodle");
$mysqli = new mysqli("localhost", "root", "", "moodle", 3306);

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');


// Moodle pages require a context, that can be system, course or module (activity or resource)
$context = context_system::instance();
$PAGE->set_context($context);

// Check that user is logued in the course.
require_login();

// Page navigation and URL settings.
$PAGE->set_url(new moodle_url('/local/profesorAsignarProyectos'));
$PAGE->set_pagelayout('incourse');
$PAGE->set_title('Feedback');

// Show the page header
echo $OUTPUT->header();

// Here goes the content
echo "<div align='center'>";

$cod=$_POST['cod1'];
$bnueva=$_POST['bnueva'];

$mysqli->query("INSERT INTO proy_carac (codigo,bitacora,feedback) values('$cod','$bnueva','')");

echo "Bitacora Ingresada!";
echo "<br>";
echo "(<a href='http://localhost/moodle/local/alumnosVerProyectos/index.php'>Volver</a>)";
// Show the page footer
echo $OUTPUT->footer();