<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/questionario.php';


/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggcmControllerQuestionario extends JControllerLegacy
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
        $this->_filterparam->id_corso=JRequest::getVar('id_corso');
        $this->_filterparam->data=JRequest::getVar('data');
        $this->_filterparam->risposta1=JRequest::getVar('risposta1');
        $this->_filterparam->risposta2=JRequest::getVar('risposta2');
        $this->_filterparam->risposta3=JRequest::getVar('risposta3');
        $this->_filterparam->risposta4=JRequest::getVar('risposta4');
        $this->_filterparam->risposta5=JRequest::getVar('risposta5');
        $this->_filterparam->risposta6=JRequest::getVar('risposta6');
        $this->_filterparam->risposta7=JRequest::getVar('risposta7');
        $this->_filterparam->risposta8=JRequest::getVar('risposta8');
        $this->_filterparam->risposta9=JRequest::getVar('risposta9');
        $this->_filterparam->risposta10=JRequest::getVar('risposta10');
        $this->_filterparam->risposta11=JRequest::getVar('risposta11');
        $this->_filterparam->risposta12=JRequest::getVar('risposta12');
        $this->_filterparam->risposta13=JRequest::getVar('risposta13');
        $this->_filterparam->risposta14=JRequest::getVar('risposta14');
        $this->_filterparam->risposta15=JRequest::getVar('risposta15');




    }
    public function insert(){

        $model=new ggcmModelQuestionario();
        if($model->insert($this->_filterparam->id_corso,
            $this->_filterparam->data,
            $this->_filterparam->risposta1,
            $this->_filterparam->risposta2,
            $this->_filterparam->risposta3,
            $this->_filterparam->risposta4,
            $this->_filterparam->risposta5,
            $this->_filterparam->risposta6,
            $this->_filterparam->risposta7,
            $this->_filterparam->risposta8,
            $this->_filterparam->risposta9,
            $this->_filterparam->risposta10,
            $this->_filterparam->risposta11,
            $this->_filterparam->risposta12,
            $this->_filterparam->risposta13,
            $this->_filterparam->risposta14,
            $this->_filterparam->risposta15

            )) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }




}
