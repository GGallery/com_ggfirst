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

require_once JPATH_COMPONENT . '/models/clienti.php';
require_once JPATH_COMPONENT . '/models/corsi.php';

class ggfirstViewPreventivi extends JViewLegacy {

    public $preventivi;
    public $clienti;
    public $corsi;
    public $stati;
    public $offset;
    public $limit;



    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggfirst/libraries/css/bootstrap.min.css');
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
        $this->preventivi = $this->getModel()->getPreventivi(null, null, null,$offset, $limit,null);

        if(JRequest::getVar('search')!=null) {
            $nome_corso=JRequest::getVar('search');
            $this->preventivi = $this->getModel()->getPreventivi(null, $nome_corso, null, $offset, $limit,null);
        }

        if(JRequest::getVar('search_cliente')!=null) {
            $nome_cliente=JRequest::getVar('search_cliente');
            $this->preventivi = $this->getModel()->getPreventivi(null, null, $nome_cliente, $offset, $limit,null);
        }


        if(JRequest::getVar('search_stato')!=null) {
            $id_stato=JRequest::getVar('search_stato');
            $this->preventivi = $this->getModel()->getPreventivi(null, null, null, $offset, $limit,$id_stato);

        }

        $clientiModel=new ggfirstModelClienti();
        $this->clienti=$clientiModel->getClienti();
        $corsiModel=new ggfirstModelCorsi();
        $this->corsi=$corsiModel->getCorsi();
        $this->stati=$this->getModel()->getStati();

        //var_dump($this->corsi);die;


        parent::display($tpl);
    }
}
    