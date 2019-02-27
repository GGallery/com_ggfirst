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
require_once JPATH_COMPONENT . '/models/crediti.php';
require_once JPATH_COMPONENT . '/models/corsi.php';

class ggfirstViewAttestati extends JViewLegacy {

    public $attestati,$studenti,$crediti,$corsi,$preselected_id_credito,$preselected_id_corso,$preselected_id_studente;


    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggfirst/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');

        if (JRequest::getVar('id_credito') != null) {
            $id_credito = JRequest::getVar('id_credito');
        } else {
            $id_credito = null;
        }

        if (JRequest::getVar('id_studente') != null) {
            $id_studente = JRequest::getVar('id_studente');
        } else {
            $id_studente = null;
        }

        if (JRequest::getVar('numero') != null) {
            $numero = JRequest::getVar('numero');
        } else {
            $numero = null;
        }

        if (JRequest::getVar('data_attestato') != null) {
            $data_attestato = JRequest::getVar('data_attestato');
        } else {
            $data_attestato = null;
        }

        if (JRequest::getVar('certificatore') != null) {
            $certificatore = JRequest::getVar('certificatore');
        } else {
            $certificatore = null;
        }

        if (JRequest::getVar('scadenza_data_minore') != null) {
            $scadenza_data_minore = JRequest::getVar('scadenza_data_minore');
        } else {
            $scadenza_data_minore = null;
        }

        if (JRequest::getVar('scadenza_data_maggiore') != null) {
            $scadenza_data_maggiore = JRequest::getVar('scadenza_data_maggiore');
        } else {
            $scadenza_data_maggiore = null;
        }

        if (JRequest::getVar('preselected_id_studente') != null) {
            $this->preselected_id_studente = JRequest::getVar('preselected_id_studente');
        } else {
            $this->preselected_id_studente = null;
        }

        if (JRequest::getVar('preselected_id_credito') != null) {
            $this->preselected_id_credito = JRequest::getVar('preselected_id_credito');
        } else {
            $this->preselected_id_credito = null;
        }

        if (JRequest::getVar('preselected_id_corso') != null) {
            $this->preselected_id_corso = JRequest::getVar('preselected_id_corso');
        } else {
            $this->preselected_id_corso = null;
        }

        $this->attestati=$this->getModel()->getAttestati(null,$id_studente,$numero,$data_attestato,$certificatore, $id_credito, null,$scadenza_data_minore,$scadenza_data_maggiore);
        $studentiModel=new ggfirstModelStudenti();
        $this->studenti=$studentiModel->getStudenti();
        $creditiModel=new ggfirstModelCrediti();
        $this->crediti=$creditiModel->getCrediti();
        $this->creditiaggiornamenti=$creditiModel->getCreditiAggiornamento();

        $corsiModel=new ggfirstModelCorsi();
        $this->corsi=$corsiModel->getCorsi();
        parent::display($tpl);
    }
}
    