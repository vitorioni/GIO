<?php



//Aca se crea el bloque
class block_simplehtml extends block_list {
	public function init() {
		$this->title = get_string('Proyectos', 'block_simplehtml');
	}
	//con esto nuestro bloque desplegara algo
	public function get_content() {
		if ($this->content !== null) {
    return $this->content;
  }
 //agrega un link a una página de moodle dentro del bloque
  $this->content         = new stdClass;
  $this->content->items  = array();
  $this->content->icons  = array();
  $this->content->footer = '';
 //se añaden los links de pestañas en el bloque de la vista alumnos
  $this->content->items[] = html_writer::tag('a', 'Ver Proyectos', array('href' => 'http://localhost/moodle/local/alumnosVerProyectos/index.php'));
  $this->content->icons[] = html_writer::empty_tag('img', array('src' => '', 'class' => 'icon'));
  //$this->content->items[] = html_writer::tag('a', 'Mis proyectos', array('href' => 'http://localhost/moodle/local/alumnosMisProyectos/index.php'));
  //$this->content->icons[] = html_writer::empty_tag('img', array('src' => '', 'class' => 'icon'));
  
 
  return $this->content;
	}
	
	public function specialization() {
		if (isset($this->config)) {
			if (empty($this->config->title)) {
				$this->title = get_string('defaulttitle', 'block_simplehtml');
			} else {
				$this->title = $this->config->title;
			}
	
			if (empty($this->config->text)) {
				$this->config->text = get_string('defaulttext', 'block_simplehtml');
			}
		}
	}
	//permite la creacion de multiples bloques en un mismo curso
	public function instance_allow_multiple() {
		return true;
	}
}




