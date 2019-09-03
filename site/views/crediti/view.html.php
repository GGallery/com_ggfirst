<?php

/**
 * @version		1
 * @package		webtv
 * @author 		antonio
 * @author mail	tony@bslt.it
 * @link
 * @copyright	Copyright (C) 2011 antonio - All rights reserved.
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

jimport('joomla.application.component.helper');



class ggcmViewCrediti extends JViewLegacy {

    public $crediti;


    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggcm/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggcm/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');

        $this->crediti=$this->getModel()->getCrediti();

        parent::display($tpl);
    }
}
    