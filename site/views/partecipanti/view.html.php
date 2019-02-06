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

require_once JPATH_COMPONENT . '/models/studenti.php';
require_once JPATH_COMPONENT . '/models/corsi.php';

class ggfirstViewPartecipanti extends JViewLegacy {

    public $partecipanti;
    public $studenti;
    public $offset;
    public $limit;
    public $id_corso;
    public $corso;



    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggfirst/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');

        if (JRequest::getVar('id_corso') != null) {
            $this->id_corso=JRequest::getVar('id_corso');
            if (JRequest::getVar('offset') != null) {
                $offset = JRequest::getVar('offset');
            } else {
                $offset = 0;
            }
            if (JRequest::getVar('limit') != null) {
                $limit = JRequest::getVar('limit');
            } else {
                $limit = 10;
            }

            if (JRequest::getVar('search') != null) {
                $cognome = JRequest::getVar('search');
                $this->partecipanti = $this->getModel()->getPartecipanti(null,$this->id_corso, $cognome, $offset, $limit);
            } else {
                $this->partecipanti = $this->getModel()->getPartecipanti(null,$this->id_corso, null, $offset, $limit);
            }
            $studentiModel = new ggfirstModelStudenti();
            $this->studenti = $studentiModel->getStudenti(null,null,null,null);
            $corsiModel=new ggfirstModelCorsi();
            $this->corso=$corsiModel->getCorsi($this->id_corso,null,null,null);

            parent::display($tpl);
        }
    }
}
    