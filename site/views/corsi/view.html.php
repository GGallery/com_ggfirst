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

require_once JPATH_COMPONENT . '/models/crediti.php';
require_once JPATH_COMPONENT . '/models/docenti.php';
require_once JPATH_COMPONENT . '/models/aule.php';
require_once JPATH_COMPONENT . '/models/luoghi.php';
require_once JPATH_COMPONENT . '/models/lezioni.php';
class ggfirstViewCorsi extends JViewLegacy {

    public $corsiAll;
    public $corso;
    public $crediti;
    public $offset;
    public $limit;
    public $id_corso;



    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggfirst/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');

        if(JRequest::getVar('id_corso')!=null) {
            $this->id_corso=JRequest::getVar('id_corso');
            $this->corso = $this->getModel()->getCorsi($this->id_corso, null)[0];
            $this->edizioni = $this->getModel()->getEdizioni(null, $this->id_corso);
            if(JRequest::getVar('id_edizione')!=null){
                $this->edizione = $this->getModel()->getEdizioni(JRequest::getVar('id_edizione'), null);
                $lezioniModel=new ggfirstModelLezioni();
                $this->lezioni=$lezioniModel->getLezioni(null,JRequest::getVar('id_edizione'),null,null);
            }
        }else{
            $this->edizioni = $this->getModel()->getEdizioni(null, null);
            $this->corso=[];
        }


        $this->corsiAll=$this->getModel()->getCorsi(null, null);
        $creditiModel=new ggfirstModelCrediti();
        $this->crediti=$creditiModel->getCrediti();
        $this->stati = $this->getModel()->getStati();
        $luoghiModel=new ggfirstModelLuoghi();
        $this->luoghi=$luoghiModel->getLuoghi();
        $auleModel=new ggfirstModelAule();
        $this->aule=$auleModel->getAule();
        $docentiModel=new ggfirstModelDocenti();
        $this->docenti=$docentiModel->getDocenti();
        parent::display($tpl);
    }
}
    