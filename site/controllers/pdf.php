<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerPdf extends JControllerLegacy
{

    private $_user;
    private $_japp;
    public  $_params;


    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_japp = JFactory::getApplication();
        $this->_params = $this->_japp->getParams();
        $this->_filterparam = new stdClass();
        $this->_filterparam->data_attestato=JRequest::getVar('data_attestato');
        $this->_filterparam->id_attestato=JRequest::getVar('id_attestato');
        $this->_filterparam->nome=JRequest::getVar('nome');
        $this->_filterparam->cognome=JRequest::getVar('cognome');

        define('SMARTY_DIR', JPATH_COMPONENT.'/libraries/smarty/smarty/');
        define('SMARTY_COMPILE_DIR', JPATH_COMPONENT.'/models/cache/compile/');
        define('SMARTY_CACHE_DIR', JPATH_COMPONENT.'/models/cache/');
        define('SMARTY_TEMPLATE_DIR', JPATH_COMPONENT.'/models/templates/');
        define('SMARTY_CONFIG_DIR', JPATH_COMPONENT.'/models/');
        define('SMARTY_PLUGINS_DIRS', JPATH_COMPONENT.'/libraries/smarty/extras/');

    }

    public function generateAttestato() {

        try {


            $model = $this->getModel('pdf');

            $orientamento = "P";
            $user["nome"]=$this->_filterparam->nome;
            $user['cognome']=$this->_filterparam->cognome;
            //$this->_filterparam->data_attestato='2018-02-06';
            //$this->_filterparam->id_attestato=4;
            $model->_generate_pdf($user, $orientamento,$this->_filterparam->id_attestato, $this->_filterparam->data_attestato);

        }catch (Exception $e){

            DEBUGG::log($e, 'Exception in generateAttestato ', 1);
        }
        $this->_japp->close();
    }


}
