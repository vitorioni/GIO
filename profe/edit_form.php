
<?php

// se añaden las configuraciones necesarias para asi adaptar nuestro block
class block_profe_edit_form extends block_edit_form {
 
 
    protected function specific_definition($mform) {
 
        // seccion del titulo en lenguaje acordado
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
 
        
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_profe'));
        $mform->setDefault('config_text', 'default value');
        $mform->setType('config_text', PARAM_RAW);  
        // Personalizar titulo
        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_profe'));
        $mform->setDefault('config_title', 'default value');
        $mform->setType('config_title', PARAM_TEXT);
 
    }
    
}
