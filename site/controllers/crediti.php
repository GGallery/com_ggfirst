<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/crediti.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggcmControllerCrediti extends JControllerLegacy
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
        $this->_filterparam->ruolo=JRequest::getVar('ruolo');
        $this->_filterparam->rischio=JRequest::getVar('rischio');
        $this->_filterparam->durata=JRequest::getVar('durata');
        $this->_filterparam->informazioni=JRequest::getVar('informazioni');
        $this->_filterparam->aggiornamento=JRequest::getVar('aggiornamento');

        $this->_filterparam->elearning=JRequest::getVar('elearning');
        $this->_filterparam->id_corso=JRequest::getVar('id_corso');

    }
    public function insert(){

        $model=new ggcmModelCrediti();
        if($model->insert($this->_filterparam->ruolo,$this->_filterparam->rischio,$this->_filterparam->durata,$this->_filterparam->informazioni,$this->_filterparam->aggiornamento,$this->_filterparam->elearning)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggcmModelCrediti();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggcmModelCrediti();
        if($model->modify($this->_filterparam->id, $this->_filterparam->ruolo,$this->_filterparam->rischio,$this->_filterparam->durata,$this->_filterparam->informazioni,$this->_filterparam->aggiornamento,$this->_filterparam->elearning)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function insert_map(){

        $model=new ggcmModelCrediti();
        if($model->insert_map($this->_filterparam->id_corso,$this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function delete_map(){

        $model=new ggcmModelCrediti();
        if($model->delete_map($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
}
