<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/preventivi.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggcmControllerPreventivi extends JControllerLegacy
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
        $this->_filterparam->id_cliente=JRequest::getVar('id_cliente');

        $this->_filterparam->budget=JRequest::getVar('budget');
        $this->_filterparam->id_stato_preventivo=JRequest::getVar('id_stato_preventivo');


    }
    public function insert(){

        $model=new ggcmModelPreventivi();
        if($model->insert($this->_filterparam->id_corso,$this->_filterparam->id_cliente,$this->_filterparam->budget,$this->_filterparam->id_stato_preventivo)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggcmModelPreventivi();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggcmModelPreventivi();
        if($model->modify($this->_filterparam->id,$this->_filterparam->id_corso,$this->_filterparam->id_cliente,$this->_filterparam->budget,$this->_filterparam->id_stato_preventivo)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }


}
