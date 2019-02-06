<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/lezioni.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerLezioni extends JControllerLegacy
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
        $this->_filterparam->id_corso=JRequest::getVar('id_corso');
        $this->_filterparam->id_docente=JRequest::getVar('id_docente');
        $this->_filterparam->id_aula=JRequest::getVar('id_aula');
        $this->_filterparam->data=JRequest::getVar('data');
        $this->_filterparam->ora_inizio=JRequest::getVar('ora_inizio');
        $this->_filterparam->ora_fine=JRequest::getVar('ora_fine');
        $this->_filterparam->titolo=JRequest::getVar('titolo');
        $this->_filterparam->note=JRequest::getVar('note');


    }
    public function insert(){

        $model=new ggfirstModelLezioni();
        if($model->insert($this->_filterparam->id_corso,$this->_filterparam->id_docente,$this->_filterparam->id_aula,$this->_filterparam->data,$this->_filterparam->ora_inizio,
            $this->_filterparam->ora_fine,$this->_filterparam->titolo,$this->_filterparam->note)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggfirstModelLezioni();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggfirstModelLezioni();
        if($model->modify($this->_filterparam->id,
            $this->_filterparam->id_corso,$this->_filterparam->id_docente,$this->_filterparam->id_aula,$this->_filterparam->data,$this->_filterparam->ora_inizio,
            $this->_filterparam->ora_fine,$this->_filterparam->titolo,$this->_filterparam->note)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }


}
