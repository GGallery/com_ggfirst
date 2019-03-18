<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/corsi.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerCorsi extends JControllerLegacy
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
        $this->_filterparam->titolo=JRequest::getVar('titolo');
        $this->_filterparam->id_corso=JRequest::getVar('id_corso');
        $this->_filterparam->codice_edizione=JRequest::getVar('codice_edizione');
        $this->_filterparam->stato=JRequest::getVar('stato');
        $this->_filterparam->minimo_partecipanti=JRequest::getVar('minimo_partecipanti');
        $this->_filterparam->credito=JRequest::getVar('credito');
        $this->_filterparam->riferimento_legislativo=JRequest::getVar('riferimento_legislativo');
        $this->_filterparam->programma=JRequest::getVar('programma','', 'get', 'string', JREQUEST_ALLOWHTML);



    }
    public function insert(){
//var_dump($this->_filterparam->programma);die;
        $model=new ggfirstModelCorsi();
        if($model->insert($this->_filterparam->titolo,$this->_filterparam->riferimento_legislativo,$this->_filterparam->programma)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function insertedizione(){

        $model=new ggfirstModelCorsi();
        if($model->insertedizioni($this->_filterparam->id_corso,$this->_filterparam->codice_edizione,$this->_filterparam->stato,$this->_filterparam->minimo_partecipanti)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggfirstModelCorsi();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggfirstModelCorsi();
        if($model->modify($this->_filterparam->id,
            $this->_filterparam->titolo,$this->_filterparam->riferimento_legislativo,$this->_filterparam->programma)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function modify_edizione(){

        $model=new ggfirstModelCorsi();
        if($model->modify_edizione($this->_filterparam->id,$this->_filterparam->codice_edizione,$this->_filterparam->stato,$this->_filterparam->minimo_partecipanti)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function insert_credito_corso(){

        $model=new ggfirstModelCorsi();
        if($model->insert_credito_corso($this->_filterparam->id,$this->_filterparam->credito)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();
    }


}
