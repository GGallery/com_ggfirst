<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/docenti.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerDocenti extends JControllerLegacy
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
        $this->_filterparam->nome=JRequest::getVar('nome');
        $this->_filterparam->cognome=JRequest::getVar('cognome');
        $this->_filterparam->provincia=JRequest::getVar('provincia');
        $this->_filterparam->codice_fiscale=JRequest::getVar('codice_fiscale');
        $this->_filterparam->data_nascita=JRequest::getVar('data_nascita');
        $this->_filterparam->luogo_nascita=JRequest::getVar('luogo_nascita');
        $this->_filterparam->prov_nascita=JRequest::getVar('prov_nascita');
        $this->_filterparam->email=JRequest::getVar('email');
        $this->_filterparam->indirizzo=JRequest::getVar('indirizzo');
        $this->_filterparam->cap=JRequest::getVar('cap');
        $this->_filterparam->citta=JRequest::getVar('citta');
        $this->_filterparam->telefono=JRequest::getVar('telefono');
        $this->_filterparam->cellulare=JRequest::getVar('cellulare');
        $this->_filterparam->materie=JRequest::getVar('materie');
        $this->_filterparam->piva=JRequest::getVar('piva');

    }
    public function insert(){

        $model=new ggfirstModelDocenti();
        if($model->insert($this->_filterparam->nome,$this->_filterparam->cognome,$this->_filterparam->provincia,$this->_filterparam->codice_fiscale,$this->_filterparam->data_nascita,
            $this->_filterparam->luogo_nascita,$this->_filterparam->prov_nascita,$this->_filterparam->email,$this->_filterparam->indirizzo,$this->_filterparam->cap,
            $this->_filterparam->citta,$this->_filterparam->telefono,$this->_filterparam->cellulare,$this->_filterparam->materie,$this->_filterparam->piva)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggfirstModelDocenti();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggfirstModelDocenti();
        if($model->modify($this->_filterparam->id,
            $this->_filterparam->nome,$this->_filterparam->cognome,$this->_filterparam->provincia,$this->_filterparam->codice_fiscale,$this->_filterparam->data_nascita,
            $this->_filterparam->luogo_nascita,$this->_filterparam->prov_nascita,$this->_filterparam->email,$this->_filterparam->indirizzo,$this->_filterparam->cap,
            $this->_filterparam->citta,$this->_filterparam->telefono,$this->_filterparam->cellulare,$this->_filterparam->materie,$this->_filterparam->piva)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }


}
