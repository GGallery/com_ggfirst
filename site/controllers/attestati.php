<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/attestati.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerAttestati extends JControllerLegacy
{
    protected $_db;
    private $_app;
    private $params;
    private $_filterparam;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_app = JFactory::getApplication();
        $this->_filterparam = new stdClass();
        $this->_filterparam->id=JRequest::getVar('id');
        $this->_filterparam->id_studente=JRequest::getVar('id_studente');
        $this->_filterparam->numero=JRequest::getVar('numero');
        $this->_filterparam->data_attestato=JRequest::getVar('data_attestato');
        $this->_filterparam->certificatore=JRequest::getVar('certificatore');
        $this->_filterparam->id_credito=JRequest::getVar('id_credito');
        $this->_filterparam->scadenza=JRequest::getVar('scadenza');


    }
    public function insert(){

        $model=new ggfirstModelAttestati();
        if($model->insert($this->_filterparam->id_studente,$this->_filterparam->numero,$this->_filterparam->data_attestato,$this->_filterparam->certificatore,$this->_filterparam->id_credito,$this->_filterparam->scadenza)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggfirstModelAttestati();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggfirstModelAttestati();
        if($model->modify($this->_filterparam->id, $this->_filterparam->id_studente,$this->_filterparam->numero,$this->_filterparam->data_attestato,$this->_filterparam->certificatore,$this->_filterparam->id_credito,$this->_filterparam->scadenza)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

}
