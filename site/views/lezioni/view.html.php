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

require_once JPATH_COMPONENT . '/models/docenti.php';
require_once JPATH_COMPONENT . '/models/aule.php';
require_once JPATH_COMPONENT . '/models/corsi.php';
class ggpmViewLezioni extends JViewLegacy {

    public $lezioni,$docenti,$aule,$corsi;





    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggpm/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');
        $this->lezioni = $this->getModel()->getLezioni();
        $auleModel=new ggpmModelAule();
        $this->aule=$auleModel->getAule();
        $docentiModel=new ggpmModelDocenti();
        $this->docenti=$docentiModel->getDocenti();
        $corsiModel=new ggpmModelCorsi();
        $this->corsi=$corsiModel->getCorsi();
        $this->calendario=$this->createCalendario();
        parent::display($tpl);
    }


    private function createCalendario(){

        $calendario=[];
        $calendarioaule=[];
        $prima_data=date_create(min(array_column($this->lezioni,'data')));
        $ultima_data=date_create(max(array_column($this->lezioni,'data')));
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($prima_data, $interval, $ultima_data->modify('+1 day'));

        $calendarrow=[''];
        $datecalendario=[];
        foreach($period as $dt){

            array_push($calendarrow,$dt);
            array_push($datecalendario,$dt);
        }


        foreach ($this->corsi[0] as $corso){
            $corsorow=[$corso['titolo']];
            foreach ($datecalendario as $dt){

                $lezione = $this->getModel()->getLezioni($corso['id'],null,date_format($dt,'Y-m-d'));

                        if ($lezione) {

                            array_push($corsorow, $lezione);
                        } else {

                            array_push($corsorow, null);
                        }

                    }


            array_push($calendario,$corsorow);
        }
        foreach ($this->aule[0] as $aula){
            $aularow=[$aula['denominazione']];
            foreach ($datecalendario as $dt){

                $lezione = $this->getModel()->getLezioni(null,$aula['id'],date_format($dt,'Y-m-d'));

                if ($lezione) {

                    array_push($aularow, $lezione);
                } else {

                    array_push($aularow, null);
                }

            }


            array_push($calendarioaule,$aularow);
        }

    return [$calendarrow,$calendario,$calendarioaule];
    }
}
    