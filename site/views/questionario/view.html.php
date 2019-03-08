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



class ggfirstViewQuestionario extends JViewLegacy {

    public $titolo_corso,$domande,$id_corso;




    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggfirst/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');

        $this->titolo_corso=JRequest::getVar('titolo_corso');
        $this->id_corso=JRequest::getVar('id_corso');
        $this->domande=[
            "Quantità di nozioni fornite",
            "Durata della lezione in base agli argomenti trattati",
            "Presenza di momenti di riflessione",
            "Livello di approfondimento degli argomenti trattati",
            "Competenze e capacità di comunicazione dei docenti",
            "Concretezza nella trattazione",
            "Chiarezza ed efficacia del docente",
            "Contenuti coerenti con gli obiettivi del corso",
            "Possibilità di intervenire e dialogare con il docente",
            "Qualità ed utilità del materiale didattico",
            "Interesse per gli argomenti trattati",
            "Utilità del corso per apprendere nuove informazioni",
            "Applicabilità nel quotidiano delle nozioni acquisite",
            "Qualità degli aspetti organizzativi e location del corso",
            "Giudizio complessivo sul corso"

        ];





        parent::display($tpl);
    }
}
    