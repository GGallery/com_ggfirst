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
class ggpmControllerCorsi extends JControllerLegacy
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
        $this->_filterparam->data_inizio=JRequest::getVar('data_inizio');
        $this->_filterparam->data_fine=JRequest::getVar('data_fine');


    }
    public function insert(){

        $model=new ggpmModelCorsi();
        if($model->insert($this->_filterparam->titolo,$this->_filterparam->data_inizio,$this->_filterparam->data_fine)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggpmModelCorsi();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }
    public function modify(){

        $model=new ggpmModelCorsi();
        if($model->modify($this->_filterparam->id,
            $this->_filterparam->titolo,$this->_filterparam->data_inizio,$this->_filterparam->data_fine)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }


}
