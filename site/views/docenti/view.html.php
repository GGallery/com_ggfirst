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



class ggpmViewDocenti extends JViewLegacy {

    public $docenti;

    public $offset;
    public $limit;



    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggpm/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');

        if(JRequest::getVar('offset')!=null) {
            $offset = JRequest::getVar('offset');
        }else{
            $offset=0;
        }
        if(JRequest::getVar('limit')!=null) {
            $limit = JRequest::getVar('limit');
        }else{
            $limit=10;
        }

        if(JRequest::getVar('search')!=null) {
            $cognome=JRequest::getVar('search');
            $this->docenti = $this->getModel()->getDocenti(null, $cognome, $offset, $limit);
        }else{
            $this->docenti = $this->getModel()->getDocenti(null, null, $offset, $limit);
        }


        parent::display($tpl);
    }
}
    