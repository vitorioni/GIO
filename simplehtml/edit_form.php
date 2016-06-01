<?php
//Se añaden las configuraciones necesarias para adaptar el bloque
class block_simplehtml_edit_form extends block_edit_form {

	protected function specific_definition($mform) {

		// Sección del título en lenguaje acordado	
		$mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

		// A sample string variable with a default value.
		$mform->addElement('text', 'config_text', get_string('blockstring', 'block_simplehtml'));
		$mform->setDefault('config_text', 'default value');
		$mform->setType('config_text', PARAM_RAW);
		//Personalizar título
		$mform->addElement('text', 'config_title', get_string('blocktitle', 'block_simplehtml'));
		$mform->setDefault('config_title', 'default value');
		$mform->setType('config_title', PARAM_TEXT);
	}
	public function instance_config_save($data, $nolongerused = false) {
		$data = stripslashes_recursive($data);
		$this->config = $data;
		return set_field('block_instance',
				'configdata',
				base64_encode(serialize($data)),
				'id',
				$this->instance->id);
		if(get_config('simplehtml', 'Allow_HTML') == '1') {
			$data->text = strip_tags($data->text);
		}
		// And now forward to the default implementation defined in the parent class
		return parent::instance_config_save($data,$nolongerused);
	}
}