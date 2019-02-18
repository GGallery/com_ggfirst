<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/clienti.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerClienti extends JControllerLegacy
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
        $this->_filterparam->denominazione=JRequest::getVar('denominazione');
        $this->_filterparam->riferimento=JRequest::getVar('riferimento');
        $this->_filterparam->email=JRequest::getVar('email');
        $this->_filterparam->indirizzo=JRequest::getVar('indirizzo');
        $this->_filterparam->cap=JRequest::getVar('cap');
        $this->_filterparam->citta=JRequest::getVar('citta');
        $this->_filterparam->piva=JRequest::getVar('piva');
        $this->_filterparam->codice_univoco=JRequest::getVar('codice_univoco');
        $this->_filterparam->codice_fiscale=JRequest::getVar('codice_fiscale');
        $this->_filterparam->codice_ateco=JRequest::getVar('codice_ateco');

    }
    public function insert(){

        $model=new ggfirstModelClienti();
        if($model->insert($this->_filterparam->denominazione,$this->_filterparam->riferimento,$this->_filterparam->email,$this->_filterparam->indirizzo,$this->_filterparam->cap,$this->_filterparam->citta,$this->_filterparam->piva,$this->_filterparam->codice_univoco,$this->_filterparam->codice_fiscale,$this->_filterparam->codice_ateco)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggfirstModelClienti();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggfirstModelClienti();
        if($model->modify($this->_filterparam->id, $this->_filterparam->denominazione,$this->_filterparam->riferimento,$this->_filterparam->email,$this->_filterparam->indirizzo,$this->_filterparam->cap,$this->_filterparam->citta,$this->_filterparam->piva,$this->_filterparam->codice_univoco,$this->_filterparam->codice_fiscale,$this->_filterparam->codice_ateco)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }


}
